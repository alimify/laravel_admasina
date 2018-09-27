<?php

namespace App\Http\Controllers\FrontEnd;

use App\Book;
use App\Category;
use App\Language;
use App\Laraption;
use App\Post;
use App\Rating;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index(){
     $books = Book::latest()->where('is_active',true)
                            ->paginate(9);

     $articles = Post::latest()->where('is_active',true)
                               ->paginate(9);

     $bookCategories = Category::where('category_for','book')
                                 ->where('is_active',true)
                                 ->get();
     $postCategories = Category::where('category_for','post')
            ->where('is_active',true)
            ->get();


        return response()->view('frontend.home',compact('books','articles','bookCategories','postCategories'));
    }


    public function aboutus(){
        return response()->view('frontend.aboutus');
    }

    public function contactus(){
    return response()->view('frontend.contact');
    }

    public function privacy(){
    return response()->view('frontend.privacy');
    }

    public function language(){
        $languages = Language::where('is_active',true)->get();
     return response()->view('frontend.language',compact('languages'));
    }


    public function set_language($id){

        if(Auth::check() && Auth::id()) {
            Laraption::updateOrCreate(
                ['optkey' => 'user.setting.' . Auth::id().'.language'],
                ['optvalue' => $id]
            );
            Cookie::queue(Cookie::forget('language', $id));
        }else {
            Cookie::queue(Cookie::forever('language', $id));
        }
        return redirect()->back()->with('status','New Language Successfully Set.');
    }


    public  function sendcontactus(Request $request){

        $this->validate($request,[
            'email' => 'required|email',
            'name' => 'required|max:50',
            //'phone' => 'required',
            'subject' => 'required|max:80',
            'message' => 'required|max:1200',
            'file' => 'mimes:gif,jpeg,jpg,png,doc,docx,pdf,epub'
        ]);

        $data = [
            'email'   => $request->email,
            'name'    => $request->name,
            //'phone'   => $request->phone,
            'subject' => $request->subject,
            'body'    => $request->message,
            'file'    => $request->file('file')
        ];

        Mail::send('mail.contact',$data,function ($mail) use ($data){
            $mail->from($data['email'],$data['name']);
            $mail->to('contact@admasina.com');
            $mail->subject($data['subject']);
            if(isset($data['file']) && $data['file']){
            $mail->attach(
               $data['file']->getRealPath(),
               [
                   'as'   => $data['file']->getClientOriginalName(),
                   'mime' => $data['file']->getMimeType()
               ]
            );


            }
        });

        return redirect()->back()->with('status','Contact message successfully sent !');
    }



    public function viewArticle($id){

        $article = Post::find($id);
        $article->views = $article->views+1;
        $article->save();
        $articles = Post::take(4)->inRandomOrder()
                                 ->get();

        return response()->view('frontend.viewArticle',compact('article','articles'));
    }


    public function viewBook($id){
        $book = Book::find($id);
        $book->views = $book->views+1;
        $book->save();
        $books = Book::take(4)->inRandomOrder()
                              ->get();

        return response()->view('frontend.viewBook',compact('book','books'));
    }






    public function book($type = null,$id = null){
       if($type == 'category' && $id){
           $books = Category::find($id)->books()
                                       ->latest()
                                       ->where('books.is_active',true)
                                       ->paginate(Config::get('websettings.siteBookPerPage'));

       }elseif ($type == 'tag' && $id){

           $books = Tag::find($id)->books()
                                  ->latest()
                                  ->where('books.is_active',true)
                                  ->paginate(Config::get('websettings.siteBookPerPage'));

       }elseif($type && !$id){
           abort(404);
       }elseif(!$type && !$id){
           $books = Book::latest()->where('is_active',true)
                                  ->paginate(Config::get('websettings.siteBookPerPage'));
       }else{
           abort(404);
       }

        $bookCategories = Category::where('category_for','book')->where('is_active',true)
                                                                ->get();
        //var_dump($books);
        //return;
        return response()->view('frontend.book',compact('books','bookCategories'));
    }





    public function article($type = null,$id = null){

        $postCategories = Category::where('category_for','post')->where('is_active',true)
                                                                ->get();

        if($type == 'category' && $id){
            $articles = Category::find($id)->posts()
                                           ->latest()
                                           ->where('posts.is_active',true)
                                           ->paginate(Config::get('websettings.siteArticlePerPage'));
        }elseif ($type == 'tag' && $id){
            $articles = Tag::find($id)->posts()
                                      ->latest()
                                      ->where('posts.is_active',true)
                                      ->paginate(Config::get('websettings.siteArticlePerPage'));

        }elseif ($type == 'author' && $id){
            abort(404);
        }elseif ($type == 'translator' && $id){
            abort(404);
        } elseif($type && !$id){
            abort(404);
        }elseif(!$type && !$id){
            $articles = Post::latest()->where('is_active',true)
                                      ->paginate(Config::get('websettings.siteArticlePerPage'));
        }else{
            abort(404);
        }

        return response()->view('frontend.article',compact('postCategories','articles'));
    }



    public function comments(Request $request,$type,$id){
        if(!$type || !$id){
            abort(404);
        }
        $page = $request->page > 0 ? : 0;

        if($type == 'book'){
         $data = Book::find($id);
        }elseif ($type == 'post'){
         $data = Post::find($id);
        }

        $comments = $data->eightComments;

        return response()->view('frontend.comments',compact('comments'));
    }



    public function rating($type,$id,$rating){
        if(!$type || !$id){
            return;
        }

        if(Auth::check()) {
            Rating::updateOrCreate(
                ['book_id' => $id, 'user_id' => Auth::id()],
                ['rate' => $rating]
            );
        }

        $current_rating = Rating::where('book_id',$id)->avg('rate');

        return round($current_rating,1,PHP_ROUND_HALF_UP);
    }



    public function search(){
        return response()->view('frontend.search');
    }
}

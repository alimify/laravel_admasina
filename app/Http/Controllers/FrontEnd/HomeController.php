<?php

namespace App\Http\Controllers\FrontEnd;

use App\Book;
use App\Category;
use App\Language;
use App\Laraption;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{

    public function index(){
     $books = Book::latest()
                    ->where('is_active',true)
                    ->paginate(Config::get('websettings.siteBookPerPage'));

     $articles = Post::latest()
                       ->where('is_active',true)
                       ->paginate(Config::get('websettings.siteBookPerPage'));

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
                ['optkey' => 'user.language.' . Auth::id()],
                ['optvalue' => $id]
            );
            Cookie::forget('language');
        }else{
            Cookie::queue(Cookie::forever('language', $id));
        }

        return redirect()->back()->with('status','New Language Successfully Set.');
    }

    public  function sendcontactus(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'name' => 'required|max:50',
            'phone' => 'required',
            'message' => 'required|max:50',
            'file' => 'mimes:gif,jpeg,jpg,png,doc,docx,pdf,epub'
        ]);



        return $request;
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Book;
use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{


    public function index()
    {
        //
    }


    public function profile($id = 0)
    {

        $id = $id ? $id : Auth::id();

        if(!$id){
            return abort(404);
        }

        $user = User::find($id);

        return response()->view('user.profile.show',compact('user'));
    }



    public function editProfile()
    {
        if(!Auth::check()){
            return abort(404);
        }
        $user = User::find(Auth::id());

        return response()->view('user.profile.edit',compact('user'));
    }



    public function updateProfile(Request $request,$id = 0)
    {
        $id = $this->checkPermit($id);

        $this->validate($request,[
            'name' => 'required|min:5|max:30',
            'email' => 'required|email',
            'quote' => 'max:60',
            'image' => 'mimes:jpg,jpeg,png,bmp,gif'
        ]);

        $user = User::find($id);
        $image = $request->file('image');
        $link = $user->image;

        if(isset($image) && $image){
            $directory = 'profile';
            $link = "$directory/".uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }


            $proImage = Image::make($image)->resize(312,312)->save("temp/tmp.".$image->getClientOriginalExtension());
            Storage::disk('public')->put($link,$proImage);

        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $link;
        $user->quote = $request->quote;


        $user->save();

        if($request->response == 'json'){
            return response()->json([
                'status' => true,
                'id' => $user->id
            ]);
        }

        return redirect()->back()->with('status','Profile Successfully Updated.');
    }


    public function setting(User $id)
    {

    }


    public function updateSetting(User $id)
    {

    }

    public function password(){
        return response()->view('user.profile.password');
    }

    public function updatePassword(Request $request, $id = 0){
     $id = $this->checkPermit($id);
      $this->validate($request,[
          'old_password' => 'required',
          'new_password' => 'required|string|min:6|confirmed'
      ]);
      $user = User::find($id);
      if(!Hash::check($request->old_password, $user->password)){
          return redirect()->back()->with('status','Incorrect old password.');
      }
      $user->password = Hash::make($request->new_password);
      $user->save();

      if($request->response == 'json'){
            return response()->json([
                'status' => true,
                'id' => $user->id
            ]);
        }

      return redirect()->back()->with('status','Password Successfully Updated.');
    }


    public function makeComment(Request $request,$type,$id){
        if(!$type || !$id){
            return abort(404);
        }

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->comment_text = $request->message;
        if($type == 'book'){
        $comment->book_id = $id;
        }elseif ($type == 'post'){
        $comment->post_id = $id;
        }
        $comment->is_active = true;
        $comment->save();

        if($type == 'book') {
        $book = Book::find($id);
        $book->comments()->attach([$comment->id]);
        }elseif ($type == 'post'){
         $post = Post::find($id);
         $post->comments()->attach([$comment->id]);
        }


        return redirect()->back()->with('status','Comment Successfully Posted.');
    }


    private function checkPermit($id){
        $id = $id ? $id : Auth::id();
        $role = Auth::user()->Role->id;
        if($id){
            $id = ($role == 1 || $id == Auth::id()) ? $id : false;
        }
        if(!$id){
            return abort(404);
        }
        return $id;
    }

}

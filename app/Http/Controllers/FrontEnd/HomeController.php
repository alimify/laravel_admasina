<?php

namespace App\Http\Controllers\FrontEnd;

use App\Book;
use App\Category;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

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
     return response()->view('frontend.language');
    }
}

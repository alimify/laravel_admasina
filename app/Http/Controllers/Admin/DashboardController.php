<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Comment;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){

        /* Articles Data */
        $posts = Post::select('id', 'created_at')
            ->whereYear('created_at', Carbon::now()->year)
            ->get()
            ->groupBy(function($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $postmcount = [];
        $postArr = [];

        foreach ($posts as $key => $value) {
            $postmcount[(int)$key] = count($value);
        }
        for($i = 1; $i <= 12; $i++) {
            if (!empty($postmcount[$i])) {
                $postArr[$i] = $postmcount[$i];
            } else {
                $postArr[$i] = 0;
            }
        }
        /* Articles Data Ended*/


        /* Books Data */
        $books = Book::select('id', 'created_at')
            ->whereYear('created_at', Carbon::now()->year)
            ->get()
            ->groupBy(function($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $bookmcount = [];
        $bookArr = [];

        foreach ($books as $key => $value) {
            $bookmcount[(int)$key] = count($value);
        }
        for($i = 1; $i <= 12; $i++) {
            if (!empty($bookmcount[$i])) {
                $bookArr[$i] = $bookmcount[$i];
            } else {
                $bookArr[$i] = 0;
            }
        }
        /* Books Data Ended*/


        /* Users Data */
        $users = User::select('id', 'created_at')
            ->whereYear('created_at', Carbon::now()->year)
            ->get()
            ->groupBy(function($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }
        for($i = 1; $i <= 12; $i++) {
            if (!empty($usermcount[$i])) {
                $userArr[$i] = $usermcount[$i];
            } else {
                $userArr[$i] = 0;
            }
        }
        /* Users Data Ended*/


        /* Comments Data */
        $comments = Comment::select('id', 'created_at')
            ->whereYear('created_at', Carbon::now()->year)
            ->get()
            ->groupBy(function($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $commentmcount = [];
        $commentArr = [];

        foreach ($comments as $key => $value) {
            $commentmcount[(int)$key] = count($value);
        }
        for($i = 1; $i <= 12; $i++) {
            if (!empty($commentmcount[$i])) {
                $commentArr[$i] = $commentmcount[$i];
            } else {
                $commentArr[$i] = 0;
            }
        }
        /* Comments Data Ended*/


        return view('admin.main.dashboard',compact('postArr','bookArr','userArr','commentArr'));
    }

    public function mediaManager(){
        return response()->view('admin.mediamanager.index');
    }

    public function ajaxSuccess($route,$status,$rv = false){
        if($route == 'false'){
            return redirect()->back()->with('status',$status);
        }elseif ($rv){
            return redirect()->route($route,$rv)->with('status',$status);
        }
        return redirect()->route($route)->with('status',$status);
    }
}

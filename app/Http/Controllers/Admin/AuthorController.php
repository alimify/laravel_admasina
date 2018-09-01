<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::latest()->paginate(Config::get('websettings.adminItemPerPage'));
        return view('admin.author.index',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'mimes:bmp,png,jpg,jpeg,gif'
        ]);

        $title = $request->title;
        $slug = str_slug($title);
        $image = $request->file('image');
        $is_active = true;

        if(isset($image) && $image){

            if (!Storage::disk('public')->exists('author')) {
                Storage::disk('public')->makeDirectory('author');
            }
            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $tagImage = Image::make($image)->resize(500,333)->save('temp/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('author/'.$imageName,$tagImage);


        }else{
            $imageName = 'default.png';
        }

        $author = new Author();
        $author->title = $title;
        $author->slug = $slug;
        $author->is_active = $is_active;
        $author->image = $imageName;
        $author->save();
        return redirect()->back()->with('status','New Author Successfully Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('admin.author.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'mimes:bmp,png,jpg,jpeg,gif'
        ]);

        $title = $request->title;
        $slug = str_slug($title);
        $image = $request->file('image');
        $is_active = true;

        if(isset($image) && $image){


            if(Storage::disk('public')->exists('author/'.$author->image)){
                Storage::disk('public')->delete('author/'.$author->image);
            }


            if (!Storage::disk('public')->exists('author')) {
                Storage::disk('public')->makeDirectory('author');
            }
            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $tagImage = Image::make($image)->resize(500,333)->save('temp/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('author/'.$imageName,$tagImage);


        }else{
            $imageName = 'default.png';
        }

        $author->title = $title;
        $author->slug = $slug;
        $author->is_active = $is_active;
        $author->image = $imageName;
        $author->save();
        return redirect()->back()->with('status','Author Successfully Edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {

        if(Storage::disk('public')->exists('author/'.$author->image)){
            Storage::disk('public')->delete('author/'.$author->image);
        }
        $author->delete();
        return redirect()->back()->with('status','Author Successfully Deleted.');

    }
}

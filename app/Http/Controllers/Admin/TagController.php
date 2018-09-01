<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->paginate(Config::get('websettings.adminItemPerPage'));

        return view('admin.tag.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
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
          'title' => 'required|max:30',
          'image' => 'mimes:bmp,png,jpg,jpeg,gif'
      ]);


        $title = $request->title;
        $slug = str_slug($title);
        $image = $request->file('image');

        if(isset($image) && $image){
            if (!Storage::disk('public')->exists('tag')) {
                Storage::disk('public')->makeDirectory('tag');
            }
            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $tagImage = Image::make($image)->resize(500,333)->save('temp/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('tag/'.$imageName,$tagImage);


        }else{
            $imageName = 'default.png';
        }


      $tag = new Tag();
      $tag->title = $request->title;
      $tag->slug = str_slug($request->title);
      $tag->is_active = true;
      $tag->image = $imageName;
      $tag->save();
      return redirect()->back()->with('status','Tag Successfully Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $this->validate($request,[
            'title' => 'required|max:30',
            'image' => 'mimes:bmp,png,jpg,jpeg,gif'
        ]);


        $title = $request->title;
        $slug = str_slug($title);
        $image = $request->file('image');

        if(isset($image) && $image){


            if(Storage::disk('public')->exists('tag/'.$tag->image)){
                Storage::disk('public')->delete('tag/'.$tag->image);
            }


            if (!Storage::disk('public')->exists('tag')) {
                Storage::disk('public')->makeDirectory('tag');
            }
            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $tagImage = Image::make($image)->resize(500,333)->save('temp/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('tag/'.$imageName,$tagImage);


        }else{
            $imageName = 'default.png';
        }


        $tag->title = $title;
        $tag->slug = $slug;
        $tag->is_active = true;
        $tag->image = $imageName;
        $tag->save();
        return redirect()->back()->with('status','Tag Successfully Updated..');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {

        if(Storage::disk('public')->exists('tag/'.$tag->image)){
            Storage::disk('public')->delete('tag/'.$tag->image);
        }

        $tag->delete();
        return redirect()->back()->with('status','Tag Successfully Deleted.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->where('category_for','post')->paginate(Config::get('websettings.adminItemPerPage'));
        return view('admin.post.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.category.create');
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
            'image' => 'image'
        ]);

        $title = $request->title;
        $slug = str_slug($title);
        $image = $request->file('image');
        $category_for = 'post';
        $is_active = true;

        if(isset($image) && $image){

            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }

            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $categoryImage = Image::make($image)->resize(500,333)->save('temp/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('category/'.$imageName,$categoryImage);
        }else{
            $imageName = "default.png";
        }

        $category = new Category();
        $category->title = $title;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->category_for = $category_for;
        $category->is_active = $is_active;
        $category->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $postCategory)
    {
        return view('admin.post.category.edit',compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $postCategory)
    {


        $this->validate($request,[
            'title' => 'required',
            'image' => 'image'
        ]);

        $title = $request->title;
        $slug = str_slug($title);
        $image = $request->file('image');
        $category_for = 'post';
        $is_active = true;

        if(isset($image) && $image){

            if(Storage::disk('public')->exists('category/'.$postCategory->image)){
                Storage::disk('public')->delete('category/'.$postCategory->image);
            }

            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }

            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $categoryImage = Image::make($image)->resize(500,333)->save('temp/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('category/'.$imageName,$categoryImage);
        }else{
            $imageName = "default.png";
        }

        $postCategory->title = $title;
        $postCategory->slug = $slug;
        $postCategory->image = $imageName;
        $postCategory->category_for = $category_for;
        $postCategory->is_active = $is_active;
        $postCategory->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $postCategory)
    {

        if(Storage::disk('public')->exists('category/'.$postCategory->image)){
            Storage::disk('public')->delete('category/'.$postCategory->image);
        }

        $postCategory->delete();


        return redirect()->back();
    }
}

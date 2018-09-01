<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->where('category_for','book')->paginate(Config::get('websettings.adminItemPerPage'));
        return view('admin.book.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.book.category.create');
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
        $category_for = 'book';
        $is_active = true;

        if(isset($image) && $image){

            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }

            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $categoryImage = Image::make($image)->resize(500,333)->save('storage/category/tmp.'.$image->getClientOriginalExtension());
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

        return redirect()->back()->with('status','Book Category Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookCategory  $bookCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Category $bookCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookCategory  $bookCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $bookCategory)
    {
        return view('admin.book.category.edit',compact('bookCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookCategory  $bookCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $bookCategory)
    {

        $this->validate($request,[
            'title' => 'required',
            'image' => 'image'
        ]);

        $title = $request->title;
        $slug = str_slug($title);
        $image = $request->file('image');
        $category_for = 'book';
        $is_active = true;

        if(isset($image) && $image){

            if(Storage::disk('public')->exists('category/'.$bookCategory->image)){
                Storage::disk('public')->delete('category/'.$bookCategory->image);
            }

            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }

            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $categoryImage = Image::make($image)->resize(500,333)->save('storage/category/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('category/'.$imageName,$categoryImage);
        }else{
            $imageName = "default.png";
        }

        $bookCategory->title = $title;
        $bookCategory->slug = $slug;
        $bookCategory->image = $imageName;
        $bookCategory->category_for = $category_for;
        $bookCategory->is_active = $is_active;
        $bookCategory->save();

        return redirect()->back()->with('status','Book Category Successfully Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookCategory  $bookCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $bookCategory)
    {
        if(Storage::disk('public')->exists('category/'.$bookCategory->image)){
            Storage::disk('public')->delete('category/'.$bookCategory->image);
        }

        $bookCategory->delete();

        return redirect()->back()->with('status','Book Category Successfully Deleted');
    }
}

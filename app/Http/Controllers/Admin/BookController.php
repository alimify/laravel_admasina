<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Book;
use App\Category;
use App\Language;
use App\Tag;
use App\Translator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->paginate(Config::get('websettings.adminItemPerPage'));

        return view('admin.book.book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all()->where('category_for','book');
        $tags = Tag::all();
        $translators = Translator::all();
        $languages = Language::all()->where('is_active',true);

        return view('admin.book.book.create',compact('authors','categories','tags','translators','languages'));
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
           'description' => 'required',
           'image' => 'mimes:png,jpg,gif,jpeg,bmp',
           'language' => 'required'
       ]);

       $imagename = 'storage/book/default.png';
       $image = $request->file('image');
       $slug = str_slug($request->title);
       $dir = 'book';
       if(isset($image) && $image){

           if (!Storage::disk('public')->exists($dir)) {
               Storage::disk('public')->makeDirectory($dir);
           }
           $imagename = $dir.'/'.$slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

           $bookImage = Image::make($image)->resize(512,512)->save('temp/tmp.'.$image->getClientOriginalExtension());
           Storage::disk('public')->put($imagename,$bookImage);
           $imagename = 'storage/'.$imagename;
       }


       $book = new Book();
       $book->user_id = Auth::id();
       $book->is_active = $request->active ? true : false;
       $book->image = $imagename;
       $book->title = $request->title;
       $book->language_id = $request->language;
       $book->description = $request->description;
       $book->book_link = $request->book_link;
       $book->save();
       $book->authors()->attach($request->author);
       $book->tags()->attach($request->tag);
       $book->translators()->attach($request->translator);
       $book->categories()->attach($request->category);

       return redirect()->route('admin.book.index')->with('status','Book Successfully Added');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('admin.book.book.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all()->where('category_for','book');
        $tags = Tag::all();
        $translators = Translator::all();
        $languages = Language::all()->where('is_active',true);


        $mainBookAuthors = $book->authors;
        $mainBookTranslators = $book->translators;
        $mainBookCategories = $book->categories;
        $mainBookTags = $book->tags;

        $authorIdArray = [];
        foreach ($mainBookAuthors as $singleAuthorData){
            $authorIdArray[] = $singleAuthorData->id;
        }


        $translatorIdArray = [];
        foreach ($mainBookTranslators as $singleTranslatorData){
            $translatorIdArray[] = $singleTranslatorData->id;
        }

        $categoryIdArray = [];
        foreach ($mainBookCategories as $singleCategoryData){
            $categoryIdArray[] = $singleCategoryData->id;
        }

        $tagIdArray = [];
        foreach ($mainBookTags as $singleTagData){
            $tagIdArray[] = $singleTagData->id;
        }

        return view('admin.book.book.edit',compact('authors','book','languages','translators','tags',
            'categories','authorIdArray','translatorIdArray','categoryIdArray','tagIdArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,gif,jpg,jpeg,bmp',
            'language' => 'required'
        ]);

        $imagename = $book->image;
        $image = $request->file('image');
        $slug = str_slug($request->title);
        $dir = 'book';

        if(isset($image) && $image){

            $exist_image = $this->rmstorage($book->image);
            if(Storage::disk('public')->exists($exist_image)){
                Storage::disk('public')->delete($exist_image);
            }

            $imagename = $dir.'/'.$slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $bookImage = Image::make($image)->resize(512,512)->save('temp/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put($imagename,$bookImage);
            $imagename = 'storage/'.$imagename;

        }


        $book->user_id = Auth::id();
        $book->is_active = $request->active ? true : false;
        $book->image = $imagename;
        $book->title = $request->title;
        $book->language_id = $request->language;
        $book->description = $request->description;
        $book->book_link = $request->book_link;
        $book->save();
        $book->authors()->sync($request->author);
        $book->tags()->sync($request->tag);
        $book->translators()->sync($request->translator);
        $book->categories()->sync($request->category);

        return redirect()->back()->with('status','Book Successfully Edited..');
    }

    public function changeStatus(Book $book){
     $book->is_active = !$book->is_active;
     $book->save();
     return redirect()->back()->with('status','Book Status Successfully Updated..');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $exist_image = $this->rmstorage($book->image);
        if(Storage::disk('public')->exists($exist_image)){
            Storage::disk('public')->delete($exist_image);
        }

        $book->tags()->detach();
        $book->authors()->detach();
        $book->translators()->detach();
        $book->categories()->detach();
        $book->delete();

        return redirect()->route('admin.book.index')->with('status','Book Successfully deleted..');
    }

    public function rmstorage($storage){
        return str_replace('storage/','',$storage);
    }

}

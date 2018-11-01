<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Translator;
use App\Category;
use App\Language;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(Config::get('websettings.adminItemPerPage'));
        return view('admin.post.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $translators = Translator::all();

        $languages = Language::all()->where('is_active',true);
        $categories = Category::all()->where('category_for','=','post');
        $tags = Tag::all();


        return view('admin.post.post.create',compact('authors','translators','languages','categories','tags'));
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
            'image' => 'mimes:jpg,jpeg,png,bmp,gif',
            'language' => 'required'
        ]);

        $image = $request->file('image');
        $dir = 'post';
        $imageName = 'storage/'.$dir.'/default.png';

        if(isset($image) && $image){
            $imageName = uniqid().str_slug(Carbon::now()).'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }

            $postImage = Image::make($image)->resize(512,350)->save('storage/'.$dir.'/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put($dir.'/'.$imageName,$postImage);

            $imageName = 'storage/'.$dir.'/'.$imageName;

        }


            $post = new Post();
            $post->user_id = Auth::id();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->language_id = $request->language;
            $post->image = $imageName;
            $post->is_active = $request->active ? true : false;
            $post->views = 0;
            $post->save();
            $post->authors()->attach($request->author);
            $post->translators()->attach($request->translator);
            $post->categories()->attach($request->category);
            $post->tags()->attach($request->tag);

            return redirect()->route('admin.post.index')->with('status','Post Successfully Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->view('admin.post.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $authors = Author::all();
        $translators = Translator::all();
        $languages = Language::all()->where('is_active',true);
        $categories = Category::all()->where('category_for','=','post');
        $tags = Tag::all();

        $postMainAuthors = $post->authors;
        $postMainTranslators = $post->translators;
        $postMainCategories = $post->categories;
        $postMainTags = $post->tags;

        /*Start Processing*/

        $authorIdArray = [];
        foreach ($postMainAuthors as $singleAuthorData){
            $authorIdArray[] = $singleAuthorData->id;
        }


        $translatorIdArray = [];
        foreach ($postMainTranslators as $singleTranslatorData){
            $translatorIdArray[] = $singleTranslatorData->id;
        }



        $categoryIdArray = [];
        foreach ($postMainCategories as $singlePostMainCategory){
            $categoryIdArray[] = $singlePostMainCategory->id;
        }

        $tagIdArray = [];
        foreach ($postMainTags as $singlePostMainTag){
            $tagIdArray[] = $singlePostMainTag->id;
        }

        return view('admin.post.post.edit',compact('post','authors','translators','languages','categories','tags',
            'categoryIdArray','tagIdArray','authorIdArray','translatorIdArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,png,gif,bmp',
            'language' => 'required'
        ]);

        $image = $request->file('image');
        $dir   = 'post';

        if(isset($image) && $image){
            $imageName = uniqid().str_slug(Carbon::now()).'.'.$image->getClientOriginalExtension();

            if(Storage::disk('public')->exists($this->rmstorage($post->image))){
                Storage::disk('public')->delete($this->rmstorage($post->image));
            }

            $postImage = Image::make($image)->resize(512,350)->save('storage/'.$dir.'/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put($dir.'/'.$imageName,$postImage);

            $post->image = 'storage/'.$dir.'/'.$imageName;

        }

            $post->title = $request->title;
            $post->description = $request->description;
            $post->language_id = $request->language;
            $post->is_active = $request->active ? true : false;
            $post->save();
            $post->authors()->sync($request->author);
            $post->translators()->sync($request->translator);
            $post->categories()->sync($request->category);
            $post->tags()->sync($request->tag);

            return redirect()->back()->with('status','Post Successfully Updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists($this->rmstorage($post->image))){
            Storage::disk('public')->delete($this->rmstorage($post->image));
        }

        $post->tags()->detach();
        $post->authors()->detach();
        $post->translators()->detach();
        $post->categories()->detach();
        $post->delete();

        return redirect()->route('admin.post.index')->with('status','Post Successfully Deleted.');
    }


    public function changeStatus(Post $post){
        $post->is_active = !$post->is_active;
        $post->save();
        return redirect()->back()->with('status','Post Status Successfully Updated..');
    }

    public function rmstorage($storage){
        return str_replace('storage/','',$storage);
    }
}

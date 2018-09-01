<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Description;
use App\Language;
use App\Post;
use App\Tag;
use App\Title;
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
        $languages = Language::all();
        $categories = Category::all()->where('category_for','=','post');
        $tags = Tag::all();

        $langData = [];

        foreach ($languages as $language){
            $langData[$language->id] = [
                'langId' => $language->id,
                'title' => '',
                'description' => ''
            ];
        }

        return view('admin.post.post.create',compact('languages','categories','tags',
            'langData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mainData = json_decode($request->data);
        $createPost = false;
        $imageName = 'default.png';
        $image = $request->file('image');

        $descriptionData = [];
        $titleData = [];
        foreach ($mainData->langData as $langData){
            $descriptionData[] = [
                'language_id' => $langData->langId,
                'description_id' => $this->addDescription($langData->description)
            ];
            $titleData[] = [
                'language_id' => $langData->langId,
                'title_id' => $this->addTitle($langData->title)
            ];
            if($langData->title){
                $createPost = true;
            }
        }

        if(isset($image) && $image){
            $imageName = uniqid().str_slug(Carbon::now()).'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            $postImage = Image::make($image)->resize(512,350)->save('temp/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('post/'.$imageName,$postImage);

        }



        if($createPost){
            $post = new Post();
            $post->user_id = Auth::id();
            $post->image = $imageName;
            $post->is_active = $mainData->active;
            $post->views = 0;
            $post->save();
            $post->titles()->attach($titleData);
            $post->descriptions()->attach($descriptionData);
            $post->categories()->attach($mainData->category);
            $post->tags()->attach($mainData->tag);

           return response()->json([
                'status' => true,
                'id' => $post->id
            ]);
        }

        return response()->json([
            'status' => false
        ]);

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
        $languages = Language::all();
        $categories = Category::all()->where('category_for','=','post');
        $tags = Tag::all();

        $postMainTitles = $post->titles;
        $postMainDescriptions = $post->descriptions;
        $postMainCategories = $post->categories;
        $postMainTags = $post->tags;

        /*Start Processing*/
        $postMainTitleKey = [];
        foreach ($postMainTitles as $singlePostMainTitle){
            $postMainTitleKey[$singlePostMainTitle->pivot->language_id] = $singlePostMainTitle;
        }

        $postMainDescriptionKey = [];
        foreach ($postMainDescriptions as $singlePostMainDescription){
            $postMainDescriptionKey[$singlePostMainDescription->pivot->language_id] = $singlePostMainDescription;
        }

        $langData = [];
        foreach ($languages as $language){
            $langData[$language->id] = [
                'langId' => $language->id,
                'title' => $postMainTitleKey[$language->id]->title ??'',
                'description' => $postMainDescriptionKey[$language->id]->description ??''
            ];
        }

        $categoryIdArray = [];
        foreach ($postMainCategories as $singlePostMainCategory){
            $categoryIdArray[] = $singlePostMainCategory->id;
        }

        $tagIdArray = [];
        foreach ($postMainTags as $singlePostMainTag){
            $tagIdArray[] = $singlePostMainTag->id;
        }

        return view('admin.post.post.edit',compact('post','languages','categories','tags','langData',
            'categoryIdArray','tagIdArray'));
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
        $post->titles()->delete();
        $post->descriptions()->delete();

        $mainData = json_decode($request->data);
        $imageName = $post->image;
        $image = $request->file('image');

        $descriptionData = [];
        $titleData = [];
        foreach ($mainData->langData as $langData){
            $descriptionData[] = [
                'language_id' => $langData->langId,
                'description_id' => $this->addDescription($langData->description)
            ];
            $titleData[] = [
                'language_id' => $langData->langId,
                'title_id' => $this->addTitle($langData->title)
            ];
        }

        if(isset($image) && $image){
            $imageName = uniqid().str_slug(Carbon::now()).'.'.$image->getClientOriginalExtension();

            if(Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->delete('book/'.$post->image);
            }
            $postImage = Image::make($image)->resize(512,350)->save('temp/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('post/'.$imageName,$postImage);

        }


            $post->image = $imageName;
            $post->is_active = $mainData->active;
            $post->save();
            $post->titles()->sync($titleData);
            $post->descriptions()->sync($descriptionData);
            $post->categories()->sync($mainData->category);
            $post->tags()->sync($mainData->tag);

            return response()->json([
                'status' => true,
                'id' => $post->id
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('book/'.$post->image);
        }
        $post->titles()->delete();
        $post->titles()->detach();
        $post->descriptions()->delete();
        $post->descriptions()->detach();
        $post->delete();
        return redirect()->route('admin.post.index')->with('status','Post Successfully Deleted.');
    }


  /* Extra Method */
    private function addTitle($title){
        $postTitle = new Title();
        $postTitle->title = preg_replace('/\s+/', ' ', $title);
        $postTitle->save();
        return $postTitle->id;
    }

    private  function addDescription($text){
        $description = new Description();
        $description->description = $text;
        $description->save();
        return $description->id;
    }

    public function changeStatus(Post $post){
        $post->is_active = !$post->is_active;
        $post->save();
        return redirect()->back()->with('status','Post Status Successfully Updated..');
    }


}

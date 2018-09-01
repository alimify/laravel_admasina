<?php

namespace App\Http\Controllers\Admin;

use App\Language;
use App\Laraption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class WebSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::all();

        return view('admin.main.setting',compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'siteTitle' => 'required|max:20',
            'homePageTitle' => 'required|max:50',
            'defaultLanguage' => 'required',
            'siteArticlePerPage' => 'required|numeric|max:40',
            'siteBookPerPage' => 'required|numeric|max:40',
            'siteCommentPerPage' => 'required|numeric|max:40',
            'adminItemPerPage' => 'required|numeric|max:40',
            'image' => 'mimes:png'
        ]);

        $image = $request->file('image');
        if(isset($image) && $image){
            if (!Storage::disk('public')->exists('laraption')) {
                Storage::disk('public')->makeDirectory('laraption');
            }
            $siteImage = Image::make($image)->save('temp/site_logo_tmp.png');
            Storage::disk('public')->put('laraption/admasina_logo.png',$siteImage);
        }

        $setData = json_encode([
            'siteTitle' => $request->siteTitle,
            'homePageTitle' => $request->homePageTitle,
            'defaultLanguage' => $request->defaultLanguage,
            'siteArticlePerPage' => $request->siteArticlePerPage,
            'siteBookPerPage' => $request->siteBookPerPage,
            'siteCommentPerPage' => $request->siteCommentPerPage,
            'adminItemPerPage' => $request->adminItemPerPage,
            'siteLogo' => 'admasina_logo.png']);

        $setting = Laraption::updateOrCreate(
            ['optkey' => 'webSetting'],
            ['optvalue' => $setData]
        );
        return redirect()->back()->with('status','Settings Successfully Updated.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laraption  $laraption
     * @return \Illuminate\Http\Response
     */
    public function show(Laraption $laraption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laraption  $laraption
     * @return \Illuminate\Http\Response
     */
    public function edit(Laraption $laraption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laraption  $laraption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laraption $laraption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laraption  $laraption
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laraption $laraption)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $languages = Language::latest()->where('is_active',true)->paginate(Config::get('websettings.adminItemPerPage'));
        return view('admin.language.index',compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.language.create');
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
           'country' => 'required',
            'language' => 'required',
            'short_code' => 'required',
            'image' => 'mimes:bmp,png,jpg,jpeg,gif'
        ]);

        $country = $request->country;
        $lang = $request->language;
        $short_code = $request->short_code;
        $image = $request->file('image');
        $slug = str_slug($short_code);
        $is_active = true;

        if(isset($image) && $image){

            if (!Storage::disk('public')->exists('language')) {
                Storage::disk('public')->makeDirectory('language');
            }
            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $langImage = Image::make($image)->resize(32,32)->save('storage/language/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('language/'.$imageName,$langImage);

        }else{
            $imageName = "default.png";
        }

        $language = new Language();
        $language->country = $country;
        $language->language = $lang;
        $language->short_code = $short_code;
        $language->image = $imageName;
        $language->slug = $slug;
        $language->is_active = $is_active;
        $language->save();

        return redirect()->back()->with('status','Language Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        return view('admin.language.edit',compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {

        $this->validate($request,[
            'country' => 'required',
            'language' => 'required',
            'short_code' => 'required',
            'image' => 'mimes:bmp,png,jpg,jpeg,gif'
        ]);

        $country = $request->country;
        $lang = $request->language;
        $short_code = $request->short_code;
        $image = $request->file('image');
        $slug = str_slug($short_code);
        $is_active = true;

        if(isset($image) && $image){

            if(Storage::disk('public')->exists('language/'.$language->image)){
                Storage::disk('public')->delete('language/'.$language->image);
            }


            if (!Storage::disk('public')->exists('language')) {
                Storage::disk('public')->makeDirectory('language');
            }
            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $langImage = Image::make($image)->resize(32,32)->save('storage/language/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('language/'.$imageName,$langImage);

        }else{
            $imageName = $language->image;
        }

        $language->country = $country;
        $language->language = $lang;
        $language->short_code = $short_code;
        $language->image = $imageName;
        $language->slug = $slug;
        $language->is_active = $is_active;
        $language->save();

        return redirect()->back()->with('status','Language Successfully Edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $language->is_active = false;
        $language->save();
        return redirect()->back()->with('status','Language Successfully Deleted.');

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Translator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TranslatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translators = Translator::latest()->paginate(Config::get('websettings.adminItemPerPage'));
        return view('admin.translator.index',compact('translators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.translator.create');
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

        if(isset($image) && $image){
            if (!Storage::disk('public')->exists('translator')) {
                Storage::disk('public')->makeDirectory('translator');
            }
        $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $translatorImage = Image::make($image)->resize(500,333)->save('storage/translator/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('translator/'.$imageName,$translatorImage);


        }else{
            $imageName = 'default.png';
        }

        $translator = new Translator();
        $translator->title = $title;
        $translator->slug = $slug;
        $translator->image = $imageName;
        $translator->is_active = true;
        $translator->save();

     return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Translator  $translator
     * @return \Illuminate\Http\Response
     */
    public function show(Translator $translator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Translator  $translator
     * @return \Illuminate\Http\Response
     */
    public function edit(Translator $translator)
    {
        return view('admin.translator.edit',compact('translator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Translator  $translator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Translator $translator)
    {

        $this->validate($request,[
            'title' => 'required',
            'image' => 'mimes:bmp,png,jpg,jpeg,gif'
        ]);

        $title = $request->title;
        $slug = str_slug($title);
        $image = $request->file('image');

        if(isset($image) && $image){

            if(Storage::disk('public')->exists('translator/'.$translator->image)){
                Storage::disk('public')->delete('translator/'.$translator->image);
            }

            if (!Storage::disk('public')->exists('translator')) {
                Storage::disk('public')->makeDirectory('translator');
            }
            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $translatorImage = Image::make($image)->resize(500,333)->save('storage/translator/tmp.'.$image->getClientOriginalExtension());
            Storage::disk('public')->put('translator/'.$imageName,$translatorImage);


        }else{
            $imageName = $translator->image;
        }

        $translator->title = $title;
        $translator->slug = $slug;
        $translator->image = $imageName;
        $translator->is_active = true;
        $translator->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Translator  $translator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Translator $translator)
    {
        if(Storage::disk('public')->exists('translator/'.$translator->image)){
            Storage::disk('public')->delete('translator/'.$translator->image);
        }
        $translator->delete();
        return redirect()->back();

    }
}

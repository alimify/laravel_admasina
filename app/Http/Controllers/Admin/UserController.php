<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(Config::get('websettings.adminItemPerPage'));

        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $this->validate($request,[
            'name' => 'required|min:5|max:30',
            'email' => 'required|email',
            'quote' => 'max:60',
            'image' => 'mimes:jpg,jpeg,png,bmp,gif',
            'role' => 'required'
        ]);

        $image = $request->file('image');
        $link = $user->image;

        if(isset($image) && $image){
            $directory = 'profile';
            $link = "$directory/".uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }


            $proImage = Image::make($image)->resize(312,312)->save("temp/tmp.".$image->getClientOriginalExtension());
            Storage::disk('public')->put($link,$proImage);

        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $link;
        $user->quote = $request->quote;
        $user->role_id = $request->role;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->with('status','Profile Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}

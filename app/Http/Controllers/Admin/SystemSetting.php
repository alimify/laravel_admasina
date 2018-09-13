<?php

namespace App\Http\Controllers\Admin;

use App\Laraption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemSetting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   return response()->view('admin.main.systemSetting');
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
        Laraption::updateOrCreate(
            ['optkey' => 'system.setting.footeraboutus'],
            ['optvalue' => $request->footerAboutUs]
        );

        Laraption::updateOrCreate(
            ['optkey' => 'system.setting.footerusefullinks'],
            ['optvalue' => $request->footerUsefulLinks]
        );

        Laraption::updateOrCreate(
            ['optkey' => 'system.setting.footersociallinks'],
            ['optvalue' => $request->footerSocialLinks]
        );

        Laraption::updateOrCreate(
            ['optkey' => 'system.setting.aboutus'],
            ['optvalue' => $request->aboutUs]
        );

        Laraption::updateOrCreate(
            ['optkey' => 'system.setting.privacy'],
            ['optvalue' => $request->privacy]
        );

    return redirect()->back()->with('status','Successfully Data Updated.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

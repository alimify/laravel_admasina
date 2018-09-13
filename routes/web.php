<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontEnd\HomeController@index')->name('index');
Route::get('/home', 'FrontEnd\HomeController@index')->name('home');
Route::get('/aboutus','FrontEnd\HomeController@aboutus')->name('aboutus');
Route::get('/contactus','FrontEnd\HomeController@contactus')->name('contactus');
Route::get('/privacy','FrontEnd\HomeController@privacy')->name('privacy');
Route::get('/language','FrontEnd\HomeController@language')->name('language');

Auth::routes();



Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','admin']],function(){
    //Route::get('post/updateStatus/{post}','PostController@updateStatus')->name('post.updateStatus');
    //,'middleware' => ['auth','admin']

    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('dashboard/ajaxSuccess/{route}/{status}','DashboardController@ajaxSuccess')->name('dashboard.ajaxSuccess');
    //Book
    Route::resource('book','BookController');
    Route::resource('bookCategory','BookCategoryController');
    Route::resource('author','AuthorController');

    //Article
    Route::resource('post','PostController');
    Route::resource('postCategory','PostCategoryController');


    //Extra
    Route::resource('user','UserController');
    Route::resource('tag','TagController');
    Route::resource('comment','CommentController');
    Route::resource('language','LanguageController');
    Route::resource('translator','TranslatorController');
    Route::resource('websetting','WebSettingController');
    Route::get('/book/changeStatus/{book}','BookController@ChangeStatus')->name('book.changeStatus');
    Route::get('/post/changeStatus/{post}','PostController@ChangeStatus')->name('post.changeStatus');

    /*System Setting */
    Route::resource('systemSetting','SystemSetting');

});



Route::group(['as' => 'user.','prefix' => 'user','namespace' => 'User','middleware' => ['auth']],function(){

    Route::get('profile/edit','UserController@editProfile')->name('profile.edit');
    Route::get('setting','UserController@setting')->name('setting.edit');
    Route::get('password','UserController@password')->name('password.edit');

    Route::put('profile/{id?}','UserController@updateProfile')->name('profile.update');
    Route::put('setting/{id?}','UserController@updateSetting')->name('setting.update');
    Route::put('password/{id?}','UserController@updatePassword')->name('password.update');

});

Route::get('user/profile/{id?}','User\UserController@profile')->name('user.profile.show');

Auth::routes();

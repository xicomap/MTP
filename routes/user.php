<?php
Route::get('/home', 'UserController@home')->name('home');
Route::get('/profile', 'UserController@profile');
Route::post('/profile', 'UserController@update')->name('updateprofile');
Route::get('/posts', 'UserController@myposts');
Route::get('/addpost', 'UserController@addpost');
Route::post('/create_post', 'UserController@create_post');
Route::get('/edit_profile','UserController@edit_profile');

/*
Route::get('/home', UserControllerfunction () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('user')->user();

    //dd($users);

    return view('user.home');
})->name('home');
*/

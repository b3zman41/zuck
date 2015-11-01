<?php

Route::get('/', function()
{
    return view('welcome');
});

Route::get('/facebook', 'Auth\AuthController@redirectToFacebook');
Route::get('facebook-callback', 'Auth\AuthController@handleFacebookCallback');

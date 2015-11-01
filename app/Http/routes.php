<?php

Route::get('/', 'FacebookController@updateMembers');

Route::get('/facebook', 'Auth\AuthController@redirectToFacebook');
Route::get('facebook-callback', 'Auth\AuthController@handleFacebookCallback');


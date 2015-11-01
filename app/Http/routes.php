<?php

Route::get('/', 'FacebookController@getGroupMembers');

Route::get('/facebook', 'Auth\AuthController@redirectToFacebook');
Route::get('facebook-callback', 'Auth\AuthController@handleFacebookCallback');


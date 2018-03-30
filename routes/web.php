<?php
//Home URL
Route::get('/', 'TaskController@index');
//Post URL
Route::post('create', 'TaskController@create');
//Delete
Route::post('remove', 'TaskController@remove');
//Update
Route::post('update', 'TaskController@update');
//Search
Route::get('search', 'TaskController@search');
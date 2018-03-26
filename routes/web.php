<?php
//Home URL
Route::get('/', 'TaskController@index');
//Post URL
Route::post('create', 'TaskController@create');
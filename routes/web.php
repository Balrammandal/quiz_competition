<?php

use Spatie\Permission\Models\Role;

Route::get('admin','Admin\AdminController@index')->name('admin');

Route::post('login','Admin\AdminController@Check_login')->name('adminLogin');

Route::get('logout','Admin\AdminController@logout')->name('adminLogout');

Route::get('/','Admin\AdminController@index')->name('admin');



Route::post('get-state','Frontend\PageController@getState')->name('getState');
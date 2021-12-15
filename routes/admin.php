<?php
Route::group(['as'=>'admin::','prefix'=>'admin','middleware' => ['role:admin']], function () {
    Route::get('/dashboard','Admin\Dashboard\DashboardController@dashboard')->name('dashboard');
    Route::get('changePassForm','Admin\AdminController@changePassForm')->name('changePassForm');
    Route::post('ChangePass','Admin\AdminController@ChangePass')->name('ChangePass');
    Route::get('profile/{id}','Admin\AdminController@profile')->name('profile');
    Route::post('update-profile','Admin\AdminController@updateProfile')->name('updateProfile');

    /* Users route start*/
    Route::get('manage-users','Admin\UserController@index')->name('manageUsers');
    Route::get('add-user','Admin\UserController@add')->name('addUser');
    Route::post('save-user','Admin\UserController@save')->name('saveUser');
    Route::get('edit-user/{id}','Admin\UserController@edit')->name('editUser');
    Route::post('update-user/{id}','Admin\UserController@update')->name('updateUser');
    Route::get('delete-user/{id}','Admin\UserController@delete')->name('deleteUser');
    Route::post('active-inactive-user/','Admin\UserController@status')->name('userStatus');
    /* Users route end*/
});
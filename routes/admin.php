<?php
Route::group(['as'=>'admin::','prefix'=>'admin','middleware' => ['role:admin']], function () {
    Route::get('/dashboard','Admin\Dashboard\DashboardController@dashboard')->name('dashboard');
    Route::get('changePassForm','Admin\AdminController@changePassForm')->name('changePassForm');
    Route::post('ChangePass','Admin\AdminController@ChangePass')->name('ChangePass');
    Route::get('profile/{id}','Admin\AdminController@profile')->name('profile');
    Route::post('update-profile','Admin\AdminController@updateProfile')->name('updateProfile');

    /* Users route start*/
    Route::get('manage-users/{type?}','Admin\UserController@index')->name('manageUsers');
    Route::get('add-user','Admin\UserController@add')->name('addUser');
    Route::post('save-user','Admin\UserController@save')->name('saveUser');
    Route::get('edit-user/{id}','Admin\UserController@edit')->name('editUser');
    Route::post('update-user/{id}','Admin\UserController@update')->name('updateUser');
    Route::get('delete-user/{id}','Admin\UserController@delete')->name('deleteUser');
    Route::post('active-inactive-user/','Admin\UserController@status')->name('userStatus');
    /* Users route end*/
    /* Teacher route start*/
    Route::get('manage-teacher','Admin\UserController@manageTeacher')->name('manageTeacher');
    Route::get('add-teacher','Admin\UserController@addTeacher')->name('addTeacher');
    Route::post('save-teacher','Admin\UserController@saveTeacher')->name('saveTeacher');
    Route::get('edit-teacher/{id}','Admin\UserController@editTeacher')->name('editTeacher');
    Route::post('update-teacher/{id}','Admin\UserController@updateTeacher')->name('updateTeacher');
    Route::get('delete-teacher/{id}','Admin\UserController@deleteTeacher')->name('deleteTeacher');
    Route::post('active-inactive-teacher/','Admin\UserController@teacherStatus')->name('teacherStatus');
    /* Teacher route end*/

    /* Subscription Plan route start*/
    Route::get('manage-subscription-plan','Admin\SubscriptionController@index')->name('manageSubscription');
    Route::get('add-subscription-plan','Admin\SubscriptionController@add')->name('addSubscription');
    Route::post('save-subscription-plan','Admin\SubscriptionController@save')->name('saveSubscription');
    Route::get('edit-subscription-plan/{id}','Admin\SubscriptionController@edit')->name('editSubscription');
    Route::post('update-subscription-plan/{id}','Admin\SubscriptionController@update')->name('updateSubscription');
    Route::get('delete-subscription-plan/{id}','Admin\SubscriptionController@delete')->name('deleteSubscription');
    Route::post('active-inactive-subscription-plan/','Admin\SubscriptionController@status')->name('subcriptionStatus');
    /* Subscription Plan route end*/

    /* Question Level route start*/
    Route::get('manage-question-level','Admin\LevelController@index')->name('manageQuestionLevel');
    Route::get('add-question-level','Admin\LevelController@add')->name('addQuestionLevel');
    Route::post('save-question-level','Admin\LevelController@save')->name('saveQuestionLevel');
    Route::get('edit-question-level/{id}','Admin\LevelController@edit')->name('editQuestionLevel');
    Route::post('update-question-level/{id}','Admin\LevelController@update')->name('updateQuestionLevel');
    Route::get('delete-question-level/{id}','Admin\LevelController@delete')->name('deleteQuestionLevel');
    Route::post('active-inactive-question-level/','Admin\LevelController@status')->name('QuestionLevelStatus');
    /* Question Level route end*/

    /* User Subscription route start */
    Route::get('manage-teacher-subscription','Admin\UserSubscriptionController@index')->name('manageUserSubscription');
    Route::get('teacher-subscription-details/{id}','Admin\UserSubscriptionController@details')->name('UserSubscriptionDetail');
});
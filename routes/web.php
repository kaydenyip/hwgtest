<?php

Route::view('/', 'welcome');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Payouts
    Route::delete('payouts/destroy', 'PayoutsController@massDestroy')->name('payouts.massDestroy');
    Route::resource('payouts', 'PayoutsController');
    Route::get('payouts/{payout_id}/complete', 'PayoutsController@complete')->name('payouts.complete');
    Route::get('payouts/{payout_id}/commission', 'PayoutsController@commission')->name('payouts.commission');
    
    // Members
    Route::delete('members/destroy', 'MembersController@massDestroy')->name('members.massDestroy');
    Route::resource('members', 'MembersController');

    // Wallets
    Route::delete('wallets/destroy', 'WalletsController@massDestroy')->name('wallets.massDestroy');
    Route::resource('wallets', 'WalletsController');

    // Projects
    Route::delete('projects/destroy', 'ProjectsController@massDestroy')->name('projects.massDestroy');
    Route::resource('projects', 'ProjectsController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Payouts
    Route::delete('payouts/destroy', 'PayoutsController@massDestroy')->name('payouts.massDestroy');
    Route::resource('payouts', 'PayoutsController');

    // Members
    Route::delete('members/destroy', 'MembersController@massDestroy')->name('members.massDestroy');
    Route::resource('members', 'MembersController');

    // Wallets
    Route::delete('wallets/destroy', 'WalletsController@massDestroy')->name('wallets.massDestroy');
    Route::resource('wallets', 'WalletsController');

    // Projects
    Route::delete('projects/destroy', 'ProjectsController@massDestroy')->name('projects.massDestroy');
    Route::resource('projects', 'ProjectsController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});

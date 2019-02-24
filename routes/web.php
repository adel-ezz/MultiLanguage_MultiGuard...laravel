<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|'localeSessionRedirect',
*/


Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::get('/', function () {
        return view('welcome');
    });
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');

    ///======================For Admin Routs======================///
    Route::group(['prefix' => 'admin/'], function () {
        Route::get('login', 'AdminController@getLogin');
        Route::post('login', 'AdminController@postLogin')->name('admin.login');
        Route::group(['middleware' => 'Admin'], function () {
            Route::get('admins','AdminController@index')->name('admins.index');
            Route::get('departments','DepartmentController@index')->name('departments.index');
            Route::get('users','UserController@index')->name('users.index');
            Route::get('/', 'AdminController@dashboard');
            Route::get('/logout', 'AdminController@logout');
        });
    });
});
//////////For Ajax DataTables For X-Editables////////////
Route::group(['prefix' => 'admin/'], function () {
    Route::group(['middleware' => 'Admin'], function () {
        Route::get('admins/getallamins', 'AdminController@getAdminsforDatatables')->name('getAllAdmins');
        Route::post('admins/store','AdminController@store')->name('admins.store');
        Route::delete('/admins', 'AdminController@destroy')->name('admins.destroy');
        Route::put('/admins/update','AdminController@update')->name('admins.update');
        ///////////////============Departments================////
        Route::get('departs/getallDeparts', 'DepartmentController@getAdminsforDatatables')->name('getAllDeparts');
        Route::post('departs/store','DepartmentController@store')->name('departs.store');
        Route::delete('/departs', 'DepartmentController@destroy')->name('departments.destroy');
        Route::put('/departs/update','DepartmentController@update')->name('departments.update');
        ////////////============users=========================////
        Route::get('users/getallusers', 'UserController@getAdminsforDatatables')->name('getAllUsers');
        Route::post('users/store','UserController@store')->name('users.store');
        Route::delete('/users', 'UserController@destroy')->name('users.destroy');
        Route::put('/users/update','UserController@update')->name('users.update');
    });
});
///=================Admin Routes=====================///
///

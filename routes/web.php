<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {

    return view('welcome');
})->name(
    'home'
);

Route::get('/login', 'HomeController@login')->name('login');
Route::post('/login', 'HomeController@store');
Route::get('/logout', 'HomeController@destroy')->name('logout');

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['login']], function () {
    //
    Route::resource('rooms', 'RoomController');
    Route::resource('users', 'UserController');

    Route::resource('userRoles', 'UserRoleController');
    Route::resource('roles', 'RoleController');
    Route::resource('menus', 'MenuController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('sequences', 'SequenceController');

    Route::get('rooms/{room}/manual', 'RoomController@manual')->name('rooms.manual');
    Route::get('rooms/{year}/groupByRandom', 'RoomController@groupByRandom')->name('rooms.groupByRandom');
    Route::get('rooms/{year}/groupByOrder', 'RoomController@groupByOrder')->name('rooms.groupByOrder');
    Route::put('rooms/{room}/saveManual', 'RoomController@saveManual')->name('rooms.saveManual');

    Route::resource('presents', 'PresentController');
    Route::resource('roomUsers', 'RoomUserController');
});


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

Route::get('/register', 'HomeController@register')->name('register');
Route::post('/register', 'HomeController@registerStore')->name('register.store');
Route::get('/', 'HomeController@index')->name('index');
Route::get('/login', 'HomeController@login')->name('login');
Route::post('/login', 'HomeController@store')->name('login');
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
    Route::get('rooms/{room}/randomPresentNumber', 'RoomController@randomPresentNumber')->name('rooms.randomPresentNumber');
    Route::get('rooms/{room}/email', 'RoomController@email')->name('rooms.email');
    //rooms.email.send
    Route::post('rooms/{room}/email/send', 'RoomController@emailSend')->name('rooms.email.send');
    Route::resource('presents', 'PresentController');
    Route::get('/presents/{id}/qrcode', 'PresentController@qrcode')->name('presents.qrcode');
//presents.advisor.paid
    Route::get('/presents/rooms/{id}/present/{present}/advisor', 'PresentController@advisor')->name('presents.advisor');
    Route::get('/presents/rooms/{id}/present/{present}/advisor/paid/{check}', 'PresentController@paid')->name('presents.advisor.paid');
   
   
    Route::resource('roomUsers', 'RoomUserController');

    Route::get('/basicInformations', 'Basic_informationController@index')->name('basicInformations.index');
    Route::get('/basicInformations/show', 'Basic_informationController@show')->name('basicInformations.show');
    Route::put('/basicInformations/update', 'Basic_informationController@update')->name('basicInformations.update');

    Route::post('/basicInformations/updateAdviser', 'Basic_informationController@updateAdviser')->name('basicInformations.updateAdviser');
    //updateAdviser
    // Route::patch('/basicInformations/{basicInformation}', 'Basic_informationController@update')->name('basicInformations.update');
    // Route::resource('basicInformations', 'Basic_informationController');
    Route::resource('userAdvisors', 'UserAdvisorController');
    Route::get('/userAdvisors/rooms/{id}', 'UserAdvisorController@main')->name('userAdvisors.main');

    Route::resource('settings', 'SettingController');
    Route::resource('uploadFiles', 'UploadFileController');
    Route::resource('advisorsApproves', 'AdvisorsApproveController');

    // Route::resource('qrcode', 'QRcodeController');
    Route::get('/qrcode', 'QRcodeController@index')->name('qrcode.index');
    Route::get('/qrcode/scan/', 'QRcodeController@scan')->name('qrcode.scan');
    Route::get('/qrcode/scan/{code}', 'QRcodeController@store');

    Route::resource('assessments', 'AssessmentController');
    // Route::resource('assessment', 'AssessmentController');
    Route::get('/assessments/users/{users}/presents/{present}', 'AssessmentController@score')->name('assessments.score');
    Route::post('/assessments/users/storeScore', 'AssessmentController@storeScore')->name('assessments.storeScore');

    Route::resource('userPresents', 'UserPresentController');

    Route::resource('advisorUserPresents', 'AdvisorUserPresentController');
    Route::get('/advisorUserPresents/showDetail/{id}/room/{room_id}', 'AdvisorUserPresentController@showDetail')->name('advisorUserPresents.showDetail');

    Route::get('/advisorFileUploads', 'AdvisorFileUploadController@index')->name('advisorFileUploads.index');
    Route::get('/advisorFileUploads/{id}', 'AdvisorFileUploadController@show')->name('advisorFileUploads.show');
    Route::get('/advisorFileUploads/showDetail/{id}/room/{room_id}', 'AdvisorFileUploadController@showDetail')->name('advisorFileUploads.showDetail');

    Route::resource('contents', 'ContentController');
});

Route::resource('checkPresents', 'CheckPresentController');
Route::post('/email/room/{id}', 'HomeController@sendNotifyEmail')->name('email.room.notify');

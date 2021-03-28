<?php

use Illuminate\Support\Facades\Route;

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
});

// Route::get('/registration',function () {
//     return view('registration.index');
// });

Route::get('/registration', 'RegistrationsController@register')->name('registration');

Route::post('/registration/store', 'RegistrationsController@store')->name('registration.store');

Route::get('/registration/show', 'RegistrationsController@show')->name('registration.show');


Route::get('/a', function () {
   /* $startTime = Carbon\Carbon::parse('2020-02-11 04:04:26');
    $endTime = Carbon\Carbon::now();

     $totalDuration =  $endTime->format('H:%I:%S');
    //$totalDuration =  $startTime->diff($endTime)->format('%H:%I:%S')." Minutes";
    //dd($endTime);
    */

   /* $startTime = Carbon\Carbon::now();
    $start = Carbon\Carbon::parse($startTime)->format('H.i');

    echo $start;
    */


});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('admin');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->middleware('clint');

//Route::get('download','Download\DownloadController@download')->name('file.download');


    Route::middleware(['auth','Admin'])->group(function (){
        Route::middleware('preventBackHistory')->group(function (){




            Route::get('admin/dashboard','Admin\DashboardController@index')->name('admin.dashboard');

            Route::resource('admin/user','Admin\UserController');
            Route::get('admin/user/edit/{id}','Admin\UserController@edit')->name('admin.useredit');
            Route::post('admin/user/edit','Admin\UserController@update');
            Route::get('admin/attendance','Admin\AttendanceController@index')->name('admin.attendancelist');
            Route::get('admin/attendanceform','Admin\AttendanceController@attendanceform')->name('admin.attendanceform');
            Route::post('admin/attendanceform','Admin\AttendanceController@store')->name('admin.attendancestore');
            Route::post('admin/attendancetimeout','Admin\AttendanceController@update')->name('admin.attendanceupdate');


            //workspace
            Route::get('admin/workspace','Admin\WorkspaceController@index');
            Route::get('admin/workspacetable','Admin\WorkspaceController@workspacetable');

            //Route::get('admin/workspace','Admin\WorkspaceController@index')->name('admin.workspace');
            Route::post('admin/addworkspace','Admin\WorkspaceController@store');
            Route::get('admin/deleteworkspace/{id}','Admin\WorkspaceController@delete');


            //projects
            Route::get('admin/workspace/view/{id}','Admin\ProjectController@index');



            //alaminbro
            Route::resource('admin/user','Admin\UserController');
            Route::resource('admin/file-management','Admin\FileManagementController');
            Route::resource('admin/client','Admin\ClientController');
            Route::get('admin/register-client','Admin\RegisterClientController@show')->name('register-client.info');
            Route::post('files/delete-all','Admin\DeleteAllController@delete')->name('delete.all');
            Route::post('files/delete-all','Admin\DeleteAllController@delete')->name('delete.all');
            //endalamin

        });
        Route::get('file/download/{file}','Admin\DownloadController@download')->name('file.download');

    });


    Route::middleware(['auth','Employee'])->group(function (){
        Route::middleware('preventBackHistory')->group(function (){

            Route::get('employee/dashboard', function (){
            return view('employee.dashboard');
            })->name('employee.dashboard');
            Route::get('employee/attendance','Employee\AttendanceController@index')->name('employee.attendancelist');
            Route::get('employee/attendanceform','Employee\AttendanceController@attendanceform')->name('employee.attendanceform');
            Route::post('employee/attendanceform','Employee\AttendanceController@store')->name('employee.attendancestore');
            Route::post('employee/attendancetimeout','Employee\AttendanceController@update')->name('employee.attendanceupdate');

        });


    });




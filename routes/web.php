<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
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



Route::middleware(['auth'])->group(function (){
    Route::get('/AdminDashboard/adminDashboard', 'AdminController@index')->middleware('role:admin');
    Route::get('/UserDashboard/UserDashboard', 'DashboardController@index')->middleware('role:user');
    Route::get('/AdminDashboard/staff', [AdminController::class, 'users']);
    Route::get('/AdminDashboard/view/{id}', [AdminController::class, 'viewstaff']);

    Route::get('/admin/add-staff', [AdminController::class, 'addstaff'])->name('addstaff.index');
    Route::post('/admin/add-staff', [AdminController::class, 'store'])->name('addstaff.store');
    // Route::get('/admin/edit', 'AdminController@edit')->name('admin.editstaff');

    Route::get('/admin/edit/{id}', [AdminController::class, 'editstaff']);
    Route::put('/admin/edit/{id}', 'AdminController@update')->name('admin.update');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

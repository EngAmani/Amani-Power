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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.home');

Route::get('/add_shift', [App\Http\Controllers\admin\ShiftController::class, 'add'])->name('add_shift');
Route::get('/shift/{id}', [App\Http\Controllers\admin\ShiftController::class, 'shift'])->name('shift');
Route::get('/unassign-shift/{id}/{shiftid}', [App\Http\Controllers\admin\ShiftController::class, 'unassign'])->name('unassign-shift');
Route::get('/add_usershift', [App\Http\Controllers\admin\ShiftController::class, 'userToShift'])->name('add_usershift');
Route::get('/shiftTable', [App\Http\Controllers\admin\ShiftController::class, 'shiftTable'])->name('shiftTable');
Route::get('/userInfo', [App\Http\Controllers\user\infoController::class, 'userInfo'])->name('userInfo');
Route::get('/userInfo1', [App\Http\Controllers\user\infoController::class, 'annual_leave_calc'])->name('annual_leave_calc');

Route::get('/employee_leaves', [App\Http\Controllers\user\leavsController::class, 'index'])->name('employee_leaves');
// Route::get('/test', [App\Http\Controllers\user\UserController::class, 'test'])->name('test');


Route::get('/exportsfiles', [App\Http\Controllers\admin\PdfController::class, 'index'])->name('pdf');



Route::post('/fileUpload', [App\Http\Controllers\user\leavsController::class, 'fileUpload'])->name('fileUpload');
Route::post('/generatPDF', [App\Http\Controllers\admin\PdfController::class, 'generatPDF'])->name('generatPDF')->middleware('Admin');;

Route::post('/storeShiftUser', [App\Http\Controllers\admin\ShiftController::class, 'storeShiftUser'])->name('storeShiftUser')->middleware('Admin');;
Route::post('/deleteShift', [App\Http\Controllers\admin\ShiftController::class, 'deleteShift'])->name('deleteShift')->middleware('Admin');;

Route::post('/store_shift', [App\Http\Controllers\admin\ShiftController::class, 'store'])->name('store_shift')->middleware('Admin');;

Route::get('/deleteShiftForEmployee/{id}', [App\Http\Controllers\admin\ShiftController::class, 'deleteShiftForEmployee'])->name('deleteShiftForEmployee')->middleware('Admin');


Route::get('/excuses_form', [App\Http\Controllers\user\excuseController::class, 'excuses_form'])->name('excuses_form');
Route::post('/stor_excuses', [App\Http\Controllers\user\excuseController::class, 'excuses'])->name('stor_excuses');
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminIndex'])->name('admin.home')->middleware('Admin');
Route::post('/sotre', [App\Http\Controllers\user\UserController::class, 'store'])->name('store');
Route::get('/edit/{post}', [App\Http\Controllers\user\UserController::class, 'edit'])->name('edit');
Route::put('/update',[App\Http\Controllers\user\UserController::class, 'update'])->name('update');
Route::get('/calc', [App\Http\Controllers\user\UserController::class, 'calc'])->name('calc');
Route::get('/extraTime', [App\Http\Controllers\user\UserController::class, 'extraTime'])->name('extraTime');
Route::get('/excusesCounter', [App\Http\Controllers\user\excuseController::class, 'excusesCounter'])->name('excusesCounter');
Route::get('/excusesHours', [App\Http\Controllers\user\excuseController::class, 'excusesHours'])->name('excusesHours');
Route::get('/absentCalculator', [App\Http\Controllers\user\absentController::class, 'absentCalculator'])->name('absentCalculator');


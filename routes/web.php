<?php

use App\Http\Controllers\B20EmployeeController;
use App\Http\Controllers\vB20ProductionorderQuanWebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('content.dashboard');
// })->name('dashboard');
// Route::get('/form', function () {
//     return view('content.form');
// });
// Route::get('/table', function () {
//     return view('content.table');
// });
// Route::get('/404', function () {
//     return view('content.error404');
// });
Route::middleware('checkRole')->prefix('/')->name('list.')->group(function (){
    Route::get('/edit/{id}', [vB20ProductionorderQuanWebController::class,'getListEdit'])->name('edit');
    Route::get('/get-time/{code}', [vB20ProductionorderQuanWebController::class,'getTime'])->name('get-time');
    Route::post('/update', [vB20ProductionorderQuanWebController::class,'update'])->name('update');
    Route::get('/notification', [vB20ProductionorderQuanWebController::class,'notification'])->name('notification');
});
Route::middleware('checkSession')->prefix('/')->name('form.')->group(function (){
    Route::get('/login', [B20EmployeeController::class,'getLogin'])->name('getLogin');
    Route::post('/login', [B20EmployeeController::class,'postLogin'])->name('postLogin');
});
Route::get('/logout', [B20EmployeeController::class, 'logout'])->name('logout');
Route::get('/back', [B20EmployeeController::class,'back'])->name('back');
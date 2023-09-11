<?php

use App\Http\Controllers\B20EmployeeController;
use App\Http\Controllers\vB20ProductionorderQuanWebController;
use App\Http\Controllers\vB30JobRecord_ExploeruWebController;
use App\Http\Controllers\vB30JobRecordDetailWebController;
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
    Route::get('edit/{id}', [vB20ProductionorderQuanWebController::class,'getListEdit'])->name('edit');
    Route::get('get-time', [vB20ProductionorderQuanWebController::class,'getTime'])->name('get-time');
    Route::get('get-product-code', [vB20ProductionorderQuanWebController::class,'getProductCode'])->name('get-product-code');
    Route::post('update', [vB20ProductionorderQuanWebController::class,'update'])->name('update');
    Route::get('notification', [vB20ProductionorderQuanWebController::class,'notification'])->name('notification');
    Route::get('list-approval-vote/{parentId}', [vB30JobRecord_ExploeruWebController::class,'getApprovalVote'])->name('get-approval-vote');
    Route::get('edit-detail-approval-vote/{grandparentId}/{parentId}', [vB30JobRecordDetailWebController::class,'getApprovalVoteDetail'])->name('edit-detail-approval-vote');
    Route::post('update-status-detail-approval-vote', [vB30JobRecordDetailWebController::class,'updateStatusApprovalVoteDetail']);
});
Route::middleware('checkSession')->prefix('/')->name('form.')->group(function (){
    Route::get('login', [B20EmployeeController::class,'getLogin'])->name('getLogin');
    Route::post('login', [B20EmployeeController::class,'postLogin'])->name('postLogin');
});
Route::get('logout', [B20EmployeeController::class, 'logout'])->name('logout');
Route::get('back', [B20EmployeeController::class,'back'])->name('back');
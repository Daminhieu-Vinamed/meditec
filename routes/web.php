<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductionOrderController;
use App\Http\Controllers\ApprovalVoteController;
use App\Http\Controllers\ApprovalVoteDetailController;
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
Route::middleware('checkRole')->prefix('/')->name('list.')->group(function (){
    Route::get('edit/{id}', [ProductionOrderController::class,'getListEdit'])->name('edit');
    Route::get('get-time', [ProductionOrderController::class,'getTime'])->name('get-time');
    Route::get('get-product-code', [ProductionOrderController::class,'getProductCode'])->name('get-product-code');
    Route::post('update', [ProductionOrderController::class,'update'])->name('update');
    Route::get('notification', [ProductionOrderController::class,'notification'])->name('notification');
    Route::get('list-approval-vote/{parentId}', [ApprovalVoteController::class,'getApprovalVote'])->name('get-approval-vote');
    Route::get('edit-detail-approval-vote/{grandparentId}/{parentId}', [ApprovalVoteDetailController::class,'getApprovalVoteDetail'])->name('edit-detail-approval-vote');
    Route::post('update-status-approval-vote', [ApprovalVoteController::class,'updateStatusApprovalVote']);
    Route::post('update-status-detail-approval-vote', [ApprovalVoteDetailController::class,'updateStatusApprovalVoteDetail']);
});
Route::middleware('checkSession')->prefix('/')->name('form.')->group(function (){
    Route::get('login', [AuthController::class,'getLogin'])->name('getLogin');
    Route::post('login', [AuthController::class,'postLogin'])->name('postLogin');
});
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('back', [AuthController::class,'back'])->name('back');
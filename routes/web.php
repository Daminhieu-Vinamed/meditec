<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductionOrderController;
use App\Http\Controllers\ApprovalVoteController;
use App\Http\Controllers\ApprovalVoteDetailController;
use App\Http\Controllers\ScanQrCodeController;
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

Route::middleware('checkRole')->prefix('/')->name('list.')->group(function () {
    Route::get('edit/{id}', [ProductionOrderController::class, 'getProductionOrder1']);
    Route::post('update-production-order-1', [ProductionOrderController::class, 'updateProductionOrder1']);
    Route::get('production-order-2/{id}', [ProductionOrderController::class, 'getProductionOrder2']);
    Route::post('update-production-order-2', [ProductionOrderController::class, 'updateProductionOrder2']);
    Route::get('additional-production-order/{id}', [ProductionOrderController::class, 'getAdditionalProductionOrder'])->name('additional-production-order');
    Route::get('get-product-code', [ProductionOrderController::class, 'getProductCode']);
    Route::get('approval-vote', [ApprovalVoteController::class, 'getViewApprovalVote'])->name('approval-vote');
    Route::get('get-data', [ApprovalVoteController::class, 'getDataApprovalVote']);
    Route::get('detail-approval-vote/{id}', [ApprovalVoteDetailController::class, 'getApprovalVoteDetail'])->name('detail-approval-vote');
    Route::post('update-status-approval-vote', [ApprovalVoteController::class, 'updateStatusApprovalVote']);
    Route::post('update-status-detail-approval-vote', [ApprovalVoteDetailController::class, 'updateStatusApprovalVoteDetail']);
    Route::get('scan-qr-code', [ScanQrCodeController::class, 'getScanQrCode'])->name('scan-qr-code');
    Route::post('scan-qr-code', [ScanQrCodeController::class, 'postScanQrCode']);
    Route::get('notification', [AuthController::class, 'notification']);
});
Route::middleware('checkSession')->prefix('/')->name('form.')->group(function () {
    Route::get('login', [AuthController::class, 'getLogin'])->name('getLogin');
    Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
});
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
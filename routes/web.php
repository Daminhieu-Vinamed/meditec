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
    Route::get('edit/{id}', [ProductionOrderController::class, 'getProductionOrderV1']);
    Route::post('update-production-order-v1', [ProductionOrderController::class, 'updateProductionOrderV1']);
    Route::get('production-order-v2/{id}', [ProductionOrderController::class, 'getProductionOrderV2']);
    Route::post('update-production-order-v2', [ProductionOrderController::class, 'updateProductionOrderV2']);
    Route::get('semi-finished-product-code', [ProductionOrderController::class, 'semiFinishedProductCode']);
    Route::get('additional-production-order-v1/{id}', [ProductionOrderController::class, 'getAdditionalProductionOrderV1'])->name('additional-production-order-v1');
    Route::get('additional-production-order-v2/{id}', [ProductionOrderController::class, 'getAdditionalProductionOrderV2'])->name('additional-production-order-v2');
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
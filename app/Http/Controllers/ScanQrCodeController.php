<?php

namespace App\Http\Controllers;

use App\Services\ScanQrCodeService;
use Illuminate\Http\Request;

class ScanQrCodeController extends Controller
{
    protected ScanQrCodeService $scanQrCodeService;

    public function __construct(ScanQrCodeService $scanQrCodeService)
    {
        $this->scanQrCodeService = $scanQrCodeService;
    }
    
    public function getScanQrCode() {
        return view('scan-qr-code');
    }
    
    public function postScanQrCode(Request $request) {
        return $this->scanQrCodeService->postScanQrCode($request);
    }
}
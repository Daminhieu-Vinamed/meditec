<?php
namespace App\Services;

class ScanQrCodeService {
    public function postScanQrCode($request) {
        $data = $request->input('data');
        return response()->json(['message' => 'QR data received successfully', 'url' => $data]);
    }
}
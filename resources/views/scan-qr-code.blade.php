@extends('layout.master')
@section('title', 'Scan QR Code')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/css/scan-qr-code.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div id="reader-camera"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('dist/js/html5-qrcode.min.js')}}"></script>
    <script src="{{asset('dist/js/scan-qr-code.js')}}"></script>
@endpush
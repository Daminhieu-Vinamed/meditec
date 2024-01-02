@extends('layout.master')
@section('title', 'Approval vote')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <h6 class="card-title">
                            <a href="{{ route('list.notification') }}">Trang chủ</a>
                            <img width="20px" src="{{ asset('dist/images/right.svg') }}" alt="">
                            <a href="{{ route('list.production-order', ['id' => session()->get('idScanQr')]) }}">Cập nhật thông tin lệnh sản xuất</a>
                            <img width="20px" src="{{ asset('dist/images/right.svg') }}" alt="">
                            Danh sách phiếu cần duyệt
                        </h6>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered display nowrap approval-vote-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Số</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Thao tác</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Mô tả</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('dist/js/approval-vote.js')}}"></script>
@endpush
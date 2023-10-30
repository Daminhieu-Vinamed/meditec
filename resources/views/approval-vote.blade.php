@extends('layout.master')
@section('title', 'Approval Vote')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <h3 class="card-title">Danh sách chi tiết phiếu cần duyệt</h3>
                        <a href="{{ route('list.production-order', ['id' => session()->get('idScanQr')]) }}" class="btn btn-danger text-white">Quay trở lại</a>
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
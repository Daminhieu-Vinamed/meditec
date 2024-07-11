@extends('layout.master')
@section('title', 'Approval vote')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-grey-light py-3 d-sm-flex align-items-center justify-content-between">
                        <h5 class="m-0 font-bold text-info">DANH SÁCH PHIẾU CẦN DUYỆT</h5>
                    </div>
                    <div class="card-body p-3">
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
    </div>
@endsection
@push('js')
    <script src="{{ asset('dist/js/approval-vote.js') }}"></script>
@endpush

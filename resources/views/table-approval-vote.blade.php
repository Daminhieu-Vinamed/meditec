@extends('layout.master')
@section('title', 'Approval Vote')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <h4 class="card-title">Danh sách chi tiết phiếu cần duyệt</h4>
                        <a href="{{ route('list.edit', ['id' =>  $parentId]) }}" class="btn btn-danger text-white">Quay trở lại</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-responsive-lg table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Số</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="products">
                                @foreach ($allApprovalVote as $item)
                                    <tr>
                                        <td><a href="{{ route('list.edit-detail-approval-vote', ['parentId' => $item->Id, 'grandparentId' => $parentId]) }}">{{$item->DeptName}}</a></td>
                                        <td><a href="{{ route('list.edit-detail-approval-vote', ['parentId' => $item->Id, 'grandparentId' => $parentId]) }}">{{$item->DocNo}}</a></td>
                                        <td>{{date('d-m-Y', strtotime($item->DocDate))}}</td>
                                        <td>{{$item->Description}}</td>
                                        <td>{{$item->DocStatusName}}</td>
                                        <td><button type="button" class="btn btn-primary submit-update" id="{{$item->Id}}">Duyệt phiếu</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">{{ $allApprovalVote->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('dist/js/addLogic2.js')}}"></script>
@endpush
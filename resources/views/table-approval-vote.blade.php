@extends('layout.master')
@section('title', 'Approval Vote')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex">
                        <h4 class="card-title">Danh sách các phiếu cần duyệt</h4>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-responsive-lg table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Số</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody class="products">
                                @foreach ($allApprovalVote as $item)
                                    <tr>
                                        <td><a href="{{ route('list.edit-detail-approval-vote', ['id' => $item->Id]) }}">{{$item->DeptName}}</a></td>
                                        <td><a href="{{ route('list.edit-detail-approval-vote', ['id' => $item->Id]) }}">{{$item->DocNo}}</a></td>
                                        <td>{{date('d-m-Y', strtotime($item->DocDate))}}</td>
                                        <td>{{$item->Description}}</td>
                                        <td>{{$item->DocStatusName}}</td>
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
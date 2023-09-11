@extends('layout.master')
@section('title', 'Approval Vote Detail')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <h4 class="card-title">Chi tiết phiếu cần duyệt</h4>
                        <button type="button" class="btn btn-primary submit-update" id="{{$parentId}}">Lưu và duyệt phiếu</button>
                        <a href="{{ route('list.get-approval-vote', ['parentId'=> $grandparentId]) }}" class="btn btn-danger text-white">Quay trở lại</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-responsive-lg table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Mã máy</th>
                                    <th scope="col">Tên máy</th>
                                    <th scope="col">Ca sản xuất</th>
                                    <th scope="col">Mã CBNV</th>
                                    <th scope="col">Tên nhân viên</th>
                                    <th scope="col">Mã BTP</th>
                                    <th scope="col">Loại BTP,TP</th>
                                    <th scope="col">ĐVT</th>
                                    <th scope="col">Giờ công</th>
                                    <th scope="col">Lô sản xuất</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Hệ số</th>
                                    <th scope="col">Số lượng quy đổi</th>
                                    <th scope="col">Phế phẩm (ĐVT gốc)</th>
                                </tr>
                            </thead>
                            <tbody class="products">
                                @foreach ($detailApprovalVote as $item)
                                    <tr>
                                        <td>{{$item->MachineCode}}</td>
                                        <td>{{$item->MachineName}}</td>
                                        <td>{{$item->ChantCode}}</td>
                                        <td>{{$item->EmployeeCode}}</td>
                                        <td>{{$item->EmployeeName}}</td>
                                        <td>{{$item->ProductCode}}</td>
                                        <td>{{$item->Name}}</td>
                                        <td>{{$item->Unit}}</td>
                                        <td>{{number_format($item->TimeExcute,2,",",".")}}</td>
                                        <td>{{$item->ItemLotCode}}</td>
                                        <td>{{$item->Quantity9}}</td>
                                        <td>{{$item->ConvertRate9}}</td>
                                        <td>{{$item->Quantity}}</td>
                                        <td>{{$item->QuantityFail}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">{{ $detailApprovalVote->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('dist/js/addLogic2.js')}}"></script>
@endpush
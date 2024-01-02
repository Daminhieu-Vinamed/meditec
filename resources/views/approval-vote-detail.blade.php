@extends('layout.master')
@section('title', 'Approval vote detail')
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
                            <a href="{{ route('list.approval-vote') }}">Danh sách phiếu cần duyệt</a>
                            <img width="20px" src="{{ asset('dist/images/right.svg') }}" alt="">
                            Chi tiết phiếu cần duyệt
                        </h6>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-5"></div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-grey-light update-status-approval-vote-detail" id="{{$parentId}}">LƯU VÀ DUYỆT</button>
                        </div>
                        <div class="col-sm-5"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="infoInTable"></div>
                        <div class="searchInTable"></div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered display nowrap approval-vote-detail-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Mã máy</th>
                                    <th scope="col">Tên máy</th>
                                    <th scope="col">Ca sản xuất</th>
                                    <th scope="col">Giờ công</th>
                                    <th scope="col">Mã CBNV</th>
                                    <th scope="col">Tên nhân viên</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">ĐVT</th>
                                    <th scope="col">Mã BTP</th>
                                    <th scope="col">Loại BTP,TP</th>
                                    <th scope="col">Lô sản xuất</th>
                                    <th scope="col">Hệ số</th>
                                    <th scope="col">Số lượng quy đổi</th>
                                    <th scope="col">Phế phẩm (ĐVT gốc)</th>
                                </tr>
                            </thead>
                            <tbody class="products">
                                @foreach ($detailApprovalVote as $location => $item)
                                <input type="hidden" name="Id[]" value="{{$item->Id}}">
                                    <tr>
                                        <td>
                                            <select name="MachineCode[]">
                                                <option value="">-----</option>
                                                @foreach ($arrayMachineCode as $itemCode)
                                                    @if ($itemCode->IsGroup == config('constants.number.zero') && $itemCode->IsActive == config('constants.number.one'))
                                                        <option {{ $item->MachineCode === $itemCode->Code ? 'selected' : '' }} machine-name="{{$itemCode->Name}}" value="{{ $itemCode->Code }}">{{$itemCode->Code}} - {{$itemCode->Name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>{{$item->MachineName}}</td>
                                        <td>
                                            <select name="ChantCode[]" class="select-chantCode" id="{{$item->Id}}">
                                                @foreach ($arrayChantCode as $itemCode)
                                                    @if ($itemCode->IsGroup == config('constants.number.zero') && $itemCode->IsActive == config('constants.number.one'))
                                                        <option {{ $item->ChantCode === $itemCode->Code ? 'selected' : '' }} value="{{ $itemCode->Code }}">{{$itemCode->Code}} - {{$itemCode->Name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="TimeExcute[]" id="TimeExcute-{{$item->Id}}" value="{{number_format($item->TimeExcute,config('constants.number.two'),".",".")}}">
                                            <span class="text-danger error-time-excute-{{$location}}"></span>
                                        </td>
                                        <td>{{$item->EmployeeCode}}</td>
                                        <td>{{$item->EmployeeName}}</td>
                                        <td>
                                            <input class="form-control" type="text" name="Quantity9[]" value="{{number_format($item->Quantity9,config('constants.number.two'),".",".")}}">
                                            <span class="text-danger error-quantity-{{$location}}"></span>
                                        </td>
                                        <td>{{$item->Unit}}</td>
                                        <td>{{$item->ProductCode}}</td>
                                        <td>{{$item->Name}}</td>
                                        <td>{{$item->ItemLotCode}}</td>
                                        <td>{{number_format($item->ConvertRate9,config('constants.number.two'),",",".")}}</td>
                                        <td>{{number_format($item->Quantity,config('constants.number.two'),",",".")}}</td>
                                        <td>{{number_format($item->QuantityFail,config('constants.number.two'),",",".")}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('dist/js/get-time-by-shift.js')}}"></script>
    <script src="{{asset('dist/js/approval-vote-detail.js')}}"></script>
@endpush
@extends('layout.master')
@section('title', 'Edit')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <h4 class="card-title">Cập nhật số lượng</h4>
                        <a href="{{ route('list.approval-vote') }}" class="btn btn-primary">Danh sách phiếu cần duyệt</a>
                    </div>
                    <form action="{{ route('list.update') }}" method="post">
                        @csrf
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-responsive-lg table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Số lượng sản xuất hôm nay</th>
                                        <th scope="col">Phế phẩm</th>
                                        <th scope="col">Ca sản xuất</th>
                                        <th scope="col">Số giờ</th>
                                        <th scope="col">Mã máy</th>
                                        <th scope="col">Công đoạn</th>
                                        @if ($arrayChildStage->isNotEmpty())
                                            <th scope="col">Công đoạn con</th>
                                        @endif
                                        <th scope="col">Số lượng ban đầu</th>
                                        <th scope="col">Số lượng đã sản xuất</th>
                                        <th scope="col">Số lượng còn lại phải sản xuất</th>
                                        <th scope="col">Lệnh sản xuất</th>
                                        <th scope="col">Lô</th>
                                    </tr>
                                </thead>
                                <tbody class="products">
                                    @foreach ($data as $location => $item)
                                        <tr>
                                            <input type="hidden" class="location-validate-workday-quantity" value="{{$location}}">
                                            <input type="hidden" name="ItemLotCode[]" value="{{$item->ItemLotCode}}">
                                            <input type="hidden" name="ProductCode[]" value="{{$item->ProductCode}}">
                                            <input type="hidden" name="Id[]" value="{{$item->Id}}">
                                            <td>{{$item->ProductCode}}</td>
                                            <td>{{$item->ProductName}}</td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control quantity-sx-{{$location}}" name="QuantitySX[]" type="text" placeholder="Số lượng">
                                                    <span class="text-danger error-quantity-{{$location}}"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control quantity-fail-{{$location}}" name="QuantityFail[]" type="text" placeholder="Phế phẩm">
                                                    <span class="text-danger error-quantity-fail-{{$location}}"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <select name="ChantCode[]" class="select-chantCode" id="{{$item->Id}}">
                                                    @foreach ($arrayChantCode as $itemCode)
                                                        @if ($itemCode->IsGroup == 0 && $itemCode->IsActive == 1)
                                                            <option value="{{ $itemCode->Code }}">{{$itemCode->Code}} - {{$itemCode->Name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" value="{{$arrayChantCode[0]->WorkDay}}" id="WorkDay-{{$item->Id}}" name="WorkDay[]" type="text" placeholder="Nhập số giờ">
                                                    <span class="text-danger error-workday-{{$location}}"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <select name="MachineCode[]" id="{{$item->Id}}">
                                                    <option value="">-----</option>
                                                    @foreach ($arrayMachineCode as $itemCode)
                                                        @if ($itemCode->IsGroup == 0 && $itemCode->IsActive == 1)
                                                            <option value="{{ $itemCode->Code }}">{{$itemCode->Code}} - {{$itemCode->Name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="StageNo[]" id="{{$item->Id}}">
                                                    <option value="">-----</option>
                                                    @foreach ($arrayStage as $itemCode)
                                                        @if ($itemCode->IsGroup == 0 && $itemCode->IsActive == 1)
                                                            <option value="{{ $itemCode->Code }}">{{$itemCode->Code}} - {{$itemCode->Name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            @if ($arrayChildStage->isNotEmpty())
                                                <td>
                                                    <select name="ChildStageNo[]" id="{{$item->Id}}">
                                                        <option value="">-----</option>
                                                        @foreach ($arrayChildStage as $itemCode)
                                                            @if ($itemCode->IsGroup == 0 && $itemCode->IsActive == 1)
                                                                <option value="{{ $itemCode->ChildCode }}">{{$itemCode->ChildCode}} - {{$itemCode->ChildName}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                            @endif
                                            <td>{{number_format($item->JobQuantity,2,",",".")}}</td>
                                            <td>{{number_format($item->JobQuantityTT,2,",",".")}}</td>
                                            <td>{{number_format($item->QuantityCL,2,",",".")}}</td>
                                            <th scope="row">{{$item->DocNo}}</th>
                                            <td>{{$item->ItemLotCode}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-info submit-update" value="update">Cập nhật</button>
                            {{-- <button type="button" class="btn btn-success text-white submit-edit" value="edit">Chỉnh sửa</button> --}}
                            {{-- <button type="button" class="btn btn-info text-white add-row">Thêm</button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('dist/js/production-order.js')}}"></script>
@endpush
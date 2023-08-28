@extends('layout.master')
@section('title', 'Edit')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex">
                        <h4 class="card-title">Cập nhật số lượng</h4>
                    </div>
                    <form action="{{ route('list.update') }}" method="post">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered table-responsive-lg">
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
                                                <select name="ChantCode[]" class="form-select select-chantCode" id="{{$item->Id}}">
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
                                                <select name="MachineCode[]" class="form-select" id="{{$item->Id}}">
                                                    <option>-----</option>
                                                    @foreach ($arrayMachineCode as $itemCode)
                                                        @if ($itemCode->IsGroup == 0 && $itemCode->IsActive == 1)
                                                            <option value="{{ $itemCode->Code }}">{{$itemCode->Code}} - {{$itemCode->Name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="StageNo[]" class="form-select" id="{{$item->Id}}">
                                                    <option>-----</option>
                                                    @foreach ($arrayStage as $itemCode)
                                                        @if ($itemCode->IsGroup == 0 && $itemCode->IsActive == 1)
                                                            <option value="{{ $itemCode->Code }}">{{$itemCode->Code}} - {{$itemCode->Name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
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
                        <button type="button" class="btn btn-primary submit-update" value="update">Cập nhật</button>
                        <button type="button" class="btn btn-success submit-edit" value="edit">Chỉnh sửa</button>
                        <button type="button" class="btn btn-info add-row">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
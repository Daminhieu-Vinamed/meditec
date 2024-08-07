@extends('layout.master')
@section('title', 'Additional Production Order v1')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-grey-light py-3 d-sm-flex align-items-center justify-content-between">
                        <h5 class="m-0 font-bold text-info">BỔ SUNG LỆNH SẢN XUẤT</h5>
                        <div>
                            <button type="button" class="btn btn-info submit-update-production-order">BỔ SUNG</button>
                            <a href="{{ url()->previous() }}" class="btn btn-danger">QUAY LẠI</a>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <div class="infoInTable"></div>
                            <div class="searchInTable"></div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered display nowrap production-order-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Thời gian bổ sung</th>
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Số lượng sản xuất hôm nay</th>
                                        <th scope="col">Phế phẩm</th>
                                        @if (!empty($arrayDept))
                                            <th scope="col">Phân xưởng</th>
                                        @endif
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
                                <tbody class="production-order-tbody">
                                    @foreach ($data as $location => $item)
                                        <tr>
                                            <input type="hidden" name="ItemLotCode[]" value="{{ $item->ItemLotCode }}">
                                            <input type="hidden" name="ProductCode[]" value="{{ $item->ProductCode }}">
                                            <input type="hidden" name="Id[]" value="{{ $item->Id }}">
                                            <td><input class="form-control" name="DocDate[]" type="date"></td>
                                            <td>{{ $item->ProductCode }}</td>
                                            <td>{{ $item->ProductName }}</td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control quantity-sx-{{ $location }}"
                                                        name="QuantitySX[]" type="text" placeholder="Nhập số lượng">
                                                    <span class="text-danger error-quantity-{{ $location }}"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control quantity-fail-{{ $location }}"
                                                        name="QuantityFail[]" type="text" placeholder="Nhập phế phẩm">
                                                    <span class="text-danger error-quantity-fail-{{ $location }}"></span>
                                                </div>
                                            </td>
                                            @if (!empty($arrayDept))
                                                <td>
                                                    <select name="DeptCodetmp[]">
                                                        <option value="">Trống</option>
                                                        @foreach ($arrayDept as $itemCode)
                                                            @if (
                                                                $itemCode->IsGroup == config('constants.number.zero') &&
                                                                    $itemCode->IsActive == config('constants.number.one') &&
                                                                    $itemCode->Loai_Ps !== config('constants.value.null'))
                                                                <option value="{{ $itemCode->Code }}">{{ $itemCode->Code }} -
                                                                    {{ $itemCode->Name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                            @endif
                                            <td>
                                                <select name="ChantCode[]" class="select-chantCode" id="{{ $item->Id }}">
                                                    @foreach ($arrayChantCode as $itemCode)
                                                        @if ($itemCode->IsGroup == config('constants.number.zero') && $itemCode->IsActive == config('constants.number.one'))
                                                            <option value="{{ $itemCode->Code }}">{{ $itemCode->Code }} -
                                                                {{ $itemCode->Name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control"
                                                        value="{{ $arrayChantCode[config('constants.number.zero')]->WorkDay }}"
                                                        id="WorkDay-{{ $item->Id }}" name="WorkDay[]" type="text"
                                                        placeholder="Nhập số giờ">
                                                    <span class="text-danger error-workday-{{ $location }}"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <select name="MachineCode[]" class="select-MachineCode">
                                                    <option value="">Trống</option>
                                                    @foreach ($arrayMachineCode as $itemCode)
                                                        @if ($itemCode->IsGroup == config('constants.number.zero') && $itemCode->IsActive == config('constants.number.one'))
                                                            <option value="{{ $itemCode->Code }}">{{ $itemCode->Code }} -
                                                                {{ $itemCode->Name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="StageNo[]" class="select-StageNo">
                                                    <option value="">Trống</option>
                                                    @foreach ($arrayStage as $itemCode)
                                                        @if ($itemCode->IsGroup == config('constants.number.zero') && $itemCode->IsActive == config('constants.number.one'))
                                                            <option value="{{ $itemCode->Code }}">{{ $itemCode->Code }} -
                                                                {{ $itemCode->Name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            @if ($arrayChildStage->isNotEmpty())
                                                <td>
                                                    <select name="ChildStageNo[]">
                                                        <option value="">Trống</option>
                                                        @foreach ($arrayChildStage as $itemCode)
                                                            @if ($itemCode->IsGroup == config('constants.number.zero') && $itemCode->IsActive == config('constants.number.one'))
                                                                <option value="{{ $itemCode->ChildCode }}">
                                                                    {{ $itemCode->ChildCode }} - {{ $itemCode->ChildName }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                            @endif
                                            <td>{{ number_format($item->JobQuantity, config('constants.number.two'), ',', '.') }}
                                            </td>
                                            <td>{{ number_format($item->JobQuantityTT, config('constants.number.two'), ',', '.') }}
                                            </td>
                                            <td>{{ number_format($item->QuantityCL, config('constants.number.two'), ',', '.') }}
                                            </td>
                                            <th scope="row">{{ $item->DocNo }}</th>
                                            <td>{{ $item->ItemLotCode }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if (empty($arrayDept))
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-success" id="add-product-to-additional-production-order">THÊM MỚI</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('dist/js/production-order-v1.js') }}"></script>
@endpush

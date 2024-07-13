@extends('layout.master')
@section('title', 'Production order 2')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-grey-light py-3 d-sm-flex align-items-center justify-content-between">
                        <h5 class="m-0 font-bold text-info">CẬP NHẬT LỆNH SẢN XUẤT</h5>
                        <div>
                            <button type="button" class="btn btn-info submit-update-production-order">CẬP NHẬT</button>
                            {{-- <a href="{{ route('list.additional-production-order', ['id' => $id]) }}" class="btn btn-info">BỔ SUNG</a> --}}
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <div class="infoInTable"></div>
                            <div class="searchInTable"></div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered display nowrap production-order-table-2" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã nhân viên</th>
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Số lượng sản xuất hôm nay</th>
                                        <th scope="col">Phế phẩm</th>
                                        <th scope="col">Phân xưởng</th>
                                        <th scope="col">Ca sản xuất</th>
                                        <th scope="col">Số giờ</th>
                                        <th scope="col">Mã máy</th>
                                        <th scope="col">Công đoạn</th>
                                        @if ($arrayChildStage->isNotEmpty())
                                            <th scope="col">Công đoạn con</th>
                                        @endif
                                        <th scope="col">Lô</th>
                                        <th scope="col">Số lượng ban đầu</th>
                                        <th scope="col">Số lượng đã sản xuất</th>
                                        <th scope="col">Số lượng còn lại phải sản xuất</th>
                                        <th scope="col">Lệnh sản xuất</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="Employee[]" multiple="multiple">
                                                <option selected disabled>Trống</option>
                                                @foreach ($arrayEmployee as $item)
                                                    <option value="{{ $item->Code }}">{{ $item->Code }} -
                                                        {{ $item->Name }}</option>
                                                @endforeach
                                            </select><br>
                                            <span class="text-danger error-employee-0"></span>
                                        </td>
                                        <td>
                                            <select name="ProductCode[]">
                                                <option value="">Trống</option>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->ProductCode }}"
                                                        ItemLotCode="{{ $item->ItemLotCode }}"
                                                        ProductName="{{ $item->ProductName }}" Id="{{ $item->Id }}"
                                                        JobQuantity="{{ $item->JobQuantity }}"
                                                        JobQuantityTT="{{ $item->JobQuantityTT }}"
                                                        QuantityCL="{{ $item->QuantityCL }}" DocNo="{{ $item->DocNo }}">
                                                        {{ $item->ProductCode }} - {{ $item->ProductName }}</option>
                                                @endforeach
                                            </select><br>
                                            <span class="text-danger error-product-code-0"></span>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control" name="QuantitySX[]" type="text"
                                                    placeholder="Nhập số lượng">
                                                <span class="text-danger error-quantity-0"></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control" name="QuantityFail[]" type="text"
                                                    placeholder="Nhập phế phẩm">
                                                <span class="text-danger error-quantity-fail-0"></span>
                                            </div>
                                        </td>
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
                                        <td>
                                            <select name="ChantCode[]">
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
                                                <input class="form-control" name="WorkDay[]" type="text" placeholder="Nhập số giờ">
                                                <span class="text-danger error-workday-0"></span>
                                            </div>
                                        </td>
                                        <td>
                                            <select name="MachineCode[]">
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
                                            <select name="StageNo[]">
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
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <div>
                                <button class="btn btn-success" id="add-row">THÊM MỚI</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('dist/js/production-order-2.js') }}"></script>
@endpush

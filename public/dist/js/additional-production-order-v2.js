/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./resources/js/additional-production-order-v2.js ***!
  \********************************************************/
$(document).ready(function () {
  var productionOrderTable = $('.production-order-table-2').DataTable({
    rowReorder: true,
    paginate: false,
    bFilter: false,
    ordering: false,
    language: {
      emptyTable: 'Danh sách hiện tại đang trống',
      info: "Tổng có _TOTAL_ sản phẩm",
      zeroRecords: "Không có sản phẩm nào có dữ liệu bạn tìm kiếm"
    },
    drawCallback: function drawCallback() {
      $('[name="ProductCode[]"], [name="MachineCode[]"], [name="ChantCode[]"], [name="StageNo[]"], [name="ChildStageNo[]"]').select2();
      $('[name="Employee[]"]').select2({
        placeholder: "Chọn mã nhân viên",
        allowClear: true
      });
      $('[name="ChantCode[]"], [name="DeptCodetmp[]"]').select2({
        minimumResultsForSearch: -1
      });
    },
    createdRow: function createdRow(row, data, dataIndex) {
      $($(row).children()[4]).attr('id', 'ProductName');
      $($(row).children()[11]).attr('id', 'Performance');
      $($(row).children()[12]).attr('id', 'ItemLotCode');
      $($(row).children()[13]).attr('id', 'DocNo');
    }
  });
  $('.dataTables_info').appendTo('.infoInTable');
  function addRow(locationId) {
    arrayColumn = ['<input type="checkbox" name="arrayCheckbox[]" class="checkbox-delete-row"/>', '<input class="form-control" name="DocDate[]" type="date">', "<select name=\"Employee[]\" id=\"Employee" + locationId + "\" multiple=\"multiple\"></select><br>\n            <span class=\"text-danger error-employee-" + locationId + "\"></span>", "<select name=\"ProductCode[]\" id=\"ProductCode" + locationId + "\">\n                <option value=\"\">Tr\u1ED1ng</option>\n            </select><br>\n            <span class=\"text-danger error-product-code-" + locationId + "\"></span>", '', "<select name=\"StageNo[]\" id=\"StageNo" + locationId + "\"></select>", "<select name=\"MachineCode[]\" id=\"MachineCode" + locationId + "\"></select>", "<input class=\"form-control\" name=\"QuantitySX[]\" id=\"QuantitySX" + locationId + "\" placeholder=\"Nh\u1EADp s\u1ED1 l\u01B0\u1EE3ng\"/>\n            <span class=\"text-danger error-quantity-" + locationId + "\"></span>", "<select name=\"DeptCodetmp[]\" id=\"DeptCodetmp" + locationId + "\"></select>", "<select name=\"ChantCode[]\" id=\"ChantCode" + locationId + "\"></select>", "<input class=\"form-control\" name=\"WorkDay[]\" type=\"text\" placeholder=\"Nh\u1EADp s\u1ED1 gi\u1EDD\">\n            <span class=\"text-danger error-workday-" + locationId + "\"></span>", '', '', ''];
    productionOrderTable.row.add(arrayColumn).draw(false);

    //Employee
    $('tbody > tr > td > #Employee0 option').each(function () {
      $('#Employee' + locationId + '').append('<option value="' + $(this).val() + '">' + $(this).text() + '</option>');
    });

    //Chant Code
    $('tbody > tr > td > #ProductCode0 option').each(function () {
      $('#ProductCode' + locationId + '').append("<option value=\"" + $(this).val() + "\" \n            ItemLotCode=\"" + $(this).attr('ItemLotCode') + "\" \n            ProductName=\"" + $(this).attr('ProductName') + "\"\n            Id=\"" + $(this).attr('Id') + "\"\n            DocNo=\"" + $(this).attr('DocNo') + "\" \n            CapacityOne=\"" + $(this).attr('CapacityOne') + "\">" + $(this).text() + "</option>");
    });
    $('#ProductCode' + locationId + ' option:eq(1)').remove();
    $('#ProductCode' + locationId + '').val($('#ProductCode' + locationId + ' option:eq(0)').val()).trigger('change');

    //Dept Code
    $('tbody > tr > td > #DeptCodetmp0 option').each(function () {
      $('#DeptCodetmp' + locationId + '').append('<option value="' + $(this).val() + '">' + $(this).text() + '</option>');
    });
    $('#DeptCodetmp' + locationId + '').val($('#DeptCodetmp' + locationId + ' option:eq(0)').val()).trigger('change');

    //Chant Code
    $('tbody > tr > td > #ChantCode0 option').each(function () {
      $('#ChantCode' + locationId + '').append('<option value="' + $(this).val() + '">' + $(this).text() + '</option>');
    });
    $('#ChantCode' + locationId + '').val($('#ChantCode' + locationId + ' option[value="HC"]').val()).trigger('change');

    //Machine Code
    $('tbody > tr > td > #MachineCode0 option').each(function () {
      $('#MachineCode' + locationId + '').append('<option value="' + $(this).val() + '">' + $(this).text() + '</option>');
    });
    $('#MachineCode' + locationId + '').val($('#MachineCode' + locationId + ' option:eq(0)').val()).trigger('change');

    //Stage No
    $('tbody > tr > td > #StageNo0 option').each(function () {
      $('#StageNo' + locationId + '').append('<option value="' + $(this).val() + '">' + $(this).text() + '</option>');
    });
    $('#StageNo' + locationId + '').val($('#StageNo' + locationId + ' option:eq(0)').val()).trigger('change');
  }
  function workDayAndPerformanceCount(trParent, QuantitySX, CapacityOne) {
    if (CapacityOne && QuantitySX && $.isNumeric(CapacityOne) && $.isNumeric(QuantitySX)) {
      var workDay = Number(QuantitySX) / Number(CapacityOne);
      var Performance = Number(QuantitySX) / workDay / Number(CapacityOne);
      trParent.find("input[name='WorkDay[]']").val(Math.floor(workDay * 100) / 100);
      trParent.find("#Performance").text(Math.ceil(Performance * 100) + '%');
    } else {
      if (QuantitySX && $.isNumeric(QuantitySX)) {
        trParent.find("input[name='WorkDay[]']").val(QuantitySX);
      } else {
        trParent.find("input[name='WorkDay[]']").val(null);
      }
      trParent.find("#Performance").text(null);
    }
  }
  $(document).on('change', "select[name='ProductCode[]']", function () {
    var trParent = $(this).parent().parent();
    var element = $(this).children('option:selected');
    var ProductCode = element.attr("value");
    var Id = element.attr("Id");
    var ItemLotCode = element.attr("ItemLotCode");
    var ProductName = element.attr("ProductName");
    var DocNo = element.attr("DocNo");
    var ProductNameHTML = ProductName ? ProductName : '';
    if (ItemLotCode && Id) {
      ProductNameHTML = ProductNameHTML + "<input type=\"hidden\" name=\"ItemLotCode[]\" value=\"" + ItemLotCode + "\">\n            <input type=\"hidden\" name=\"Id[]\" value=\"" + Id + "\">";
    }
    trParent.find("#ProductName").html(ProductNameHTML);
    trParent.find("#ItemLotCode").text(ItemLotCode ? ItemLotCode : '');
    trParent.find("#DocNo").text(DocNo ? DocNo : '');
    trParent.find("input[name='QuantitySX[]']").val(null);
    $.ajax({
      url: "/semi-finished-product-code",
      type: 'GET',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        ProductCode: ProductCode
      },
      success: function success(responseSuccess) {
        var stageNoSelect = trParent.find("select[name='StageNo[]']");
        stageNoSelect.find('option').remove();
        stageNoSelect.append('<option value="">Trống</option>');
        stageNoSelect.val(stageNoSelect.children('option:eq(0)').val()).trigger('change');
        responseSuccess.arrStageNo.forEach(function (element) {
          stageNoSelect.append('<option value="' + element.ItemCode + '" CapacityOne="' + element.CapacityOne + '">' + element.ItemCode + '</option>');
        });
      },
      error: function error(responseError) {
        Toast.fire({
          icon: 'error',
          title: 'Hệ thống đang xảy ra lỗi !'
        });
      }
    });
  });
  $(document).on('change', "select[name='StageNo[]']", function () {
    var trParent = $(this).parent().parent();
    var element = $(this).children('option:selected');
    var CapacityOneProductCode = trParent.find("select[name='ProductCode[]']").children('option:selected').attr("CapacityOne");
    var CapacityOneStageNo = element.attr("CapacityOne");
    var CapacityOne = CapacityOneStageNo ? CapacityOneStageNo : CapacityOneProductCode;
    var QuantitySX = trParent.find("input[name='QuantitySX[]']").val();
    workDayAndPerformanceCount(trParent, QuantitySX, CapacityOne);
  });
  $(document).on('change keyup paste', "input[name='QuantitySX[]']", function () {
    var trParent = $(this).parent().parent();
    var CapacityOneProductCode = trParent.find("select[name='ProductCode[]']").children('option:selected').attr("CapacityOne");
    var CapacityOneStageNo = trParent.find("select[name='StageNo[]']").children('option:selected').attr("CapacityOne");
    var CapacityOne = CapacityOneStageNo ? CapacityOneStageNo : CapacityOneProductCode;
    var QuantitySX = $(this).val();
    workDayAndPerformanceCount(trParent, QuantitySX, CapacityOne);
  });
  $(document).on('change keyup paste', "input[name='WorkDay[]']", function () {
    var trParent = $(this).parent().parent();
    var workDay = $(this).val();
    var QuantitySX = trParent.find("input[name='QuantitySX[]']").val();
    var CapacityOneProductCode = trParent.find("select[name='ProductCode[]']").children('option:selected').attr("CapacityOne");
    var CapacityOneStageNo = trParent.find("select[name='StageNo[]']").children('option:selected').attr("CapacityOne");
    var CapacityOne = CapacityOneStageNo ? CapacityOneStageNo : CapacityOneProductCode;
    if (workDay && CapacityOne && QuantitySX && $.isNumeric(workDay) && $.isNumeric(CapacityOne) && $.isNumeric(QuantitySX)) {
      var Performance = Number(QuantitySX) / workDay / Number(CapacityOne);
      trParent.find("#Performance").text(Math.ceil(Performance * 100) + '%');
    } else {
      trParent.find("#Performance").text(null);
    }
  });
  $(document).on('click', '#add_row', function () {
    var locationId = $('tbody tr').length;
    addRow(locationId);
    if (!$('.delete-new-product').is('*')) {
      $(this).parent().append('<button class="btn btn-danger delete-new-product">XÓA</button>');
    }
  });
  $(document).on('click', '.delete-new-product', function () {
    var arrayCheckbox = $("input[name='arrayCheckbox[]']").map(function () {
      if ($(this).prop('checked')) {
        return $(this);
      }
    }).get();
    var countRow = productionOrderTable.page.info().recordsTotal;
    if ($.isArray(arrayCheckbox) && arrayCheckbox.length > 0) {
      if (countRow == arrayCheckbox.length) {
        var locationId = 0;
        addRow(locationId);
      }
      arrayCheckbox.forEach(function (element) {
        productionOrderTable.row(element.parents('tr')).remove().draw();
      });
      Toast.fire({
        icon: 'success',
        title: 'Xóa sản phẩm thành công !'
      });
    } else {
      Toast.fire({
        icon: 'error',
        title: 'Chưa chọn sản phẩm để xóa !'
      });
    }
  });
  $(document).on('click', '.submit-update-production-order', function () {
    var arrEmployee = [];
    for (var index = 0; index < productionOrderTable.rows().count(); index++) {
      var employee = $('#Employee' + index + '').val();
      var arrEmployeeChild = [];
      if (employee.length > 0) {
        for (var _index = 0; _index < employee.length; _index++) {
          arrEmployeeChild[_index] = employee[_index];
        }
        arrEmployee[index] = arrEmployeeChild;
      } else {
        arrEmployee[index] = '';
      }
    }
    var DocDate = $("input[name='DocDate[]']").map(function () {
      return $(this).val();
    }).get();
    var QuantitySX = $("input[name='QuantitySX[]']").map(function () {
      return $(this).val();
    }).get();
    var WorkDay = $("input[name='WorkDay[]']").map(function () {
      return $(this).val();
    }).get();
    var ItemLotCode = $("input[name='ItemLotCode[]']").map(function () {
      return $(this).val();
    }).get();
    var ProductCode = $("[name='ProductCode[]']").map(function () {
      return $(this).val();
    }).get();
    var Id = $("input[name='Id[]']").map(function () {
      return $(this).val();
    }).get();
    var ChantCode = $("select[name='ChantCode[]']").map(function () {
      return $(this).val();
    }).get();
    var MachineCode = $("[name='MachineCode[]']").map(function () {
      return $(this).val();
    }).get();
    var DeptCodetmp = $("select[name='DeptCodetmp[]']").map(function () {
      return $(this).val();
    }).get();
    var StageNo = $("select[name='StageNo[]']").map(function () {
      return $(this).val();
    }).get();
    $.ajax({
      url: "/update-production-order-v2",
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        DocDate: DocDate,
        Employee: arrEmployee,
        QuantitySX: QuantitySX,
        WorkDay: WorkDay,
        ItemLotCode: ItemLotCode,
        ProductCode: ProductCode,
        ChantCode: ChantCode,
        Id: Id,
        MachineCode: MachineCode,
        DeptCodetmp: DeptCodetmp,
        StageNo: StageNo
      },
      success: function success(dataSuccess) {
        for (var i = 0; i < QuantitySX.length; i++) {
          $('.error-quantity-' + i).html('');
          $('.error-workday-' + i).html('');
          $('.error-product-code-' + i).val('');
          $('.error-employee-' + i).val('');
        }
        if (dataSuccess.error) {
          ToastErrorCenter.fire({
            text: dataSuccess.error
          });
        } else {
          ToastSuccessCenterTime.fire({
            title: dataSuccess.success
          }).then(function (result) {
            if (result.dismiss === Swal.DismissReason.timer) {
              sessionStorage.clear();
              location.href = window.location.origin + '/logout';
            }
          });
        }
      },
      error: function error(dataError) {
        var _dataError$responseJS;
        var errors = (_dataError$responseJS = dataError.responseJSON) === null || _dataError$responseJS === void 0 ? void 0 : _dataError$responseJS.errors;
        for (var i = 0; i < QuantitySX.length; i++) {
          errors['QuantitySX.' + i] ? $('.error-quantity-' + i).html(errors['QuantitySX.' + i][0]) : $('.error-quantity-' + i).html('');
          errors['WorkDay.' + i] ? $('.error-workday-' + i).html(errors['WorkDay.' + i][0]) : $('.error-workday-' + i).html('');
          errors['ProductCode.' + i] ? $('.error-product-code-' + i).html(errors['ProductCode.' + i][0]) : $('.error-product-code-' + i).html('');
          errors['Employee.' + i] ? $('.error-employee-' + i).html(errors['Employee.' + i][0]) : $('.error-employee-' + i).html('');
          errors['DocDate.' + i] ? $('.error-doc-date-' + i).html(errors['DocDate.' + i][0]) : $('.error-doc-date-' + i).html('');
        }
        Toast.fire({
          icon: 'error',
          title: 'Cập nhật lệnh sản xuất thất bại !'
        });
      }
    });
  });
});
/******/ })()
;
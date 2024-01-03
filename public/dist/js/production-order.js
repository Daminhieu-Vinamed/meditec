/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/production-order.js ***!
  \******************************************/
$(document).ready(function () {
  var productionOrderTable = $('.production-order-table').DataTable({
    rowReorder: true,
    paginate: false,
    language: {
      emptyTable: 'Danh sách hiện tại đang trống',
      search: "Tìm kiếm sản phẩm có dữ liệu _INPUT_",
      info: "Tổng có _TOTAL_ sản phẩm",
      zeroRecords: "Không có sản phẩm nào có dữ liệu bạn tìm kiếm"
    },
    drawCallback: function drawCallback() {
      $('[name="MachineCode[]"], [name="ChantCode[]"], [name="StageNo[]"], [name="ChildStageNo[]"]').select2();
      $('[name="ChantCode[]"], [name="DeptCodetmp[]"]').select2({
        minimumResultsForSearch: -1
      });
    }
  });
  $('.dataTables_info').appendTo('.infoInTable');
  $('.dataTables_filter').appendTo('.searchInTable');
  $('.select-chantCode').change(function () {
    getTime($(this).val(), $(this).attr('id'), 'WorkDay');
  });
  function addRow(locationId, idButtonAddProduct) {
    arrayColumn = ["<select name=\"ProductCode[]\" id=\"ProductCode-" + locationId + "\">\n                <option value=\"\">Tr\u1ED1ng</option>" + JSON.parse(sessionStorage.getItem('product-code')).map(function (item) {
      return "<option value=" + item.ProductCode + ">" + item.ProductCode + " - " + item.Name + "</option>";
    }) + "</select><br>\n            <span class=\"text-danger error-product-code-" + locationId + "\"></span>", '', "<input class=\"form-control\" name=\"QuantitySX[]\" placeholder=\"Nh\u1EADp s\u1ED1 l\u01B0\u1EE3ng\"/>\n            <span class=\"text-danger error-quantity-" + locationId + "\"></span>", "<input class=\"form-control\" name=\"QuantityFail[]\" placeholder=\"Nh\u1EADp ph\u1EBF ph\u1EA9m\"/>\n            <span class=\"text-danger error-quantity-fail-" + locationId + "\"></span>", "<select name=\"ChantCode[]\" id=\"" + locationId + "\" class=\"select-chantCode select2-chantCode-" + locationId + "\"></select>", "<input class=\"form-control\" id=\"WorkDay-" + locationId + "\" name=\"WorkDay[]\" type=\"text\" placeholder=\"Nh\u1EADp s\u1ED1 gi\u1EDD\">\n            <span class=\"text-danger error-workday-" + locationId + "\"></span>", "<select name=\"MachineCode[]\" id=\"MachineCode-" + locationId + "\"></select>", "<select name=\"StageNo[]\" id=\"StageNo-" + locationId + "\"></select>", "<input class=\"form-control\" name=\"ItemLotCode[]\" type=\"text\" placeholder=\"Nh\u1EADp l\xF4\">\n            <span class=\"text-danger error-item-lot-code-" + locationId + "\"></span>", "<button class=\"btn btn-danger delete-new-product\">X\xF3a s\u1EA3n ph\u1EA9m</button>", '', '', ''];
    if (idButtonAddProduct === 'add-product-to-additional-production-order') {
      var columnTime = "<input class=\"form-control\" name=\"DocDate[]\" type=\"date\">";
      arrayColumn.unshift(columnTime);
    }
    productionOrderTable.row.add(arrayColumn).draw(false);
    $('.delete-new-product').on('click', function () {
      productionOrderTable.row($(this).parents('tr')).remove().draw();
    });

    //Select2
    $('#ProductCode-' + locationId + ', #MachineCode-' + locationId + ', #StageNo-' + locationId + '').select2();
    $('.select2-chantCode-' + locationId + '').select2({
      minimumResultsForSearch: -1
    });

    //Product Code
    $('#ProductCode-' + locationId + '').on('change', function () {
      var _this = this;
      var MyJSON = JSON.parse(sessionStorage.getItem('product-code'));
      var objectProduct = MyJSON.find(function (element) {
        return element.ProductCode === $(_this).val();
      });
      $(this).parent().next('td').text(objectProduct.Name);
    });

    //Chant Code
    $(".production-order-tbody > tr:first > td > .select-chantCode option").each(function () {
      $('.select2-chantCode-' + locationId + '').append('<option value="' + $(this).val() + '">' + $(this).text() + '</option>');
    });
    $('.select2-chantCode-' + locationId + '').val($('.select2-chantCode-' + locationId + ' option:eq(0)').val()).trigger('change');
    getTime($('.select2-chantCode-' + locationId + ' option:eq(0)').val(), locationId, 'WorkDay');
    $('.select2-chantCode-' + locationId + '').change(function () {
      getTime($(this).val(), $(this).attr('id'), 'WorkDay');
    });

    //Machine Code
    $(".production-order-tbody > tr:first > td > .select-MachineCode option").each(function () {
      $('#MachineCode-' + locationId + '').append('<option value="' + $(this).val() + '">' + $(this).text() + '</option>');
    });
    $('#MachineCode-' + locationId + '').val($('#MachineCode-' + locationId + ' option:eq(0)').val()).trigger('change');

    //Stage No
    $(".production-order-tbody > tr:first > td > .select-StageNo option").each(function () {
      $('#StageNo-' + locationId + '').append('<option value="' + $(this).val() + '">' + $(this).text() + '</option>');
    });
    $('#StageNo-' + locationId + '').val($('#StageNo-' + locationId + ' option:eq(0)').val()).trigger('change');
  }
  $(document).on('click', '#add-product-to-production-order, #add-product-to-additional-production-order', function () {
    var locationId = $('.production-order-tbody tr').length;
    var idButtonAddProduct = $(this).attr('id');
    if (sessionStorage.getItem('product-code') === null) {
      $.ajax({
        url: "/get-product-code",
        type: 'GET',
        success: function success(data) {
          var myJSON = JSON.stringify(data.arrayProductCode);
          sessionStorage.setItem('product-code', myJSON);
          addRow(locationId, idButtonAddProduct);
        }
      });
    } else {
      addRow(locationId, idButtonAddProduct);
    }
  });
  $(document).on('click', '.submit-update-production-order', function () {
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
    var QuantityFail = $("input[name='QuantityFail[]']").map(function () {
      return $(this).val();
    }).get();
    var DeptCodetmp = $("select[name='DeptCodetmp[]']").map(function () {
      return $(this).val();
    }).get();
    var DocDate = $("input[name='DocDate[]']").map(function () {
      return $(this).val();
    }).get();
    $.ajax({
      url: "/update-production-order",
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        QuantitySX: QuantitySX,
        WorkDay: WorkDay,
        ItemLotCode: ItemLotCode,
        ProductCode: ProductCode,
        ChantCode: ChantCode,
        Id: Id,
        QuantityFail: QuantityFail,
        MachineCode: MachineCode,
        DeptCodetmp: DeptCodetmp,
        DocDate: DocDate
      },
      success: function success(dataSuccess) {
        for (var i = 0; i < QuantitySX.length; i++) {
          $('.error-quantity-' + i).html('');
          $('.error-workday-' + i).html('');
          $('.quantity-sx-' + i).val('');
          $('.quantity-fail-' + i).val('');
        }
        if (dataSuccess.error_incorrect) {
          ToastErrorCenter.fire({
            text: dataSuccess.error_incorrect
          });
        } else {
          ToastSuccessCenterTime.fire({
            title: dataSuccess.error_correct
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
          errors['QuantityFail.' + i] ? $('.error-quantity-fail-' + i).html(errors['QuantityFail.' + i][0]) : $('.error-quantity-fail-' + i).html('');
          errors['WorkDay.' + i] ? $('.error-workday-' + i).html(errors['WorkDay.' + i][0]) : $('.error-workday-' + i).html('');
          errors['ProductCode.' + i] ? $('.error-product-code-' + i).html(errors['ProductCode.' + i][0]) : $('.error-product-code-' + i).html('');
          errors['ItemLotCode.' + i] ? $('.error-item-lot-code-' + i).html(errors['ItemLotCode.' + i][0]) : $('.error-item-lot-code-' + i).html('');
          errors['DeptCodetmp.' + i] ? $('.error-dept-code-mp-' + i).html(errors['DeptCodetmp.' + i][0]) : $('.error-dept-code-mp-' + i).html('');
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
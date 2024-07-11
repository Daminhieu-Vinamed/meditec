/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/approval-vote-detail.js ***!
  \**********************************************/
$(document).ready(function () {
  $('.approval-vote-detail-table').DataTable({
    rowReorder: true,
    paginate: false,
    language: {
      emptyTable: 'Danh sách hiện tại đang trống',
      search: "Tìm kiếm bản ghi có dữ liệu _INPUT_",
      info: "Tổng có _TOTAL_ bản ghi",
      zeroRecords: "Không có bản ghi nào có dữ liệu bạn tìm kiếm"
    },
    drawCallback: function drawCallback() {
      $('.totalInPage, [name="ChantCode[]"]').select2({
        minimumResultsForSearch: -1
      });
      $('[name="MachineCode[]"]').select2();
    }
  });
  $('.dataTables_info').appendTo('.infoInTable');
  $('.dataTables_filter').appendTo('.searchInTable');
  function hasAlphabet(string) {
    for (var i = 0; i < string.length; i++) {
      if (/[a-zA-Z]/.test(string.charAt(i))) {
        return true;
      }
    }
    return false;
  }
  $("select[name='MachineCode[]']").change(function () {
    var machineName = $(this).children('option:selected').attr('machine-name');
    $(this).parent().parent().find("td:eq(1)").text(machineName === undefined ? '' : machineName);
  });
  $(document).on('click', '.update-status-approval-vote-detail', function () {
    var parentId = $(this).attr('id');
    var Id = $("input[name='Id[]']").map(function () {
      return $(this).val();
    }).get();
    var MachineCode = $("select[name='MachineCode[]']").map(function () {
      return $(this).val();
    }).get();
    var ChantCode = $("select[name='ChantCode[]']").map(function () {
      return $(this).val();
    }).get();
    var TimeExcute = $("input[name='TimeExcute[]']").map(function () {
      return $(this).val();
    }).get();
    var Quantity9 = $("input[name='Quantity9[]']").map(function () {
      return $(this).val();
    }).get();
    Quantity9.forEach(function (element, key) {
      if (hasAlphabet(element) && element.length !== 0) {
        Quantity9[key] = "string";
      }
    });
    $.ajax({
      url: "/update-status-detail-approval-vote",
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        parentId: parentId,
        Id: Id,
        MachineCode: MachineCode,
        ChantCode: ChantCode,
        TimeExcute: TimeExcute,
        Quantity9: Quantity9
      },
      success: function success(dataSuccess) {
        var link = window.location.origin;
        if (dataSuccess.error_correct === undefined) {
          Toast.fire({
            icon: 'success',
            title: 'Duyệt phiếu thành công !'
          });
          location.href = link + '/approval-vote';
        } else {
          Toast.fire({
            icon: 'success',
            title: dataSuccess.error_correct
          });
        }
      },
      error: function error(dataError) {
        var _dataError$responseJS;
        var errors = (_dataError$responseJS = dataError.responseJSON) === null || _dataError$responseJS === void 0 ? void 0 : _dataError$responseJS.errors;
        for (var i = 0; i < Quantity9.length; i++) {
          errors['Quantity9.' + i] ? $('.error-quantity-' + i).html(errors['Quantity9.' + i][0]) : $('.error-quantity-' + i).html('');
          errors['TimeExcute.' + i] ? $('.error-time-excute-' + i).html(errors['TimeExcute.' + i][0]) : $('.error-time-excute-' + i).html('');
        }
        if (dataError.error_incorrect !== undefined) {
          ToastErrorCenter.fire({
            text: dataError.error_incorrect
          });
        } else {
          Toast.fire({
            icon: 'error',
            title: 'Duyệt phiếu thất bại !'
          });
        }
      }
    });
  });
});
/******/ })()
;
/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/get-time-by-shift.js ***!
  \*******************************************/
function getTime(valueSelect, idNumberSelect, idStringSelect) {
  if (sessionStorage.getItem('string-all-shift') === null) {
    $.ajax({
      url: "/get-time",
      type: 'GET',
      success: function success(data) {
        var objectShift = data.shiftAll.find(function (element) {
          return element.Code === valueSelect;
        });
        $('#' + idStringSelect + '-' + idNumberSelect + '').val(objectShift.WorkDay);
        var myJSON = JSON.stringify(data.shiftAll);
        sessionStorage.setItem('string-all-shift', myJSON);
      }
    });
  } else {
    var MyJSON = JSON.parse(sessionStorage.getItem('string-all-shift'));
    var objectShift = MyJSON.find(function (element) {
      return element.Code === valueSelect;
    });
    $('#' + idStringSelect + '-' + idNumberSelect + '').val(objectShift.WorkDay);
  }
}
/******/ })()
;
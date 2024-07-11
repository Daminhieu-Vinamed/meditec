/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/scan-qr-code.js ***!
  \**************************************/
$(document).ready(function () {
  function onScanSuccess(decodedText, decodedResult) {
    $.ajax({
      url: 'scan-qr-code',
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        data: decodedText
      },
      success: function success(response) {
        var link = window.location.origin;
        var id = response.url.slice(response.url.lastIndexOf("/") + 1);
        location.href = link + '/edit/' + id;
      },
      error: function error(jqXHR, textStatus, errorThrown) {
        console.error('AJAX error:', textStatus, errorThrown);
      }
    });
  }
  function onScanFailure(error) {
    // console.warn(`Code scan error = ${error}`);
  }
  function getQrBoxSize() {
    var width = $('#reader-camera').width();
    return Math.min(250, width * 0.8);
  }
  var html5QrcodeScanner = new Html5QrcodeScanner("reader-camera", {
    fps: 10,
    qrbox: getQrBoxSize()
  }, false);
  html5QrcodeScanner.render(onScanSuccess, onScanFailure);
  $(window).resize(function () {
    html5QrcodeScanner.clear();
    html5QrcodeScanner = new Html5QrcodeScanner("reader-camera", {
      fps: 10,
      qrbox: getQrBoxSize()
    }, false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
  });
});
/******/ })()
;
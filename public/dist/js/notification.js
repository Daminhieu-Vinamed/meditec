var Toast = Swal.mixin({
    toast: true,
    position: 'top-right',
    customClass: {
      popup: 'colored-toast'
    },
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    didOpen: function didOpen(toast) {
      toast.addEventListener('mouseenter', Swal.stopTimer);
      toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

var ToastErrorCenter = Swal.mixin({
    icon: 'error',
    title: 'THÔNG BÁO !',
    confirmButtonColor: '#137eff',
    customClass: {
        confirmButton: 'btn btn-info',
    }
})

let timerInterval
var ToastSuccessCenterTime = Swal.mixin({
    icon: 'success',
    html: 'Hệ thống sẽ tự động đăng xuất sau khi thời gian kết thúc.\n Thời gian còn <b></b> milli giây',
    timer: 5000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft()
        }, 100)
    },
    willClose: () => {
        clearInterval(timerInterval)
    }
})

var ToastSuccessCenterLogin = Swal.mixin({
    showDenyButton: true,
    confirmButtonText: 'OK',
    denyButtonText: `HỦY`,
    icon: 'info',
    customClass: {
        confirmButton: 'btn btn-primary',
        denyButton: 'btn btn-danger',
    }
})
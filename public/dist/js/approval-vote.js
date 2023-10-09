$(document).ready(function () {
    var aprrovalVote = $('.approval-vote-table').DataTable({
        ajax: {
            type: 'get',
            url: 'get-data',
        },
        columns: [
            { data: 'DeptName', name: 'DeptName' },
            { data: 'DocNo', name: 'DocNo' },
            { data: 'DocStatusName', name: 'DocStatusName' },
            { data: 'action', name: 'action' },
            { data: 'DocDate', name: 'DocDate' },
            { data: 'Description', name: 'Description' },
        ],
        responsive: true,
        rowReorder: true,
        scrollX: true,
        language: {
            emptyTable: 'Danh sách hiện tại đang trống',
            info: "Đang hiển thị trang _PAGE_ trên tổng _PAGES_ trang, _PAGES_ trang này có tổng _TOTAL_ phiếu",
            lengthMenu: 'Hiển thị <select>'+
                        '<option value="10">10 phiếu trên trang</option>'+
                        '<option value="20">20 phiếu trên trang</option>'+
                        '<option value="30">30 phiếu trên trang</option>'+
                        '<option value="40">40 phiếu trên trang</option>'+
                        '<option value="50">50 phiếu trên trang</option>'+
                        '<option value="-1">tất cả phiếu trên trang</option>'+
                        '</select>',
            search: "Tìm kiếm phiếu có dữ liệu _INPUT_",
            paginate: {
                previous: '<i class="fa-solid fa-caret-left"></i>',
                next: '<i class="fa-solid fa-caret-right"></i>',
            },
        }
    });

    $('select').select2({ minimumResultsForSearch: -1 });

    $(document).on('click', '.update-status-approval-vote', function () {
        const parentId = $(this).attr('id');
        $.ajax({
            url: "/update-status-approval-vote",
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                parentId: parentId
            },
            success: function(notification) {
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
                if (notification.error_correct  === undefined) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Duyệt phiếu thành công !'
                    })
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: notification.error_correct
                    })
                }
                aprrovalVote.ajax.reload();
            },
            error: function (notification) {
                if (notification.error_incorrect !== undefined) {
                    alert(notification.error_incorrect);
                } else {
                    alert('Lỗi hệ thống !');
                }
            }
        });
    });
})
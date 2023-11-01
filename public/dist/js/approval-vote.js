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
                previous: '<i class="previous">&laquo;</i>',
                next: '<i class="next">&raquo;</i>',
            },
            zeroRecords: "Không có phiếu nào có dữ liệu bạn tìm kiếm"
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
                    ToastErrorCenter.fire({
                        text: notification.error_incorrect,
                    })
                } else {
                    ToastErrorCenter.fire({
                        text: 'Duyệt phiếu thất bại !',
                    })
                }
            }
        });
    });
})
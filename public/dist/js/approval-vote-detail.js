$(document).ready(function () {
    $('.approval-vote-detail-table').DataTable({
        responsive: true,
        rowReorder: true,
        scrollX: true,
        language: {
            emptyTable: 'Danh sách hiện tại đang trống',
            info: "Đang hiển thị trang _PAGE_ trên tổng _PAGES_ trang, _PAGES_ trang này có tổng _TOTAL_ bản ghi",
            lengthMenu: 'Hiển thị <select class="totalInPage">'+
                        '<option value="10">10 bản ghi trên trang</option>'+
                        '<option value="20">20 bản ghi trên trang</option>'+
                        '<option value="30">30 bản ghi trên trang</option>'+
                        '<option value="40">40 bản ghi trên trang</option>'+
                        '<option value="50">50 bản ghi trên trang</option>'+
                        '<option value="-1">tất cả bản ghi trên trang</option>'+
                        '</select>',
            search: "Tìm kiếm phiếu có dữ liệu _INPUT_",
            paginate: {
                previous: '<i class="fa-solid fa-caret-left"></i>',
                next: '<i class="fa-solid fa-caret-right"></i>',
            },
        },
        drawCallback: function() {
            $('.totalInPage, [name="ChantCode[]"]').select2({ minimumResultsForSearch: -1 });
            $('[name="MachineCode[]"]').select2();
        }
    })
    $(document).on('click', '.update-status-approval-vote-detail', function () {
        const parentId = $(this).attr('id');
        const Id = $("input[name='Id[]']").map(function(){return $(this).val();}).get();
        const MachineCode = $("select[name='MachineCode[]']").map(function(){return $(this).val();}).get();
        const ChantCode = $("select[name='ChantCode[]']").map(function(){return $(this).val();}).get();
        const TimeExcute = $("input[name='TimeExcute[]']").map(function(){return $(this).val();}).get();
        const Quantity9 = $("input[name='Quantity9[]']").map(function(){return $(this).val();}).get();
        $.ajax({
            url: "/update-status-detail-approval-vote",
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                parentId: parentId,
                Id: Id,
                MachineCode: MachineCode,
                ChantCode: ChantCode,
                TimeExcute: TimeExcute,
                Quantity9: Quantity9,
            },
            success: function(notification) {
                if (notification.error_correct  === undefined) {
                    alert('Duyệt phiếu thành công !')
                } else {
                    alert(notification.error_correct);   
                }
                window.location.reload();
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
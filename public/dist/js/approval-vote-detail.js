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
        drawCallback: function() {
            $('.totalInPage, [name="ChantCode[]"]').select2({ minimumResultsForSearch: -1 });
            $('[name="MachineCode[]"]').select2();
        }
    })
    $('.dataTables_info').appendTo('.infoInTable');
    $('.dataTables_filter').appendTo('.searchInTable');
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
$(document).ready(function () {
    if ($('.update-status-approval-vote').length !== 0) {
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
                    alert(notification.error_correct);
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
    } else {
        $('[name="MachineCode[]"]').select2();
        $('[name="ChantCode[]"]').select2({ minimumResultsForSearch: -1 });
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
                    alert(notification.error_correct);
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
    }
})
$(document).ready(function () {
    $(document).on('click', '.submit-update', function () {
        const parentId = $(this).attr('id');
        $.ajax({
            url: "/update-status-detail-approval-vote",
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
})
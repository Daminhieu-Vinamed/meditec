$(function() {
    $('.login-user').click(function(){ 
        var Code = $("input[name='Code']").val();
        var password = $("input[name='password']").val();
        if ($("input[name='id']").length > 0) {
            var id = $("input[name='id']").val();
        }
        $.ajax({
            url: "/login" ,
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                Code: Code,
                password: password,
                id: id !== undefined ? id : null
            },
            success: function(dataSuccess) {
                var link = window.location.origin;
                if (dataSuccess.errorLogin === undefined) {
                    if(confirm("KIỂM TRA LẠI THÔNG TIN\n" + "Họ và tên: " + dataSuccess.fullName + "\n" + "Mã nhân viên: "+ dataSuccess.Code + "\n" + "Thông tin đúng nhấn nút OK\nThông tin sai nhấn Hủy")){
                        if (dataSuccess.id !== null) {
                            location.href = link + '/edit/' + dataSuccess.id;
                        }else{
                            location.href = link + '/notification';
                        }
                    }else{
                        if (dataSuccess.id !== null) {
                            location.href = link + '/back?id=' + dataSuccess.id;
                        }else{
                            location.href = link + '/back' 
                        }
                    }
                }else{
                    alert(dataSuccess.errorLogin);
                    if (dataSuccess.id !== null) {
                        location.href = link + '/edit/' + dataSuccess.id;
                    }else{
                        location.href = link + '/notification';
                    }
                }
            },
        });
    });
})
$(function() {
    var input = $('.validate-input .input100');
    $('.login-user').click(function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if($(input[i]).val().trim() == ''){
                var thisAlert = $(input[i]).parent();
                $(thisAlert).addClass('alert-validate');
                check=false;
            }
        }

        if (check) {
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
                        ToastSuccessCenterLogin.fire({
                            title: 'KIỂM TRA LẠI THÔNG TIN',
                            html: "Họ và tên: <b>" + dataSuccess.fullName + "</b><br>Mã nhân viên: <b>"+ dataSuccess.Code + "</b><br>Thông tin đúng nhấn nút <b>OK</b><br>Thông tin sai nhấn <b>HỦY</b>",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (dataSuccess.id !== null) {
                                    location.href = link + '/edit/' + dataSuccess.id;
                                }else{
                                    location.href = link + '/notification';
                                }
                            } else if (result.isDenied) {
                                location.href = link + '/back';
                            }
                        });
                    }else{
                        Toast.fire({
                            icon: 'error',
                            title: dataSuccess.errorLogin
                        }).then(() => {
                            if (dataSuccess.id !== null) {
                                location.href = link + '/edit/' + dataSuccess.id;
                            }else{
                                location.href = link + '/notification';
                            }
                        });
                    }
                },
            });   
        }
    });
    
    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
            var thisAlert = $(this).parent();
            $(thisAlert).removeClass('alert-validate');
        });
    });
})
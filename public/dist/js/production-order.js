$(document).ready(function () {
    $('[name="MachineCode[]"], [name="ChantCode[]"], [name="StageNo[]"], [name="ChildStageNo[]"]').select2();
    $('[name="ChantCode[]"], [name="DeptCodetmp[]"]').select2({ minimumResultsForSearch: -1 });
    $('.select-chantCode').change(function(){
        const valueSelect = $(this).val();
        const idSelect = $(this).attr('id');
        if (sessionStorage.getItem('string-all-shift') === null) {
            $.ajax({
                url: "/get-time",
                type:'GET',
                success: function(data) {
                    var objectShift =data.shiftAll.find(element => element.Code === valueSelect);
                    $('#WorkDay-'+idSelect+'').val(objectShift.WorkDay);
                    const myJSON = JSON.stringify(data.shiftAll);
                    sessionStorage.setItem('string-all-shift', myJSON)
                }
            });
        } else {
            const MyJSON = JSON.parse(sessionStorage.getItem('string-all-shift'));
            var objectShift = MyJSON.find(element => element.Code  === valueSelect);
            $('#WorkDay-'+idSelect+'').val(objectShift.WorkDay);
        }
    });

    $(document).on('click', '.submit-update, .submit-edit', function () {
        var QuantitySX = $("input[name='QuantitySX[]']")
              .map(function(){return $(this).val();}).get();
        var WorkDay = $("input[name='WorkDay[]']")
              .map(function(){return $(this).val();}).get();
        var ItemLotCode = $("input[name='ItemLotCode[]']")
              .map(function(){return $(this).val();}).get();
        var ProductCode = $("[name='ProductCode[]']")
              .map(function(){return $(this).val();}).get();
        var Id = $("input[name='Id[]']")
              .map(function(){return $(this).val();}).get();
        var ChantCode = $("select[name='ChantCode[]']")
              .map(function(){return $(this).val();}).get();
        var MachineCode = $("[name='MachineCode[]']")
              .map(function(){return $(this).val();}).get();
        var QuantityFail = $("input[name='QuantityFail[]']")
              .map(function(){return $(this).val();}).get();
        var DeptCodetmp = $("select[name='DeptCodetmp[]']")
              .map(function(){return $(this).val();}).get();
        var type = $(this).val();
        $.ajax({
            url: "/update" ,
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                QuantitySX: QuantitySX,
                WorkDay: WorkDay,
                ItemLotCode: ItemLotCode,
                ProductCode: ProductCode,
                ChantCode: ChantCode,
                Id: Id,
                type: type,
                QuantityFail: QuantityFail,
                MachineCode: MachineCode,
                DeptCodetmp: DeptCodetmp,
            },
            success: function(dataSuccess) {
                for (let i = 0; i < QuantitySX.length; i++) {
                    $('.error-quantity-' + i).html('')
                    $('.error-workday-' + i).html('')
                    $('.quantity-sx-' + i).val('')
                    $('.quantity-fail-' + i).val('')
                }
                if (dataSuccess.error_incorrect) {
                    ToastErrorCenter.fire({
                        text: dataSuccess.error_incorrect,
                    })
                }else{
                    ToastSuccessCenterTime.fire({
                        title: dataSuccess.error_correct,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            sessionStorage.clear();
                            location.href = window.location.origin + '/logout';
                        }
                    });
                }
            },
            error: function (dataError) {
                let errors = dataError.responseJSON?.errors;
                for (let i = 0; i < QuantitySX.length; i++) {
                    errors['QuantitySX.'+ i] ? $('.error-quantity-' + i).html(errors['QuantitySX.'+ i][0]) : $('.error-quantity-' + i).html('')
                    errors['QuantityFail.'+ i] ? $('.error-quantity-fail-' + i).html(errors['QuantityFail.'+ i][0]) : $('.error-quantity-fail-' + i).html('')
                    errors['WorkDay.'+ i] ? $('.error-workday-' + i).html(errors['WorkDay.'+ i][0]) : $('.error-workday-' + i).html('')
                    errors['ProductCode.'+ i] ? $('.error-product-code-' + i).html(errors['ProductCode.'+ i][0]) : $('.error-product-code-' + i).html('')
                }
                Toast.fire({
                    icon: 'error',
                    title: 'Thao tác không thành công !'
                })
            }
        });
    });
})
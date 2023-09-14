$(document).ready(function () {
    $('[name="MachineCode[]"]').select2();
    $('[name="StageNo[]"]').select2();
    $('[name="ChantCode[]"]').select2({ minimumResultsForSearch: -1 });
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
            },
            success: function(dataSuccess) {
                for (let i = 0; i < QuantitySX.length; i++) {
                    $('.error-quantity-' + i).html('')
                    $('.error-workday-' + i).html('')
                    $('.quantity-sx-' + i).val('')
                    $('.quantity-fail-' + i).val('')
                }
                if (dataSuccess.error_incorrect) {
                    alert(dataSuccess.error_incorrect);
                }else{
                    alert(dataSuccess.error_correct);
                    sessionStorage.clear();
                    location.href = window.location.origin + '/logout';
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
                alert('Thao tác không thành công !')
            }
        });
    });

    function appendOptionSelect(arrayData, location) {
        var selectProductCode = $('.select-add-productCode');
        if (location !== null) {
            selectProductCode = $('.product-code-select-' + location);
        }
        for (let index = 0; index < arrayData.length; index++) {
            selectProductCode.append('<option value="'+ arrayData[index].ProductCode +'">' + arrayData[index].ProductCode + ' - ' + arrayData[index].Name + '</option>');
        }
    }

    $(document).on('click', '.add-row', function () {
        const numberDeleteRow = Math.floor((Math.random() * 200000) + 1);
        var $locationValidateWorkdayQuantity = parseInt($('tr:last > .location-validate-workday-quantity').val()) + 1;
        var $locationValidateProductCode = $('tr:last > .location-validate-product-code').length > 0 ? parseInt($('tr:last > .location-validate-product-code').val()) + 1 : 1;
        $('.products').append(
            `<tr class="location-delete-row-tr-`+ numberDeleteRow +`">
                <input type="hidden" class="location-validate-workday-quantity" value="`+$locationValidateWorkdayQuantity+`">
                <input type="hidden" class="location-validate-product-code" value="`+$locationValidateProductCode+`">
                <input type="hidden" name="ItemLotCode[]">
                <input type="hidden" name="Id[]">
                <input type="hidden" name="QuantityFail[]">
                <input type="hidden" name="MachineCode[]">
                <td>
                    <select name="ProductCode[]" class="form-control select-add-productCode product-code-select-`+ numberDeleteRow +`" number-location-select="`+ numberDeleteRow +`">
                        <option value="">Chọn mã sản phẩm</option>
                    </select>
                    <span class="text-danger error-product-code-`+$locationValidateProductCode+`"></span>
                </td>
                <td class="td-name-product-`+numberDeleteRow+`">Tên sản phẩm</td>
                <td>
                    <div class="form-group">
                        <input class="form-control quantity-sx-`+$locationValidateWorkdayQuantity+`" id="quantity-sx-`+numberDeleteRow+`" name="QuantitySX[]" type="text" placeholder="Số lượng">
                        <span class="text-danger error-quantity-`+$locationValidateWorkdayQuantity+`"></span>
                    </div>
                </td>
                <td></td>
                <td>
                    <select name="ChantCode[]" class="select-add-chantCode-`+$locationValidateProductCode+`"></select>
                </td>
                <td>
                    <div class="form-group">
                        <input class="form-control input-work-day" id="`+numberDeleteRow+`" name="WorkDay[]" type="text" placeholder="Nhập số giờ">
                        <span class="text-danger error-workday-`+$locationValidateWorkdayQuantity+`"></span>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger text-white delete-row" location-delete-row-button="`+ numberDeleteRow +`">Xóa dòng</button>
                </td>
                <td colspan="5"></td>
            </tr>`
        );

        $('.input-work-day').change(function(){
            $location = $(this).attr('id');
            $('#quantity-sx-' + $location).val($(this).val());
        });

        if (sessionStorage.getItem("string-data-product-code") === null) {
            $.ajax({
                url: "/get-product-code" ,
                type:'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(dataSuccess) {
                    appendOptionSelect(dataSuccess.arrayProductCode, null);
                    const myJSON = JSON.stringify(dataSuccess.arrayProductCode);
                    sessionStorage.setItem("string-data-product-code", myJSON);
                },
            });
        }else{
            const MyJSON = JSON.parse(sessionStorage.getItem("string-data-product-code"));
            appendOptionSelect(MyJSON, numberDeleteRow);
        }
        
        $(".products > tr:first > td > .select-chantCode option").each(function(){
            $('.select-add-chantCode-'+$locationValidateProductCode).append('<option value="'+ $(this).val() +'">' + $(this).text() + '</option>');
        });

        $('[name="ChantCode[]"]').select2({ minimumResultsForSearch: -1 });
    });

    $(document).on('change', '.select-add-productCode', function () {
        const MyJSON = JSON.parse(sessionStorage.getItem("string-data-product-code"));
        var objectProduct = MyJSON.find(element => element.ProductCode  === $(this).val());
        const numerLocationSelect = $(this).attr('number-location-select');
        $('.td-name-product-'+numerLocationSelect).text(objectProduct.Name);
    });
    
    $(document).on('click', '.delete-row', function () {
        var locationDeleteButton = $(this).attr('location-delete-row-button');
        var deleteRow = $(".location-delete-row-tr-"+ locationDeleteButton);
        deleteRow.remove()
    });
    
})
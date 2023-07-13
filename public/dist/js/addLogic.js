$(document).ready(function () {
    $('.form-select').change(function(){ 
        $.ajax({
            url: "/get-time/" + $(this).val(),
            type:'GET',
            data: {
                idSelect: $(this).attr('id')
            },
            success: function(data) {
                $('#WorkDay-'+data.idSelect+'').val(data.hour);
            }
        });
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
        var MachineCode = $("select[name='MachineCode[]']")
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
        var selectProductCode = $('.select-add');
        if (location !== null) {
            selectProductCode = $('.product-code-select-' + location);
        }
        for (let index = 0; index < arrayData.length; index++) {
            selectProductCode.append('<option value="'+ arrayData[index].ProductCode +'">' + arrayData[index].ProductCode + '</option>');
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
                <td colspan="2">
                    <select name="ProductCode[]" class="form-select select-add product-code-select-`+ numberDeleteRow +`" number-location-select="`+ numberDeleteRow +`">
                        <option value="">Chọn mã sản phẩm</option>
                    </select>
                    <span class="text-danger error-product-code-`+$locationValidateProductCode+`"></span>
                </td>
                <td colspan="5" class="td-name-product-`+numberDeleteRow+`">Tên sản phẩm</td>
                <td colspan="2">
                    <div class="form-group">
                        <input class="form-control quantity-sx-`+$locationValidateWorkdayQuantity+`" name="QuantitySX[]" type="text" placeholder="Số lượng">
                        <span class="text-danger error-quantity-`+$locationValidateWorkdayQuantity+`"></span>
                    </div>
                </td>
                <td colspan="2">
                    <div class="form-group">
                        <input class="form-control" name="WorkDay[]" type="text" placeholder="Nhập số giờ">
                        <span class="text-danger error-workday-`+$locationValidateWorkdayQuantity+`"></span>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger delete-row" location-delete-row-button="`+ numberDeleteRow +`">Xóa dòng</button>
                </td>
            </tr>`
        );

        if ($('.string-data-product-code').length === 0) {
            var stringDataProductCode = document.createElement("p");
            stringDataProductCode.setAttribute('class', 'string-data-product-code');
            $('.table-responsive').append(stringDataProductCode);
            $.ajax({
                url: "/get-product-code" ,
                type:'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(dataSuccess) {
                    appendOptionSelect(dataSuccess.arrayProductCode, null);
                    const myJSON = JSON.stringify(dataSuccess.arrayProductCode);                  
                    $('.string-data-product-code').append(myJSON);
                },
            });
        }else{
            const MyJSON = JSON.parse($('.string-data-product-code').text());
            appendOptionSelect(MyJSON, numberDeleteRow);
        }
    });

    $(document).on('change', '.select-add', function () {
        const MyJSON = JSON.parse($('.string-data-product-code').text());
        var objectProduct = MyJSON.find(element => element.ProductCode  === $(this).val());
        const numerLocationSelect = $(this).attr('number-location-select');
        $('.td-name-product-'+numerLocationSelect).text(objectProduct.Name);
    });
    
    $(document).on('click', '.delete-row', function () {
        var locationDeleteButton = $(this).attr('location-delete-row-button');
        var deleteRow = $(".location-delete-row-tr-"+ locationDeleteButton);
        deleteRow.remove()
    });

    // $('.add-row').click(function(){ 
    //     $('.products').append(
    //         `<tr>
    //             <input type="hidden" name="ItemLotCode[]" value="{{$item->ItemLotCode}}">
    //             <input type="hidden" name="ProductCode[]" value="{{$item->ProductCode}}">
    //             <input type="hidden" name="Id[]" value="{{$item->Id}}">
    //             <td>
    //                 <select class="form-select">
    //                     <option>Chọn mã sản phẩm</option>
    //                 </select>
    //             </td>
    //             <td></td>
    //             <td>
    //                 <div class="form-group">
    //                     <input class="form-control quantity-sx-{{$location}}" name="QuantitySX[]" type="text" placeholder="Số lượng">
    //                     <span class="text-danger error-quantity-{{$location}}"></span>
    //                 </div>
    //             </td>
    //             <td>
    //                 <div class="form-group">
    //                     <input class="form-control quantity-fail-{{$location}}" name="QuantityFail[]" type="text" placeholder="Phế phẩm">
    //                     <span class="text-danger error-quantity-fail-{{$location}}"></span>
    //                 </div>
    //             </td>
    //             <td>
    //                 <select name="ChantCode[]" class="form-select chantCodeAdd"></select>
    //             </td>
    //         </tr>`
    //     );
    //     $.ajax({
    //         url: "/get-chant-code" ,
    //         type:'GET',
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(dataSuccess) {
    //             var selectChantCode = $('.chantCodeAdd').attr('id', Math.random());
    //             for (let index = 0; index < dataSuccess.arrayChantCode.length; index++) {
    //                 if (dataSuccess.arrayChantCode[index].IsGroup == 0 && dataSuccess.arrayChantCode[index].IsActive == 1) {
    //                     selectChantCode.append('<option value="'+ dataSuccess.arrayChantCode[index].Code +'">' + dataSuccess.arrayChantCode[index].Code + '-' + dataSuccess.arrayChantCode[index].Code + '</option>')
    //                 }
    //             }
    //         },
    //     });
    // });
})
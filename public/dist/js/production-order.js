$(document).ready(function () {
    $('.production-order-table').DataTable({
        rowReorder: true,
        paginate: false,
        language: {
            emptyTable: 'Danh sách hiện tại đang trống',
            search: "Tìm kiếm sản phẩm có dữ liệu _INPUT_",
            info: "Tổng có _TOTAL_ sản phẩm",
            zeroRecords: "Không có sản phẩm nào có dữ liệu bạn tìm kiếm"
        },
        drawCallback: function() {
            $('[name="MachineCode[]"], [name="ChantCode[]"], [name="StageNo[]"], [name="ChildStageNo[]"]').select2();
            $('[name="ChantCode[]"], [name="DeptCodetmp[]"]').select2({ minimumResultsForSearch: -1 });
        }
    });

    $('.dataTables_info').appendTo('.infoInTable');
    $('.dataTables_filter').appendTo('.searchInTable');

    function getTime(valueSelect, idSelect) {
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
    }

    $('.select-chantCode').change(function(){
        getTime($(this).val(), $(this).attr('id'));
    });

    function addRow(locationId) {
        if ($('.list-product-new').length === 0) {
            $('.production-order-tbody').append(
                `<tr class="list-product-new">
                    <td colspan="13"><h4>SẢN PHẨM MỚI</h4></td>
                </tr>`
            )
        }else{
            locationId--; 
        }

        $('.production-order-tbody').append(`<tr>
            <td>
                <select name="ProductCode[]" id="ProductCode-`+ locationId +`">
                    <option value="">-----</option>`+
                    JSON.parse(sessionStorage.getItem('product-code')).map(item => ("<option value="+ item.ProductCode +">"+ item.ProductCode + " - " + item.Name +"</option>"))    
                +`</select><br>
                <span class="text-danger error-product-code-` + locationId + `"></span>
            </td>
            <td></td>
            <td>
                <input class="form-control" name="QuantitySX[]" placeholder="Nhập số lượng"/>
                <span class="text-danger error-quantity-` + locationId + `"></span>
            </td>
            <td>
                <input class="form-control" name="QuantityFail[]" placeholder="Nhập phế phẩm"/>
                <span class="text-danger error-quantity-fail-` + locationId + `"></span>
            </td>
            <td>
                <select name="ChantCode[]" id="`+ locationId +`" class="select-chantCode select2-chantCode-` + locationId + `"></select>
            </td>
            <td>
                <input class="form-control" id="WorkDay-` + locationId + `" name="WorkDay[]" type="text" placeholder="Nhập số giờ">
                <span class="text-danger error-workday-` + locationId + `"></span>
            </td>
            <td><select name="MachineCode[]" id="MachineCode-`+ locationId +`"></select></td>
            <td><select name="StageNo[]" id="StageNo-`+ locationId +`"></select></td>
            <td>
                <input class="form-control" name="ItemLotCode[]" type="text" placeholder="Nhập lô">
                <span class="text-danger error-item-lot-code-` + locationId + `"></span>
            </td>
            <td colspan="4"><button class="btn btn-danger delete-new-product">Xóa sản phẩm</button></td>
        </tr>`);

        $('.delete-new-product').on('click', function() {
            $(this).parent().parent().remove();
        })

        //Select2
        $('#ProductCode-' + locationId + ', #MachineCode-' + locationId + ', #StageNo-' + locationId + '').select2();
        $('.select2-chantCode-' + locationId + '').select2({ minimumResultsForSearch: -1 });
        
        //Product Code
        $('#ProductCode-' + locationId + '').on('change', function() {
            const MyJSON = JSON.parse(sessionStorage.getItem('product-code'));
            var objectProduct = MyJSON.find(element => element.ProductCode  ===  $(this).val());
            $(this).parent().parent().find("td:eq(1)").text(objectProduct.Name);
        })

        //Chant Code
        $(".production-order-tbody > tr:first > td > .select-chantCode option").each(function(){
            $('.select2-chantCode-' + locationId + '').append('<option value="'+ $(this).val() +'">' + $(this).text() + '</option>');
        });

        $('.select2-chantCode-' + locationId + '').val($('.select2-chantCode-' + locationId + ' option:eq(0)').val()).trigger('change');

        getTime($('.select2-chantCode-' + locationId + ' option:eq(0)').val(), locationId);

        $('.select2-chantCode-' + locationId + '').change(function(){
            getTime($(this).val(), $(this).attr('id'));
        });

        //Machine Code
        $(".production-order-tbody > tr:first > td > .select-MachineCode option").each(function(){
            $('#MachineCode-' + locationId + '').append('<option value="'+ $(this).val() +'">' + $(this).text() + '</option>');
        });

        $('#MachineCode-' + locationId + '').val($('#MachineCode-' + locationId + ' option:eq(0)').val()).trigger('change');

        //Stage No
        $(".production-order-tbody > tr:first > td > .select-StageNo option").each(function(){
            $('#StageNo-' + locationId + '').append('<option value="'+ $(this).val() +'">' + $(this).text() + '</option>');
        });

        $('#StageNo-' + locationId + '').val($('#StageNo-' + locationId + ' option:eq(0)').val()).trigger('change');
    }

    $(document).on('click', '.add-product-to-production-order', function () {
        let locationId = $('.production-order-tbody tr').length;

        if (sessionStorage.getItem('product-code') === null) {
            $.ajax({
                url: "/get-product-code",
                type:'GET',
                success: function(data) {
                    const myJSON = JSON.stringify(data.arrayProductCode);
                    sessionStorage.setItem('product-code', myJSON)
                    addRow(locationId)
                }
            });
        }else{
            addRow(locationId)
        }
    }); 

    $(document).on('click', '.submit-update-production-order', function () {
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
        var DocDate = $("input[name='DocDate[]']")
              .map(function(){return $(this).val();}).get();
        $.ajax({
            url: "/update-production-order" ,
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
                QuantityFail: QuantityFail,
                MachineCode: MachineCode,
                DeptCodetmp: DeptCodetmp,
                DocDate: DocDate,
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
                    errors['ItemLotCode.'+ i] ? $('.error-item-lot-code-' + i).html(errors['ItemLotCode.'+ i][0]) : $('.error-item-lot-code-' + i).html('')
                }
                Toast.fire({
                    icon: 'error',
                    title: 'Thao tác không thành công !'
                })
            }
        });
    });
})
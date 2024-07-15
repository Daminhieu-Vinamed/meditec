$(document).ready(function () {
    var productionOrderTable = $('.production-order-table-2').DataTable({
        rowReorder: true,
        paginate: false,
        language: {
            emptyTable: 'Danh sách hiện tại đang trống',
            search: "Tìm kiếm sản phẩm có dữ liệu _INPUT_",
            info: "Tổng có _TOTAL_ sản phẩm",
            zeroRecords: "Không có sản phẩm nào có dữ liệu bạn tìm kiếm"
        },
        drawCallback: function() {
            $('[name="ProductCode[]"], [name="MachineCode[]"], [name="ChantCode[]"], [name="StageNo[]"], [name="ChildStageNo[]"]').select2();
            $('[name="Employee[]"]').select2({
                placeholder: "Chọn mã nhân viên",
                allowClear: true
            });
            $('[name="ChantCode[]"], [name="DeptCodetmp[]"]').select2({ minimumResultsForSearch: -1 });
        },
        createdRow: function( row, data, dataIndex ) {
            $($(row).children()[2]).attr('id', 'ProductName');
            $($(row).children()[10]).attr('id', 'ItemLotCode');
            $($(row).children()[11]).attr('id', 'JobQuantity');
            $($(row).children()[12]).attr('id', 'JobQuantityTT');
            $($(row).children()[13]).attr('id', 'QuantityCL');
            $($(row).children()[14]).attr('id', 'DocNo');
        },
    });
    $('.dataTables_info').appendTo('.infoInTable');
    $('.dataTables_filter').appendTo('.searchInTable');

    function addRow(locationId) {
        arrayColumn = [
            `<select name="Employee[]" id="Employee-`+ locationId +`" multiple="multiple">
                <option selected disabled>Trống</option>
            </select><br>
            <span class="text-danger error-employee-` + locationId + `"></span>`,
            `<select name="ProductCode[]" id="ProductCode-`+ locationId +`">
                <option value="">Trống</option>
            </select><br>
            <span class="text-danger error-product-code-` + locationId + `"></span>`,
            `<input type="checkbox" name="arrayCheckbox[]" class="checkbox-delete-row"/>`,
            `<input class="form-control" name="QuantitySX[]" placeholder="Nhập số lượng"/>
            <span class="text-danger error-quantity-` + locationId + `"></span>`,
            `<input class="form-control" name="QuantityFail[]" placeholder="Nhập phế phẩm"/>
            <span class="text-danger error-quantity-fail-` + locationId + `"></span>`,
            `<select name="DeptCodetmp[]" id="DeptCodetmp-`+ locationId +`">
                <option value="">Trống</option>
            </select>`,
            `<select name="ChantCode[]" id="ChantCode-`+ locationId +`"></select>`,
            `<input class="form-control" name="WorkDay[]" type="text" placeholder="Nhập số giờ">
            <span class="text-danger error-workday-` + locationId + `"></span>`,
            `<select name="MachineCode[]" id="MachineCode-`+ locationId +`">
                <option value="">Trống</option>
            </select>`,
            `<select name="StageNo[]" id="StageNo-`+ locationId +`">
                <option value="">Trống</option>
            </select>`,
            '','','','','',
        ]

        productionOrderTable.row.add(arrayColumn).draw(false);

        //Employee
        $('tbody > tr:first > td > [name="Employee[]"] option').each(function(){
            $('#Employee-' + locationId + '').append('<option value="'+ $(this).val() +'">' + $(this).text() + '</option>');
        });
        $('#Employee-' + locationId + ' option:eq(0)').remove();

        //Chant Code
        $('tbody > tr:first > td > [name="ProductCode[]"] option').each(function(){
            $('#ProductCode-' + locationId + '').append(`<option value="`+ $(this).val() +`" 
            ItemLotCode="`+ $(this).attr('ItemLotCode') +`" 
            ProductName="`+ $(this).attr('ProductName') +`"
            Id="`+ $(this).attr('Id') +`"
            JobQuantity="`+ $(this).attr('JobQuantity') +`"
            JobQuantityTT="`+ $(this).attr('JobQuantityTT') +`"
            QuantityCL="`+ $(this).attr('QuantityCL') +`"
            DocNo="`+ $(this).attr('DocNo') +`">` + $(this).text() + `</option>`);
        });
        $('#ProductCode-' + locationId + ' option:eq(0)').remove();

        //Dept Code
        $('tbody > tr:first > td > [name="DeptCodetmp[]"] option').each(function(){
            $('#DeptCodetmp-' + locationId + '').append('<option value="'+ $(this).val() +'">' + $(this).text() + '</option>');
        });
        $('#DeptCodetmp-' + locationId + ' option:eq(0)').remove();

        //Chant Code
        $('tbody > tr:first > td > [name="ChantCode[]"] option').each(function(){
            $('#ChantCode-' + locationId + '').append('<option value="'+ $(this).val() +'">' + $(this).text() + '</option>');
        });
        $('#ChantCode-' + locationId + '').val($('#ChantCode-' + locationId + ' option:eq(0)').val()).trigger('change');

        //Machine Code
        $('tbody > tr:first > td > [name="MachineCode[]"] option').each(function(){
            $('#MachineCode-' + locationId + '').append('<option value="'+ $(this).val() +'">' + $(this).text() + '</option>');
        });
        $('#MachineCode-' + locationId + ' option:eq(0)').remove();

        //Stage No
        $('tbody > tr:first > td > [name="StageNo[]"] option').each(function(){
            $('#StageNo-' + locationId + '').append('<option value="'+ $(this).val() +'">' + $(this).text() + '</option>');
        });
        $('#StageNo-' + locationId + ' option:eq(0)').remove();

        $('#ProductCode-' + locationId + '').change(function(){
            var element = $(this).children('option:selected');
            var Id = element.attr("Id");
            var ItemLotCode = element.attr("ItemLotCode");
            var ProductName = element.attr("ProductName");
            var JobQuantity = element.attr("JobQuantity");
            var JobQuantityTT = element.attr("JobQuantityTT");
            var QuantityCL = element.attr("QuantityCL");
            var DocNo = element.attr("DocNo");
            $(this).parent().parent().find("#ProductName").html(`<input type="checkbox" name="arrayCheckbox[]" class="checkbox-delete-row"/>`+ProductName+`
            <input type="hidden" name="ItemLotCode[]" value="` + ItemLotCode + `">
            <input type="hidden" name="Id[]" value="` + Id + `">`);
            $(this).parent().parent().find("#ItemLotCode").text(ItemLotCode);
            $(this).parent().parent().find("#JobQuantity").text(JobQuantity);
            $(this).parent().parent().find("#JobQuantityTT").text(JobQuantityTT);
            $(this).parent().parent().find("#QuantityCL").text(QuantityCL);
            $(this).parent().parent().find("#DocNo").text(DocNo);
        });
    }

    $(document).on('click', '#add-row', function () {
        let locationId = $('tbody tr').length;
        if (!$('.delete-new-product').is('*')) {
            $(this).parent().append('<button class="btn btn-danger delete-new-product">XÓA</button>')
        }
        addRow(locationId)
    });

    $("select[name='ProductCode[]']").change(function(){
        var element = $(this).children('option:selected');
        var Id = element.attr("Id");
        var ItemLotCode = element.attr("ItemLotCode");
        var ProductName = element.attr("ProductName");
        var JobQuantity = element.attr("JobQuantity");
        var JobQuantityTT = element.attr("JobQuantityTT");
        var QuantityCL = element.attr("QuantityCL");
        var DocNo = element.attr("DocNo");
        $(this).parent().parent().find("#ProductName").html(ProductName && ItemLotCode && Id ? ``+ProductName+`
        <input type="hidden" name="ItemLotCode[]" value="` + ItemLotCode + `">
        <input type="hidden" name="Id[]" value="` + Id + `">` : '');
        $(this).parent().parent().find("#ItemLotCode").text(ItemLotCode ? ItemLotCode : '');
        $(this).parent().parent().find("#JobQuantity").text(JobQuantity ? JobQuantity: '');
        $(this).parent().parent().find("#JobQuantityTT").text(JobQuantityTT ? JobQuantityTT: '');
        $(this).parent().parent().find("#QuantityCL").text(QuantityCL ? QuantityCL: '');
        $(this).parent().parent().find("#DocNo").text(DocNo ? DocNo : '');
    });

    $(document).on('click', '.delete-new-product', function () {
        var arrayCheckbox = $("input[name='arrayCheckbox[]']").map(
                function(){
                    if ($(this).prop('checked')) {
                        return $(this);
                    }
                }
            ).get();
        if ($.isArray(arrayCheckbox) && arrayCheckbox.length > 0 ) {
            arrayCheckbox.forEach(element => {
                productionOrderTable.row(element.parents('tr') ).remove().draw();
            })
            Toast.fire({
                icon: 'success',
                title: 'Xóa sản phẩm thành công !'
            })
        } else {
            Toast.fire({
                icon: 'error',
                title: 'Chưa chọn sản phẩm để xóa !'
            })
        }
    }); 

    $(document).on('click', '.submit-update-production-order', function () {
        var arrEmployee = [];
        for (let index = 0; index < productionOrderTable.rows().count(); index++) {
            let employee = $('#Employee-' + index + '').val();
            let arrEmployeeChild = [];
            if (employee.length > 0) {
                for (let index = 0; index < employee.length; index++) {
                    arrEmployeeChild[index] = employee[index];
                }
                arrEmployee[index] = arrEmployeeChild;
            }else{
                arrEmployee[index] = '';
            }
        }
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
            url: "/update-production-order-2",
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                Employee: arrEmployee,
                QuantitySX: QuantitySX,
                WorkDay: WorkDay,
                ItemLotCode: ItemLotCode,
                ProductCode: ProductCode,
                ChantCode: ChantCode,
                Id: Id,
                QuantityFail: QuantityFail,
                MachineCode: MachineCode,
                DeptCodetmp: DeptCodetmp,
                DocDate: DocDate
            },
            success: function(dataSuccess) {
                for (let i = 0; i < QuantitySX.length; i++) {
                    $('.error-quantity-' + i).html('')
                    $('.error-quantity-fail-' + i).val('')
                    $('.error-workday-' + i).html('')
                    $('.error-product-code-' + i).val('')
                    $('.error-employee-' + i).val('')
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
                    errors['Employee.'+ i] ? $('.error-employee-' + i).html(errors['Employee.'+ i][0]) : $('.error-employee-' + i).html('')
                }
                Toast.fire({
                    icon: 'error',
                    title: 'Cập nhật lệnh sản xuất thất bại !'
                })
            }
        });
    });
});

$(document).ready(function(){
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    //get base URL *********************
    var url = $('#url').val();
    

    $('#type').select2({
        placeholder: "Seleccionar Tipo",
        dropdownParent: $('#myModal .modal-content'),
        tags: true
    });

    $('#tableMaterials thead tr').clone(true).appendTo('#tableMaterials thead');

    $('#tableMaterials thead tr:eq(1) th').each( function (i) {
        if (i == 0 || i == 7) {
            $(this).css('color', 'transparent');
            
            // $(this).html('<input type="text" class="form-control" />');
        }
        else {            
            $(this).html('<input type="text" class="form-control" />');
        }
 
        $( 'input', this ).on( 'keyup change', function () {
            if (dataTable.column(i).search() !== this.value) {             
                dataTable
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    
    var dataTable = $('#tableMaterials').DataTable({
        processing: true,
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true, 
        ajax: {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getMaterials", // json datasource            
            type: "post", // method  , by default get           
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "LER" },
            { "data": "code" },
            { "data": "description" },
            { "data": "valorization" },
            { "data": "unit_of_measurement" },
            { "data": "type" },
            { "data": "percent_formula" },
            { "data": "fix_value" },
            {"data": null,
                render: function (data, type, row) {
                    var echo = '';
                    if (data.edit == true && data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Empresa'>Editar</a>"
                                +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Empresa'>Eliminar</a>";
                    }
                    else if (data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Empresa'>Eliminar</a>";
                    } else {
                        echo = "No tienes permiso";
                    }
                    return echo;
                },
                "targets": -1
            } 
        ],
        "order": [[0, "desc"]]
    });

    //display modal form for creating new product *********************
    $('#btn_add').click(function () {
        $('#btn-save').val("add");
        $('#frmMaterials').trigger("reset");
        $("#percent_formula").removeAttr('disabled');
        $("#fix_value").css('display', 'none');

        if($("#valor_fijo").is(':checked')){
            $("#valor_fijo").removeAttr('checked');
        }

        $("#type option:selected").removeAttr("selected");

        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });




    //display modal form for product EDIT ***************************
    $(document).on('click', '.button_edit', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var id = data.id; 
        $('#frmMaterials').trigger("reset");
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + id,
            success: function (data) {
                console.log(data);
                $('#material_id').val(data.id);
                $('#LER').val(data.LER);
                $('#code').val(data.code);
                $('#description').val(data.description);
                $('#valorization').val(data.valorization);
                $('#unit_of_measurement').val(data.unit_of_measurement);
                
                if(data.percent_formula != null && data.percent_formula != ''){
                    $("#percent_formula").removeAttr('disabled');
                    if($("#valor_fijo").is(':checked')){
                        $("#valor_fijo").removeAttr('checked');
                    }
                    $("#fix_value").css('display', 'none');
                    $('#fix_value').val(null);
                    $('#percent_formula').val(data.percent_formula);
                }

                if(data.fix_value != null && data.fix_value != ''){
                    $("#valor_fijo").attr('checked', 'true');
                    $("#fix_value").removeAttr('disabled');
                    $("#fix_value").css('display', 'block');
                    $('#fix_value').val(data.fix_value);
                    $("#percent_formula").attr('disabled', 'disabled');
                    $('#percent_formula').val(null);
                }


                if (data.type !== null && data.type !== '') {
                    var types = data.type.split(',');
                    //console.log(activities);
                    //setTimeout(function(){
                        $('#type').val(types);
                        $('#type').trigger('change');
                    //}, 1200);

                } else {
                    $('#type').val('');
                    $('#type').trigger('change');
                }
                
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
    //create new product / update existing product ***************************
    $("#btn-save").click(function (e) {
        e.preventDefault();

        var percent_formula = null, fix_value = null;

        if($("#valor_fijo").is(':checked')){
            fix_value = $("#fix_value").val();
        }else{
            fix_value = '';
            percent_formula = $("#percent_formula").val();
        }

        var formData = {
            LER: $('#LER').val(),
            code: $('#code').val(),
            description: $('#description').val(),
            valorization: $('#valorization').val(),
            unit_of_measurement: $('#unit_of_measurement').val(),
            percent_formula: percent_formula,
            fix_value: fix_value,
            type: $('#type').val()
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var material_id = $('#material_id').val();
        var my_url = url;
        if (state == "update") {
            type = "PUT"; //for updating existing resource
            my_url += '/' + material_id;
        }
        preloader('show');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.code == 200) {
                    dataTable.ajax.reload();
                    preloader('hide', data.message, 'success');
                    $('#frmMaterials').trigger("reset");
                    $('#errors').html('');
                    $('.alert').prop('hidden', true);
                    $('#myModal').modal('hide')
                }
                if (data.code == 422) {
                    $('#errors').html('');
                    preloader('hide', data.message, 'error');
                    var list = '';
                    $.each(data.response, function (i, value) {
                        list += '<li>' + value + '</li>';
                    });
                    $('.alert').prop('hidden', false);
                    $('#errors').html(list);
                }              
                                
            },
            error: function (data) {
                console.log(data)
            }
        });
    });
       
    
    //////////////////////////////////////////////////////////////////
    //delete product and remove it from TABLE list ***************************
    $(document).on('click', '.button_delete', function (e) {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var waste_companies_id = data.id;

        e.preventDefault();
        Swal.fire({
            title:  "Estas seguro?",
            text: "Quieres volver?!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, hazlo!",
            cancelButtonText: "No, cancelar!",
            }).then(result => {
            if (result.dismiss) {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: 'Operación cancelada :)',
                    showConfirmButton: !1,
                    timer: 1500
                });
                //swal("Cancelled", "Data is safe :)", "error");
            }
            if (result.value) {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
                    type: "DELETE",
                    url: url + '/' + waste_companies_id,
                    success: function (data) {
                        if (data.code == 200) {
                            dataTable.ajax.reload();
                            preloader('hide', data.message, 'success');
                        }
                        else if (data.code == 422) {
                            preloader('hide', data.message, 'error');
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });       
    });

    $("#valor_fijo").click(function(){
        if($(this).is(':checked')){
            $("#percent_formula").attr('disabled', 'disabled');
            $("#fix_value").css('display', 'block');
        }else{
            $("#percent_formula").removeAttr('disabled');
            $("#fix_value").css('display', 'none');
        }
    });
 
    
});
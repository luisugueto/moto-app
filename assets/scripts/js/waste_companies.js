
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    $("#myModalMaterials").on("shown.bs.modal", function() {
        $("#add_materials").select2({
            placeholder: "Agregar Material",
            tags: true,
            multiple: true
        });

    });

    $('#tableBusiness thead tr').clone(true).appendTo('#tableBusiness thead');

    $('#tableBusiness thead tr:eq(1) th').each( function (i) {
        if (i != 4) {
            $(this).html('<input type="text" class="form-control" />');
        }
        else{
            $(this).css('display', 'none');
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

    
    var dataTable = $('#tableWasteCompanies').DataTable({
        processing: true,
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true, 
        ajax: {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getWasteCompanies", // json datasource            
            type: "post", // method  , by default get           
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "nif_inst_destination" },
            { "data": "email_id" },            
            { "data": "reason_social_inst_destination" },
            { "data": "nima_inst_destination" },
            { "data": "location" },
            { "data": "province" },
            { "data": "authorization_no" },
            {"data": null,
                render: function (data, type, row) {
                    var echo = '';
                    if (data.edit == true && data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-info text-white button_add_meterials' title='Agregar Materiales'>Agregar Materiales</a>"
                            +"<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title = 'Editar Empresa' > Editar</a >"
                            +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Empresa'>Eliminar</a>";
                    }
                    else if (data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-info text-white button_add_meterials' title='Agregar Materiales'>Agregar Materiales</a>" +
                            "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Empresa'>Eliminar</a>";
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
        $('#frmWasteCompanies').trigger("reset");
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

        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + id,
            success: function (data) {
                // console.log(data);
                $('#waste_companies_id').val(data.id);
                $('#name').val(data.name);
                $('#email_id').val(data.email_id);
                $('#nif_inst_destination').val(data.nif_inst_destination);
                $('#reason_social_inst_destination').val(data.reason_social_inst_destination);
                $('#nima_inst_destination').val(data.nima_inst_destination);
                $('#type_via').val(data.type_via);
                $('#name_via').val(data.name_via);
                $('#nro_street').val(data.nro_street);
                $('#flat').val(data.flat);
                $('#door').val(data.door);
                $('#postal_code').val(data.postal_code);
                $('#location').val(data.location);
                $('#province').val(data.province);
                $('#country').val(data.country);
                $('#authorization_no').val(data.authorization_no);
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
        var formData = {
            name: $('#name').val(),
            email_id: $('#email_id').val(),
            nif_inst_destination: $('#nif_inst_destination').val(),
            reason_social_inst_destination: $('#reason_social_inst_destination').val(),
            nima_inst_destination: $('#nima_inst_destination').val(),
            type_via: $('#type_via').val(),
            name_via: $('#name_via').val(),
            nro_street: $('#nro_street').val(),
            flat: $('#flat').val(),
            door: $('#door').val(),
            postal_code: $('#postal_code').val(),
            location: $('#location').val(),
            province: $('#province').val(),
            country: $('#country').val(),
            authorization_no: $('#authorization_no').val()
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var waste_companies_id = $('#waste_companies_id').val();
        var my_url = url;
        if (state == "update") {
            type = "PUT"; //for updating existing resource
            my_url += '/' + waste_companies_id;
        }
        preloader('show');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {

                //console.log(data)
                if (data.code == 200) {
                    dataTable.ajax.reload();
                    preloader('hide', data.message, 'success');
                    $('#frmWasteCompanies').trigger("reset");
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
    $(document).on('click', '.button_add_meterials', function (e) {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var waste_companies_id = data.id;

        $.ajax({
            type: "GET",
            url: url + '/agregar-materiales/' + waste_companies_id,
            success: function (data) {
                // console.log(data);
                $('#waste_companies_2_id').val(data.id);
                $('#myModalMaterials').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });      
    });

    // /////////////////////////////////////////////////////////////////
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
 
    
});
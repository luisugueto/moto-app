
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

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

    
    var dataTable = $('#tableBusiness').DataTable({
        processing: true,
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true, 
        ajax: {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getBusiness", // json datasource            
            type: "post", // method  , by default get           
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "service_id" },
            { "data": "email_id" },
            { "data": "name" },
            { "data": "cif" },
            { "data": "email" },
            { "data": "city" },
            { "data": "province" },
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
        $('#frmBusiness').trigger("reset");
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
                $('#business_id').val(data.id);
                $('#service_id').val(data.service_id);
                $('#email_id').val(data.email_id);
                $('#name').val(data.name);
                $('#cif').val(data.cif);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('#postal_code').val(data.postal_code);
                $('#city').val(data.city);
                $('#province').val(data.province);
                $('#address').val(data.address);
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
            service_id: $('#service_id').val(),
            email_id: $('#email_id').val(),
            name: $('#name').val(),
            cif: $('#cif').val(),
            phone: $('#phone').val(),
            email: $('#email').val(),
            postal_code: $('#postal_code').val(),
            city: $('#city').val(),
            province: $('#province').val(),
            address: $('#address').val()
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var business_id = $('#business_id').val();
        var my_url = url;
        if (state == "update") {
            type = "PUT"; //for updating existing resource
            my_url += '/' + business_id;
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
                    $('#frmBusiness').trigger("reset");
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
                $('#errors').html('');
                if (data.code == 422) {
                    preloader('hide', data.message, 'error');
                    var list = '';
                    $.each(data.response, function (i, value) {
                        list += '<li>' + value + '</li>';
                    });
                    $('.alert').prop('hidden', false);
                    $('#errors').html(list);

                }
            }
        });
    });
       
    
    //////////////////////////////////////////////////////////////////
    //delete product and remove it from TABLE list ***************************
    $(document).on('click', '.button_delete', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var email_id = data.id;

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: "DELETE",
            url: url + '/' + email_id,
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
                if (data.status == 422) {
                    $('.main-card').before('Correo no encontrado! No se pudo eliminar');
                    dataTable.ajax.reload();
                    console.log('Error:', data);
                }
            }
        });
    });

    //////////////////////////////////////////////////////////////////
    $('#tableEmails tbody').on('click', '.button_view', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var id = data.id;        
        User.status(id, status);
    });
    
  
    
});
$(document).ready(function () {

    //get base URL *********************
    var url = $('#url').val();

    $('#tableSubProcesses thead tr').clone(true).appendTo('#tableSubProcesses thead');
 
    $('#tableSubProcesses thead tr:eq(1) th').each( function (i) {
        if (i == 0 || i == 6) {
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

    var dataTable = $('#tableSubProcesses').DataTable({
        processing: true,
        responsive: true,
        "ajax": {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getSubProcesses", // json datasource            
            type: "post", // method  , by default get
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "description" },
            {"data": null,
                render:function(data)
                    {
                        let $class = '', $name = '';
                        if(data.status == 1) $class = 'success', $name='Activo'; else $class = 'danger', $name = 'Inactivo';
                        return '<span class="badge badge-'+ $class +'">'+ $name +'</span>';
            
                    },
                    "targets": -1
                },
            { "data": "processes" },
            { "data": "email" },
            {"data": null,
                render: function (data, type, row) {
                    var echo = '';
                    if (data.edit == true && data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Proceso'>Editar</a>"
                                +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Proceso'>Eliminar</a>";
                    }
                    else if (data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Proceso'>Eliminar</a>";
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
        $('#frmSubProcess').trigger("reset");
        $('#check_business').css('display', 'none');
        $('#business_select').css('display', 'none');
        $('#email_id').prop('disabled',false);
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });




    //display modal form for product EDIT ***************************
    $(document).on('click', '.button_edit', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var subprocess_id = data.id;

        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + subprocess_id,
            success: function (data) {
                //console.log(data);
                $('#subprocess_id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#status').val(data.status);
                $('#processes_id').val(data.processes_id);
                $('#email_id').val(data.email_id);
                if ($("#processes_id option:selected").text() == 'Grua') {
                    $('input[name="is_business"]').prop('checked', true);
                    $('#check_business').css('display', 'block');
                    $('#business_select').css('display', 'block');
                    $('#business_id').val(data.business_id);
                }
                else {
                    $('input[name="is_business"]').prop('checked', false);
                    $('#check_business').css('display', 'none');
                    $('#business_select').css('display', 'none');
                    $('#business_id').val('');
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
        var business_id = '';
        if ($("#processes_id option:selected").text() == 'Grua') {
            business_id = $('#business_id').val()
        }
        e.preventDefault();
        var formData = {
            name: $('#name').val(),
            description: $('#description').val(),
            status: $('#status').val(),
            processes_id: $('#processes_id').val(),
            email_id: $('#email_id').val(),
            business_id: business_id,
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var subprocess_id = $('#subprocess_id').val();;
        var my_url = url;
        if (state == "update") {
            type = "PUT"; //for updating existing resource
            my_url += '/' + subprocess_id;
        }
       
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                
                if (data.code == 200) {
                    dataTable.ajax.reload();
                    preloader('hide', data.message, 'success');
                    $('#frmpSubPocess').trigger("reset");
                    $('#errors').html('');
                    $('.alert').prop('hidden', true);
                    $('#myModal').modal('hide')
                }
                else if (data.code == 422) {
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
                if (data.status == 422) {
                    $('#errors').html('');
                    var list = '';
                    $.each(data.responseJSON, function (i, value) {
                        list = '<li>' + value + '</li>';
                        $('.alert').prop('hidden', false);
                        $('#errors').append(list);
                        console.log(value)
                    });

                }
            }
        });
    });


    //delete product and remove it from TABLE list ***************************
    $(document).on('click', '.button_delete', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var subprocess_id = data.id;

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: "DELETE",
            url: url + '/' + subprocess_id,
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
    });

});
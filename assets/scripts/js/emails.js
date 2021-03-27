
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();
    
    var dataTable = $('#tableEmails').DataTable({
        processing: true,
        responsive: true,
        ajax: {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getEmails", // json datasource            
            type: "post", // method  , by default get           
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "subject" },
            { "data": "content" },
            {"data": null,
                render: function (data, type, row) {
                    var echo = '';
                    // if (data.view == true && data.edit == true && data.delete == true) {
                    //     echo = "<a class='mb-2 mr-2 btn btn-info text-white button_view' title='Ver Email'>Ver</a>"
                    //         + "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Email'>Editar</a>"
                    //         +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Email'>Eliminar</a>";
                    // }
                    if (data.edit == true && data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Email'>Editar</a>"
                                +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Email'>Eliminar</a>";
                    }
                    else if (data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Email'>Eliminar</a>";
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
        $('#frmEmails').trigger("reset");
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
                $('#email_id').val(data.id);
                $('#name').val(data.name);
                $('#subject').val(data.subject);
                $('#content').val(data.content);
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name=_token]').val()
            }
        })

        e.preventDefault();
        var formData = {
            name: $('#name').val(),
            subject: $('#subject').val(),
            content: $('#content').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var email_id = $('#email_id').val();;
        var my_url = url;
        if (state == "update") {
            type = "PUT"; //for updating existing resource
            my_url += '/' + email_id;
        }
     
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                
                dataTable.ajax.reload();
                $('#frmpEmails').trigger("reset");
                $('#errors').html('');
                $('.alert').prop('hidden', true);
                $('#myModal').modal('hide')
            },
            error: function (data) {
                $('#errors').html('');
                if (data.status == 422) {                    
                    var list = '';
                    $.each(data.responseJSON, function (i, value) {
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
                var message = `
                <div class="alert alert-success" role="alert">
                    Registro eliminado exitosamente!
                </div>`;
                $('.main-card').before(message);
                dataTable.ajax.reload();
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
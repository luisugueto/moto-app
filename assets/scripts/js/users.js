
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    var dataTable = $('#tableUsers').DataTable({
        processing: true,
        responsive: true,
        "ajax": {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getUsers", // json datasource            
            type: "post", // method  , by default get
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            {"data": null,
                render:function(data)
                    {
                        return '<span class="badge badge-info">'+ data.role +'</span>';
            
                    },
                    "targets": -1
            },
            {"data": null,
                render: function (data, type, row) {
                    var echo = '';
                    if (data.edit == true && data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Estado'>Editar</a>"
                                +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
                    }
                    else if (data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
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
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmUsers').trigger("reset");
        $('#email').prop('readonly', false);
        $('.hide').prop('hidden', false);
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });



    //display modal form for product EDIT ***************************
    $(document).on('click', '.button_edit', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var user_id = data.id;
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + user_id,
            success: function (data) {
                $('#user_id').val(data.id);
                $('#name').val(data.name);
                $('#last_name').val(data.last_name);
                $('#email').val(data.email);
                $('#email').prop('readonly', true);
                $('#phone').val(data.phone);
                $('#rol_id').val(data.role);
                $('.hide').prop('hidden', true);
                
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
            last_name: $('#last_name').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            password: $('#password').val(),
            confirm_password: $('#confirm-password').val(),
            roles: $('#rol_id').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var button = $('#btn-save').val();       
        var type = "POST"; //for creating new resource
        var user_id = $('#user_id').val();
        var my_url = url;
        if (button == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + user_id;
        }
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
               
                dataTable.ajax.reload();
                $('#frmUsers').trigger("reset");
                $('#errors').html('');
                $('.alert').prop('hidden', true);
                $('#myModal').modal('hide')
            },
            error: function (data) {
                //console.log('Error:', data);
                if (data.status == 422) {
                    $('#errors').html('');
                    var list = '';
                    $.each(data.responseJSON, function (i, value) {
                        list = '<li>' + value + '</li>';
                        $('.alert').prop('hidden', false);
                        $('#errors').append(list);
                    });
                 
                }
            }
        });
    });


    //delete product and remove it from TABLE list ***************************
    $(document).on('click', '.button_delete', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var user_id = data.id;
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: "DELETE",
            url: url + '/' + user_id,
            success: function (data) {                 
                var message = `
                <div class="notification alert alert-success" role="alert">
                    Registro eliminado exitosamente!
                </div>`;
                $('.main-card').before(message);
                dataTable.ajax.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
});
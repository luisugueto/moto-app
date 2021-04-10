
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    var dataTable = $('#tableRoles').DataTable({
        processing: true,
        responsive: true,
        "ajax": {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getRoles", // json datasource            
            type: "post", // method  , by default get
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "description" },
            // {
            //     "data": null,
            //     render: function (data, type, row) {
            //         var permision = data.permissions.split(',');
            //         var val = [];
            //         $.each(permision, function(i, v){
            //             val.push('<label class="badge badge-info">'+v+'</label>');
            //         })
            //         return val;                    
            //     },
            //     "targets": -1
            // },
            {"data": null,
                render: function (data, type, row) {
                    var echo = '';
                    echo = "<a class='mb-2 mr-2 btn btn-info text-white button_view' title='Ver Email'>Ver</a>"
                    + "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Email'>Editar</a>"
                    +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Email'>Eliminar</a>";
                    // if (data.view == true && data.edit == true && data.delete == true) {
                    //     echo = "<a class='mb-2 mr-2 btn btn-info text-white button_view' title='Ver Email'>Ver</a>"
                    //         + "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Email'>Editar</a>"
                    //         +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Email'>Eliminar</a>";
                    // }
                    // else if (data.edit == true && data.delete == true) {
                    //     echo = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Estado'>Editar</a>"
                    //             +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
                    // }
                    // else if (data.delete == true) {
                    //     echo = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
                    // } else {
                    //     echo = "No tienes permiso";
                    // }
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
        $('#frmRoles').trigger("reset");
        $('.nameDiv').prop('hidden', false);
        $('input:checkbox').removeAttr('checked');
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });



    //display modal form for product EDIT ***************************
    $(document).on('click', '.button_edit', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var role_id = data.id;
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + role_id,
            success: function (data) {
                $('input:checkbox').removeAttr('checked');
                
                $('#role_id').val(data.id);
                $('.nameDiv').prop('hidden', true);
                $('#display_name').val(data.display_name);
                $('#description').val(data.description);

                // var array = data.permisions.split(',').slice(0,-1);
                // $.each(array, function (i) {
                //     var array2 = array[i].split(":=");
                //     $('#custom_'+array2[0]).val(array2[0]);
                //     $('#custom_'+array2[0]).attr('checked', array2[0]);

                // });
                 
                $('#status').val(data.status); 
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
        var permission = [];
        $("input:checkbox[name=permission]:checked").each(function() {
            permission.push($(this).val());
        });
        console.log(permission)
        var formData = {
            name: $('#name').val(),
            display_name: $('#display_name').val(),
            description: $('#description').val(),
            permission: permission,
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var button = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var role_id = $('#role_id').val();;
        var my_url = url;
        if (button == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + role_id;
        }
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
               
                dataTable.ajax.reload();
                $('#frmState').trigger("reset");
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
        var state_id = data.id;
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: "DELETE",
            url: url + '/' + state_id,
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
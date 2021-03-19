
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();


    //display modal form for creating new product *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmStates').trigger("reset");
        $('#myModal').modal('show');
    });



    //display modal form for product EDIT ***************************
    $(document).on('click','.open_modal',function(){
        var state_id = $(this).val();
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + state_id,
            success: function (data) {
                console.log(data);
                $('#state_id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#email_id').val(data.email_id);
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
        var formData = {
            name: $('#name').val(),
            description: $('#description').val(),
            email_id: $('#email_id').val(),
            status: $('#status').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var button = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var state_id = $('#state_id').val();;
        var my_url = url;
        if (button == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + state_id;
        }
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
               
                // console.log(data);
                var state = '<tr id="state' + data.id + '">';
                state += '<td>' + data.id + '</td>';
                state += '<td>' + data.name + '</td>';
                state += '<td>' + data.description + '</td>';
                state += '<td>' + data.email+ '</td>';
                if (data.status == 1) {
                    state += '<td><span class="badge badge-success">Activo</span></td>';
                } else {
                    state += '<td><span class="badge badge-danger">Inactivo</span></td>';
                }
                state += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '">Editar</button>';
                state += ' <button class="btn btn-danger btn-delete delete-state" value="' + data.id + '">Eliminar</button></td></tr>';
                if (state == "add"){ //if user added a new record
                    $('#states-list').append(state);
                }else{ //if user updated an existing record
                    $("#state" + state_id).replaceWith( state );
                }
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
                        console.log(value)
                    });
                 
                }
            }
        });
    });


    //delete product and remove it from TABLE list ***************************
    $(document).on('click', '.delete-state', function () {        
        var state_id = $(this).val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: "DELETE",
            url: url + '/' + state_id,
            success: function (data) {                 
                var message = `
                <div class="alert alert-success" role="alert">
                    Registro eliminado exitosamente!
                </div>`;
                $('.main-card').before(message);
                $("#state" + state_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
});

$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();


    //display modal form for creating new product *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmProcess').trigger("reset");
        $('#myModal').modal('show');
    });



    //display modal form for product EDIT ***************************
    $(document).on('click','.open_modal',function(){
        var process_id = $(this).val();
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + process_id,
            success: function (data) {
                console.log(data);
                $('#process_id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name=_token]').val()
            }
        })

        e.preventDefault(); 
        var formData = {
            name: $('#name').val(),
            description: $('#description').val(),
            status: $('#status').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var process_id = $('#process_id').val();;
        var my_url = url;
        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + process_id;
        }
        console.log(formData, my_url);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                var process = '<tr id="process' + data.id + '">';
                process += '<td>' + data.id + '</td>';
                process += '<td>' + data.name + '</td>';
                process += '<td>' + data.description + '</td>';
                if (data.status == 1) {
                    process += '<td><span class="badge badge-success">Activo</span></td>';
                } else {
                    process += '<td><span class="badge badge-danger">Inactivo</span></td>';
                }
                process += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '">Editar</button>';
                process += ' <button class="btn btn-danger btn-delete delete-process" value="' + data.id + '">Eliminar</button></td></tr>';
                if (state == "add"){ //if user added a new record
                    $('#processes-list').append(process);
                }else{ //if user updated an existing record
                    $("#process" + process_id).replaceWith( process );
                }
                $('#frmpPocess').trigger("reset");
                $('#errors').html('');
                $('.alert').prop('hidden', true);
                $('#myModal').modal('hide')
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
    $(document).on('click','.delete-process',function(){
        var process_id = $(this).val();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name=_token]').val()
            }
        })
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: "DELETE",
            url: url + '/' + process_id,
            success: function (data) {
                var message = `
                <div class="alert alert-success" role="alert">
                    Registro eliminado exitosamente!
                </div>`;
                $('.main-card').before(message);
                $("#process" + process_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
});
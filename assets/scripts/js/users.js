
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();
    var fileInput2 = '';

    $('#tableUsers thead tr').clone(true).appendTo('#tableUsers thead');
 
    $('#tableUsers thead tr:eq(1) th').each( function (i) {
        if (i != 5) {
            $(this).html('<input type="text" class="form-control" />');
        }
        else {          
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

    var dataTable = $('#tableUsers').DataTable({
        processing: true,
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true, 
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
                render:function(data, type, row)
                    {
                        let $checked = '', $disabled = '';
                        if(data.status == 1) $checked = 'checked'; else $checked = '';
                        return '<label class="switch" for="customSwitch' + data.id+'"><input type="checkbox" class="checkbox_status"  id="customSwitch' + data.id+'" '+$checked+' ><span class="slider round "></span></label>';
                    },
                    "targets": -1
                },
            {"data": null,
                render: function (data, type, row) {
                    var echo = '';
                    echo = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Estado'>Editar</a>"
                                +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
                    // if (data.edit == true && data.delete == true) {
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
                $('.previsualizar').attr('src', 'local/public/img_app/profile_images/' + data.ruta);            
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

        var button = $('#btn-save').val();       
        var type = "POST"; //for creating new resource
        var user_id = $('#user_id').val();
        var my_url = url;
        if (button == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + user_id;
        }
        
        if (fileInput2.length > 0) {
            var formData = new FormData();
            formData.append("name", $('#name').val());
            formData.append("last_name", $('#last_name').val());
            formData.append("email", $('#email').val());
            formData.append("phone", $('#phone').val());
            formData.append("password", $('#password').val());
            formData.append("confirm_password", $('#confirm-password').val());
            formData.append("roles", $('#rol_id').val());
            formData.append("image", fileInput2);

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
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
        }
        else { // no attached file(s)

            var formData = {
                name: $('#name').val(),
                last_name: $('#last_name').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                password: $('#password').val(),
                confirm_password: $('#confirm-password').val(),
                roles: $('#rol_id').val()
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
            
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        
      
        
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

    //////////////////////////////////////////////////////////////////
    $('#tableUsers tbody').on('click', '.checkbox_status', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var id = data.id;
        var status = $(this).is(":checked") == true ? 1 : 0;

        var formData = {
            "id": id,
            "status": status
        }
        preloader('show');
         $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: "POST",
            url: url + '/change_status_user',
            data: formData,
            dataType: 'json',
             success: function (data) {
                 if (data.code == 200) {
                    preloader('hide', data.message, 'success');                      
                    dataTable.ajax.reload();
                 }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('#btn_refresh').click(function () {
        preloader('show');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: "POST",
            url: url + '/get_employees_prestashop',         
            dataType: 'json',
             success: function (data) {
                 if (data.code == 200) {
                    preloader('hide', data.message, 'success');  
                    dataTable.ajax.reload();
                 }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });

    $("#image").change(function(event) { //validar que sea imagen     
        var fileInput = document.getElementById('image');
        var imagen = this.files[0];
        var filePath = fileInput.value;
        var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
  
            Swal.fire("Ups..", 'Cargue el archivo con las extensiones .jpeg / .jpg / .png / .gif solamente', "warning");
            $("#image").val('');
        }
        fileInput2 = '';
        fileInput2 = imagen;
    
        var datosImagen = new FileReader();
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function(event) {
            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src", rutaImagen);
        });
    });

    
    // preventing page from redirecting
    $("html").on("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();      
    });

    $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });

    // Drag enter
    $('.upload-drag').on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
    });

    // Drag over
    $('.upload-drag').on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
    });

    // Drop
    $('.upload-drag').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();

        var file = e.originalEvent.dataTransfer.files;
        var label = file[0]['name'];
        var imagen = file[0];       

        var input = $(this).prop('placeholder', label);        
       
        var datosImagen = new FileReader();
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function(event) {
            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src", rutaImagen);
            
        });
        
        // fd.append('file', file[0]);
        fileInput2 = '';
        fileInput2 = file[0];
        // uploadData(fd);
    }); 
});
 
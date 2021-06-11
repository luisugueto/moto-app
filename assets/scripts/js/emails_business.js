
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    $('#tableEmails thead tr').clone(true).appendTo('#tableEmails thead');

    $('#tableEmails thead tr:eq(1) th').each( function (i) {
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

    
    var dataTable = $('#tableEmails').DataTable({
        processing: true,
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true, 
        ajax: {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getEmailsBusiness", // json datasource            
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
                $('#content').summernote("editor.pasteHTML", data.content);
                $('#content').val(data.content);
                $('#type').val(data.type);
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
            subject: $('#subject').val(),
            content: $('#content').val(),
            type: $('#type').val()
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

                if (data.code == 200) {
                    dataTable.ajax.reload();
                    preloader('hide', data.message, 'success');
                    $('#frmpEmails').trigger("reset");
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
                console.log('Error:', data);       
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
                console.log('Error:', data);                 
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
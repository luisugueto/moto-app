
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    $('#tableStates thead tr').clone(true).appendTo('#tableStates thead');
 
    $('#tableStates thead tr:eq(1) th').each( function (i) {
        if (i != 3) {
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

    var dataTable = $('#tableStates').DataTable({
        processing: true,
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        
        "ajax": {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getStates", // json datasource            
            type: "post", // method  , by default get
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "description" },
            { "data": "email" },
            {"data": null,
                render:function(data)
                    {
                        let $class = '', $name = '';
                        if(data.status == 1) $class = 'success', $name='Activo'; else $class = 'danger', $name = 'Inactivo';
                        return '<span class="badge badge-'+ $class +'">'+ $name +'</span>';
            
                    },
                    "targets": -1
            },
            {"data": null,
                render: function (data, type, row) {
                    var echo = '';
                    if (data.edit == true && data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Estado'>Editar</a>";
                        if(data.id > 6)
                                echo+="<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
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
        $('#frmStates').trigger("reset");
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });



    //display modal form for product EDIT ***************************
    $(document).on('click', '.button_edit', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var state_id = data.id;
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + state_id,
            success: function (data) {
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
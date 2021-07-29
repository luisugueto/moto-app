
$(document).ready(function () {

    //get base URL *********************
    var url = $('#url').val();

    var dataTable = $('#tableProcesses').DataTable({
        processing: true,
        responsive: true,
        "ajax": {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getProcesses", // json datasource            
            type: "post", // method  , by default get
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "description" },
            {
                "data": null,
                render: function (data)
                {
                    let destiny_status = '';
                    if(data.destiny == 1){
                        destiny_status = 'En Revisión';
                    }
                    if(data.destiny == 2){
                        destiny_status = 'No Interesa';
                    }
                    if(data.destiny == 3){
                        destiny_status = 'Interesa';
                    }
                    if(data.destiny == 4){
                       destiny_status = 'Desguace';
                    }
                    if(data.destiny == 5){
                        destiny_status = 'Venta';
                    }
                    if(data.destiny == 6){
                        destiny_status = 'Subasta';
                    }
                    if(data.destiny == 7){
                        destiny_status = 'Desguazadas';
                    }
                    if(data.destiny == 8){
                        destiny_status = 'Vendidas';
                    }
                    if(data.destiny == 9){
                        destiny_status = 'Subastada';
                    }
                    if(data.destiny == 10){
                        destiny_status = 'Sin Acuerdo';
                    }
                    return destiny_status;
                },
                "targets": -1
            },
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
        $('#frmProcess').trigger("reset");
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });




    //display modal form for product EDIT ***************************
    $(document).on('click', '.button_edit', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var process_id = data.id;
        console.log(process_id)

        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + process_id,
            success: function (data) {
                // console.log(data);
                $('#process_id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#destiny').val(data.destiny);
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
            destiny: $('#destiny').val(),
            status: $('#status').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var process_id = $('#process_id').val();;
        var my_url = url;
        if (state == "update") {
            type = "PUT"; //for updating existing resource
            my_url += '/' + process_id;
        }
       
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                
                dataTable.ajax.reload();
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
    $(document).on('click', '.button_delete', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var process_id = data.id;

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: "DELETE",
            url: url + '/' + process_id,
            success: function (data) {
                var message = `
                <div class="alert alert-success" role="alert">
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
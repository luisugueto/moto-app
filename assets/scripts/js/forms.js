
$(document).ready(function () {

    //get base URL *********************
    var url = $('#url').val();

    $('#tableForms thead tr').clone(true).appendTo('#tableForms thead');
 
    $('#tableForms thead tr:eq(1) th').each( function (i) {
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

    var dataTable = $('#tableForms').DataTable({
        processing: true,
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true, 
        "ajax": {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getForms", // json datasource            
            type: "post", // method  , by default get
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
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
                    echo = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Formulario'>Editar</a>"
                    +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Formulario'>Eliminar</a>";
                    // if (data.edit == true && data.delete == true) {
                    //     echo = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Formulario'>Editar</a>"
                    //             +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Formulario'>Eliminar</a>";
                    // }
                    // else if (data.delete == true) {
                    //     echo = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Formulario'>Eliminar</a>";
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
    $('#btn_add').click(function () {
        sessionStorage.setItem('action', 1);
        window.location.href = 'formularios/create';
    });

    //display modal form for product EDIT ***************************
    $(document).on('click', '.button_edit', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var id_form = data.id;

        sessionStorage.setItem('id_form', id_form);
        sessionStorage.setItem('action', 2);
        window.location.href = 'formularios/create';
       
         
    });

    //delete product and remove it from TABLE list ***************************
    $(document).on('click', '.button_delete', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var form_id = data.id;

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: "DELETE",
            url: url + '/' + form_id,
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
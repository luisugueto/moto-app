$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    var dataTable = $('#tableDocumentsTasacionMotos').DataTable({
        processing: true,
        responsive: true,
        "ajax": {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getDocumentsPurchaseValuations", // json datasource            
            type: "post", // method  , by default get
            error: function () {  // error handling
            }
        },
        "columns": [ 
            { "data": "id" },
            { "data": "purchase_valuation_id"},
            { "data": "name" },

            {"data": null,
                render: function (data, type, row) {
                    let echo = '';
                    // if (data.edit == true && data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
                    // }
                    // else if (data.delete == true) {
                    //     echo = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
                    // } else {
                    //     echo = "No tienes permiso";
                    // }
                    return echo;
                },
                "targets": -1
            },

        ],
        "order": [[0, "desc"]]
    });

    //delete product and remove it from TABLE list ***************************
    $(document).on('click', '.button_delete', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var document_id = data.id;
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: "DELETE",
            url: url + '/' + document_id,
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


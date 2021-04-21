$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    var dataTable = $('#tableTasacionMotos').DataTable({
        processing: true,
        responsive: true,
        "ajax": {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getPurchaseValuations", // json datasource            
            type: "post", // method  , by default get
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": null,
                render:function(data){
                    return '<input type="checkbox" name="apply[]" id="apply" value="'+data.id+'">';
        
                },
                "targets": -1
            },  
            { "data": "id" },
            { "data": null,
                render:function(data){
                    var echo = '';
                    if(data.states_id == 0)
                        echo = "En Revisión";
                    else if(data.states_id == 1)
                        echo = "No Interesa";
                    else if(data.states_id == 2)
                        echo = "Interesa";

                    return echo;
                },
                "targets": -1
            },
            { "data": "date" },
            { "data": "brand" },
            { "data": "model" },
            { "data": "year" },
            { "data": "km" },
            { "data": "name" },
            { "data": "province" },
            { "data": null,
                render:function(data){
                    let echo = '';
                    
                    if(data.status_trafic == "Alta")
                        echo = "Alta";
                    else if(data.status_trafic == "Baja definitiva")
                        echo = "Baja definitiva";

                    return echo;
                },
                "targets": -1
            },
            { "data": null,
                render:function(data){
                    let echo = '';
 
                    if(data.g_del == 1)
                        echo = "Si";
                    else
                        echo = "No";

                    return echo;
                },
                "targets": -1
            },
            { "data": null,
                render:function(data){
                    let echo = '';
                    
                    if(data.g_tras == 1)
                        echo = "Si";
                    else
                        echo = "No";

                    return echo;
                },
                "targets": -1
            },
            { "data": null,
                render:function(data){
                    let echo = '';
                    
                    if(data.av_elec == 1)
                        echo = "Si";
                    else
                        echo = "No";

                    return echo;
                },
                "targets": -1
            },
            { "data": null,
                render:function(data){
                    let echo = '';
                    
                    if(data.av_mec == 1)
                        echo = "Si";
                    else
                        echo = "No";

                    return echo;
                },
                "targets": -1
            },
            { "data": null,
                render:function(data){
                    let echo = '';
                    
                    if(data.old == 1)
                        echo = "Si";
                    else
                        echo = "No";

                    return echo;
                },
                "targets": -1
            },

            { "data": "price_min" },
            { "data": "observations" },

            {"data": null,
                render: function (data, type, row) {
                    let echo = '';
                    // if (data.edit == true && data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Estado'>Editar</a>"
                                +"<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>"
                                +"<a class='mb-2 mr-2 btn btn-primary text-white button_document' title='Agregar Document'>Agregar Documento</a>";
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
                
                $('#purchase_id').val(data.id);
                $('#year').val(data.year);
                $('#km').val(data.km);
                $('#name').val(data.name);
                $('#lastname').val(data.lastname);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                $('#province').val(data.province);
                
                if(data.status_trafic == 'Alta')
                    $('#high').attr('checked', true)
                else if(data.status_trafic == 'Baja definitiva')
                    $('#low').attr('checked', true)

                // console.log(data);
                if(data.g_del == 1)
                    $('#g_del').attr('checked', true)

                if(data.g_tras == 1)
                    $('#g_tras').attr('checked', true)

                if(data.av_elec == 1)
                    $('#av_elec').attr('checked', true)

                if(data.av_mec == 1)
                    $('#av_mec').attr('checked', true)

                if(data.old == 1)
                    $('#old').attr('checked', true)

                $('#price_min').val(data.price_min);
                $('#observations').val(data.observations);

                $('.hide').prop('hidden', true);
                
                $('#btn-save').val("update");
                $('#modalPurchase').modal('show');
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
            brand: $("#brand").val(),
            model: $("#model").val(),
            year: $("#year").val(),
            km: $("#km").val(),
            name: $("#name").val(),
            lastname: $("#lastname").val(),
            email: $("#email").val(),
            phone: $("#phone").val(),
            province: $("#province").val(),
            status_trafic: $("#status_trafic").val(),
            g_del: $("#g_del").val(),
            g_tras: $("#g_tras").val(),
            av_elec: $("#av_elec").val(),
            av_mec: $("#av_mec").val(),
            old: $("#old").val(),
            price_min: $("#price_min").val(),
            observations: $("#observations").val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var button = $('#btn-save').val();       
        var type = "POST"; //for creating new resource
        var purchase_id = $('#purchase_id').val();
        var my_url = url;

        if (button == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + purchase_id;
        }

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                dataTable.ajax.reload();
                $('#frmPurchase').trigger("reset");
                $('#errors').html('');
                $('.alert').prop('hidden', true);
                $('#modalPurchase').modal('hide');

                var message = `
                <div class="notification alert alert-success" role="alert">
                    Registro modificado exitosamente!
                </div>`;
                $('.main-card').before(message);
                
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
        var purchase_id = data.id;
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: "DELETE",
            url: url + '/' + purchase_id,
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

    //display modal form for add document ***************************
    $(document).on('click', '.button_document', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var id = data.id;

        $('#purchase_id').val(id);
        $('#modalDocument').modal('show');
    });
});

Dropzone.options.myDropzone = {
    autoProcessQueue: false,
    uploadMultiple: true,
    maxFilezise: 10,
    maxFiles: 2,
    
    init: function() {
        var submitBtn = document.querySelector("#uploadDocument");
        myDropzone = this;
        
        submitBtn.addEventListener("click", function(e){
            e.preventDefault();
            e.stopPropagation();
            myDropzone.processQueue();
        });
        
        this.on("addedfile", function(file) {

        });
        
        this.on("complete", function(file) {
            myDropzone.removeFile(file);
        });

        this.on("success", 
            myDropzone.processQueue.bind(myDropzone)
        );
    }
};
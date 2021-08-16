$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();
    var dataTable = '';

    dataTable = $('#tableRetiroResiduos').DataTable({
        processing: true,
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true, 
        "ajax": {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getResiduos", // json datasource            
            type: "post", // method  , by default get
            error: function () {  // error handling
            }
        },
        "columns": [  
            { "data": "id" },
            { "data": null,
                render:function(data){
                    return '<div class="custom-control custom-checkbox"><input type="checkbox" name="apply[]" id="apply_'+data.id+'" value="'+data.id+'" class="custom-control-input"><label class="custom-control-label" for="apply_'+data.id+'"></label></div>';
        
                },
                "targets": -1
            },
            { "data": null,
                render:function(data){
                    return data.name +' / <br><b>'+ data.business +'</b>';
        
                },
                "targets": -1
            },
            { "data": null,
                render:function(data){
                    return '<input name="entrega[]" id="entrega_'+data.id+'" type="number" step="0.1" class="form-control" value="" required>';
        
                },
                "targets": -1
            }, 
            { "data": null,
                render:function(data){
                    return '<input name="en_instalaciones[]" id="en_instalaciones_'+data.id+'" type="number" step="0.1" class="form-control" value="" required>';
        
                },
                "targets": -1
            },
            { "data": null,
                render:function(data){
                    return '<input name="dcs[]" id="dcs_'+data.id+'" type="text"  class="form-control" value="" required>';
        
                },
                "targets": -1
            },
            {"data": null,
                render:function(data, type, row)
                    {
                      var echo ="<a class='mb-2 mr-2 btn btn-info button_retiro text-white' title='Info'> Retiro</a>";
                      return echo;
                    },
                    "targets": -1
                }
             

        ],
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
            }
        ],
        "order": [[0, "desc"]]
    });
    $('#tab-0').click(function () {
        if ($.fn.DataTable.isDataTable("#tableRetiroResiduos")) {
            $('#tableRetiroResiduos').DataTable().clear().destroy();
        }
        dataTable = $('#tableRetiroResiduos').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true, 
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getResiduos", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columns": [  
                { "data": "id" },
                { "data": null,
                    render:function(data){
                        return '<div class="custom-control custom-checkbox"><input type="checkbox" name="apply[]" id="apply_'+data.id+'" value="'+data.id+'" class="custom-control-input"><label class="custom-control-label" for="apply_'+data.id+'"></label></div>';
            
                    },
                    "targets": -1
                },
                { "data": null,
                    render:function(data){
                        return data.name +' / <br><b>'+ data.business +'</b>';
            
                    },
                    "targets": -1
                },
                { "data": null,
                    render:function(data){
                        return '<input name="entrega[]" id="entrega_'+data.id+'" type="number" step="0.1" class="form-control" value="" required>';
            
                    },
                    "targets": -1
                }, 
                { "data": null,
                    render:function(data){
                        return '<input name="en_instalaciones[]" id="en_instalaciones_'+data.id+'" type="number" step="0.1" class="form-control" value="" required>';
            
                    },
                    "targets": -1
                },
                { "data": null,
                    render:function(data){
                        return '<input name="dcs[]" id="dcs_'+data.id+'" type="text"  class="form-control" value="" required>';
            
                    },
                    "targets": -1
                },
                {"data": null,
                    render:function(data, type, row)
                        {
                          var echo ="<a class='mb-2 mr-2 btn btn-info button_retiro text-white' title='Info'> Retiro</a>";
                          return echo;
                        },
                        "targets": -1
                    }
                 
    
            ],
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false,
                }
            ],
            "order": [[0, "desc"]]
        });
    });
    // RESIDUOS RETIRADOS
    $('#tab-1').click(function () {
        if ($.fn.DataTable.isDataTable("#tableResiduosRetirados")) {
            $('#tableResiduosRetirados').DataTable().clear().destroy();
        }
        dataTable = $('#tableResiduosRetirados').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true, 
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getResiduosRetirados", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columns": [  
                { "data": "id" },                 
                { "data": null,
                    render:function(data){
                        return data.material +' / <br><b>'+ data.companie +'</b>';
            
                    },
                    "targets": -1
                },            
                { "data": "delivery" },
                { "data": "in_installation" },
                { "data": "dcs" },
                { "data": "created_at" },
                {"data": null,
                    render:function(data, type, row)
                        {
                        var echo ="<a class='mb-2 mr-2 btn btn-info button_edit text-white' title='Info'> Editar</a>";
                        return echo;
                        },
                        "targets": -1
                    }
                

            ],
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false,
                }
            ],
            "order": [[0, "desc"]]
        });
    });
 


    // RETIRO RESIDUO INDIVIDUAL
    
    $(document).on('click', '.button_retiro', function (e) {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var id_material = data.id;  
        var entrega = $("#entrega_"+id_material).val();
        var en_instalaciones = $("#en_instalaciones_"+id_material).val();
        var dcs = $("#dcs_"+id_material).val();

        if($.isNumeric(entrega)){}else{preloader('hide', "El campo entrega no es númerico", 'error'); e.preventDefault(); return;}
        if($.isNumeric(en_instalaciones)){}else{preloader('hide', "El campo en instalaciones no es númerico", 'error'); e.preventDefault(); return;}
        if(dcs != ''){}else{preloader('hide', "El campo dcs está vacío", 'error'); e.preventDefault(); return;}


        e.preventDefault();
        var formData = {
            id_material: id_material,
            entrega: entrega,
            en_instalaciones: en_instalaciones,
            dcs: dcs
        }
     
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: 'POST',
            url: url + '/retirar',
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.code == 200) {
                    dataTable.ajax.reload();
                    preloader('hide', data.message, 'success');
                    $('#apply_'+id_material).prop('checked', false);
                    $('#errors').html('');
                    $('.alert').prop('hidden', true);
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
                console.log(data)
            }
        });
         
    });

    // RETIRO VARIOS RESIDUOS

    $("#btnRetiroAll").click(function (e) {
        let error = 0;
        var values = $("input[name='apply[]']:checkbox:checked")
              .map(function(){return $(this).val();}).get();

        if(values.length == 0){ preloader('hide', "Por favor seleccione residuos", 'warning'); e.preventDefault(); return;}

        values.forEach(function(val, index){
            if($.isNumeric($("#entrega_"+val).val())){}else{preloader('hide', "El campo entrega no es númerico", 'error'); e.preventDefault(); error = 1; return;}
            if($.isNumeric($("#en_instalaciones_"+val).val())){}else{preloader('hide', "El campo en instalaciones no es númerico", 'error'); e.preventDefault(); error = 1; return;}
            if($("#dcs_"+val).val() != ''){}else{preloader('hide', "El campo dcs está vacío", 'error'); e.preventDefault(); error = 1; return;}
        });

        if(error) return;

        var entrega = $("input[name='entrega[]']")
              .map(function(){return $(this).val();}).get();

        var en_instalaciones = $("input[name='en_instalaciones[]']")
              .map(function(){return $(this).val();}).get();

        var dcs = $("input[name='dcs[]']")
              .map(function(){return $(this).val();}).get();

        e.preventDefault();
        var formData = {
            material: values,
            entrega: entrega,
            en_instalaciones: en_instalaciones,
            dcs: dcs
        }

        preloader('show');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: 'POST',
            url: url + '/retirar_varios',
            data: formData,
            dataType: 'json',
            success: function (data) {
                if (data.code == 200) {
                    dataTable.ajax.reload();
                    preloader('hide', data.message, 'success');
                    $('#frmAddMaterials').trigger("reset");
                    $('#errors').html('');
                    $('.alert').prop('hidden', true);
                    $('#myModalMaterials').modal('hide');
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
                console.log(data)
            }
        });
    });
    
    //EDITAR RESIDUO
    $(document).on('click', '.button_edit', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var residuo_id = data.id;

        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + residuo_id,
            success: function (data) {
                // console.log(data);
                $('#residuo_id').val(data.id);
                $('#entrega').val(data.delivery);
                $('#en_instalaciones').val(data.in_installation);
                $('#dcs').val(data.dcs);                 
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

});

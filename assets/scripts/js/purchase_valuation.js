$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();
    let dataTable = '';

    //Tabla para el estado en revision
    $('#tableTasacionMotos thead tr').clone(true).appendTo('#tableTasacionMotos thead');

    $('#tableTasacionMotos thead tr:eq(1) th').each( function (i) {
        
        if (i != 14) {
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
    });
    if ($.fn.DataTable.isDataTable("#tableTasacionMotos")) {
        $('#tableTasacionMotos').DataTable().clear().destroy();
    }
    dataTable = $('#tableTasacionMotos').DataTable({
        processing: true,
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        sDom: "Rlfrtip",
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
                    return '<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply_'+data.id+'" value="'+data.id+'" class="custom-control-input"><label class="custom-control-label" for="apply_'+data.id+'"></label></div>';
        
                },
                "targets": -1
            },  
            { "data": "id" },
            { "data": null,
                render:function(data){
                    var echo = '';
                    if(data.states_id == 1)
                        echo = "En Revisión";
                    else if(data.states_id == 2)
                        echo = "No Interesa";
                    else if(data.states_id == 3)
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
    
                    if(data.motocycle_state  == "Golpe Delantero")
                        echo = "Golpe Delantero";
                    else if(data.motocycle_state  == "Golpe Trasero")
                        echo = "Golpe Trasero";
                    else if(data.motocycle_state  == "Avería Eléctrica")
                        echo = "Avería Eléctrica";
                    else if(data.motocycle_state  == "Avería Mecánica")
                        echo = "Avería Mecánica";
                    else if(data.motocycle_state  == "Vieja o Abandonada")
                        echo = "Vieja o Abandonada";
                    return echo;
                },
                "targets": -1
            },                

            { "data": "price_min" },
            { "data": "observations" },
            { "data": null,
                    render:function(data){
                        let echo = '';
                        
                        if(data.status_ficha == 2)
                            echo = "<span class='badge badge-success'>Ficha <br> Verificada</span>";
                        else if(data.status_ficha == 1)
                            echo = "<span class='badge badge-warning'>Ficha <br> Registrada</span>";
                        else if(data.status_ficha == 0)
                            echo = "<span class='badge badge-danger'>Ficha No <br> Registrada</span>";

                        return echo;
                    },
                    "targets": -1
                },

            {"data": null,
                render: function (data, type, row) {
                    let echo = '';
                    if (data.edit == true && data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Estado'>Editar</a>"
                            + "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
                                    
                    }
                    else if (data.delete == true) {
                        echo = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
                    } else {
                        echo = "No tienes permiso";
                    }
                    return echo;
                },
                "targets": -1
            },

        ],
        "columnDefs": [
            {
                "targets": [ 1 ],
                "visible": true,
            },
            {
                "targets": [ 13 ],
                "visible": false
            }
        ],
        "order": [[0, "desc"]]
    });
    $('input.toggle-vis').on('change', function(e) {
        e.preventDefault();
        // Get the column API object
        var column = dataTable.column($(this).attr('data-column'));
        // Toggle the visibility
        console.log(column);             
        column.visible(!column.visible());
    });
    $('#tab-0').click(function () {
        if ($.fn.DataTable.isDataTable("#tableTasacionMotos")) {
            $('#tableTasacionMotos').DataTable().clear().destroy();
        }
        dataTable = $('#tableTasacionMotos').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true,
            sDom: "Rlfrtip",
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
                        return '<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply_'+data.id+'" value="'+data.id+'" class="custom-control-input"><label class="custom-control-label" for="apply_'+data.id+'"></label></div>';
            
                    },
                    "targets": -1
                },  
                { "data": "id" },
                { "data": null,
                    render:function(data){
                        var echo = '';
                        if(data.states_id == 1)
                            echo = "En Revisión";
                        else if(data.states_id == 2)
                            echo = "No Interesa";
                        else if(data.states_id == 3)
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
     
                        if(data.motocycle_state  == "Golpe Delantero")
                            echo = "Golpe Delantero";
                        else if(data.motocycle_state  == "Golpe Trasero")
                            echo = "Golpe Trasero";
                        else if(data.motocycle_state  == "Avería Eléctrica")
                            echo = "Avería Eléctrica";
                        else if(data.motocycle_state  == "Avería Mecánica")
                            echo = "Avería Mecánica";
                        else if(data.motocycle_state  == "Vieja o Abandonada")
                            echo = "Vieja o Abandonada";
                        return echo;
                    },
                    "targets": -1
                },                
    
                { "data": "price_min" },
                { "data": "observations" },
                { "data": null,
                    render:function(data){
                        let echo = '';
                        
                        if(data.status_ficha == 2)
                            echo = "<span class='badge badge-success'>Ficha <br> Verificada</span>";
                        else if(data.status_ficha == 1)
                            echo = "<span class='badge badge-warning'>Ficha <br> Registrada</span>";
                        else if(data.status_ficha == 0)
                            echo = "<span class='badge badge-danger'>Ficha No <br> Registrada</span>";

                        return echo;
                    },
                    "targets": -1
                },
    
                {"data": null,
                    render: function (data, type, row) {
                        let echo = '';
                        if (data.edit == true && data.delete == true) {
                            echo = "<a class='mb-2 mr-2 btn btn-warning text-white button_edit' title='Editar Estado'>Editar</a>"
                                + "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
                                     
                        }
                        else if (data.delete == true) {
                            echo = "<a class='mb-2 mr-2 btn btn-danger text-white button_delete' title='Eliminar Estado'>Eliminar</a>";
                        } else {
                            echo = "No tienes permiso";
                        }
                        return echo;
                    },
                    "targets": -1
                },
    
            ],
            "columnDefs": [
                {
                    "targets": [ 1 ],
                    "visible": true,
                },
                {
                    "targets": [ 13 ],
                    "visible": false
                }
            ],
            "order": [[0, "desc"]]
        });
        $('input.toggle-vis').on('change', function(e) {
            e.preventDefault();
            // Get the column API object
            var column = dataTable.column($(this).attr('data-column'));
            // Toggle the visibility
            console.log(column);             
            column.visible(!column.visible());
        });
    });
    

    //Tabla para el estado Interesa   
    $('#tableMotosQueInterensan thead tr').clone(true).appendTo('#tableMotosQueInterensan thead');
 
    $('#tableMotosQueInterensan thead tr:eq(1) th').each(function (i) {
    
        if (i != 12) {
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
    });
    $('#tab-1').click(function () {
       
        if ($.fn.DataTable.isDataTable("#tableMotosQueInterensan")) {
            $('#tableMotosQueInterensan').DataTable().clear().destroy();
        }
        dataTable = $('#tableMotosQueInterensan').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true,
            sDom: "Rlfrtip",
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getPurchaseValuationsInterested", // json datasource            
                type: "post", // method  , by default get
                 
                error: function () {  // error handling
                }
            },
            "columnDefs": [{
				"targets": [1],
				"visible": true
			}],
            "order": [[0, "desc"]]
        });

        $('input.toggle-vis-1').on('change', function(e) {
            e.preventDefault();
            // Get the column API object
            var column = dataTable.column($(this).attr('data-column'));
            // Toggle the visibility            
            column.visible(!column.visible());
        });
    });
    

    //Tabla para el estado Desguace  
    $('#tableMotosParaDesguace thead tr').clone(true).appendTo('#tableMotosParaDesguace thead');

    $('#tableMotosParaDesguace thead tr:eq(1) th').each( function (i) {
        if (i != 12) {
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
    });
    $('#tab-2').click(function () {
        if ($.fn.DataTable.isDataTable("#tableMotosParaDesguace")) {
            $('#tableMotosParaDesguace').DataTable().clear().destroy();
        }
        dataTable = $('#tableMotosParaDesguace').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true,
            sDom: "Rlfrtip",
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getPurchaseValuationsScrapping", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columnDefs": [{
				"targets": [1],
				"visible": true
			}],
            "order": [[0, "desc"]]
        });

        $('input.toggle-vis-2').on('change', function(e) {
            e.preventDefault();
            // Get the column API object
            var column = dataTable.column($(this).attr('data-column'));
            // Toggle the visibility            
            column.visible(!column.visible());
        });
    });
        

    //Tabla para el estado Venta       
    $('#tableMotosParaVenta thead tr').clone(true).appendTo('#tableMotosParaVenta thead');

    $('#tableMotosParaVenta thead tr:eq(1) th').each( function (i) {
        if (i != 12) {
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
    });
    $('#tab-3').click(function () {
        if ($.fn.DataTable.isDataTable("#tableMotosParaVenta")) {
            $('#tableMotosParaVenta').DataTable().clear().destroy();
        }
        dataTable = $('#tableMotosParaVenta').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true,
            sDom: "Rlfrtip",
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getPurchaseValuationsSale", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columnDefs": [{
				"targets": [1],
				"visible": true
			}],
            "order": [[0, "desc"]]
        });

        $('input.toggle-vis-3').on('change', function(e) {
            e.preventDefault();
            // Get the column API object
            var column = dataTable.column($(this).attr('data-column'));
            // Toggle the visibility            
            column.visible(!column.visible());
        });
    });
     

    //Tabla para el estado Subasta 
    $('#tableMotosParaSubasta thead tr').clone(true).appendTo('#tableMotosParaSubasta thead');

    $('#tableMotosParaSubasta thead tr:eq(1) th').each( function (i) {
        if (i != 12) {
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
    });
    $('#tab-4').click(function () {
        if ($.fn.DataTable.isDataTable("#tableMotosParaSubasta")) {
            $('#tableMotosParaSubasta').DataTable().clear().destroy();
        }
        dataTable = $('#tableMotosParaSubasta').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true,
            sDom: "Rlfrtip",
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getPurchaseValuationsAuction", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columnDefs": [{
				"targets": [1],
				"visible": true
			}],
            "order": [[0, "desc"]]
        });

        $('input.toggle-vis-4').on('change', function(e) {
            e.preventDefault();
            // Get the column API object
            var column = dataTable.column($(this).attr('data-column'));
            // Toggle the visibility            
            column.visible(!column.visible());
        });
    });
   

    //Tabla para el estado No Interesan 
    $('#tableMotosQueNoInteresan thead tr').clone(true).appendTo('#tableMotosQueNoInteresan thead');

    $('#tableMotosQueNoInteresan thead tr:eq(1) th').each( function (i) {
        if (i != 12) {
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
    });
    $('#tab-5').click(function () {
        if ($.fn.DataTable.isDataTable("#tableMotosQueNoInteresan")) {
            $('#tableMotosQueNoInteresan').DataTable().clear().destroy();
        }
        dataTable = $('#tableMotosQueNoInteresan').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true,
            sDom: "Rlfrtip",
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getPurchaseValuationsNoInterested", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columnDefs": [{
				"targets": [1],
				"visible": true
			}],
            "order": [[0, "desc"]]
        });

        $('input.toggle-vis-5').on('change', function(e) {
            e.preventDefault();
            // Get the column API object
            var column = dataTable.column($(this).attr('data-column'));
            // Toggle the visibility            
            column.visible(!column.visible());
        });
    });

    //Tabla para el estado Desguazadas
    $('#tableMotosDesguazadas thead tr').clone(true).appendTo('#tableMotosDesguazadas thead');

    $('#tableMotosDesguazadas thead tr:eq(1) th').each( function (i) {
        if (i != 12) {
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
    });

    $('#tab-6').click(function () {
        if ($.fn.DataTable.isDataTable("#tableMotosDesguazadas")) {
            $('#tableMotosDesguazadas').DataTable().clear().destroy();
        }
        dataTable = $('#tableMotosDesguazadas').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true,
            sDom: "Rlfrtip",
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getPurchaseValuationsScrapped", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columnDefs": [{
				"targets": [1],
				"visible": true
			}],
            "order": [[0, "desc"]]
        });

        $('input.toggle-vis-6').on('change', function(e) {
            e.preventDefault();
            // Get the column API object
            var column = dataTable.column($(this).attr('data-column'));
            // Toggle the visibility            
            column.visible(!column.visible());
        });
    });


    //Tabla para el estado Vendidas
    $('#tableMotosVendidas thead tr').clone(true).appendTo('#tableMotosVendidas thead');

    $('#tableMotosVendidas thead tr:eq(1) th').each( function (i) {
        if (i != 12) {
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
    });

    $('#tab-7').click(function () {
        if ($.fn.DataTable.isDataTable("#tableMotosVendidas")) {
            $('#tableMotosVendidas').DataTable().clear().destroy();
        }
        dataTable = $('#tableMotosVendidas').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true,
            sDom: "Rlfrtip",
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getPurchaseValuationsSold", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columnDefs": [{
				"targets": [1],
				"visible": true
			}],
            "order": [[0, "desc"]]
        });

        $('input.toggle-vis-7').on('change', function(e) {
            e.preventDefault();
            // Get the column API object
            var column = dataTable.column($(this).attr('data-column'));
            // Toggle the visibility            
            column.visible(!column.visible());
        });
    });

    //Tabla para el estado Subastadas
    $('#tableMotosSubastadas thead tr').clone(true).appendTo('#tableMotosSubastadas thead');

    $('#tableMotosSubastadas thead tr:eq(1) th').each( function (i) {
        if (i != 12) {
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
    });

    $('#tab-8').click(function () {
        if ($.fn.DataTable.isDataTable("#tableMotosSubastadas")) {
            $('#tableMotosSubastadas').DataTable().clear().destroy();
        }
        dataTable = $('#tableMotosSubastadas').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true,
            sDom: "Rlfrtip",
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getPurchaseValuationsAuctioned", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columnDefs": [{
				"targets": [1],
				"visible": true
			}],
            "order": [[0, "desc"]]
        });

        $('input.toggle-vis-7').on('change', function(e) {
            e.preventDefault();
            // Get the column API object
            var column = dataTable.column($(this).attr('data-column'));
            // Toggle the visibility            
            column.visible(!column.visible());
        });
    });

    ////////////////////////////////////////////////////////////////////////////
    $('#btnApplyState').click(function() {

        var motos = '';
        preloader('show');
       
        $("input[name=apply]").each(function(index) {
            if ($(this).is(':checked')) {
                motos += $(this).val() + ',';
            }
        });
        var formData = {
            applyState: $('#applyState').val(),
            apply: motos.slice(0, -1)  
        };

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            url: 'applyState',
            data: formData,
            dataType: 'json',
            success: function (response) {
                console.log(response)
                if (response.code == 200) {
                    dataTable.ajax.reload();
                    preloader('hide', response.message, 'success');
                }
                if (response.code == 204) {
                    preloader('hide', response.message, 'error');
                }
            },
            error: function (data) {
               console.log('Error:', data);                
            }
         });
        
    });

     ////////////////////////////////////////////////////////////////////////////
     $('#btnApplyProcess').click(function() {
        var motos = '';
        preloader('show');
       
        $("input[name=apply]").each(function(index) {
            if ($(this).is(':checked')) {
                motos += $(this).val() + ',';
            }
        });
        var formData = {
            applyProcess: $('#applyProcess').val(),
            apply: motos.slice(0, -1)  
        };
  
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            url: 'applyProcesses',
            data: formData,
            dataType: 'json',
            success: function (response) {
                console.log(response)
                if (response.code == 200) {
                    dataTable.ajax.reload();
                    preloader('hide', response.message, 'success');
                }
                if (response.code == 204) {
                    preloader('hide', response.message, 'error');
                }
            },
            error: function (data) {
               console.log('Error:', data);                
            }
         });
        
    });

    var verify_model_brand = null;

     $('#ver').click(function(){

        if(verify_model_brand == 1){
            $(this).html("Elegir marca y modelo de la lista");
            
            $('#model').attr('disabled', 'disabled');
            $('#brand').attr('disabled', 'disabled');
            $('#brand_text').removeAttr('disabled');
            $('#model_text').removeAttr('disabled');

            $('#brand_text').attr('required', 'required');
            $('#model_text').attr('required', 'required');
            $('#brand_text').val('');
            $('#model_text').val('');
    
            $("#exist_model_brand").val(0);

            verify_model_brand = 0;

            $(".ocultar").show();
            $(".mostrar").hide();
        } else {

            $(this).html("No encuentro Modelo/marca");
             
            $('#brand_text').removeAttr('required');
            $('#model_text').removeAttr('required');
            $('#brand_text').attr('disabled', 'disabled');
            $('#model_text').attr('disabled', 'disabled');
            $('#brand_text').val('');
            $('#model_text').val('');

            $('#brand').removeAttr('disabled');
            $('#model').removeAttr('disabled');
            
            $("#exist_model_brand").val(1);

            verify_model_brand = 1;

            $(".ocultar").hide();
            $(".mostrar").show();
        }
    });
     

    //display modal form for product EDIT ***************************
    $(document).on('click', '.button_edit', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var id =  data.id;

        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + id,
            success: function (data) {
                $("#exist_model_brand").val(data.exist_model_brand);

                if(data.exist_model_brand == 0){  // 0 IS TEXT, 1 IS SELECT
                    verify_model_brand = 1;
                    $("#ver").click();
                    $('#brand_text').val(data.brand);
                    $('#model_text').val(data.model);
                }else{
                    verify_model_brand = 0;
                    $("#ver").click();
                }
                
                $('#purchase_id').val(data.id);
                $('#year').val(data.year);
                $('#brand').val(data.brand).trigger("change");
                setTimeout(() => { $('#model').val(data.model).trigger("change"); }, 6000);
                

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

                if(data.motocycle_state  == "Golpe Delantero")
                    $('#g_del').attr('checked', true)
                else if(data.motocycle_state  == "Golpe Trasero")
                    $('#g_tras').attr('checked', true)
                else if(data.motocycle_state  == "Avería Eléctrica")
                    $('#av_elec').attr('checked', true)
                else if(data.motocycle_state  == "Avería Mecánica")
                    $('#av_mec').attr('checked', true)
                else if(data.motocycle_state  == "Vieja o Abandonada")
                    $('#old').attr('checked', true)

                $('#price_min').val(data.price_min);
                $('#observations').val(data.observations);



                if (data.data_serialize !== '') {
                    var response = JSON.parse(data.data_serialize);
                    setTimeout(function() {
                        for (i = 0; i < response.length; i++) {

                            if ($('#' + response[i].name + '.date').length) {

                                if (response[i].value != '') {
                                    var dateValue = response[i].value;
                                    var date2 = new Date(dateValue);
                                    if (dateValue.search('-') != -1) {
                                        date2.setDate(date2.getDate() + 1);
                                    }
                                    //console.log('response[i].value: ' + response[i].value + ' ;date2:' + date2);
                                    $('#' + response[i].name).datepicker('setDate', date2);
                                }
                            } else if (response[i].name.indexOf('radio_') > -1) {

                                $("input[name=" + response[i].name + "][value='" + response[i].value + "']").prop("checked", true);

                            } else {

                                $('#' + response[i].name).val(response[i].value);
                                $('.' + response[i].name + '').text(response[i].value);
                            }
                        }
                    }, 3000);
                }

                $('#form_display_complement').html(data.form_display);

                $('.hide').prop('hidden', true);

                //images
                var div = '';
                data.images_purchase_valuation.forEach(function (element) {
                    div+=`<div class="col-lg-4 col-md-4 col-sm-6 "><img src="${data.link}/local/public/img_app/images_purchase/${element.name}" class="img-thumbnail my-3"></a>
                    </div>`;
                });
                
                $("#images").html(div);
                
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
        var data = $('#form_display_complement').find('select, textarea, input').serializeArray();
        var dataArray = [];
       
        for (i = 0; i < data.length; i++) {
            if ($('#' + data[i].name + '.tagss').length) {
                var find = false;
                $.each(dataArray, function(key, val) {
                    if (val.name == data[i].name) {
                        dataArray[key].value = data[i].value + ',' + val.value;
                        find = true;
                    }
                });
                if (!find) {
                    dataArray.push({
                        name: data[i].name,
                        value: data[i].value
                    });
                }
            } else if ($('#' + data[i].name + '.date').length) {
                var today = new Date(data[i].value);
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                today = yyyy + '-' + mm + '-' + dd;

                dataArray.push({
                    name: data[i].name,
                    value: today
                });
            }  else {
                dataArray.push({
                    name: data[i].name,
                    value: data[i].value
                });
            }
        }

        let brandform = '';
        let modelform = '';

        if(verify_model_brand == 0){
            brandform = $("#brand_text").val();
            modelform = $("#model_text").val();
        }else{
            brandform = $("#brand").val();
            modelform = $("#model").val();
        }

        var dataSerialize = JSON.stringify(dataArray, null, 2);
        var formData = {
            brand: brandform,
            model: modelform,
            exist_model_brand: $("#exist_model_brand").val(),
            year: $("#year").val(),
            km: $("#km").val(),
            name: $("#name").val(),
            lastname: $("#lastname").val(),
            email: $("#email").val(),
            phone: $("#phone").val(),
            province: $("#province").val(),
            status_trafic: $("input[name='status_trafic']:checked").val(),
            motocycle_state: $("input[name='motocycle_state']:checked").val(),
            price_min: $("#price_min").val(),
            observations: $("#observations").val(),
            data_serialize: dataSerialize.replace(/\s+/g, " ")
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
        preloader('show');
        if (dataArray[0].value != '' && dataArray[1].value != '') {
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data)
                if (data.code == 422) {
                    preloader('hide', data.message, 'warning');
                    $('#errors').html('');
                    var list = '';
                    $.each(data.response, function (i, value) {
                        list = '<li>' + value + '</li>';
                        $('.alert').css('display', 'block');
                        $('#errors').append(list);
                    });
                }
                if (data.code == 200) {
                    dataTable.ajax.reload();
                    preloader('hide', data.message, 'success');
                    $('#frmPurchase').trigger("reset");
                    $('#errors').html('');
                    $('.alert').css('display', 'none');
                    $('#modalPurchase').modal('hide');
                }
                
            },
            error: function (data) {
                console.log('Error:', data);
                if (data.status == 422) {
                    
                 
                }
            }
         });
        } else {
            preloader('hide', 'Campos complementarios requeridos', 'warning');
        }
        
    });


    //delete product and remove it from TABLE list DT 0 ***************************
    $(document).on('click', '.button_delete', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var purchase_id =  data[1];
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
        var id =  data[1];

        $('#purchase_id').val(id);
        $('#modalDocument').modal('show');
    });

    //***************************
    $(document).on('click', '.button_ficha', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var id_purchase = data[1];

        sessionStorage.setItem('id_purchase', id_purchase);
        sessionStorage.setItem('action', 2);
        window.location.href = 'purchase_valuation_interested/ficha_de_la_moto';       
         
    });

    //***************************
    $(document).on('click', '.button_verificar', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var id_purchase = data[1];

        var formData = {
            id: id_purchase,
        };
        console.log(formData);
        preloader('show');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: "POST",
            url: url + '/verificar',
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

    

     //***************************
     $(document).on('click', '.button_publish', function () {
        var $tr = $(this).closest('tr');
        var data = dataTable.row($(this).parents($tr)).data();
        var status = $(this).val();
        if (status == 1) {
            $(this).text('No Publicado');
            
            $(this).val('0'); 
         }
         if (status == 0) {
            $(this).text('Publicado');
            $(this).addClass('btn-success');
            $(this).removeClass('btn-info');
            $(this).val('1'); 
        }     
        var formData = {
            id:  data[1],
            status: status
        };
        preloader('show');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: "POST",
            url: url + '/subasta',
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
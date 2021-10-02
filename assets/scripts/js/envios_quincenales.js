$(document).ready(function () {
 
    //get base URL *********************
    var url = $('#url').val();
    var dataTable = '';

    $('#tableEnviosQuincenalesSinDescargar thead tr').clone(true).appendTo('#tableEnviosQuincenalesSinDescargar thead');

    $('#tableEnviosQuincenalesSinDescargar thead tr:eq(1) th').each( function (i) {
      
        if (i == 0) {
            $(this).css('color', 'transparent');
        }
        else {            
            $(this).html('<input type="text" class="form-control" />');
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

    dataTable = $('#tableEnviosQuincenalesSinDescargar').DataTable({
        processing: true,
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true, 
        "ajax": {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getEnviosQuincenalesSinDescargar", // json datasource            
            type: "post", // method  , by default get
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": null,
                render:function(data){
                    return '<div class="custom-control custom-checkbox"><input type="checkbox" name="apply[]" id="apply_'+data.id+'" value="'+data.id+'" class="custom-control-input" checked><label class="custom-control-label" for="apply_'+data.id+'"></label></div>';
        
                },
                "targets": -1
            },  
            { "data": "model" },
            { "data": "registration_number" },
            { "data": "registration_date" },
            { "data": "frame_no" },
            { "data": null,
                render:function(data){
                    let echo = '';
                    
                    if(data.vehicle_state_trafic == "Alta")
                        echo = "Alta";
                    else if(data.vehicle_state_trafic == "Baja definitiva")
                        echo = "Baja definitiva";
                    else if(data.vehicle_state_trafic == "Baja temporal")
                        echo = "Baja temporal";


                        if(data.vehicle_state == "Siniestrado")
                        echo = "Baja definitiva";
                        else if(data.vehicle_state == "Averiado")
                        echo = "Baja definitiva";                        
                        else if(data.vehicle_state == "Abandonado")
                        echo = "Abandonado";
                        else if(data.vehicle_state == "Completo")
                        echo = "Completo";
                        else if(data.vehicle_state == "Parcialmente desmontado")
                        echo = "Parcialmente desmontado";
                    

                    return echo;
                },
                "targets": -1
            },
            { "data": "weight" },
            { "data": "titular" },
            { "data": "dni" },
            { "data": "birthdate" },
            { "data": "direction" },
            { "data": "postal_code" },
            { "data": "municipality" },
            { "data": "province" },
            { "data": null,
                render:function(data){
                    let echo = '';
                    if(data.vehicle_state == "Siniestrado")
                        echo = "Baja definitiva";
                    else if(data.vehicle_state == "Averiado")
                        echo = "Baja definitiva";                        
                    else if(data.vehicle_state == "Abandonado")
                        echo = "Abandonado";
                    else if(data.vehicle_state == "Completo")
                        echo = "Completo";
                    else if(data.vehicle_state == "Parcialmente desmontado")
                        echo = "Parcialmente desmontado";                    

                    return echo;
                },
                "targets": -1
            },
            { "data": "current_year" },
            { "data": "id" },
            { "data": "certificate_destruction_date" },
            { "data": "collection_contract_date" }
             

        ],
        "columnDefs": [
            {
                "targets": [ 3 ],
                "visible": false,
            },
            {
                "targets": [ 5 ],
                "visible": false,
            },
            {
                "targets": [ 6 ],
                "visible": false,
            },
            {
                "targets": [ 9 ],
                "visible": false,
            },
            {
                "targets": [ 10 ],
                "visible": false,
            },
            {
                "targets": [ 11 ],
                "visible": false,
            },
            {
                "targets": [ 12 ],
                "visible": false,
            },
            {
                "targets": [ 18 ],
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

    $("#applyInf").click(function(){
        var values = $("input[name='apply[]']:checkbox:checked")
              .map(function(){return $(this).val();}).get();

        var apply = [];

        values.forEach(function(val, index){
            apply.push($("#apply_"+val).val());
        });

        $("#applyForm").val(apply);
        $("#formApply").submit();
    });

    $("#applyInf1").click(function(){
        var values = $("input[name='apply1[]']:checkbox:checked")
              .map(function(){return $(this).val();}).get();

        var apply = [];

        values.forEach(function(val, index){
            apply.push($("#apply1_"+val).val());
        });

        $("#applyForm1").val(apply);
        $("#formApply1").submit();
    });
    
    $('#tab-0').click(function () {
        if ($.fn.DataTable.isDataTable("#tableEnviosQuincenalesSinDescargar")) {
            $('#tableEnviosQuincenalesSinDescargar').DataTable().clear().destroy();
        }
        
        dataTable = $('#tableEnviosQuincenalesSinDescargar').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true, 
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getEnviosQuincenalesSinDescargar", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columns": [
                { "data": null,
                    render:function(data){
                        return '<div class="custom-control custom-checkbox"><input type="checkbox" name="apply[]" id="apply_'+data.id+'" value="'+data.id+'" class="custom-control-input" checked><label class="custom-control-label" for="apply_'+data.id+'"></label></div>';
            
                    },
                    "targets": -1
                },  
                { "data": "model" },
                { "data": "registration_number" },
                { "data": "registration_date" },
                { "data": "frame_no" },
                { "data": null,
                    render:function(data){
                        let echo = '';
                        
                        if(data.vehicle_state_trafic == "Alta")
                            echo = "Alta";
                        else if(data.vehicle_state_trafic == "Baja definitiva")
                            echo = "Baja definitiva";
                        else if(data.vehicle_state_trafic == "Baja temporal")
                            echo = "Baja temporal";
    
    
                            if(data.vehicle_state == "Siniestrado")
                            echo = "Baja definitiva";
                            else if(data.vehicle_state == "Averiado")
                            echo = "Baja definitiva";                        
                            else if(data.vehicle_state == "Abandonado")
                            echo = "Abandonado";
                            else if(data.vehicle_state == "Completo")
                            echo = "Completo";
                            else if(data.vehicle_state == "Parcialmente desmontado")
                            echo = "Parcialmente desmontado";
                        
    
                        return echo;
                    },
                    "targets": -1
                },
                { "data": "weight" },
                { "data": "titular" },
                { "data": "dni" },
                { "data": "birthdate" },
                { "data": "direction" },
                { "data": "postal_code" },
                { "data": "municipality" },
                { "data": "province" },
                { "data": null,
                    render:function(data){
                        let echo = '';
                        if(data.vehicle_state == "Siniestrado")
                            echo = "Baja definitiva";
                        else if(data.vehicle_state == "Averiado")
                            echo = "Baja definitiva";                        
                        else if(data.vehicle_state == "Abandonado")
                            echo = "Abandonado";
                        else if(data.vehicle_state == "Completo")
                            echo = "Completo";
                        else if(data.vehicle_state == "Parcialmente desmontado")
                            echo = "Parcialmente desmontado";                    
    
                        return echo;
                    },
                    "targets": -1
                },
                { "data": "current_year" },
                { "data": "id" },
                { "data": "certificate_destruction_date" },
                { "data": "collection_contract_date" }
                 
    
            ],
            "columnDefs": [
                {
                    "targets": [ 3 ],
                    "visible": false,
                },
                {
                    "targets": [ 5 ],
                    "visible": false,
                },
                {
                    "targets": [ 6 ],
                    "visible": false,
                },
                {
                    "targets": [ 9 ],
                    "visible": false,
                },
                {
                    "targets": [ 10 ],
                    "visible": false,
                },
                {
                    "targets": [ 11 ],
                    "visible": false,
                },
                {
                    "targets": [ 12 ],
                    "visible": false,
                },
                {
                    "targets": [ 18 ],
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
    $('#tableEnviosQuincenalesDescargados thead tr').clone(true).appendTo('#tableEnviosQuincenalesDescargados thead');
 
    $('#tableEnviosQuincenalesDescargados thead tr:eq(1) th').each(function (i) {
    
        if (i == 0) {
            $(this).css('color', 'transparent');
        }
        else {            
            $(this).html('<input type="text" class="form-control" />');
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
        if ($.fn.DataTable.isDataTable("#tableEnviosQuincenalesDescargados")) {
            $('#tableEnviosQuincenalesDescargados').DataTable().clear().destroy();
        }
        dataTable = $('#tableEnviosQuincenalesDescargados').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true, 
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getEnviosQuincenalesDescargados", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columns": [
                { "data": null,
                    render:function(data){
                        return '<div class="custom-control custom-checkbox"><input type="checkbox" name="apply1[]" id="apply1_'+data.id+'" value="'+data.id+'" class="custom-control-input"><label class="custom-control-label" for="apply1_'+data.id+'"></label></div>';
            
                    },
                    "targets": -1
                },  
                { "data": "model" },
                { "data": "registration_number" },
                { "data": "registration_date" },
                { "data": "frame_no" },
                { "data": null,
                    render:function(data){
                        let echo = '';
                        
                        if(data.vehicle_state_trafic == "Alta")
                            echo = "Alta";
                        else if(data.vehicle_state_trafic == "Baja definitiva")
                            echo = "Baja definitiva";
                        else if(data.vehicle_state_trafic == "Baja temporal")
                            echo = "Baja temporal";
    
    
                            if(data.vehicle_state == "Siniestrado")
                            echo = "Baja definitiva";
                            else if(data.vehicle_state == "Averiado")
                            echo = "Baja definitiva";                        
                            else if(data.vehicle_state == "Abandonado")
                            echo = "Abandonado";
                            else if(data.vehicle_state == "Completo")
                            echo = "Completo";
                            else if(data.vehicle_state == "Parcialmente desmontado")
                            echo = "Parcialmente desmontado";
                        
    
                        return echo;
                    },
                    "targets": -1
                },
                { "data": "weight" },
                { "data": "titular" },
                { "data": "dni" },
                { "data": "birthdate" },
                { "data": "direction" },
                { "data": "postal_code" },
                { "data": "municipality" },
                { "data": "province" },
                { "data": null,
                    render:function(data){
                        let echo = '';
                        if(data.vehicle_state == "Siniestrado")
                            echo = "Baja definitiva";
                        else if(data.vehicle_state == "Averiado")
                            echo = "Baja definitiva";                        
                        else if(data.vehicle_state == "Abandonado")
                            echo = "Abandonado";
                        else if(data.vehicle_state == "Completo")
                            echo = "Completo";
                        else if(data.vehicle_state == "Parcialmente desmontado")
                            echo = "Parcialmente desmontado";                    
    
                        return echo;
                    },
                    "targets": -1
                },
                { "data": "current_year" },
                { "data": "id" },
                { "data": "certificate_destruction_date" },
                { "data": "collection_contract_date" }
                 
    
            ],
            "columnDefs": [
                {
                    "targets": [ 3 ],
                    "visible": false,
                },
                {
                    "targets": [ 5 ],
                    "visible": false,
                },
                {
                    "targets": [ 6 ],
                    "visible": false,
                },
                {
                    "targets": [ 9 ],
                    "visible": false,
                },
                {
                    "targets": [ 10 ],
                    "visible": false,
                },
                {
                    "targets": [ 11 ],
                    "visible": false,
                },
                {
                    "targets": [ 12 ],
                    "visible": false,
                },
                {
                    "targets": [ 18 ],
                    "visible": false
                }
            ],
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

    ////////////////////////////////////////////////////////////////////////////
    $('#btnApplySubProcesses').click(function() {

        var motos = '';
        preloader('show');
       
        $("input[name=apply]").each(function(index) {
            if ($(this).is(':checked')) {
                motos += $(this).val() + ',';
            }
        });
        var formData = {
            applySubProcesses: $('#applySubProcesses').val(),
            apply: motos.slice(0, -1)  
        };

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            url: 'envios-quincenales/applySubProcesses',
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

});
 
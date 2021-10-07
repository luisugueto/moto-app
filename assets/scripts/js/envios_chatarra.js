$(document).ready(function () {
 
    //get base URL *********************
    var url = $('#url').val();
    var dataTable = '';
    $('#count').html(0);

    $('#tableEnviosChatarraAluminio thead tr').clone(true).appendTo('#tableEnviosChatarraAluminio thead');

    $('#tableEnviosChatarraAluminio thead tr:eq(1) th').each( function (i) {
      
        $(this).html('<input type="text" class="form-control" />');         
 
        $( 'input', this ).on( 'keyup change', function () {
            if (dataTable.column(i).search() !== this.value) {             
                dataTable
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    dataTable = $('#tableEnviosChatarraAluminio').DataTable({
        processing: true,
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true, 
        "ajax": {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getEnviosChatarraAluminio", // json datasource            
            type: "post", // method  , by default get
            error: function () {  // error handling
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "frame_no" },
            { "data": "model" },
            { "data": "registration_number" },
            { "data": "registration_date" },               

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

    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
        type: "POST",
        url: 'getCountEnviosChatarraIncidencias',
        success: function (data) {
            if (data.code == 200) {
                $('#count').html(data.purchases);
            }
            
        },
        error: function (data) {
        }
    });
    
    $('#tab-0').click(function () {
        if ($.fn.DataTable.isDataTable("#tableEnviosChatarraAluminio")) {
            $('#tableEnviosChatarraAluminio').DataTable().clear().destroy();
        }
        
        dataTable = $('#tableEnviosChatarraAluminio').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true, 
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getEnviosChatarraAluminio", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
                       
            "columns": [
                { "data": "id" },
                { "data": "frame_no" },
                { "data": "model" },
                { "data": "registration_number" },
                { "data": "registration_date" },               
    
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
    

    //Tabla para chatarra hierro  
    $('#tableEnviosChatarraHierro thead tr').clone(true).appendTo('#tableEnviosChatarraHierro thead');
 
    $('#tableEnviosChatarraHierro thead tr:eq(1) th').each(function (i) {
    
        $(this).html('<input type="text" class="form-control" />'); 

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
        if ($.fn.DataTable.isDataTable("#tableEnviosChatarraHierro")) {
            $('#tableEnviosChatarraHierro').DataTable().clear().destroy();
        }
        dataTable = $('#tableEnviosChatarraHierro').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true, 
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getEnviosChatarraHierro", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columns": [
                { "data": "id" },
                { "data": "frame_no" },
                { "data": "model" },
                { "data": "registration_number" },
                { "data": "registration_date" },               
    
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

    //Tabla para chatarra hierro  
    $('#tableEnviosChatarraCamion thead tr').clone(true).appendTo('#tableEnviosChatarraCamion thead');
 
    $('#tableEnviosChatarraCamion thead tr:eq(1) th').each(function (i) {    
                    
        $(this).html('<input type="text" class="form-control" />');       

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
        if ($.fn.DataTable.isDataTable("#tableEnviosChatarraCamion")) {
            $('#tableEnviosChatarraCamion').DataTable().clear().destroy();
        }
        dataTable = $('#tableEnviosChatarraCamion').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true, 
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getEnviosChatarraCamion", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columns": [
                { "data": "id" },
                { "data": "frame_no" },
                { "data": "model" },
                { "data": "registration_number" },
                { "data": "registration_date" },               
    
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

    //Tabla para chatarra hierro  
    $('#tableEnviosChatarraHistorico thead tr').clone(true).appendTo('#tableEnviosChatarraHistorico thead');
 
    $('#tableEnviosChatarraHistorico thead tr:eq(1) th').each(function (i) {
    
        $(this).html('<input type="text" class="form-control" />');
        
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
        if ($.fn.DataTable.isDataTable("#tableEnviosChatarraHistorico")) {
            $('#tableEnviosChatarraHistorico').DataTable().clear().destroy();
        }
        dataTable = $('#tableEnviosChatarraHistorico').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true, 
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getEnviosChatarraHistorico", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columns": [
                { "data": "id" },
                { "data": "frame_no" },
                { "data": "model" },
                { "data": "registration_number" },
                { "data": "registration_date" },               
                {
                    "data": null,
                    render: function (data) {
                        let echo = '<b>' + data.check_chasis + '</b>';
                                        
    
                        return echo;
                    },
                    "targets": -1
                },
                { "data": "send_date" },      
            ],             
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

    $('#tab-4').click(function () {
        if ($.fn.DataTable.isDataTable("#tableEnviosChatarraIncidencias")) {
            $('#tableEnviosChatarraIncidencias').DataTable().clear().destroy();
        }
        dataTable = $('#tableEnviosChatarraIncidencias').DataTable({
            processing: true,
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true, 
            "ajax": {
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                url: "getEnviosChatarraIncidencias", // json datasource            
                type: "post", // method  , by default get
                error: function () {  // error handling
                }
            },
            "columns": [
                { "data": "id" },
                { "data": "frame_no" },
                { "data": "model" },
                { "data": "registration_number" },
                { "data": "registration_date" },               
                {
                    "data": null,
                    render: function (data) {
                        let echo = '<b>' + data.check_chasis + '</b>';
                                        
    
                        return echo;
                    },
                    "targets": -1
                },
                // { "data": "send_date" },      
            ],             
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


    

});
 
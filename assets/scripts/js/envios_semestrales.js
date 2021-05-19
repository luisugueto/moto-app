$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    $('#tableEnviosSemestrales thead tr').clone(true).appendTo('#tableEnviosSemestrales thead');

    $('#tableEnviosSemestrales thead tr:eq(1) th').each( function (i) {
      
        if (i != 15) {
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

    var dataTable = $('#tableEnviosSemestrales').DataTable({
        processing: true,
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true, 
        "ajax": {
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            url: "getEnviosSemestrales", // json datasource            
            type: "post", // method  , by default get
            error: function () {  // error handling
            }
        },
        "columns": [
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
                "targets": [ 15 ],
                "visible": false,
            },
            {
                "targets": [ 16 ],
                "visible": false
            },
            {
                "targets": [ 17 ],
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
 
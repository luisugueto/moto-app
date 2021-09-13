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
            { "data": "id" },
            { "data": "type_proccess" },
            { "data": "LER" },
            { "data": null,
                render:function(data){
                    return data.material +' / <br><b>'+ data.companie +'</b>';
        
                },
                "targets": -1
            },            
            { "data": "delivery" },
            { "data": "in_installation" },
            { "data": "dcs" },
            { "data": "withdrawal_date" }            

        ],
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
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
 
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
                    return '<div class="custom-control custom-checkbox"><input type="checkbox" name="apply" id="apply_'+data.id+'" value="'+data.id+'" class="custom-control-input"><label class="custom-control-label" for="apply_'+data.id+'"></label></div>';
        
                },
                "targets": -1
            },  
            { "data": "name" },
            { "data": null,
                render:function(data){
                    return '<input name="entrega" id="entrega" type="number" step="0.1" class="form-control" value="">';
        
                },
                "targets": -1
            }, 
            { "data": null,
                render:function(data){
                    return '<input name="en_instalaciones" id="en_instalaciones" type="number" step="0.1" class="form-control" value="">';
        
                },
                "targets": -1
            },
            { "data": null,
                render:function(data){
                    return '<input name="dcs" id="dcs" type="text"  class="form-control" value="">';
        
                },
                "targets": -1
            },
            {"data": null,
                render:function(data, type, row)
                    {
                      var echo ="<a class='mb-2 mr-2 btn btn-info button_detail text-white' title='Info'> Retiro</a>";
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

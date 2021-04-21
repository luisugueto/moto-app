$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    //ver
    $('.check_record-view').on("change", ".custom-control-input", function () {
        $(".input_record-view:checkbox").not(this).prop('checked', this.checked);
    });

     //listar
    $('.check_record-list').on("change", ".custom-control-input", function () {
        $(".input_record-list:checkbox").not(this).prop('checked', this.checked);
    });

    //crear
    $('.check_record-create').on("change", ".custom-control-input", function () {
        $(".input_record-create:checkbox").not(this).prop('checked', this.checked);
    });

    //modificar
    $('.check_record-edit').on("change", ".custom-control-input", function () {
        $(".input_record-edit:checkbox").not(this).prop('checked', this.checked);
    });

    //eliminar
    $('.check_record-delete').on("change", ".custom-control-input", function () {
        $(".input_record-delete:checkbox").not(this).prop('checked', this.checked);
    });
    
    //todas
    $('.check_all').on("change", ".custom-control-input", function (e) {
         $("input:checkbox[data-select='permission-"+$(this).data("id")+"']").not(this).prop('checked', this.checked);
    });

    

});
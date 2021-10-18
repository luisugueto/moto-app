 
 //***************************
 $(document).on('click', '#backFicha', function () {
    var $tr = $('#idFicha').val();
    var id_purchase = $tr;

    sessionStorage.setItem('id_purchase', id_purchase);
    sessionStorage.setItem('action', 2);
    window.location.href = '../../purchase_valuation_interested/ficha_de_la_moto';       
     
})
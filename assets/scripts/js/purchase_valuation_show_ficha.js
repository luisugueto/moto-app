$(document).ready(function () {

    var action = sessionStorage.getItem('action');
         
    if (action == 1) {
        sessionStorage.clear(); 
    }
    if (action == 2) {
        var id = sessionStorage.getItem('id_purchase');
        console.log(action, id)
        $.ajax({
            type: "GET",
            url: 'ficha_de_la_moto/' + id,
            dataType: 'json',
            success: function (data) {
       
                $('#purchase_id').val(data.id);
                $('#year').val(data.year);
                $('#brand').val(data.brand).trigger("change");
                $('#model').val(data.model).trigger("change");
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
                            } else if ($('#' + response[i].name + '.date_us').length) {

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
                
                $('#btn-save').val("update");
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
});
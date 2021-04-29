$(document).ready(function () {
    var url = $('#url').val();

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

                $('#formFichaTabs').find('select, textarea, input').each(function () {
                    $(this).prop('disabled', true);
                });
       
                $('#purchase_id').val(data.id);
                $('#year').val(data.year);
                $('#brand').val(data.brand).trigger("change");
                setTimeout(() => { $('#model').val(data.model).trigger("change"); }, 4500);
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


                // Datos Purchase Management
                $('#file_no').val(data.file_no);
                $('#current_year').val(data.current_year);
                $('#collection_contract_date').val(data.collection_contract_date);
                if(data.documents_attached == 1)
                    $('#documents_attached').attr('checked', true)
                if(data.non_existence_document == 1)
                    $('#non_existence_document').attr('checked', true)
                if(data.vehicle_delivers == 'Titular')
                    $('#incumbent').attr('checked', true)
                else if(data.vehicle_delivers == 'Propietario')    
                    $('#owner').attr('checked', true)
                else if(data.vehicle_delivers == 'Representante')    
                    $('#representative').attr('checked', true)
                $('#firts_name').val(data.firts_name);    
                $('#firts_surname').val(data.firts_surname);
                $('#second_surtname').val(data.second_surtname);
                $('#dni').val(data.dni);
                $('#birthdate').val(data.birthdate);
                $('#phone').val(data.phone);    
                $('#email').val(data.email);
                $('#street').val(data.street);
                $('#nro_street').val(data.nro_street);
                $('#stairs').val(data.stairs);
                $('#floor').val(data.floor);    
                $('#letter').val(data.letter);
                $('#municipality').val(data.municipality);
                $('#postal_code').val(data.postal_code);
                $('#province_management').val(data.province_management);
                $('#iban').val(data.iban);
                $('#sale_amount').val(data.sale_amount);
                $('#name_representantive').val(data.name_representantive);
                $('#firts_surname_representative').val(data.firts_surname_representative);
                $('#second_surtname_representantive').val(data.second_surtname_representantive);
                $('#dni_representative').val(data.dni_representative);
                $('#birthdate_representative').val(data.birthdate_representative);
                $('#phone_representantive').val(data.phone_representantive);
                $('#email_representative').val(data.email_representative);
                $('#representation_concept').val(data.representation_concept);
                $('#brand_management').val(data.brand_management);
                $('#model_management').val(data.model_management);
                $('#version').val(data.version);
                $('#type').val(data.type);
                $('#kilometres').val(data.kilometres);
                $('#color').val(data.color);
                if(data.fuel == 'Gasolina')
                    $('#gasoline').attr('checked', true)
                else if(data.fuel == 'Gasóleo')    
                    $('#diesel_oil').attr('checked', true)
                else if(data.fuel == 'Otros')    
                    $('#others').attr('checked', true)
                $('#registration_number').val(data.registration_number);
                $('#registration_date').val(data.registration_date);
                $('#registration_country').val(data.registration_country);
                $('#frame_no').val(data.frame_no);
                $('#motor_no').val(data.motor_no);
                if(data.vehicle_state_trafic == 'Alta')
                    $('#high').attr('checked', true)
                else if(data.vehicle_state_trafic == 'Baja definitiva')    
                    $('#final_discharge').attr('checked', true)
                else if(data.vehicle_state_trafic == 'Baja temporal')    
                    $('#temporary_leave').attr('checked', true)
                if(data.vehicle_state == 'Siniestrado')
                    $('#sinister').attr('checked', true)
                else if(data.vehicle_state == 'Averiado')    
                    $('#damaged').attr('checked', true)
                else if(data.vehicle_state == 'Abandonado')    
                    $('#abandoned').attr('checked', true)
                else if(data.vehicle_state == 'Completo')    
                    $('#full').attr('checked', true)
                else if(data.vehicle_state == 'Parcialmente desmontado')    
                    $('#partially_disassembled').attr('checked', true)

                $('.hide').prop('hidden', true);
                
                $('#btn-save').val("update");
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

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
        // console.log(dataArray)

        var status_trafic = '';
        if($('#high').is(':checked') )
            status_trafic = 'Alta';
        else if($('#low').is(':checked') )
            status_trafic = 'Baja definitiva';

        var g_del = 0; if($('#g_del').is(':checked') ) g_del = 1;
        var g_tras = 0; if($('#g_tras').is(':checked') ) g_tras = 1;
        var av_elec = 0; if($('#av_elec').is(':checked') ) av_elec = 1;
        var av_mec = 0; if($('#av_mec').is(':checked') ) av_mec = 1;
        var old = 0; if($('#old').is(':checked') ) old = 1;

        var vehicle_delivers = '';  
        if($('#incumbent').is(':checked') ) 
            vehicle_delivers = 'Titular';
        else if($('#owner').is(':checked') )
            vehicle_delivers = 'Propietario';
        else if($('#representative').is(':checked') )
            vehicle_delivers = 'Representante';

        var fuel = ''; 
        if($('#gasoline').is(':checked') )
            fuel = 'Gasolina';
        else if($('#diesel_oil').is(':checked') )    
            fuel = 'Gasóleo';
        else if($('#others').is(':checked') )    
            fuel = 'Otros';

        var vehicle_state_trafic = ''; 
        if($('#high').is(':checked') )
            vehicle_state_trafic = 'Alta';
        else if($('#final_discharge').is(':checked') )    
            vehicle_state_trafic = 'Baja definitiva';
        else if($('#temporary_leave').is(':checked') )
            vehicle_state_trafic = 'Baja temporal';

        var vehicle_state = '';
        if($('#sinister').is(':checked') )
            vehicle_state = 'Siniestrado';
        else if($('#damaged').is(':checked') )    
            vehicle_state = 'Averiado';
        else if($('#abandoned').is(':checked') )    
            vehicle_state = 'Abandonado';
        else if($('#full').is(':checked') )
            vehicle_state = 'Completo';    
        else if($('#partially_disassembled').is(':checked') )   
            vehicle_state = 'Parcialmente desmontado';

        var dataSerialize = JSON.stringify(dataArray, null, 2);
        var formData = {
            purchase_id : $('#purchase_id').val(),
            brand: $("#brand").val(),
            model: $("#model").val(),
            year: $("#year").val(),
            km: $("#km").val(),
            name: $("#name").val(),
            lastname: $("#lastname").val(),
            email: $("#email").val(),
            phone: $("#phone").val(),
            province: $("#province").val(),
            price_min: $("#price_min").val(),
            observations: $("#observations").val(),
            status_trafic: status_trafic,
            g_del: g_del,
            g_tras: g_tras,
            av_elec: av_elec,
            av_mec: av_mec,
            old: old,
            data_serialize: dataSerialize.replace(/\s+/g, " "),
            file_no: $('#file_no').val(),
            current_year:        $('#current_year').val(),
            collection_contract_date:        $('#collection_contract_date').val(),
            documents_attached:        $('#documents_attached').val(),
            non_existence_document:        $('#non_existence_document').val(),
            vehicle_delivers: vehicle_delivers,
            fuel: fuel,
            vehicle_state_trafic: vehicle_state_trafic,
            vehicle_state: vehicle_state,
            firts_name:       $('#firts_name').val(),    
            firts_surname:       $('#firts_surname').val(),
            second_surtname:        $('#second_surtname').val(),
            dni:        $('#dni').val(),
            birthdate:        $('#birthdate').val(),
            phone:        $('#phone').val(),    
            email:        $('#email').val(),
            street:        $('#street').val(),
            nro_street:        $('#nro_street').val(),
            stairs:        $('#stairs').val(),
            floor:        $('#floor').val(),    
            letter:        $('#letter').val(),
            municipality:        $('#municipality').val(),
            postal_code:        $('#postal_code').val(),
            province_management:        $('#province_management').val(),
            iban:        $('#iban').val(),
            sale_amount:        $('#sale_amount').val(),
            name_representantive:        $('#name_representantive').val(),
            firts_surname_representative:        $('#firts_surname_representative').val(),
            second_surtname_representantive:        $('#second_surtname_representantive').val(),
            dni_representative:        $('#dni_representative').val(),
            birthdate_representative:        $('#birthdate_representative').val(),
            phone_representantive:        $('#phone_representantive').val(),
            email_representative:        $('#email_representative').val(),
            representation_concept:        $('#representation_concept').val(),
            brand_management:        $('#brand_management').val(),
            model_management:        $('#model_management').val(),
            version:        $('#version').val(),
            type:        $('#type').val(),
            kilometres:        $('#kilometres').val(),
            color:        $('#color').val(),
            registration_number:        $('#registration_number').val(),
            registration_date:        $('#registration_date').val(),
            registration_country:        $('#registration_country').val(),
            frame_no:        $('#frame_no').val(),
            motor_no:        $('#motor_no').val()
        }

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var message = `
                <div class="notification alert alert-success" role="alert">
                    Registro modificado exitosamente!
                </div>`;
                $('#ficha').before(message);
            },
            error: function (data) {
                //console.log('Error:', data);
                if (data.status == 422) {
                    $('#errors').html('');
                    var list = '';
                    $.each(data.responseJSON, function (i, value) {
                        list = '<li>' + value + '</li>';
                        $('.alert').prop('hidden', false);
                        $('#errors').append(list);
                    });
                 
                }
            }
        });
    });


    ///////////////////////////////////////////////
    $('#editTabFicha0').click(function (e) {
        e.preventDefault();
        $('#tab-ficha-0').find('select, textarea, input').each(function () {
            if ($(this).prop('disabled')) $(this).prop('disabled', false); else $(this).prop('disabled', true);
        });
    });
     ///////////////////////////////////////////////
     $('#editTabFicha1').click(function (e) {
        e.preventDefault();
        $('#tab-ficha-1').find('select, textarea, input').each(function () {
            if ($(this).prop('disabled')) $(this).prop('disabled', false); else $(this).prop('disabled', true);
        });
     });
     ///////////////////////////////////////////////
     $('#editTabFicha2').click(function (e) {
        e.preventDefault();
        $('#tab-ficha-2').find('select, textarea, input').each(function () {
            if ($(this).prop('disabled')) $(this).prop('disabled', false); else $(this).prop('disabled', true);
        });
     });
     ///////////////////////////////////////////////
     $('#editTabFicha3').click(function (e) {
        e.preventDefault();
        $('#tab-ficha-3').find('select, textarea, input').each(function () {
            if ($(this).prop('disabled')) $(this).prop('disabled', false); else $(this).prop('disabled', true);
        });
     });
     ///////////////////////////////////////////////
     $('#editTabFicha4').click(function (e) {
        e.preventDefault();
        $('#tab-ficha-4').find('select, textarea, input').each(function () {
            if ($(this).prop('disabled')) $(this).prop('disabled', false); else $(this).prop('disabled', true);
        });
     });
     ///////////////////////////////////////////////
     $('#editTabFicha5').click(function (e) {
        e.preventDefault();
        $('#tab-ficha-5').find('select, textarea, input').each(function () {
            if ($(this).prop('disabled')) $(this).prop('disabled', false); else $(this).prop('disabled', true);
        });
     });
     ///////////////////////////////////////////////
     $('#editTabFicha6').click(function (e) {
        e.preventDefault();
        $('#tab-ficha-6').find('select, textarea, input').each(function () {
            if ($(this).prop('disabled')) $(this).prop('disabled', false); else $(this).prop('disabled', true);
        });
     });
     ///////////////////////////////////////////////
     $('#editTabFicha7').click(function (e) {
        e.preventDefault();
        $('#tab-ficha-7').find('select, textarea, input').each(function () {
            if ($(this).prop('disabled')) $(this).prop('disabled', false); else $(this).prop('disabled', true);
        });
     });
     ///////////////////////////////////////////////
     $('#editTabFicha8').click(function (e) {
        e.preventDefault();
        $('#tab-ficha-8').find('select, textarea, input').each(function () {
            if ($(this).prop('disabled')) $(this).prop('disabled', false); else $(this).prop('disabled', true);
        });
    });
    
});
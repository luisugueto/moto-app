$(document).ready(function () {
    var url = $('#url').val();
    var url_process = $('#url_process').val();
    var url_index = $('#url_index').val();

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
                $('#document_purchase_id').val(data.id);
                $('#image_purchase_id').val(data.id);
                $('#year').val(data.year);
                $('#brand').val(data.brand).trigger("change");
                setTimeout(() => { $('#model').val(data.model).trigger("change"); }, 6000);
                $('#km').val(data.km);
                $('#name').val(data.name);
                $('#lastname').val(data.lastname);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                $('#province').val(data.province);

                if (data.status_trafic == 'Alta')
                    $('#high').attr('checked', true)
                else if (data.status_trafic == 'Baja definitiva')
                    $('#low').attr('checked', true)

     
                if (data.motocycle_state == "Golpe Delantero")
                    $('#g_del').attr('checked', true)
                else if (data.motocycle_state == "Golpe Trasero")
                    $('#g_tras').attr('checked', true)
                else if (data.motocycle_state == "Avería Eléctrica")
                    $('#av_elec').attr('checked', true)
                else if (data.motocycle_state == "Avería Mecánica")
                    $('#av_mec').attr('checked', true)
                else if (data.motocycle_state == "Vieja o Abandonada")
                    $('#old').attr('checked', true)

                $('#price_min').val(data.price_min);
                $('#observations').val(data.observations);

                
                if (data.data_serialize !== '') {
                    var response = JSON.parse(data.data_serialize);
                    
                    setTimeout(function () {
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

                                if (response[i].name == 'dLQrpaV2') {
                                    $('#sale_amount').val(response[i].value);
                                }
                            }
                        }
                    }, 3000);
                }

                $('#form_display_complement').html(data.form_display);


                // Datos Purchase Management
                $('#file_no').val(data.id);
                $('#current_year').val(data.current_year);
                $('#collection_contract_date').val(data.collection_contract_date);
                if (data.documents_attached == 1)
                    $('#documents_attached').attr('checked', true)
                if (data.non_existence_document == 1)
                    $('#non_existence_document').attr('checked', true)
                if (data.vehicle_delivers == 'Titular')
                    $('#incumbent').attr('checked', true)
                else if (data.vehicle_delivers == 'Propietario')
                    $('#owner').attr('checked', true)
                else if (data.vehicle_delivers == 'Representante')
                    $('#representative').attr('checked', true)
                $('#firts_name').val(data.firts_name);
                $('#firts_surname').val(data.firts_surname);
                $('#second_surtname').val(data.second_surtname);
                $('#dni').val(data.dni);
                $('#birthdate').val(data.birthdate);
                $('#phone_management').val(data.phone_management);
                $('#email_management').val(data.email_management);
                $('#street').val(data.street);
                $('#nro_street').val(data.nro_street);
                $('#stairs').val(data.stairs);
                $('#floor').val(data.floor);
                $('#letter').val(data.letter);
                $('#municipality').val(data.municipality);
                $('#postal_code').val(data.postal_code);
                $('#province_management').val(data.province_management);
                $('#iban').val(data.iban);
                
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
                if (data.fuel == 'Gasolina')
                    $('#gasoline').attr('checked', true)
                else if (data.fuel == 'Gasóleo')
                    $('#diesel_oil').attr('checked', true)
                else if (data.fuel == 'Otros')
                    $('#others').attr('checked', true)
                $('#registration_number').val(data.registration_number);
                $('#registration_date').val(data.registration_date);
                $('#registration_country').val(data.registration_country);
                $('#frame_no').val(data.frame_no);
                $('#motor_no').val(data.motor_no);
                if (data.vehicle_state_trafic == 'Alta')
                    $('#high_state').attr('checked', true)
                else if (data.vehicle_state_trafic == 'Baja definitiva')
                    $('#final_discharge').attr('checked', true)
                else if (data.vehicle_state_trafic == 'Baja temporal')
                    $('#temporary_leave').attr('checked', true)
                if (data.vehicle_state == 'Siniestrado')
                    $('#sinister').attr('checked', true)
                else if (data.vehicle_state == 'Averiado')
                    $('#damaged').attr('checked', true)
                else if (data.vehicle_state == 'Abandonado')
                    $('#abandoned').attr('checked', true)
                else if (data.vehicle_state == 'Completo')
                    $('#full').attr('checked', true)
                else if (data.vehicle_state == 'Parcialmente desmontado')
                    $('#partially_disassembled').attr('checked', true)

                $('.hide').prop('hidden', true);

                var i = 0;
                $('#titleModalImage').text('');
                data.images_purchase_valuation.forEach(function (element) {
                    $('#images').append(`<div class="col-lg-4 col-md-4 col-sm-6 "><span class="fa fa-times text-danger float-right" onclick="deleteImages(${element.id})"></span>
                        <a data-toggle="modal" data-target="#modal" href="#lightbox" id="imgModal" data-slide-to="${i}"><img src="${data.link}/local/public/img_app/images_purchase/${element.name}" class="img-thumbnail mt-1 mb-3"></a>
                    </div>`);
                    

                    $(`<div class="carousel-item">
                        <img class="d-block w-100 img-fluid" src="${data.link}/local/public/img_app/images_purchase/${element.name}" alt="${i}" data-slide-to="${i}" height="200">
                    </div>`).appendTo('.carousel-inner');
                    $(`<li data-target="#lightbox" data-slide-to="${i}"></li>`).appendTo('.carousel-indicators');
                    i++;
                });
                $('#titleModalImage').text('Imagenes de la moto ' + data.model);
                $('.carousel-item').first().addClass('active');
                $('.carousel-indicators > li').first().addClass('active');
               
               
                data.documents_purchase_valuation.forEach(function (element) {
                    console.log(element)
                    $("#documents").append(` <a href="${data.link}/local/public/documents_purchase/${element.name}" target="_blank" style="margin: 15px">${element.name}</a><span class="fa fa-times text-danger float-right" style="margin-left: -15px;" onclick="deleteDocuments(${element.id})"></span>`);
                });

                if (!!data.dni_doc) { 
                    data.dni_doc.split(',').forEach(function (element) {
                        console.log(element)
                        $("#documents").append(`<a href="${data.link}/local/public/dni/${element}" target="_blank" style="margin: 15px">${element}</a>`);
                    });
                }
                if (!!data.per_circulacion) {
                    data.per_circulacion.split(',').forEach(function (element) {
                        $("#documents").append(`<a href="${data.link}/local/public/per_circulacion/${element}" target="_blank" style="margin: 15px">${element}</a>`);
                    });
                }
                if (!!data.ficha_tecnica) {
                    data.ficha_tecnica.split(',').forEach(function (element) {
                        $("#documents").append(`<a href="${data.link}/local/public/ficha_tecnica/${element}" target="_blank" style="margin: 15px">${element}</a>`);
                    });
                }
                if (!!data.other_docs) {
                    data.other_docs.split(',').forEach(function (element) {
                        $("#documents").append(`<a href="${data.link}/local/public/other_docs/${element}" target="_blank" style="margin: 15px">${element}</a>`);
                    });
                }
                $('#btn-save').val("update");

                if (data.states_id != 1) {
                    $('#divProcesosDesguace').css('display', 'block');
                    var sb2 = '';
                    data.processes.forEach(function (element) {      
                        $("#ulProcesses").append(
                            '<li class="list-group-item">' +
                            '<div class="todo-indicator bg-warning"></div>' +
                            '<div class="widget-content p-0">' +
                            '<div class="widget-content-wrapper">' +
                            '<div class="widget-content-left mr-1"></div>' +
                            '<div class="widget-content-left">' +
                            '<div class="widget-heading">' + element.name + '</div>' +
                            '</div>' +
                            '<div class="widget-content-right widget-content-actions"></div>' +
                            '<div class="widget-content-right ml-3" id="divSubProceso">' +
                            
                            
                            '<div class="badge badge-pill badge-primary">' + element.subproceso + '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</li>'
                        );
                    });
                }
                
                if (!!data.datos_del_mecanico) {
                    var response2 = JSON.parse(data.datos_del_mecanico);
                    setTimeout(function () {
                        for (i = 0; i < response2.length; i++) {

                            if ($('#' + response2[i].name + '.date').length) {

                                if (response2[i].value != '') {
                                    var dateValue = response2[i].value;
                                    var date2 = new Date(dateValue);
                                    if (dateValue.search('-') != -1) {
                                        date2.setDate(date2.getDate() + 1);
                                    }
                                    //console.log('response2[i].value: ' + response2[i].value + ' ;date2:' + date2);
                                    $('#' + response2[i].name).datepicker('setDate', date2);
                                }
                            }  else if (response2[i].name.indexOf('radio_') > -1) {

                                $("input[name=" + response2[i].name + "][value='" + response2[i].value + "']").prop("checked", true);

                            } else {

                                $('#' + response2[i].name).val(response2[i].value);
                                $('.' + response2[i].name + '').text(response2[i].value);
                            }
                        }
                    }, 3000);
                }

                $('#form_display_datos_mecanico').html(data.form_display_datos_mecanico);
 
                $('#form_display_datos_mecanico').find('select, textarea, input').each(function (index, detalle) {
                    if (index === 0) $(this).val(data.brand);
                    if (index === 1) $(this).val(data.model);
                    if (index === 2) $(this).val(data.id);
                    if (index === 3) $(this).val(data.motor_no);
                    if (index === 7) $(this).val(data.km);
                  
                    $(this).prop('disabled', true);
                });

                if (!!data.datos_internos) {
                    var response3 = JSON.parse(data.datos_internos);
                    setTimeout(function () {
                        for (i = 0; i < response3.length; i++) {

                            if ($('#' + response3[i].name + '.date').length) {

                                if (response3[i].value != '') {
                                    var dateValue = response3[i].value;
                                    var date2 = new Date(dateValue);
                                    if (dateValue.search('-') != -1) {
                                        date2.setDate(date2.getDate() + 1);
                                    }
                                    //console.log('response3[i].value: ' + response3[i].value + ' ;date2:' + date2);
                                    $('#' + response3[i].name).datepicker('setDate', date2);
                                }
                            }  else if (response3[i].name.indexOf('radio_') > -1) {

                                $("input[name=" + response3[i].name + "][value='" + response3[i].value + "']").prop("checked", true);

                            } else {

                                $('#' + response3[i].name).val(response3[i].value);
                                $('.' + response3[i].name + '').text(response3[i].value);
                            }
                        }
                    }, 3000);
                }
                $('#form_display_datos_internos').html(data.form_display_datos_internos);

                if(!!data.document_generate){
                    $('#divSendDocument').css('display', 'block');
                    $("#button_send_document").attr("href", "send_document_viafirma/"+data.id);
                }

                if (data.documents_send) {
                    $('#divDocumentsViafirma').css('display', 'block');
                    let sb = '<tbody><tr><th>' + data.get_status_document.status + '</th>';
                    let sb2 = '';
                    if (data.get_status_document.status != 'ERROR') {
                        sb2 = '<a class="btn btn-info" href="' + data.url_label + '" target="_blank">Descargar etiquetas</a>';                    
                        sb += '<th><a href="' + data.download_signed.link + '" target="_blank">Descargar Documento</a></th></tr></tbody>';
                    }
                    else {
                    sb += '<th>ERROR</th></tr></tbody>';
                }
                    $('#buttonLabelss').html(sb2);
                    $("#tableDocumentsViafirma").append(sb);
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

        //Peticion para traer las imagenes


    }

    $("#btn-save").click(function (e) {

        e.preventDefault();
        
        var data = $('#form_display_complement').find('select, textarea, input').serializeArray(),
            data3 = $(' #form_display_datos_internos').find('select, textarea, input').serializeArray(),
            data2 = $(' #form_display_datos_mecanico').find('select, textarea, input').serializeArray();
        var dataArray = [], dataMecanicArray = [], dataInternArray = []; ;

        for (i = 0; i < data.length; i++) {
            if ($('#' + data[i].name + '.date').length) {
                var today = new Date(data[i].value);
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                today = yyyy + '-' + mm + '-' + dd;

                dataArray.push({
                    name: data[i].name,
                    value: today
                });
            } else {
                dataArray.push({
                    name: data[i].name,
                    value: data[i].value
                });
            }
        }

        for (i = 0; i < data2.length; i++) {
            if ($('#' + data2[i].name + '.date').length) {
                var today = new Date(data2[i].value);
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                today = yyyy + '-' + mm + '-' + dd;

                dataMecanicArray.push({
                    name: data2[i].name,
                    value: today
                });
            } else {
                dataMecanicArray.push({
                    name: data2[i].name,
                    value: data2[i].value
                });
            }
        }
        // esto es para verificar si los datos del formulario estan llenos, para que se pueda enviar el correo al mecanico
        var inputLenght = 0;
        $.each(dataMecanicArray, function (i, v) {
            
            if (i === 4 && v.value != '')
                inputLenght++;
            if (i === 5 && v.value != '')
                inputLenght++;
            if (i === 6 && v.value != '')
                inputLenght++;
            if (i === 8 && v.value != '')
                inputLenght++;
            if (i === 9 && v.value != '')
                inputLenght++;           
        });
        
        for (i = 0; i < data3.length; i++) {
            if ($('#' + data3[i].name + '.date').length) {
                var today = new Date(data3[i].value);
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                today = yyyy + '-' + mm + '-' + dd;

                dataInternArray.push({
                    name: data3[i].name,
                    value: today
                });
            } else {
                dataInternArray.push({
                    name: data3[i].name,
                    value: data3[i].value
                });
            }
        }
        
        var status_trafic = '';
        if ($('#high').is(':checked'))
            status_trafic = 'Alta';
        else if ($('#low').is(':checked'))
            status_trafic = 'Baja definitiva';
        
         var motocycle_state = '';
        if ($('#g_del').is(':checked'))
            motocycle_state = 'Golpe Delantero';
        else if ($('#g_tras').is(':checked'))
            motocycle_state = 'Golpe Trasero';
        else if ($('#av_elec').is(':checked'))
            motocycle_state = 'Avería Eléctrica';
        else if ($('#av_mec').is(':checked'))
            motocycle_state = 'Avería Mecánica';
        else if ($('#old').is(':checked'))
            motocycle_state = 'Vieja o Abandonada';

        var vehicle_delivers = '';
        if ($('#incumbent').is(':checked'))
            vehicle_delivers = 'Titular';
        else if ($('#owner').is(':checked'))
            vehicle_delivers = 'Propietario';
        else if ($('#representative').is(':checked'))
            vehicle_delivers = 'Representante';

        var fuel = '';
        if ($('#gasoline').is(':checked'))
            fuel = 'Gasolina';
        else if ($('#diesel_oil').is(':checked'))
            fuel = 'Gasóleo';
        else if ($('#others').is(':checked'))
            fuel = 'Otros';

        var vehicle_state_trafic = '';
        if ($('#high').is(':checked'))
            vehicle_state_trafic = 'Alta';
        else if ($('#final_discharge').is(':checked'))
            vehicle_state_trafic = 'Baja definitiva';
        else if ($('#temporary_leave').is(':checked'))
            vehicle_state_trafic = 'Baja temporal';

        var vehicle_state = '';
        if ($('#sinister').is(':checked'))
            vehicle_state = 'Siniestrado';
        else if ($('#damaged').is(':checked'))
            vehicle_state = 'Averiado';
        else if ($('#abandoned').is(':checked'))
            vehicle_state = 'Abandonado';
        else if ($('#full').is(':checked'))
            vehicle_state = 'Completo';
        else if ($('#partially_disassembled').is(':checked'))
            vehicle_state = 'Parcialmente desmontado';

        var dataSerialize = JSON.stringify(dataArray, null, 2), dataSerialize2 = JSON.stringify(dataMecanicArray, null, 2), dataSerialize3 = JSON.stringify(dataInternArray, null, 2) ;
        var formData = {
            purchase_id: $('#purchase_id').val(),
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
            motocycle_state:motocycle_state,
            data_serialize: dataSerialize.replace(/\s+/g, " "),
            file_no: $('#file_no').val(),
            current_year: $('#current_year').val(),
            collection_contract_date: $('#collection_contract_date').val(),
            documents_attached: $('#documents_attached').val(),
            non_existence_document: $('#non_existence_document').val(),
            vehicle_delivers: vehicle_delivers,
            fuel: fuel,
            vehicle_state_trafic: vehicle_state_trafic,
            vehicle_state: vehicle_state,
            firts_name: $('#firts_name').val(),
            firts_surname: $('#firts_surname').val(),
            second_surtname: $('#second_surtname').val(),
            dni: $('#dni').val(),
            birthdate: $('#birthdate').val(),
            phone_management: $('#phone_management').val(),
            email_management: $('#email_management').val(),
            street: $('#street').val(),
            nro_street: $('#nro_street').val(),
            stairs: $('#stairs').val(),
            floor: $('#floor').val(),
            letter: $('#letter').val(),
            municipality: $('#municipality').val(),
            postal_code: $('#postal_code').val(),
            province_management: $('#province_management').val(),
            iban: $('#iban').val(),
            sale_amount: $('#sale_amount').val(),
            name_representantive: $('#name_representantive').val(),
            firts_surname_representative: $('#firts_surname_representative').val(),
            second_surtname_representantive: $('#second_surtname_representantive').val(),
            dni_representative: $('#dni_representative').val(),
            birthdate_representative: $('#birthdate_representative').val(),
            phone_representantive: $('#phone_representantive').val(),
            email_representative: $('#email_representative').val(),
            representation_concept: $('#representation_concept').val(),
            brand_management: $('#brand_management').val(),
            model_management: $('#model_management').val(),
            version: $('#version').val(),
            type: $('#type').val(),
            kilometres: $('#kilometres').val(),
            color: $('#color').val(),
            registration_number: $('#registration_number').val(),
            registration_date: $('#registration_date').val(),
            registration_country: $('#registration_country').val(),
            frame_no: $('#frame_no').val(),
            motor_no: $('#motor_no').val(),            
            datos_del_mecanico: dataSerialize2.replace(/\s+/g, " "),
            datos_internos: dataSerialize3.replace(/\s+/g, " "),
            sendMailMecanico: inputLenght == '5' ? 1 : 0
            
        }
        preloader('show');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                if (data.code == 200) {
                    preloader('hide', data.message, 'success');
                }
            },
            error: function (data) {
                console.log('Error:', data);

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
            if ($(this).attr('id') == 'file_no') {
                $(this).prop('disabled', true);
            } else {
                if ($(this).prop('disabled')) $(this).prop('disabled', false); else $(this).prop('disabled', true);
            }
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
    ///////////////////////////////////////////////
    $('#editTabFicha9').click(function (e) {
        e.preventDefault();
        $('#tab-ficha-9').find('select, textarea, input').each(function () {        
            if ($(this).attr('id') == 'V6RrZFvV') {
                $(this).prop('disabled', true);
            } else {
                if ($(this).prop('disabled')) $(this).prop('disabled', false); else $(this).prop('disabled', true);
            }
        });
    });

    ///////////////////////////////////////////////
    $('#editTabFicha10').click(function (e) {
        e.preventDefault();
        $('#tab-ficha-10').find('select, textarea, input').each(function () {
            if ($(this).prop('disabled')) $(this).prop('disabled', false); else $(this).prop('disabled', true);
        });
    });

    $("#process").change(function (e){
        $.ajax({
            type: "GET",
            url: url_process + '/' + $("#process").val(),
            success: function (data) {
                
                $('#subprocess').empty().append('<option disabled selected>Seleccione</option>');
                data.data.forEach(function (element){
                    
                    $('#subprocess').append($('<option>', {
                        value: element.id,
                        text: element.name
                    }));
                });
                                    },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $("#btn-applySubProcess").click(function (e) {
        var formData = {
            purchase_id: $('#purchase_id').val(),
            processes_id: $('#process').val(),
            subprocesses_id: $('#subprocess').val() 
        };
        preloader('show');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: 'POST',
            url: url_index + '/applyProcesses',
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.code == 200) {
                    preloader('hide', data.message, 'success');
                }
               
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });




});

Dropzone.options.myDropzone = {
    autoProcessQueue: true,
    uploadMultiple: true,
    maxFilezise: 10,
    // maxFiles: 1,
    acceptedFiles: "application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,image/jpeg,image/png,image/gif",

    init: function () {
        myDropzone = this;

        this.on("addedfile", function (file) {
        });

        this.on("complete", function (file) {
            var formData = {
                id: $('#image_purchase_id').val()
            };
            preloader('show');
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                type: 'POST',
                data: formData,
                dataType: 'json',
                url: 'findDocuments',
                success: function (data) {
                    if (data.code == 200) {
                        preloader('hide', data.message, 'success');
                        $("#documents").html('');
                        data.documents_purchase_valuation.forEach(function (element) {
                            $("#documents").append(`<a href="${data.link}/local/public/documents_purchase/${element.name}" target="_blank" style="margin: 15px">${element.name}</a><span class="fa fa-times text-danger float-right" style="margin-left: -15px;" onclick="deleteDocuments(${element.id})"></span>`);
                        });

                        if (!!data.dni_doc) { 
                            data.dni_doc.split(',').forEach(function (element) {
                                console.log(element)
                                $("#documents").append(`<a href="${data.link}/local/public/dni/${element}" target="_blank" style="margin: 15px">${element}</a>`);
                            });
                        }
                        if (!!data.per_circulacion) {
                            data.per_circulacion.split(',').forEach(function (element) {
                                $("#documents").append(`<a href="${data.link}/local/public/per_circulacion/${element}" target="_blank" style="margin: 15px">${element}</a>`);
                            });
                        }
                        if (!!data.ficha_tecnica) {
                            data.ficha_tecnica.split(',').forEach(function (element) {
                                $("#documents").append(`<a href="${data.link}/local/public/ficha_tecnica/${element}" target="_blank" style="margin: 15px">${element}</a>`);
                            });
                        }
                        if (!!data.other_docs) {
                            data.other_docs.split(',').forEach(function (element) {
                                $("#documents").append(`<a href="${data.link}/local/public/other_docs/${element}" target="_blank" style="margin: 15px">${element}</a>`);
                            });
                        }
                    }
                   
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        this.on("success",
            myDropzone.processQueue.bind(myDropzone)
        );
    }
};
 
Dropzone.options.imageDropzone = {
    autoProcessQueue: true,
    uploadMultiple: true,
    maxFilezise: 10,
    acceptedFiles: "image/jpeg,image/png,image/gif",

    init: function () {
        var preview = $('#images');
        imageDropzone = this;

        this.on("addedfile", function (file) {
        });
       
        this.on("complete", function (file) {
            var formData = {
                id: $('#image_purchase_id').val()
            };
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                type: 'POST',
                data: formData,
                dataType: 'json',
                url: 'findImages',
                success: function (data) {
                    if (data.code == 200) {
                        preloader('hide', data.message, 'success');
                        $('#images').html('');
                        var i = 0;
                        var response = '';
                        data.images_purchase_valuation.forEach(function (element) {
                            response += `<div class="col-lg-4 col-md-4 col-sm-6 "><span class="fa fa-times text-danger float-right" onclick="deleteImages(${element.id},'${element.name}')"></span>
                            <a data-toggle="modal" data-target="#modal" href="#lightbox" data-slide-to="${i}"><img src="${data.link}/local/public/img_app/images_purchase/${element.name}" class="img-thumbnail mt-1 mb-3"></a>
                        </div>`;
    
                            $(`<div class="carousel-item">
                            <img class="d-block w-100 img-fluid" src="${data.link}/local/public/img_app/images_purchase/${element.name}" alt="${i}" height="200">
                        </div>`).appendTo('.carousel-inner');
                            $(`<li data-target="#lightbox" data-slide-to="${i}"></li>`).appendTo('.carousel-indicators');
                            i++;
                        });
                        $('#images').append(response);
                    }
                
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        this.on("success",
            imageDropzone.processQueue.bind(imageDropzone)
        );
    }
};
 


function deleteImages(id) {     

    Swal.fire({
        title:  "Estas seguro?",
        text: "Quieres volver?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, hazlo!",
        cancelButtonText: "No, cancelar!",
        }).then(result => {
        if (result.dismiss) {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: 'Operación cancelada :)',
                showConfirmButton: !1,
                timer: 1500
            });
            //swal("Cancelled", "Data is safe :)", "error");
        }
        if (result.value) {
            var formData = {
                id: id
            };
            preloader('show');
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                type: 'POST',
                data: formData,
                dataType: 'json',
                url: 'deleteImages',
                success: function (data) {
                    if (data.code == 200) {
                        preloader('hide', data.message, 'success');
                        $('#images').html('');
                        var i = 0;
                        var response = '';
                        data.images_purchase_valuation.forEach(function (element) {
                            response += `<div class="col-lg-4 col-md-4 col-sm-6 "><span class="fa fa-times text-danger float-right" onclick="deleteImages(${id},'${element.name}')"></span>
                                <a data-toggle="modal" data-target="#modal" href="#lightbox" data-slide-to="${i}"><img src="${data.link}/local/public/img_app/images_purchase/${element.name}" class="img-thumbnail mt-1 mb-3"></a>
                            </div>`;
        
                            $(`<div class="carousel-item">
                                <img class="d-block w-100 img-fluid" src="${data.link}/local/public/img_app/images_purchase/${element.name}" alt="${i}" height="200">
                            </div>`).appendTo('.carousel-inner');
                            $(`<li data-target="#lightbox" data-slide-to="${i}"></li>`).appendTo('.carousel-indicators');        
                            i++;
                        });
                        $('#images').append(response);
                    }
                   
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

}

function deleteDocuments(id) {     

    Swal.fire({
        title:  "Estas seguro?",
        text: "Quieres volver?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, hazlo!",
        cancelButtonText: "No, cancelar!",
        }).then(result => {
        if (result.dismiss) {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: 'Operación cancelada :)',
                showConfirmButton: !1,
                timer: 1500
            });
            //swal("Cancelled", "Data is safe :)", "error");
        }
        if (result.value) {
            var formData = {
                id: id
            };
            preloader('show');
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                type: 'POST',
                data: formData,
                dataType: 'json',
                url: 'deleteDocuments',
                success: function (data) {
                    if (data.code == 200) {
                        preloader('hide', data.message, 'success');
                        $("#documents").html('');
                        var response = '';
                        data.documents_purchase_valuation.forEach(function (element) {
                            console.log(element)
                            response +=  `<a href="${data.link}/local/public/documents_purchase/${element.name}" target="_blank" style="margin: 15px">${element.name}</a><span class="fa fa-times text-danger float-right" style="margin-left: -15px;" onclick="deleteDocuments(${element.id})"></span>`;
                        });
                        $("#documents").append(response);
                        if (!!data.dni_doc) { 
                            data.dni_doc.split(',').forEach(function (element) {
                                console.log(element)
                                $("#documents").append(`<a href="${data.link}/local/public/dni/${element}" target="_blank" style="margin: 15px">${element}</a>`);
                            });
                        }
                        if (!!data.per_circulacion) {
                            data.per_circulacion.split(',').forEach(function (element) {
                                $("#documents").append(`<a href="${data.link}/local/public/per_circulacion/${element}" target="_blank" style="margin: 15px">${element}</a>`);
                            });
                        }
                        if (!!data.ficha_tecnica) {
                            data.ficha_tecnica.split(',').forEach(function (element) {
                                $("#documents").append(`<a href="${data.link}/local/public/ficha_tecnica/${element}" target="_blank" style="margin: 15px">${element}</a>`);
                            });
                        }
                        if (!!data.other_docs) {
                            data.other_docs.split(',').forEach(function (element) {
                                $("#documents").append(`<a href="${data.link}/local/public/other_docs/${element}" target="_blank" style="margin: 15px">${element}</a>`);
                            });
                        }
                    }
                   
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

}
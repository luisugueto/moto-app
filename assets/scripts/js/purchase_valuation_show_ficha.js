$(document).ready(function () {
    var url = $('#url').val();
    var url_process = $('#url_process').val();
    var url_index = $('#url_index').val();

    var action = sessionStorage.getItem('action');
    var inputBloq = 1;

    let dataGlobal = null;

    if (action == 1) {
        sessionStorage.clear();
    }
    if (action == 2) {
        var id = sessionStorage.getItem('id_purchase');

        $.ajax({
            type: "GET",
            url: 'ficha_de_la_moto/' + id,
            dataType: 'json',
            success: function (data) {
                $('#formFichaTabs').find('select, textarea, input').each(function () {
                    $(this).prop('disabled', true);
                });

                dataGlobal = data;
                $("#exist_model_brand").val(data.exist_model_brand);

                // if(data.exist_model_brand == 0){  // 0 IS TEXT, 1 IS SELECT
                    
                    // $("#ver").click();
                    // verify_model_brand = 1;
                    $('#brand_text').val(data.brand);
                    $('#model_text').val(data.model);
                    $(".ocultar").show();
                    $(".mostrar").hide();
                // }else{
                //     verify_model_brand = 0;
                //     $("#ver").click();
                // }

                $('#purchase_valuation_id').val(data.id);
                $('#purchase_id').val(data.id);
                $('#document_purchase_id').val(data.id);
                $('#image_purchase_id').val(data.id);
                $('#certificate_purchase_id').val(data.id);
                $('#documents_mail_purchase_id').val(data.id); 
                $("#year").val(data.year).trigger('change');
                $('#brand').val(data.brand).trigger("change");
                $('#model').val(data.model).trigger("change");
               
                if(sessionStorage.getItem('modelLoad')){
                    setTimeout(() => { $('#model').val(data.model).trigger("change"); }, 4500);
                }

                $("#brand_text").val(data.brand);
                $("#model_text").val(data.model);
                $('#km').val(data.km);
                $('#created_at').val(data.created_at);
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
                                    // $('#dLQrpaV2').val(response[i].value);
                                    $('#sale_amount').val(response[i].value);

                                    if (response[i].value > 1) {
                                        let b4 = '<a class="btn btn-success" href="rebu/' + data.id + '">REBU</a>';
                                        $('#buttonREBU').html(b4);
                                    }
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
                    $('#yes_documents_attached').attr('checked', true)
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
                $('#weight').val(data.weight);
                $('#registration_date').val(data.registration_date);
                $('#registration_country').val(data.registration_country);
                $('#frame_no').val(data.frame_no);
                $('#motor_no').val(data.motor_no);
                $('#type_motor').val(data.type_motor);
                $('#approval_certificate').val(data.approval_certificate);
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
                    $("#documents").append(` <a href="${data.link}/local/public/documents_purchase/${element.name}" target="_blank" style="margin: 15px">${element.name}</a><span class="fa fa-times text-danger float-right" style="margin-left: -15px;" onclick="deleteDocuments(${element.id})"></span>`);
                });

                data.certficates_purchase_valuation.forEach(function (element) {
                    $("#certificates").append(`<a href="${data.link}/local/public/certificates/${element.name}" target="_blank" style="margin: 15px">${element.name}</a><span class="fa fa-times text-danger float-right ml-3 mt-2"  onclick="deleteDocumentsCertificated(${element.id})"></span>`);

                });

                if(data.documents_mail_purchase_valuation.length)
                    $("#buttonSendDocumentsEmail").css('display', 'block');

                data.documents_mail_purchase_valuation.forEach(function (element) {
                    $("#documents_mail").append(`<a href="${data.link}/local/public/documents_mail/${element.name}" target="_blank" style="margin: 15px">${element.name}</a><div class="custom-control custom-checkbox ml-2 mt-2"><input type="checkbox" name="apply[]" id="apply_${element.id}" value="${element.id}" class="custom-control-input" checked><label class="custom-control-label" for="apply_${element.id}"></label></div><span class="fa fa-times text-danger float-right ml-3 mt-2"  onclick="deleteDocumentsMail(${element.id})"></span>`);
                });
                // <span class="fa fa-times text-danger float-right" style="margin-left: -15px;" onclick="deleteCertificate(${element.id})"></span>
                

                if (!!data.dni_doc) {
                    data.dni_doc.split(',').forEach(function (element) {
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
                        // console.log(element)
                        if (element.name == 'Bastidor' && element.subproceso == 'Guardar Bastidor') {
                            $('#checkChasisDiv').css('display', 'none');
                        }
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
                            '<div class="widget-content-right ml-3" id="divSubProceso">' + element.date +

                            '<div class="badge badge-pill badge-primary" style="margin-left: 10px;">' + element.subproceso + '</div>' +
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
                    if (index === 3) $(this).val(data.type_motor);
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

                if(!!data.documents_send){
                    $('#divSendDocument').css('display', 'block');
                    $("#button_document_destruction").attr("href", "send_document_destruction/"+data.id);
                    $("#button_destruction_deceased").attr("href", "send_destruction_deceased/"+data.id);
                    $("#button_possible_sale").attr("href", "send_possible_sale/"+data.id);
                    $("#button_sale_deceased").attr("href", "send_sale_deceased/"+data.id);

                    let b3 = '';
                    b3 = '<a class="btn btn-warning" href="send_mail_document/' + data.id + '">Enviar Documentos por Correo</a>';
                    $('#buttonSendMail').html(b3);
                }

                if (data.status_ficha == 2) {
                    let sb2 = '';
                    sb2 = '<a class="btn btn-info" href="' + data.url_label + '" target="_blank">Descargar etiquetas</a>';
                    $('#buttonLabelss').html(sb2);
                }

                if (data.check_chasis == 'Hierro')
                    $('#iron').attr('checked', true)
                else if (data.check_chasis == 'Aluminio')
                    $('#aluminium').attr('checked', true)
                else if (data.check_chasis == 'Camion')
                    $('#truck').attr('checked', true)

                if (!!data.documents_send) {
                    $('#divDocumentsViafirma').css('display', 'block');

                    // DOCUMENTS DESTRUCTION
                    let dd = '<tbody>';
                    data.documentsDestruction.forEach(function (element) {
                        if(element.get_status_document.status == 'WAITING'){
                            dd += '<tr><th>'+element.name_document+'</th>';
                            dd += '<th>'+element.code+'</th>';
                            dd += '<th>Esperando firma</th>';
                            dd += '<th>'+element.date+'</th>';
                            dd += '<th></th></tr>';
                        }
                        else if(element.get_status_document.status == 'ERROR'){
                            dd += '<tr><th>'+element.name_document+'</th>';
                            dd += '<th>'+element.code+'</th>';
                            dd += '<th>Error</th>';
                            dd += '<th>'+element.date+'</th>';
                            dd += '<th></th></tr>';
                        }
                        else if(element.get_status_document.status == 'WAITING_CHECK'){
                            dd += '<tr><th>'+element.name_document+'</th>';
                            dd += '<th>'+element.code+'</th>';
                            dd += '<th>Esperando aprobación</th>';
                            dd += '<th>'+element.date+'</th>';
                            dd += '<th><a href="'+element.approval_document + '" target="_blank">Aprobar Documento</a></th></tr>';
                        }
                        else if(element.get_status_document.status == 'REJECTED'){
                            dd += '<tr><th>'+element.name_document+'</th>';
                            dd += '<th>'+element.code+'</th>';
                            dd += '<th>Rechazado</th>';
                            dd += '<th>'+element.date+'</th>';
                            dd += '<th></th></tr>';
                        }
                        else if(element.get_status_document.status == 'RESPONSED'){
                            dd += '<tr><th>'+element.name_document+'</th>';
                            dd += '<th>'+element.code+'</th>';
                            dd += '<th>Aprobado</th>';
                            dd += '<th>'+element.date+'</th>';
                            dd += '<th><a href="' + element.download_signed.link + '" target="_blank">Descargar Documento</a></th></tr>';
                        }
                    });
                    dd += '</tbody>';
                    $("#tableDocumentsDestruction").append(dd);

                    // DOCUMENTS DESTRUCTION DECEASED
                    let ddd = '<tbody>';
                    data.documentsDestructionDeceased.forEach(function (element) {
                        if(element.get_status_document.status == 'WAITING'){
                            ddd += '<tr><th>'+element.name_document+'</th>';
                            ddd += '<th>'+element.code+'</th>';
                            ddd += '<th>Esperando firma</th>';
                            ddd += '<th>'+element.date+'</th>';
                            ddd += '<th></th></tr>';
                        }
                        else if(element.get_status_document.status == 'ERROR'){
                            ddd += '<tr><th>'+element.name_document+'</th>';
                            ddd += '<th>'+element.code+'</th>';
                            ddd += '<th>Error</th>';
                            ddd += '<th>'+element.date+'</th>';
                            ddd += '<th></th></tr>';
                        }
                        else if(element.get_status_document.status == 'WAITING_CHECK'){
                            ddd += '<tr><th>'+element.name_document+'</th>';
                            ddd += '<th>'+element.code+'</th>';
                            ddd += '<th>Esperando aprobación</th>';
                            ddd += '<th>'+element.date+'</th>';
                            ddd += '<th><a href="'+element.approval_document + '" target="_blank">Aprobar Documento</a></th></tr>';
                        }
                        else if(element.get_status_document.status == 'REJECTED'){
                            ddd += '<tr><th>'+element.name_document+'</th>';
                            ddd += '<th>'+element.code+'</th>';
                            ddd += '<th>Rechazado</th>';
                            ddd += '<th>'+element.date+'</th>';
                            ddd += '<th></th></tr>';
                        }
                        else if(element.get_status_document.status == 'RESPONSED'){
                            ddd += '<tr><th>'+element.name_document+'</th>';
                            ddd += '<th>'+element.code+'</th>';
                            ddd += '<th>Aprobado</th>';
                            ddd += '<th>'+element.date+'</th>';
                            ddd += '<th><a href="' + element.download_signed.link + '" target="_blank">Descargar Documento</a></th></tr>';
                        }
                    });
                    ddd += '</tbody>';
                    $("#tableDestructionDeceased").append(ddd);

                    // DOCUMENTS POSSIBLE SALE
                    let ps = '<tbody>';
                    data.documentsPossibleSale.forEach(function (element) {
                        if(element.get_status_document.status == 'WAITING'){
                            ps += '<tr><th>'+element.name_document+'</th>';
                            ps += '<th>'+element.code+'</th>';
                            ps += '<th>Esperando firma</th>';
                            ps += '<th>'+element.date+'</th>';
                            ps += '<th></th></tr>';
                        }
                        else if(element.get_status_document.status == 'ERROR'){
                            ps += '<tr><th>'+element.name_document+'</th>';
                            ps += '<th>'+element.code+'</th>';
                            ps += '<th>Error</th>';
                            ps += '<th>'+element.date+'</th>';
                            ps += '<th></th></tr>';
                        }
                        else if(element.get_status_document.status == 'WAITING_CHECK'){
                            ps += '<tr><th>'+element.name_document+'</th>';
                            ps += '<th>'+element.code+'</th>';
                            ps += '<th>Esperando aprobación</th>';
                            ps += '<th>'+element.date+'</th>';
                            ps += '<th><a href="'+element.approval_document + '" target="_blank">Aprobar Documento</a></th></tr>';
                        }
                        else if(element.get_status_document.status == 'REJECTED'){
                            ps += '<tr><th>'+element.name_document+'</th>';
                            ps += '<th>'+element.code+'</th>';
                            ps += '<th>Rechazado</th>';
                            ps += '<th>'+element.date+'</th>';
                            ps += '<th></th></tr>';
                        }
                        else if(element.get_status_document.status == 'RESPONSED'){
                            ps += '<tr><th>'+element.name_document+'</th>';
                            ps += '<th>'+element.code+'</th>';
                            ps += '<th>Aprobado</th>';
                            ps += '<th>'+element.date+'</th>';
                            ps += '<th><a href="' + element.download_signed.link + '" target="_blank">Descargar Documento</a></th></tr>';
                        }
                    });
                    ps += '</tbody>';
                    $("#tablePossibleSale").append(ps);

                    // DOCUMENTS POSSIBLE SALE DECEASED
                    let psd = '<tbody>';
                    data.documentsPossibleSaleDeceased.forEach(function (element) {
                        if(element.get_status_document.status == 'WAITING'){
                            psd += '<tr><th>'+element.name_document+'</th>';
                            psd += '<th>'+element.code+'</th>';
                            psd += '<th>Esperando firma</th>';
                            psd += '<th>'+element.date+'</th>';
                            psd += '<th></th></tr>';
                        }
                        else if(element.get_status_document.status == 'ERROR'){
                            psd += '<tr><th>'+element.name_document+'</th>';
                            psd += '<th>'+element.code+'</th>';
                            psd += '<th>Error</th>';
                            psd += '<th>'+element.date+'</th>';
                            psd += '<th></th></tr>';
                        }
                        else if(element.get_status_document.status == 'WAITING_CHECK'){
                            psd += '<tr><th>'+element.name_document+'</th>';
                            psd += '<th>'+element.code+'</th>';
                            psd += '<th>Esperando aprobación</th>';
                            psd += '<th>'+element.date+'</th>';
                            psd += '<th><a href="'+element.approval_document + '" target="_blank">Aprobar Documento</a></th></tr>';
                        }
                        else if(element.get_status_document.status == 'REJECTED'){
                            psd += '<tr><th>'+element.name_document+'</th>';
                            psd += '<th>'+element.code+'</th>';
                            psd += '<th>Rechazado</th>';
                            psd += '<th>'+element.date+'</th>';
                            psd += '<th></th></tr>';
                        }
                        else if(element.get_status_document.status == 'RESPONSED'){
                            psd += '<tr><th>'+element.name_document+'</th>';
                            psd += '<th>'+element.code+'</th>';
                            psd += '<th>Aprobado</th>';
                            psd += '<th>'+element.date+'</th>';
                            psd += '<th><a href="' + element.download_signed.link + '" target="_blank">Descargar Documento</a></th></tr>';
                        }
                    });
                    psd += '</tbody>';
                    $("#tableSaleDeceased").append(psd);

                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });



        //PARA VALIDACIONES DE CAMPO IBAN
        $(".input-iban").keyup(function () { //Keylistener HTML: <input type="text" class="input-iban">
            val = jQuery(this).val()
                .replace(new RegExp(" ", 'g'), ''); //remove spaces

            val_chars = val.split(""); //split chars
            val = ""; //new value

            count = 1;
            for(index in val_chars) {
                if(count <= 2) { //first 2 alphabetical chars
                    val_chars[index] = val_chars[index].toUpperCase(); //uppercase, example: dE => DE
                    if (val_chars[index].search(/^[A-Z]+$/) == -1) { //search für A-Z
                        break; //if not found (error)
                    }
                }else {
                    if (val_chars[index].search(/^[0-9]+$/) == -1) { //search for 0-9
                        continue; //if not found (error)
                    }
                }
                if(val.length < 29){
                    val += val_chars[index]; // add char to return Value
                }
                if(count%4 == 0 && val.length < 29) { //Avery 4 chars an space
                    val += " ";
                }

                count++;
            }
            jQuery(this).val(val); //set to Textfield value
        });

    }

    $("#btn-save").click(function (e) {

        e.preventDefault();

        $('#form_display_datos_mecanico').find('select, textarea, input').each(function (index, detalle) {
            $(this).prop('disabled', false);
            $(this).prop('readonly', true);
        });

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
            dataMecanicArray.push({
                name: data2[i].name,
                value: data2[i].value
            });
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
            if (i === 10 && v.value != '')
                inputLenght++;
        });

        for (i = 0; i < data3.length; i++) {             
            dataInternArray.push({
                name: data3[i].name,
                value: data3[i].value
            });        
        }

        var documents_attached = '', non_existence_document = '';
        var radioValue = $("input[name='documents_attached']:checked").val();
        if(radioValue == 1){
            documents_attached = 1;
            non_existence_document = 0;
        }
        if(radioValue == 2){
            non_existence_document = 1;
            documents_attached = 0;
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


        let brandform = '';
        let modelform = '';

        if(verify_model_brand == 0){
            brandform = $("#brand_text").val();
            modelform = $("#model_text").val();
        }else{
            brandform = $("#brand").val();
            modelform = $("#model").val();
        }

        var check_chasis = '';
        if ($('#iron').is(':checked'))
            check_chasis = 'Hierro';
        else if ($('#aluminium').is(':checked'))
            check_chasis = 'Aluminio';
        else if ($('#truck').is(':checked'))
            check_chasis = 'Camion';

        var dataSerialize = JSON.stringify(dataArray, null, 2),
            dataSerialize2 = JSON.stringify(dataMecanicArray, null, 2),
            dataSerialize3 = JSON.stringify(dataInternArray, null, 2);
        
        var formData = {
            purchase_id: $('#purchase_id').val(),
            brand: brandform,
            model: modelform,
            exist_model_brand: $("#exist_model_brand").val(),
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
            documents_attached: documents_attached,
            non_existence_document: non_existence_document,
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
            brand_management: $("#brand").val(),
            model_management: $("#model").val(),
            version: $('#version').val(),
            type: $('#type').val(),
            kilometres: $('#kilometres').val(),
            color: $('#color').val(),
            registration_number: $('#registration_number').val(),
            registration_date: $('#registration_date').val(),
            registration_country: $('#registration_country').val(),
            frame_no: $('#frame_no').val(),
            weight: $('#weight').val(),
            motor_no: $('#motor_no').val(),
            type_motor: $('#type_motor').val(),
            approval_certificate: $('#approval_certificate').val(),
            datos_del_mecanico: dataSerialize2.replace(/\s+/g, " "),
            datos_internos: dataSerialize3.replace(/\s+/g, " "),
            sendMailMecanico: inputLenght == '6' ? 1 : 0,
            check_chasis: check_chasis

        }

        if(inputBloq == 1){
            delete formData.model;
            delete formData.brand;
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
        
        if(dataGlobal.exist_model_brand == 0){  // 0 IS TEXT, 1 IS SELECT
            verify_model_brand = 1;
            $('#brand_text').val(dataGlobal.brand);
            $('#model_text').val(dataGlobal.model);
            $("#ver").click();

         }else{
            verify_model_brand = 0;
            $('#model').val(dataGlobal.model).trigger('change');
            $("#ver").click();

         }
        
        $('#tab-ficha-0').find('select, textarea, input, button#ver').each(function () {
            if ($(this).prop('disabled')){
                inputBloq = 0;
                $(this).prop('disabled', false); 
            } else {
                inputBloq = 1;
               
                $(this).prop('disabled', true);
            }
            
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
        $('#tab-ficha-9').find('select, textarea, input, #buttonResetCheckbox').each(function () {
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

    var check_incide = false;

    $("#subprocess").change(function (e){
        let inci = $("#subprocess option:selected").text().toLowerCase().includes("incid");

        if(inci){
            check_incide = true;
            $("#incidencia").css('display', 'block');
        }else{
            check_incide = false;
            $("#incidencia").css('display', 'none');
        }
    });

    $("#btn-applySubProcess").click(function (e) {
        if(!check_incide){
            var formData = {
                purchase_id: $('#purchase_id').val(),
                processes_id: $('#process').val(),
                subprocesses_id: $('#subprocess').val()
            };
        }else{
            var formData = {
                purchase_id: $('#purchase_id').val(),
                processes_id: $('#process').val(),
                subprocesses_id: $('#subprocess').val(),
                incidence: $("#incidence").val()
            };
        }

        preloader('show');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            type: 'POST',
            url: url_index + '/applyProcesses',
            data: formData,
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                if (data.code == 200) {
                    if(check_incide)
                        $("#incidence").val('');

                    preloader('hide', data.message, 'success');
                }

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    /////////////////////////////////////////////////
    var verify_model_brand = null;

     $('#ver').click(function(){
        if(verify_model_brand == 1){
            $(this).html("Elegir marca y modelo de la lista");

            $('#model').attr('disabled', 'disabled');
            $('#brand').attr('disabled', 'disabled');

            if(inputBloq == 0){
                $('#brand_text').removeAttr('disabled');
                $('#model_text').removeAttr('disabled');
            }

            $('#brand_text').attr('required', 'required');
            $('#model_text').attr('required', 'required');
            $('#brand_text').val(dataGlobal.brand);
            $('#model_text').val(dataGlobal.model);

            $("#exist_model_brand").val(0);

            verify_model_brand = 0;

            $(".ocultar").show();
            $(".mostrar").hide();
        } else {

            $(this).html("No encuentro Modelo/marca");

            $('#brand_text').removeAttr('required');
            $('#model_text').removeAttr('required');
            $('#brand_text').attr('disabled', 'disabled');
            $('#model_text').attr('disabled', 'disabled');
            $('#brand_text').val('');
            $('#model_text').val('');
            
            if(inputBloq == 0){
                $('#brand').removeAttr('disabled');
                $('#model').removeAttr('disabled');
            }


            $("#exist_model_brand").val(1);

            verify_model_brand = 1;

            $(".ocultar").hide();
            $(".mostrar").show();
        }
     });
    
    //Resetear checbox para los envios chatarra 
    $('#buttonResetCheckbox').click(function () {
       $('.myCheckbox').prop('checked', false); 
    })
    


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

Dropzone.options.certificateDropzone = {
    autoProcessQueue: true,
    uploadMultiple: true,
    maxFilezise: 10,
    // maxFiles: 1,
    acceptedFiles: "application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,image/jpeg,image/png,image/gif",

    init: function () {
        certificateDropzone = this;

        this.on("addedfile", function (file) {
        });

        this.on("complete", function (file) {
            var formData = {
                id: $('#certificate_purchase_id').val()
            };
            preloader('show');
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                type: 'POST',
                data: formData,
                dataType: 'json',
                url: 'findCertificate',
                success: function (data) {
                    if (data.code == 200) {
                        preloader('hide', data.message, 'success');
                        $("#certificates").html('');
                        data.certificates.forEach(function (element) {
                            $("#certificates").append(`<a href="${data.link}/local/public/certificates/${element.name}" target="_blank" style="margin: 15px">${element.name}</a><span class="fa fa-times text-danger float-right ml-3 mt-2"  onclick="deleteDocumentsCertificated(${element.id})"></span>`);
                        });
                    }

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        this.on("success",
            certificateDropzone.processQueue.bind(certificateDropzone)
        );
    }
};
 
Dropzone.options.documentsMailDropzone = {
    autoProcessQueue: true,
    uploadMultiple: true,
    maxFilezise: 10,
    // maxFiles: 1,
    acceptedFiles: "application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,image/jpeg,image/png,image/gif",

    init: function () {
        documentsMailDropzone = this;

        this.on("addedfile", function (file) {
        });

        this.on("complete", function (file) {
            var formData = {
                id: $('#documents_mail_purchase_id').val()
            };
            preloader('show');
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                type: 'POST',
                data: formData,
                dataType: 'json',
                url: 'findDocumentsMail',
                success: function (data) {
                    if (data.code == 200) {
                        preloader('hide', data.message, 'success');
                        $("#documents_mail").html('');
                        data.documents_mail_purchase_valuation.forEach(function (element) {
                            $("#documents_mail").append(`<a href="${data.link}/local/public/documents_mail/${element.name}" target="_blank" style="margin: 15px">${element.name}</a><div class="custom-control custom-checkbox ml-2 mt-2"><input type="checkbox" name="apply[]" id="apply_${element.id}" value="${element.id}" class="custom-control-input" checked><label class="custom-control-label" for="apply_${element.id}"></label></div><span class="fa fa-times text-danger float-right ml-3 mt-2"  onclick="deleteDocumentsMail(${element.id})"></span>`);
                        });
                    }

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        this.on("success",
            documentsMailDropzone.processQueue.bind(documentsMailDropzone)
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
                            response +=  `<a href="${data.link}/local/public/documents_purchase/${element.name}" target="_blank" style="margin: 15px">${element.name}</a><span class="fa fa-times text-danger float-right" style="margin-left: -15px;" onclick="deleteDocuments(${element.id})"></span>`;
                        });
                        $("#documents").append(response);
                        if (!!data.dni_doc) {
                            data.dni_doc.split(',').forEach(function (element) {
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

function deleteDocumentsMail(id) {

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
                url: 'deleteDocumentsMail',
                success: function (data) {
                    if (data.code == 200) {
                        preloader('hide', data.message, 'success');
                        $("#documents_mail").html('');
                        var response = '';
                        data.documents_mail_purchase_valuation.forEach(function (element) {
                            response +=  `<a href="${data.link}/local/public/documents_mail/${element.name}" target="_blank" style="margin: 15px">${element.name}</a><div class="custom-control custom-checkbox ml-2 mt-2"><input type="checkbox" name="apply[]" id="apply_${element.id}" value="${element.id}" class="custom-control-input" checked><label class="custom-control-label" for="apply_${element.id}"></label></div><span class="fa fa-times text-danger float-right ml-3 mt-2"  onclick="deleteDocumentsMail(${element.id})"></span>`;
                        });
                        $("#documents_mail").append(response);                         
                    }

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

}

function deleteDocumentsCertificated(id) {
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
                url: 'deleteCertificate',
                success: function (data) {
                    if (data.code == 200) {
                        preloader('hide', data.message, 'success');
                        $("#certificates").html('');
                        var response = '';
                        data.certificates.forEach(function (element) {
                            response +=  `<a href="${data.link}/local/public/certificates/${element.name}" target="_blank" style="margin: 15px">${element.name}</a><span class="fa fa-times text-danger float-right ml-3 mt-2"  onclick="deleteDocumentsCertificated(${element.id})"></span>`;
                        });
                        $("#certificates").append(response);                         
                    }

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

}
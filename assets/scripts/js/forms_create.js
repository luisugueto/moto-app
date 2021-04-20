var $formAddValidate = $('#formServices'),
    regexp = /^[ A-Za-z0-9áéíóúüñ]+$/i,
    $tagss = '';
//get base URL *********************
var url = '/formularios';

var forms_view = {
    init: function () {       
        
        $("#modal_inputs").on("shown.bs.modal", function() {            
            $("#kind_class").select2({
                placeholder: "Select a class",
                minimumResultsForSearch: 1 / 0,
                width: '100%'
            });
            $("#its_beneficiary_class").select2({
                placeholder: "Select a beneficiary class",
                minimumResultsForSearch: 1 / 0,
                width: '100%'
            });
        });
        $("#modal_select").on("shown.bs.modal", function() {
            $("#its_beneficiary_class2").select2({
                placeholder: "Select a beneficiary class",
                minimumResultsForSearch: 1 / 0,
                width: '100%'
            });
        });
        $("#modal_preloader_name_beneficiarie").on("shown.bs.modal", function() {
            $("#size_2").select2({
                placeholder: "Select the input size",
                minimumResultsForSearch: 1 / 0
            });
        });
        $(document).on('ajaxComplete', function(e) {
            forms_view.init_modal_tags();
        });

        $("#content_form").sortable({
            connectWith: ".item",
            items: ".m-portlet--sortable",
            handle: ".item",
            update: function(e, t) {
                t.item.prev().hasClass("m-portlet--sortable-empty") && t.item.prev().before(t.item)
            }
        });
    
        $('#name_beneficiarie_out_tab').click(function() {
            let i = +$(this).data("count");
            if (i < 20) {
                console.log("+ " + (++i))
                $(this).data("count", i);
                var vInput = '';
                var nameField = 'beneficiarie_name_' + i;
                var labelText = $('#name_input_data_2').val();
                var size = $('#size_2').val();
                vInput = '<div id="div_' + nameField + '" class="m-portlet--sortable col-sm-' + size + '" style="margin-top: 15px;">' + '<div class="item">' + '<button type="button" id="dest_' + nameField + '" onclick="forms_view.destroy_field(\'div_' + nameField + '\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;"><i class="fa fa-minus"></i></button>' + '<label class="capitalize_text">' + labelText + '</label>' + '<input type="text" class="form-control m-input " id="' + nameField + '" name="' + nameField + '" required="">' + '</div>' + '</div>';
                $("#name_input_data_2").val('');
                $('#content_form').append(vInput).html();
                $('#modal_preloader_name_beneficiarie').modal('hide');
            }
        });
        $('#name_beneficiarie_in_tab').click(function() {
            let i = +$(this).data("count2");
            if (i < 20) {
                console.log("+ " + (++i))
                $(this).data("count2", i);
                var vInput = '';
                var nameField = 'beneficiarie_name_' + i;
                var labelText = $('#name_input_data_2').val();
                var size = $('#size_2').val();
                vInput = '<div id="div_' + nameField + '" class="m-portlet--sortable col-sm-' + size + '" style="margin-top: 15px;">' + '<div class="item">' + '<button type="button" id="dest_' + nameField + '" onclick="forms_view.destroy_field(\'div_' + nameField + '\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;"><i class="fa fa-minus"></i></button>' + '<label class="capitalize_text">' + labelText + '</label>' + '<input type="text" class="form-control m-input " id="' + nameField + '" name="' + nameField + '" required="">' + '</div>' + '</div>';
                $("#name_input_data_2").val('');
                $('.tab-pane.active>div').append(vInput).html();
                $('#modal_preloader_name_beneficiarie').modal('hide');
            }
        });

        
    },
    init_validations: function() {
        $('.inner_form').attr('required', 'true');
    },
    init_modal_tags: function() {
        $tagss = $(".tagss").select2({
            multiple: true,
            tags: true,
            tokenSeparators: [','],
        });
    },
    date: function() {
        var t;
        t = mUtil.isRTL() ? {
            leftArrow: '<i class="fa fa-angle-right"></i>',
            rightArrow: '<i class="fa fa-angle-left"></i>'
        } : {
            leftArrow: '<i class="fa fa-angle-left"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>'
        };
        $('.date').datepicker({
            dateFormat: "dd/mm/yy",
            rtl: mUtil.isRTL(),
            todayHighlight: !0,
            orientation: "bottom left",
            templates: t
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });
    },
    time: function() {
        $('.time').timepicker({
            defaultTime: "11:45:20 AM",
            minuteStep: 1,
            defaultTime: "",
            showSeconds: !0,
            showMeridian: !1,
            snapToStep: !0
        });
    },
    show_kind: function() {
        var checkValue = $('#import_export').is(':checked');
        if (checkValue === true) {
            $('.kind_hidden').toggle('show');
            $('.kind_hidden').removeClass("m--hide");
        } else {
            $('.kind_hidden').toggle('hide');
        }
    },
    events: function() {
        $('#name_input_data').keypress(function(e) {
            if (!/^[ a-z0-9áéíóúüñ]*$/i.test(this.value)) {
                this.value = this.value.replace(/[^ a-z0-9áéíóúüñ]+/ig, '');
            }
        });
        $('#add_select').keypress(function(e) {
            if (!/^[ a-z0-9áéíóúüñ]*$/i.test(this.value)) {
                this.value = this.value.replace(/[^ a-z0-9áéíóúüñ]+/ig, '');
            }
        });
        $('#add_radio').keypress(function(e) {
            if (!/^[ a-z0-9áéíóúüñ]*$/i.test(this.value)) {
                this.value = this.value.replace(/[^ a-z0-9áéíóúüñ]+/ig, '');
            }
        });
        $('#add_check').keypress(function(e) {
            if (!/^[ a-z0-9áéíóúüñ]*$/i.test(this.value)) {
                this.value = this.value.replace(/[^ a-z0-9áéíóúüñ]+/ig, '');
            }
        });

        // Para editar
        $('.choice_button').click(function() {
            var name = '';
            var item = $(this); // item that triggered the event
            console.log(item)
            name = $(this).attr('name');
            forms_view.update_inputs_form(name);
        });

    },
    view_edit: function () {
        var action = sessionStorage.getItem('action');
         
        if (action == 1) {
            sessionStorage.clear(); 
        }
        if (action == 2) {
            var id = sessionStorage.getItem('id_form');
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                type: "GET",
                url: url + '/' + id,
                success: function (data) {
                    if (data.form_original !== null && data.form_original !== '') {
                        $('#form_id').val(data.id_form);
                        var form = data.form_original;
                        var formOriginal = form.replace('contenteditable="false"', 'contenteditable="true"');
                        var xx = $('#form_created').html(formOriginal);
                        $("#content_form").sortable({
                            connectWith: ".item",
                            items: ".m-portlet--sortable",
                            handle: ".item",
                            update: function (e, t) {
                                t.item.prev().hasClass("m-portlet--sortable-empty") && t.item.prev().before(t.item)
                            }
                        });
                        forms_view.init_validations();
                        $('button').remove('.edit');
                        $('.delete').css('display', 'none');
                        if ($('.edit').length) {
                            $('.edit').css('display', 'block');
                        } else {
                            setTimeout(function () {
                                $('.edit').css('display', 'block');
                                var xl = xx.find('#content_form');
    
    
                                xl.find('div>div').each(function (i, e) {
                                    $(this).before('');
                                    $(this).addClass('item ui-sortable-handle');
                                    var label = $(this).children("label").text();
                                    // Para los inputs
                                    var input = $(this).children("input");
                                    var input_id = input.attr('id');
                                    var input_class = input.attr('class');
                                    var input_type = input.attr('type');
                                    var input_required = input.attr('required');
    
                                    if (input.length && !input.hasClass('select2-search__field')) {
                                        $(this).children("label").before('<button type="button" id="dest_' + input_id + '" onclick="forms_view.edit_field(\'' + input_id + '\', \'' + input_class + '\', \'' + input_type + '\', \'' + input_required + '\',\'' + label + '\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:block;"><i class="fa fa-edit"></i></button>');
                                    }
                                    //
    
                                    //Para los select
                                    var select = $(this).children("select");
                                    var select_id = select.attr('id');
                                    var select_class = select.attr('class');
                                    var select_type = 'select';
                                    var select_required = select.attr('required');
                                    if (select.length) {
    
                                        if (select.hasClass('.tagss')) {
                                            select_type = 'tagss';
                                        }
    
                                        $(this).children("label").before('<button type="button" id="dest_' + select_id + '" onclick="forms_view.edit_field(\'' + select_id + '\', \'' + select_class + '\', \'' + select_type + '\', \'' + select_required + '\',\'' + label + '\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:block;"><i class="fa fa-edit"></i></button>');
                                    }
    
    
                                    // Textareas
                                    var textarea = $(this).children("textarea");
                                    var textarea_id = textarea.attr('id');
                                    var textarea_class = textarea.attr('class');
                                    var textarea_type = 'textarea';
                                    var textarea_required = textarea.attr('required');
    
                                    if (textarea.length) {
                                        $(this).children("label").before('<button type="button" id="dest_' + textarea_id + '" onclick="forms_view.edit_field(\'' + textarea_id + '\', \'' + textarea_class + '\', \'' + textarea_type + '\', \'' + textarea_required + '\',\'' + label + '\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:block;"><i class="fa fa-edit"></i></button>');
                                    }
                                    //
                                });
                            }, 3000);
                        }
    
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    },
    savedata: function() {
        var id = sessionStorage.getItem('id_service');
        var form = $('#form_created').html();
        var formOriginal = form.replace('contenteditable="true"', 'contenteditable="false"');
        $('#formServices').removeClass('AVAST_PAM_nonloginform');
        $('#content_form').removeClass('ui-sortable');
        $('#content_form>div').removeClass('m-portlet--sortable');
        $('#content_form>div>div').removeClass('item');
        $('#content_form>div>div').removeClass('ui-sortable-handle');
        $('.tab-content>div').removeClass('m-portlet--sortable');
        $('.tab-content>div>div>div').removeClass('m-portlet--sortable');
        $('.tab-content>div>div>div>div').removeClass('item ui-sortable-handle');
        $('.tab-content>div>div>div>div').removeAttr('class');
        $('button').remove('.delete');
        $('button').remove('.edit');
        $('span').remove('#x');
        $('div').remove('.head');
        $('.billing_address').removeAttr('onclick');
        var vform = $('#form_created').html();
        var vForm = vform.replace('contenteditable="true"', 'contenteditable="false"');


        var vTabPayment = $('#form_created').find('.tab_payment');
        if (vTabPayment.length) {
            var vFormPayment = vTabPayment.html();
            vFormPayment.replace(/[']/g, "\'");
        }


        //console.log(vFormPayment)
        // hijos.each(function() {
        //     console.log($(this).html());

        // });

        preloader('show');
 
        var formData = {
            name: $('#title').text(),
            description: $('#desc').text(),            
            form: vForm.replace(/[']/g, "\'"),
            form_original: formOriginal.replace(/[']/g, "\'")
        }
        console.log(formData)
        //used to determine the http verb to use [add=POST], [update=PUT]
        var button = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var form_id = $('#form_id').val();
        var my_url = url;
        if (form_id > 0 ){
            type = "PUT"; //for updating existing resource
            my_url += '/' + form_id;
        }
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                
                preloader('hide', 'Formulario Almacenado Exitosamente...', 'success');
                $('#form_created').html(formOriginal);
                setTimeout(function () {
                    window.location = url;
                }, 1000);
            },
            error: function (data) {
               console.log('Error:', data);
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
    },
    loadform: function() {
        console.clear();
        $("#formServices").find(':input').each(function() {
            var elemento = this;
            var tag = this.tagName;
            var type = this.type;
            if (tag == "input" && (type == "checkbox" || type == "radio")) elemento.value = this.is(":checked");
        });
    },
    add_field: function() {
        //console.clear();
        var vInput = '';
        var requiredField = $('#required_input').val();
        var labelText = $('#name_input_data').val();
        var typeField = $('#create_input').val();
        var spaceField = $('#space_input').val();
        var size = $('#size').val();
        var age_field = randString(8);
        var notification_event = $('#notification_event').val();
        if (notification_event == 1) {
            var class_event = 'event_notification';
        } else {
            class_event = '';
        }

        nameField = randString(8);

        if (!regexp.test($("#name_input_data").val())) {
            swal('This field can only have alphanumeric characters !', '', 'warning');
            $("#name_input_data").val('');
        } else {
            if (spaceField == 'm-grid') {
                vInput = '<div id="div_' + nameField + '" class="m-portlet--sortable col-sm-' + size + '" style="margin-top: 15px;">'
            }
            switch (typeField) {
                case 'text':
                    vInput += `<div class="item">
                                <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:none;">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <label class="capitalize_text">${labelText}</label>
                                <input type="text" class="form-control m-input" id="${nameField}" name="${nameField}" ${requiredField} />
                            </div>`;

                    break;
                case 'textarea':
                    strRows = '';
                    vInput += `<div class="item">
                        <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:none;">
                            <i class="fa fa-edit"></i>
                        </button>
                        <label class="capitalize_text">${labelText}</label>
                        <textarea id="${nameField}" name="${nameField}" ${requiredField} class="form-control m-input" ${strRows}' /></textarea>
                    </div>`;
                    break;
                case 'email':
                    vInput += `<div class="item">
                        <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:none;">
                            <i class="fa fa-edit"></i>
                        </button>
                        <label class="capitalize_text">${labelText}</label>
                        <input type="email" class="form-control m-input" id="${nameField}" name="${nameField}" ${requiredField} />
                    </div>`;
                    break;
                case 'time':
                    vInput += `<div class="item">
                        <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:none;">
                            <i class="fa fa-edit"></i>
                        </button>
                        <label class="capitalize_text">${labelText}</label>
                        <input type="time" class="form-control m-input time" id="${nameField}" name="${nameField}" ${requiredField} />
                    </div>`;
                    break;
                case 'date':
                    vInput += `<div class="item">
                        <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:none;">
                            <i class="fa fa-edit"></i>
                        </button>
                        <label class="capitalize_text">${labelText}</label>
                        <input type="date" class="form-control m-input date" id="${nameField}" name="${nameField}" ${requiredField} />
                    </div>`;
                    break;
                case 'tags':
                    vInput += `<div class="item">
                    <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:none;">
                        <i class="fa fa-edit"></i>
                    </button>
                    <label class="capitalize_text">${labelText}</label>
                    <select id="${nameField}" name="${nameField}" class="form-control select2 tagss" multiple></select>
                </div>`
                break;
            }
            vInput += '</div>';
            forms_view.clear_modal_inputs();
            $('#modal_inputs').modal('hide');
            var vContent = $('#content_form').html() + vInput;
            $('#content_form').html(vContent);
        }
    },
    add_select: function() {
        var nameField = randString(8);
        var labelText = $('#add_select').val();
        var size = $('#size_select').val();

        if (!regexp.test($("#add_select").val())) {
            swal('This field can only have alphanumeric characters !', '', 'warning');
            $("#add_select").val('');
        } else {
            var vInput = `
            <div class="m-portlet--sortable col-sm-${size} div_${nameField}" style="margin-top: 15px;">
                <div class="item">
                    <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field_class(\'div_${nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;"><i class="fa fa-minus"></i></button>
                    <label class="capitalize_text">${labelText}</label>
                    <select id="${nameField}" name="${nameField}" class="custom custom-select" required></select>
                </div>
            </div>            
            `;
            $('#field_select').html(vInput);
            $('#add_select').val(labelText);
            $('#add_select').attr('disabled', true);
            $('#btnCreateSelect').attr('disabled', true);
            $('#select_option').attr('disabled', false);
            $('#btn_agselect').attr('disabled', false);
            sessionStorage.setItem("select_name", nameField);
        }
    },
    add_option_select: function() {
        var nameField = sessionStorage.getItem("select_name");
        var vOption = $('#select_option').val();
        if (vOption == "") {
            swal('You must provide the text of the option!', '', 'warning');
            return false;
        }
        var labelOption = vOption;
        vOption = $('#select_option').val().replace(' ', '_').toLowerCase();
        var strOption = '<option value="' + vOption + '">' + labelOption + '</option>';
        $('#' + nameField).append(strOption);
        $('#select_option').val('');
    },
    finish_select: function() {
        var vContent = $.trim($('#field_select').html());
        if (vContent != 'Waiting...') {
            $('#content_form').append(vContent);
        }
        $('#add_select').val('');
        $('#select_option').val('');
        $('#field_select').html('Waiting...');
        $('#add_select').attr('disabled', false);
        $('#btnCreateSelect').attr('disabled', false);
        $('#modal_select').modal('hide');
    },
    close_select: function() {
        $('#add_select').val('');
        $('#select_option').val('');
        $('#field_select').html('Waiting...');
        $('#add_select').attr('disabled', false);
        $('#btnCreateSelect').attr('disabled', false);
    },
    add_radios: function() {
        var nameField = randString(8);
        var nameLabel = $('#add_radio').val();
        var size = $('#size_radio').val();
        if (!regexp.test($("#add_radio").val())) {
            swal('This field can only have alphanumeric characters !', '', 'warning');
            $("#add_radio").val('');
        } else {
            var vInput = `
            <div class="m-portlet--sortable col-sm-${size} div_${nameField}" style="margin-top: 15px;">
                <div class="item">
                    <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field_class(\'div_${nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;"><i class="fa fa-minus"></i></button>        
                    <fieldset class="position-relative form-group">
                        <label class="capitalize_text">${nameLabel}:</label>           
                        <div id="options_${nameField}"></div>     
                    </fieldset>   
                </div>
            </div>         
            `;
            $('#field_radio').html(vInput);
            $('#add_radio').val(nameLabel);
            $('#add_radio').attr('disabled', true);
            $('#btnCreateRadio').attr('disabled', true);
            $('#radio_option').attr('disabled', false);
            $('#btn_agoption').attr('disabled', false);
            sessionStorage.setItem("radio_name", nameField);
        }
    },
    add_option_radio: function() {
        var nameField = sessionStorage.getItem("radio_name");
        var vOption = $('#radio_option').val();
        if (vOption == "") {
            swal('You must provide the text of the option!');
            return false;
        }
        
        var nameOption = $('#radio_option').val().replace(' ', '_').toLowerCase();
        var strOption =  `<div class="position-relative form-check-inline
        "><label class="form-check-label">
            <input class="form-check-input" type="radio" id="radio_${nameField}" name="radio_${nameField}" value="${vOption}"/>
            <p style="margin-left:-7px;margin-right: 10px;">${vOption}</p>
            <span style="margin-rigth:10px"></span>
        </label></div>`;
        $('#options_' + nameField).append(strOption);
        $('#radio_option').val('');
    },
    finish_radios: function() {
        var vContent = $.trim($('#field_radio').html());
        if (vContent != 'Waiting...') {
            $('#content_form').append(vContent);
        }
        $('#add_radio').val('');
        $('#radio_option').val('');
        $('#field_radio').html('Waiting...');
        $('#add_radio').attr('disabled', false);
        $('#btnCreateradio').attr('disabled', false);
        $('#modal_radio').modal('hide');
    },
    close_radios: function() {
        $('#add_radio').val('');
        $('#radio_option').val('');
        $('#field_radio').html('Waiting...');
        $('#add_radio').attr('disabled', false);
        $('#btnCreateRadio').attr('disabled', false);
    },
    add_check: function() {
        var nameField = randString(8);
        var nameLabel = $('#add_check').val();
        var size = $('#size_check').val();
        if (!regexp.test($("#add_check").val())) {
            swal('This field can only have alphanumeric characters !');
            $("#add_check").val('');
        } else {
            var vInput = `<div class="m-portlet--sortable col-sm-${size} div_${nameField}" style="margin-top: 15px;">
                <div class="item">
                    <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field_class(\'div_${nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;"><i class="fa fa-minus"></i></button>        
                    <fieldset class="position-relative form-group">
                        <label class="capitalize_text">${nameLabel}:</label>           
                        <div id="checkboxs_${nameField}"></div>     
                    </fieldset>   
                </div>
            </div>         
            `;
            $('#field_check').html(vInput);
            $('#add_check').val(nameLabel);
            $('#add_check').attr('disabled', true);
            $('#btnCreateCheck').attr('disabled', true);
            $('#check_option').attr('disabled', false);
            $('#btn_agcheck').attr('disabled', false);
            sessionStorage.setItem("check_name", nameField);
        }
    },
    add_option_check: function() {
        var nameField = sessionStorage.getItem("check_name");
        var vOption = $('#check_option').val();
        if (vOption == "") {
            swal('You must provide the text of the option!');
            return false;
        }
        var nameOption = $('#check_option').val().replace(' ', '_').toLowerCase();
        var strOption =  `<div class="position-relative form-check-inline
        "><label class="form-check-label">
            <input class="form-check-input" type="checkbox" id="check_${nameField}" name="check_${nameField}" value="${vOption}"/>
            <p style="margin-left:-7px;margin-right: 10px;">${vOption}</p>
            <span style="margin-rigth:10px"></span>
        </label></div>`;
        $('#checkboxs_' + nameField).append(strOption);
        $('#check_option').val('');
    },
    finish_check: function() {
        var vContent = $.trim($('#field_check').html());
        if (vContent != 'Waiting...') {
            $('#content_form').append(vContent);
        }
        $('#add_check').val('');
        $('#check_option').val('');
        $('#field_check').html('Waiting...');
        $('#add_check').attr('disabled', false);
        $('#btnCreateCheck').attr('disabled', false);
        $('#modal_check').modal('hide');
    },
    close_check: function() {
        $('#add_check').val('');
        $('#check_option').val('');
        $('#field_check').html('Waiting...');
        $('#add_check').attr('disabled', false);
        $('#btnCreateCheck').attr('disabled', false);
    },
    clear_modal_inputs: function() {
        console.log('clear_modal')
        var addStatus = $("#req_data").is(':checked');
        if (addStatus == false) {
            $('#add_status').click();
        }
        $('#create_input').val('');
        $('#space_input').val('m-grid');
        $('#required_input').val('required');
        $('#name_input_data').val('');
        $("#edit_tabs").val('');
        $("#add_name_section").val('');
        $('#import_export').prop('checked', false);
        $('.kind_hidden').css('display', 'none');
        $('#kind_class').val('');
        $('#its_beneficiary').prop('checked', false);
        $('#its_beneficiary_class').val('');
        $('.its_beneficiary_hidden').css('display', 'none');
    },
    clear_select_dynamic: function() {
        $('#import_export').prop('checked', false);
        $('.kind_hidden').css('display', 'none');
        $('#its_beneficiary').prop('checked', false);
        $('.its_beneficiary_hidden').css('display', 'none');
    },
    validate_layout: function() {
        if ($('.nav.nav-tabs.tabs').length) {
            swal('A tab created in this form already exists', '', 'error');
        } else {
            forms_view.create_layout();
        }
    },
    create_layout: function() {
        console.clear();
        var vInput = '';
        var idTabs = randString(8);
        var size = $('#size_tabs').val();
        var vInput = `
        <div id="div_${idTabs}" class="col-sm-12" style="margin-top: 10px;">
        <div class="mb-3 card">
            <h3 class="float-right">
                <button type="button" id="dest_${idTabs}" onclick="forms_view.destroy_field_class(\'div_${idTabs}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;margin-right:10px;">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button"  onclick="forms_view.validate_tabs(\'${idTabs}\')" class="btn btn-sm m-btn btn-primary float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                    <i class="fa fa-plus"></i>
                </button>
            </h3>
            <div class="card-header card-header-tab-animation" style="margin-top:-15px">                
                <ul class="nav nav-justified tabs" id="pre_${idTabs}" role="tablist" ></ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="tabs_${idTabs}"></div>
            </div>
        </div>`;         
        $('#content_form').html(vInput);
        $('#btnCreateTabs').attr('disabled', true);
        $('#add_tabs').attr('disabled', false);
        $('#btn_agtabs').attr('disabled', false);
    },
    validate_tabs: function(idTabs) {
        sessionStorage.setItem("id_tabs", idTabs);
        $('#add_tabs').val('');
        $('#payment_tab').prop('checked', false);
        $('#modal_add_tabs').modal('show');
    },
    add_tabs: function() {
        if ($('.nav.nav-tabs.tabs>li>a.tab_payment').length) {
            swal('A tab payment created in this form already exists', '', 'error');
        } else {
            var vNameTab = $('#add_tabs').val();
            var vPaymentTab = 0;
            if ($('#payment_tab').is(':checked')) vPaymentTab = 1;
            var idTab = randString(8);
            var idTabs = sessionStorage.getItem("id_tabs");
            var isPayment = "";
            if (vNameTab == "") {
                swal('You must provide the text of the tabs!', '', 'warning');
                return false;
            }
            console.log(vPaymentTab)
            if (vPaymentTab == 1) {
                isPayment = 'tab_payment';
            } else {
                isPayment = '';
            }
            var strTab = `<li class="nav-item tab_${idTabs}">
                <a class="nav-link m-tabs__link tab_${idTabs}" data-toggle="tab" href="#tab_${idTabs}" role="tab">
                <span class="capitalize_text">${vNameTab}</span>
                <span onclick="forms_view.delete_tab(\'${idTabs}\')"  id="x">x</span>
                </a>
            </li>`;
            var strContent = `<div class="tab-pane m-portlet--sortable tab_${idTabs}" id="tab_${idTabs}" role="tabpanel">
                <div id="${idTabs}" class="position-relative form-group row">
                </div>
            </div>`;
            $('#pre_' + idTabs).append(strTab);
            $('#tabs_' + idTabs).append(strContent);
            $('#modal_add_tabs').modal('hide');
        }
    },
    delete_tab: function(idTab) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function(e) {
            if (e.dismiss === "cancel") {
                 Swal.fire("Cancelled", "The field is safe :)", "error");
            }
            if (e.value) {
                console.log(e)
                console.log(idTab)
                $('.nav-item.tab_' + idTab).remove();
                $('.tab_' + idTab + '.active').remove();
                 Swal.fire("Deleted!", "Tab removed successfully.", "success");
            }
        });
    },
    add_section_tabs: function() {
        var nameSection = $('#add_name_section').val();
        var nameField = randString(8);
        var vInput = '';
        if (!regexp.test($("#add_name_section").val())) {
            Swal.fire('This field can only have alphanumeric characters !', '', 'warning');
            $("#add_name_section").val('');
        } else {
            vInput += `<div class="m-portlet--sortable col-sm-12 div_${nameField}"  style="margin-top: 15px;">
                <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field_tab(\'div_${nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;margin-right:10px;">
                <i class="fa fa-minus"></i>
                </button>
                <h3 class="font-size-md text-capitalize font-weight-normal">${nameSection}</h3>
                <hr>
            </div>`;
            forms_view.clear_modal_inputs();
            $('#modal_add_section').modal('hide');
            $('.tab-pane.active>div').append(vInput);
        }
    },
    add_section: function() {
        var nameSection = $('#add_name_section').val();
        var nameField = randString(8);
        var vInput = '';
        if (!regexp.test($("#add_name_section").val())) {
            Swal.fire('This field can only have alphanumeric characters !', '', 'warning');
            $("#add_name_section").val('');
        } else {
            vInput += `<div class="m-portlet--sortable col-sm-12 div_${nameField}"  style="margin-top: 15px;">
            <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field_tab(\'div_${nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;margin-right:10px;">
            <i class="fa fa-minus"></i>
            </button>
            <h3 class="font-size-md text-capitalize font-weight-normal">${nameSection}</h3>
            <hr>
        </div>`;
            forms_view.clear_modal_inputs();
            $('#modal_add_section').modal('hide');
            $('#content_form').append(vInput);
        }
    },
    add_field_tabs: function() {
        console.clear();
        var vInput = '';
        var requiredField = $('#required_input').val();
        var labelText = $('#name_input_data').val();
        var typeField = $('#create_input').val();
        var spaceField = $('#space_input').val();
        var notification_event = $('#notification_event').val();
        var size = $('#size').val();
        var age_field = randString(8);
        if (notification_event == 1) {
            var class_event = 'event_notification';
        } else {
            class_event = '';
        }
        nameField = randString(8);
        if (!regexp.test($("#name_input_data").val())) {
            swal('This field can only have alphanumeric characters !', '', 'warning');
            $("#name_input_data").val('');
        } else {
            if (spaceField == 'm-grid') {
                vInput = '<div id="div_' + nameField + '" class="m-portlet--sortable col-sm-' + size + '" style="margin-top: 15px;">'
            }
            switch (typeField) {
                case 'text':
                    vInput += `<div class="item">
                                <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:none;">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <label class="capitalize_text">${labelText}</label>
                                <input type="text" class="form-control m-input" id="${nameField}" name="${nameField}" ${requiredField} />
                            </div>`;

                    break;
                case 'textarea':
                    strRows = '';
                    vInput += `<div class="item">
                        <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:none;">
                            <i class="fa fa-edit"></i>
                        </button>
                        <label class="capitalize_text">${labelText}</label>
                        <textarea id="${nameField}" name="${nameField}" ${requiredField} class="form-control m-input" ${strRows}' /></textarea>
                    </div>`;
                    break;
                case 'email':
                    vInput += `<div class="item">
                        <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:none;">
                            <i class="fa fa-edit"></i>
                        </button>
                        <label class="capitalize_text">${labelText}</label>
                        <input type="email" class="form-control m-input" id="${nameField}" name="${nameField}" ${requiredField} />
                    </div>`;
                    break;
                case 'time':
                    vInput += `<div class="item">
                        <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:none;">
                            <i class="fa fa-edit"></i>
                        </button>
                        <label class="capitalize_text">${labelText}</label>
                        <input type="time" class="form-control m-input time" id="${nameField}" name="${nameField}" ${requiredField} />
                    </div>`;
                    break;
                case 'date':
                    vInput += `<div class="item">
                        <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:none;">
                            <i class="fa fa-edit"></i>
                        </button>
                        <label class="capitalize_text">${labelText}</label>
                        <input type="date" class="form-control m-input date" id="${nameField}" name="${nameField}" ${requiredField} />
                    </div>`;
                    break;
                case 'tags':
                    vInput += `<div class="item">
                    <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:none;">
                        <i class="fa fa-edit"></i>
                    </button>
                    <label class="capitalize_text">${labelText}</label>
                    <select id="${nameField}" name="${nameField}" class="form-control select2 tagss" multiple></select>
                </div>`
                break;
            }
            vInput += '</div>';
            forms_view.clear_modal_inputs();
            $('#modal_inputs').modal('hide');
            $('.tab-pane.active>div').append(vInput);
        }
    },
    finish_select_tabs: function() {
        var vContent = $.trim($('#field_select').html());
        if (vContent != 'Waiting...') {
            $('.tab-pane.active>div').append(vContent);
        }
        $('#add_select').val('');
        $('#select_option').val('');
        $('#field_select').html('Waiting...');
        $('#add_select').attr('disabled', false);
        $('#btnCreateSelect').attr('disabled', false);
        $('#modal_select').modal('hide');
    },
    finish_radios_tabs: function() {
        var vContent = $.trim($('#field_radio').html());
        if (vContent != 'Waiting...') {
            $('.tab-pane.active>div').append(vContent);
        }
        $('#add_radio').val('');
        $('#radio_option').val('');
        $('#field_radio').html('Waiting...');
        $('#add_radio').attr('disabled', false);
        $('#btnCreateradio').attr('disabled', false);
        $('#modal_radio').modal('hide');
    },
    finish_check_tabs: function() {
        var vContent = $.trim($('#field_check').html());
        if (vContent != 'Waiting...') {
            $('.tab-pane.active>div').append(vContent);
        }
        $('#add_check').val('');
        $('#check_option').val('');
        $('#field_check').html('Waiting...');
        $('#add_check').attr('disabled', false);
        $('#btnCreateCheck').attr('disabled', false);
        $('#modal_check').modal('hide');
    },
    dob_out_tab: function() {
        var vInput = '';
        var nameField = randString(8);
        var requiredField = $('#required_input').val();
        var labelText = $('#name_input_dob').val();
        var notification_event = $('#notification_event').val();
        var age_field = randString(8);
        if (notification_event == 1) {
            var class_event = 'event_notification';
        } else {
            class_event = '';
        }
        if (!regexp.test($("#name_input_dob").val())) {
            swal('This field can only have alphanumeric characters !', '', 'warning');
            $("#name_input_dob").val('');
        } else {
            vInput = `<div id="div_${nameField}" class="m-portlet--sortable col-sm-3 div_dob" style="margin-top: 15px;">
                    <div class="item">
                        <label class="capitalize_text">${labelText}</label>
                        <input type="date" class="form-control m-input date" id="${nameField}" name="${nameField}" ${requiredField} onchange="ageCalculate(this.value, \'age_${age_field}\')"/>
                    </div>
                </div>
                <div id="div_${nameField}" class="m-portlet--sortable col-sm-2 div_dob" style="margin-top: 15px;">
                    <label class="capitalize_text text-center">Age</label>
                    <input type="text" class="form-control m-input" id="age_${age_field}" name="age_${age_field}" readonly/>
                </div>
               
                <div class="m-portlet--sortable col-sm-1 div_dob" style="margin-top: 15px;">
                    <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field_class(\'div_dob\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;margin-right:45px"><i class="fa fa-minus"></i></button>
                </div>`;
            forms_view.clear_modal_inputs();
            $('#content_form').append(vInput).html();
            $('#modal_dob').modal('hide');
        }
    },
    dob_in_tab: function() {
        var vInput = '';
        var nameField = randString(8);
        var requiredField = $('#required_input').val();
        var labelText = $('#name_input_dob').val();
        var notification_event = $('#notification_event').val();
        var age_field = randString(8);
        if (notification_event == 1) {
            var class_event = 'event_notification';
        } else {
            class_event = '';
        }
        if (!regexp.test($("#name_input_dob").val())) {
            swal('This field can only have alphanumeric characters !', '', 'warning');
            $("#name_input_dob").val('');
        } else {
            vInput = `<div id="div_${nameField}" class="m-portlet--sortable col-sm-3 div_dob" style="margin-top: 15px;">
            <div class="item">
                <label class="capitalize_text">${labelText}</label>
                <input type="date" class="form-control m-input date" id="${nameField}" name="${nameField}" ${requiredField} onchange="ageCalculate(this.value, \'age_${age_field}\')"/>
            </div>
            </div>
            <div id="div_${nameField}" class="m-portlet--sortable col-sm-2 div_dob" style="margin-top: 15px;">
                <label class="capitalize_text text-center">Age</label>
                <input type="text" class="form-control m-input" id="age_${age_field}" name="age_${age_field}" readonly/>
            </div>
        
            <div class="m-portlet--sortable col-sm-1 div_dob" style="margin-top: 15px;">
                <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field_class(\'div_dob\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;margin-right:45px"><i class="fa fa-minus"></i></button>
            </div>`;
            forms_view.clear_modal_inputs();
            $('#modal_dob').modal('hide');
            $('.tab-pane.active>div').append(vInput);
        }
    },
    cleanform: function() {
        $('#formServices').removeClass('AVAST_PAM_nonloginform');
        $('#content_form').removeClass('ui-sortable');
        $('#content_form>div').removeClass('m-portlet--sortable');
        $('#content_form>div>div').removeClass('item');
        $('#content_form>div>div').removeClass('ui-sortable-handle');
        $('.tab-content>div').removeClass('m-portlet--sortable');
        $('.tab-content>div>div>div').removeClass('m-portlet--sortable');
        $('.tab-content>div>div>div>div').removeClass('item ui-sortable-handle');
        $('.tab-content>div>div>div>div').removeAttr('class');
        $("button").remove(".delete");
        $("span").remove("#x");
        $('div').remove('.head');
    },
    destroy_field: function(idField) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function(e) {
            if (e.dismiss === "cancel") {
                Swal.fire("Cancelled", "The field is safe :)", "error");
            }
            if (e.value) {
                $('#' + idField).remove();
                Swal.fire("Deleted!", "Your field has been deleted.", "success");
            }
        });
    },
    destroy_field_class: function(classField) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
        }).then(function(e) {
            if (e.dismiss === "cancel") {
                Swal.fire("Cancelled", "The field is safe :)", "error");
            }
            if (e.value) {
                $('.' + classField).remove();
                Swal.fire("Deleted!", "Your field has been deleted.", "success");
            }
        });
    },
    destroy_field_tab: function(classField) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
        }).then(function(e) {
            if (e.dismiss === "cancel") {
                Swal.fire("Cancelled", "The tab is safe :)", "error");
            }
            if (e.value) {
                $('.' + classField).remove();
                Swal.fire("Deleted!", "Your tab has been deleted.", "success");
            }
        });
    },
    edit_field: function(field, classes, type, required, label) {
        console.log(field, classes, type, required, label)
        forms_view.clear_edit_form();
        var clase = classes.split(' ');
        console.log(clase)
        var clases_extra = '';
        $(".label").text(label);
        $('#id_field').val(field);
        $('#size').select2({disabled: true});
        $('#name_input_data').attr('class', classes);
        $('#name_input_data').attr('type', type);
        $('#button_add_inputs').text('Edit');
        $('#button_add_inputs').attr('onclick', '');
        $('#button_add_inputs_tabs').text('Edit in tabs');
        $('#button_add_inputs_tabs').attr('onclick', '');
        $('#button_add_inputs_tabs').removeAttr('disabled');
        $('#modal_inputs').modal('show');

        if (type == 'text') {

            if (clase[0] == 'autocomplete') {
                // Para importar/exportar data
                if (clase[3] == 'classFull_name' ||
                    clase[3] == 'className' ||
                    clase[3] == 'classLast_name' ||
                    clase[3] == 'classCity' ||
                    clase[3] == 'classState' ||
                    clase[3] == 'strCountryofResidence' ||
                    clase[3] == 'classEmail' ||
                    clase[3] == 'classPhone' ||
                    clase[3] == 'classAddress' ||
                    clase[3] == 'classZip') {

                    $('#import_export').prop('checked', 'true');
                    $('.kind_hidden').css('display', 'block');
                    $('#kind_class').val(null).trigger("change");
                    $('#kind_class').val(clase[3]).trigger("change");
                    $('#create_input').val('address');
                }

                else if (clase[3] == 'beneficiaries' ||
                        clase[3] == 'vehicle' ||
                        clase[3] == 'property') {
                    $('#its_beneficiary').prop('checked', 'true');
                    $('.its_beneficiary_hidden').css('display', 'block');
                    $('#its_beneficiary_class').val(null).trigger("change");
                    $('#its_beneficiary_class').val(clase[3]).trigger("change");
                    $('#create_input').val('address');
                }

                else if (clase[4] == 'beneficiaries' ||
                        clase[4] == 'vehicle' ||
                        clase[4] == 'property') {
                    $('#its_beneficiary').prop('checked', 'true');
                    $('.its_beneficiary_hidden').css('display', 'block');
                    $('#its_beneficiary_class').val(null).trigger("change");
                    $('#its_beneficiary_class').val(clase[4]).trigger("change");
                    $('#create_input').val('address');
                }
            }
            else if (clase[0] != 'autocomplete') {
                // Para importar/exportar data

                if (clase[2] == 'classFull_name' ||
                    clase[2] == 'className' ||
                    clase[2] == 'classLast_name' ||
                    clase[2] == 'classCity' ||
                    clase[2] == 'classState' ||
                    clase[2] == 'strCountryofResidence' ||
                    clase[2] == 'classEmail' ||
                    clase[2] == 'classPhone' ||
                    clase[2] == 'classAddress' ||
                    clase[2] == 'classZip' ||
                    clase[2] == 'classBirthday' ||
                    clase[2] == 'classAge') {

                	if (clase[3] == 'beneficiaries' ||
                        clase[3] == 'vehicle' ||
                        clase[3] == 'property') {

                		$('#its_beneficiary').prop('checked', 'true');
                    	$('.its_beneficiary_hidden').css('display', 'block');
                    	$('#its_beneficiary_class').val(null).trigger("change");
                    	$('#its_beneficiary_class').val(clase[3]).trigger("change");
                    	$('#oldClass').val(clase[3]);
                	}

                    $('#import_export').prop('checked', 'true');
                    $('.kind_hidden').css('display', 'block');
                    $('#kind_class').val(null).trigger("change");
                    $('#kind_class').val(clase[2]).trigger("change");
                    $('#oldClass').val(clase[3]);
                    $('#create_input').val(type);
                }

                // Para los documentos requeridos
                else if (clase[2] == 'beneficiaries' ||
                        clase[2] == 'vehicle' ||
                        clase[2] == 'property') {
                    $('#its_beneficiary').prop('checked', 'true');
                    $('.its_beneficiary_hidden').css('display', 'block');
                    $('#its_beneficiary_class').val(null).trigger("change");
                    $('#its_beneficiary_class').val(clase[2]).trigger("change");
                    $('#oldClass').val(clase[3]);
                    $('#create_input').val(type);
                }

                else if (clase[2] == 'date') {
                    if (clase[3] == 'classBirthday') {

                        $('#import_export').prop('checked', 'true');
                        $('.kind_hidden').css('display', 'block');
                        $('#kind_class').val(null).trigger("change");
                        $('#kind_class').val(clase[3]).trigger("change");
                        $('#oldClass').val('');
                    }

                    else if (clase[4] == 'classBirthday') {

                        $('#import_export').prop('checked', 'true');
                        $('.kind_hidden').css('display', 'block');
                        $('#kind_class').val(null).trigger("change");
                        $('#kind_class').val(clase[4]).trigger("change");
                        $('#oldClass').val('');
                    }

                    else if (clase[3] == 'event_notification') {
                        $('#notification_event').val('1');
                        $('#event_1').prop('checked', 'true');
                        $('.noti').css('display', 'block');
                    }
                    else  if (clase[4] == 'event_notification') {
                        $('#notification_event').val('1');
                        $('#event_1').prop('checked', 'true');
                        $('.noti').css('display', 'block');
                    }
                    else if (clase[5] == 'event_notification') {
                        $('#notification_event').val('1');
                        $('#event_1').prop('checked', 'true');
                        $('.noti').css('display', 'block');
                    }

                    $('#oldClass').val('');
                    $('#create_input').val('date');
                }


                else if (clase[3] == 'inner_form') {
                    $('#oldClass').val(clase[3]);
                    $('#create_input').val(type);
                }

                else if (clase[4] == 'inner_form') {
                    clases_extra = clase[3] + ' ' + clase[4];
                    $('#oldClass').val(clases_extra);
                    $('#create_input').val(type);
                }

                else{
                    $('#oldClass').val(clase[2]);
                    $('#create_input').val(type);
                }
            }

        }
        if (type == 'date') {

            $('#create_input').val('date');
            $('#name_input_data').attr('type', 'text');
        }
        if (type == 'select') {
            $('#name_input_data').keyup(function() {
                $('.name_select_new').css('display', 'block');
            });
            $('.name_select_new').css('display', 'none');

            $('#create_input').val('select');
            $('.impexp').css('display', 'none');
            var options = $('select#'+field+' option');
            $('#options_select_edit').html('');
            var values = $.map(options ,function(option) {
                $('#options_select_edit').append('<option value="' + option.value + '">' + option.text + '</option>');
            });

            if (clase[2] == 'beneficiaries' || clase[2] == 'vehicle' || clase[2] == 'property') {
                $('#its_beneficiary').prop('checked', 'true');
                $('.its_beneficiary_hidden').css('display', 'block');
                $('#its_beneficiary_class').val(null).trigger("change");
                $('#its_beneficiary_class').val(clase[2]).trigger("change");
            }

            else if (clase[2] != 'beneficiaries' || clase[2] != 'vehicle' || clase[2] != 'property') {
                clases_extra = clase[2];
                if (clase[3] == 'inner_form') {
                    clases_extra = clase[2] + ' ' + clase[3];
                }
                $('#oldClass').val(clases_extra);
            }
            else{
                $('#oldClass').val(clase[2]);
            }

            // $('#addnewname').click(function() {
            //     $('#button_add_inputs_tabs').prop('disabled', 'true');
            //     forms_view.update_inputs_form();
            // });

            $('#editoption').click(function() {
                var value_new = $('#options_select_edit').val();
                $('.edit_option').css('display', 'block');
                  $('.new_option').css('display', 'none');
                $('#button_add_inputs_tabs').prop('disabled', 'true');
                $('#newOption').val(value_new);
                $('#oldOption').val(value_new);
            });

            $('#editnewoption').click(function(e) {
                e.preventDefault();
                var vOption = $('#editOption').val();
                var vOldOption = $('#oldOption').val();

                if (vOldOption !== '') {
                    $('#options_select_edit option:contains('+ vOldOption +')').val(vOption);
                    $('#options_select_edit option:contains('+ vOldOption +')').text(vOption);
                    // $('#options_select_edit option[value='+ vOldOption +']').remove();
                    // $('#options_select_edit').replaceWith(strOption);
                    // $('#oldOption').val(vOption);
                }
                $('#newOption').val('');
                $('#oldOption').val('');
                $('.edit_option').css('display', 'none');
                $('#button_add_inputs_tabs').prop('disabled', 'true');

            });

            $('#deleteoption').click(function() {
                var value_new = $('#options_select_edit').val();
                $('.new_option').css('display', 'none');
                $('#button_add_inputs_tabs').prop('disabled', 'true');
                $('#options_select_edit option:contains('+ value_new +')').remove();
            });

            $('#addoption').click(function() {
                $('.edit_option').css('display', 'none');
                $('.new_option').css('display', 'block');
                $('#newOption').val('');
                $('#button_add_inputs_tabs').prop('disabled', 'true');
            });

            $('#addnewoption').click(function() {
                var vOption = $('#newOption').val();
                var strOption = '<option value="' + vOption + '">' + vOption + '</option>';

                $('#options_select_edit option:contains('+ vOption +')').remove();
                $(strOption).appendTo('#options_select_edit');

                $('.new_option').css('display', 'none');
                $('#button_add_inputs_tabs').prop('disabled', 'true');

            });


        }

        if (type == 'textarea') {
            $('.options_select').css('display', 'none');
            $('#create_input').val('textarea');
        }

        if (required !== 'undefined') {
            $('#required_input').val('required');
            $('#req_data').prop('checked', 'true');
        }

        $('#its_beneficiary_class').change(function(e) {
            e.preventDefault();
            if ($(this).val() == 'none') {
                $('#its_beneficiary').prop('checked', false);
                $('.its_beneficiary_hidden').css('display', 'none');
            } else {
                $('#its_beneficiary').prop('checked', true);
                $('.its_beneficiary_hidden').css('display', 'block');
            }
        });
        $('#kind_class').change(function(e) {
            e.preventDefault();

            if ($(this).val() == 'none') {
                $('#import_export').prop('checked', false);
                $('.kind_hidden').css('display', 'none');
            } else {
                $('#import_export').prop('checked', true);
                $('.kind_hidden').css('display', 'block');
            }
        });

    },
    update_inputs_form: function(button) {
        // console.log(button)
        var vInput = '';
        var requiredField = $('#required_input').val();
        var newLabelText = $('#name_input_data').val();
        var oldLabel = $('.label').text();
        var labelText = '';
        var nameField = $('#id_field').val();
        var typeField = $('#create_input').val();
        var size = $('#size').val();
        var notification_event = $('#notification_event').val();
        var oldClass = $('#oldClass').val();
        if (notification_event == 1) {
            var class_event = 'event_notification';
        } else {
            class_event = '';
        }
        // console.log(oldLabel)
        if (newLabelText != '') {labelText = newLabelText;}else{labelText = oldLabel;}
        // console.log(nameField,labelText,requiredField,typeField,notification_event,class_import_export,its_beneficiary_class, size )
        if (!regexp.test(labelText)) {
            swal('This field can only have alphanumeric characters !', '', 'warning');
            $("#name_input_data").val('');
        } else {
            switch (typeField) {
                case 'text':
                    vInput += `
                             <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;display:none;">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'${ nameField}\', \'form-control m-input\', \'${ typeField}\', \'${ requiredField }\', \'${ labelText}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:block;">
                                <i class="fa fa-edit"></i>
                            </button>
                            <label class="capitalize_text">${labelText}</label>
                            <input type="text" class="form-control m-input" id="${nameField}" name="${nameField}" ${requiredField} />
                            `;
                    break;
                case 'textarea':
                    vInput += `
                             <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;display:none;">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'${ nameField}\', \'form-control m-input\', \'${ typeField}\', \'${ requiredField }\', \'${ labelText}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:block;">
                                <i class="fa fa-edit"></i>
                            </button>
                            <label class="capitalize_text">${labelText}</label>
                            <textarea id="${nameField}" name="${nameField}" class="form-control m-input" ${requiredField}/></textarea>
                            `;
                    break;
                case 'email':
                    vInput += `
                            <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;display:none;">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'${ nameField}\', \'form-control m-input\', \'${ typeField}\', \'${ requiredField }\', \'${ labelText}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:block;">
                                <i class="fa fa-edit"></i>
                            </button>
                            <label class="capitalize_text">${labelText}</label>
                            <input type="email" class="form-control m-input" id="${nameField}" name="${nameField}" ${requiredField} />
                            `;
                    break;
                case 'date':
                    vInput += `
                            <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;display:none;">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'${ nameField}\', \'form-control m-input date ${class_event}\', \'${ typeField}\', \'${ requiredField }\', \'${ labelText}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:block;">
                                <i class="fa fa-edit"></i>
                            </button>
                            <label class="capitalize_text">${labelText}</label>
                            <input type="date" class="form-control m-input date ${class_event}" id="${nameField}" name="${nameField}" ${requiredField} />
                            `;
                    break;
                case 'time':
                    vInput += `
                             <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;display:none;">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'${ nameField}\', \'form-control m-input time\', \'${ typeField}\', \'${ requiredField }\', \'${ labelText}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:block;">
                                <i class="fa fa-edit"></i>
                            </button>
                            <label class="capitalize_text">${labelText}</label>
                            <input type="time" class="form-control m-input time" id="${nameField}" name="${nameField}" ${requiredField} />
                            `;
                    break;
                case 'tags':
                    vInput += `
                             <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;display:none;">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'${ nameField}\', \'form-control select2 tagss\', \'${ typeField}\', \'${ requiredField }\', \'${ labelText}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:block;">
                                <i class="fa fa-edit"></i>
                            </button>
                            <label class="capitalize_text">${labelText}</label>
                            <select id="${nameField}" name="${nameField}" class="form-control select2 tagss" multiple></select>
                            `;
                    break;
                case 'select':
                        vInput += `
                                <button type="button" id="dest_${nameField}" onclick="forms_view.destroy_field(\'div_${ nameField}\')" class="btn btn-sm m-btn btn-info float-right delete" style="margin-top: -5px;margin-bottom: 10px;display:none;">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" id="dest_${nameField}" onclick="forms_view.edit_field(\'${ nameField}\', \'form-control m-input\', \'${ typeField}\', \'${ requiredField }\', \'${ labelText}\')" class="btn btn-sm m-btn btn-warning float-right edit" style="margin-top: -5px;margin-bottom: 10px; width: 30px;height: 30px; padding: 1px; display:block;">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <label class="capitalize_text">${labelText}</label>
                                <select id="${nameField}" name="${nameField}" class="form-control m-input"></select>
                                `;
                    break;

            }

            if (button == 'in_tab') {
                $('.tab-pane.active>div>div>div').each(function() {
                    var input = $(this).children("input");
                    var select = $(this).children("select");
                    var textarea = $(this).children("textarea");
                    var idField = input.attr('id');
                    var idSelect = select.attr('id');
                    var idTextarea = textarea.attr('id');
                    var divId = nameField;

                    if (idField == divId) {
                        forms_view.clear_edit_form();
                        $('#modal_inputs').modal('hide');
                        $(this).empty().html(vInput);
                    }
                    else if (idSelect == divId){
                        $(this).empty().html(vInput);
                        $('.name_select_new').css('display', 'none');
                        $('.options_select').css('display', 'block');

                        $('#savechangeselect').click(function(e) {
                            e.preventDefault();
                            var options = $('#options_select_edit option');
                            $('select#'+idSelect).html('');
                            var values = $.map(options ,function(option) {
                                $('select#'+idSelect).append('<option value="' + option.value + '">' + option.text + '</option>');
                            });
                            forms_view.clear_edit_form();
                            $('#modal_inputs').modal('hide');
                        });
                    }
                    else if (idTextarea == divId) {
                        forms_view.clear_edit_form();
                        $('#modal_inputs').modal('hide');
                        $(this).empty().html(vInput);
                    }
                });
            }
            if(button == 'out_tab'){
                $('#content_form>div>div').each(function() {
                    var input = $(this).children("input");
                    var select = $(this).children("select");
                    var textarea = $(this).children("textarea");
                    var idField = input.attr('id');
                    var idSelect = select.attr('id');
                    var idTextarea = textarea.attr('id');
                    var divId = nameField;
                    if (idField == divId) {
                        forms_view.clear_edit_form();
                        $('#modal_inputs').modal('hide');
                        $(this).empty().html(vInput);
                    }
                    else if (idSelect == divId){
                        $(this).empty().html(vInput);
                        $('.name_select_new').css('display', 'none');
                        $('.options_select').css('display', 'block');

                        $('#savechangeselect').click(function(e) {
                            e.preventDefault();
                            var options = $('#options_select_edit option');
                            $('select#'+idSelect).html('');
                            var values = $.map(options ,function(option) {
                                $('select#'+idSelect).append('<option value="' + option.value + '">' + option.text + '</option>');
                            });
                            forms_view.clear_edit_form();
                            $('#modal_inputs').modal('hide');
                        });
                    }
                    else if (idTextarea == divId) {
                        forms_view.clear_edit_form();
                        $('#modal_inputs').modal('hide');
                        $(this).empty().html(vInput);
                    }
                });
            }
        }

    },

    clear_edit_form: function() {
        console.log('clear_modal')

        var addStatus = $("#req_data").is(':checked');
        if (addStatus == false) {
            $('#add_status').click();
        }
        $('#create_input').val('');
        $('#space_input').val('m-grid');
        $('#required_input').val('');
        $('#name_input_data').val('');
        $('.choice_button').trigger("change");
        $("#edit_tabs").val('');
        $("#add_name_section").val('');
        $('#newOption').val('');
        $('#oldOption').val('');
        $('#import_export').prop('checked', false);
        $('.kind_hidden').css('display', 'none');
        $('.options_select').css('display', 'none');
        $('#kind_class').val('');
        $('#its_beneficiary').prop('checked', false);
        $('#its_beneficiary_class').val('');
        $('.its_beneficiary_hidden').css('display', 'none');
        $('.noti').css('display', 'none');
    }
};
$(function() {
    forms_view.init();
    forms_view.events();
    forms_view.view_edit();
});



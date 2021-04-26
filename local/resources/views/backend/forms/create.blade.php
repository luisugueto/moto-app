@extends('layouts.backend')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div><span class="lang" key="heading">Formularios</span>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ url('formularios') }}" class="mb-2 mr-2 btn-icon btn-pill btn btn-primary"> 
                        <i class="pe-7s-back btn-icon-wrapper"> </i>Regresar
                    </a>                     
                </div>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-header">            
            <h3 class="card-title lang" key="heading">Generador de Formularios</h3>
            
        </div>
        <div class="card-body">
            <h4 class="text-center">
                <a href="#" class="mb-2 mr-2 btn btn-xs btn-outline-light"><i class="fa fa-undo js-boton" data-type="undo" ></i></a>
                <a href="#" class="mb-2 mr-2 btn btn-xs btn-outline-light"><i class="fa fa-share js-boton" data-type="redo" ></i></a>
                <a href="#" class="mb-2 mr-2 btn btn-xs btn-outline-light"><i class="fa fa-italic js-boton" data-type="italic" ></i></a>
                <a href="#" class="mb-2 mr-2 btn btn-xs btn-outline-light"><i class="fa fa-bold js-boton" data-type="bold" ></i></a>
                <a href="#" class="mb-2 mr-2 btn btn-xs btn-outline-light"><i class="fa fa-underline js-boton" data-type="underline" ></i></a>
                <a href="#" class="mb-2 mr-2 btn btn-xs btn-outline-light"><i class="fa fa-align-left js-boton"  data-type="justifyLeft" ></i></a>
                <a href="#" class="mb-2 mr-2 btn btn-xs btn-outline-light"><i class="fa fa-align-center js-boton" data-type="justifyCenter" ></i></a>
                <a href="#" class="mb-2 mr-2 btn btn-xs btn-outline-light"><i class="fa fa-align-right js-boton" data-type="justifyRight" ></i></a>
                <a href="#" class="mb-2 mr-2 btn btn-xs btn-outline-light"><i class="fa fa-text-height js-boton" data-type="increaseFontSize" ></i></a>
                <a href="#" class="mb-2 mr-2 btn btn-xs btn-outline-light"><i class="fa fa-minus js-boton" data-type="inserthorizontalrule" ></i></a>
            </h4>
            <div class="row">
                <div class="col-sm-8">
                    <div id="form_created">                                              
                        <div id="editorWYS" contenteditable="true">
                            <div style="border: 3px solid;border-color: #1976d2; border-radius: 5px; width: 100%;padding-top:2%;padding-bottom: 0%;margin-bottom: 7px">
                                <h1 id="title">Title</h1>
                                <hr>
                            </div>
                            <p id="desc">Description</p>
                            <hr>
                        </div>
                        <div id="formServices" method="post">
                            <div id="content_form" class="row">

                            </div>
                        </div>
                    </div>
                    <div class="text-right text-capitalize mt-4">
                        {{ csrf_field() }}  
                        <input type="hidden" id="form_id" name="form_id" value="0">
                        <button onclick="forms_view.savedata();" class="btn btn-primary tr" id="btn-save" value="add" >Guardar Cambios</button>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3 card text-white card-body bg-primary">
                        <h3 class="text-white card-title" key="heading">Campos</h3>                       
                        <div class="m-accordion m-accordion--default m-accordion--solid m-accordion--section  m-accordion--toggle-arrow" id="m_accordion_7" role="tablist">
                            <div class="m-accordion__item">
                                <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_7_item_1_head" data-toggle="collapse" href="#m_accordion_7_item_1_body" aria-expanded="false">
                                    <span class="m-accordion__item-title tr" key="Basics">Básicos</span>

                                    <span class="m-accordion__item-mode"></span>
                                </div>

                                <div class="m-accordion__item-body collapse" id="m_accordion_7_item_1_body" role="tabpanel" aria-labelledby="m_accordion_7_item_1_head" data-parent="#m_accordion_7">
                                    <div class="m-accordion__item-content">
                                        <ul class="uk-nestable">
                                            <br>
                                            <li class="uk-nestable-item">
                                                <div class="uk-nestable-panel">
                                                    <i class="fa fa-comment"></i>
                                                    <span><strong>Text</strong></span>
                                                    <button class="mb-2 mr-2 btn-icon btn btn-danger  float-right" data-toggle="modal" data-target="#modal_inputs" onclick="$('#inputs_options').text('Opciones - Text');$('#create_input').val('text');$('.noti').css('opacity', 0);forms_view.clear_select_dynamic();"  style="margin-top: -4px;height: 25px;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </li>
                                            <li class="uk-nestable-item">
                                                <div class="uk-nestable-panel">
                                                    <i class="fa fa-text-width"></i>
                                                    <span><strong>Textarea</strong></span>
                                                    <button class="mb-2 mr-2 btn-icon btn btn-danger  float-right" data-toggle="modal" data-target="#modal_inputs" onclick="$('#inputs_options').text('Opciones - Textarea');$('#create_input').val('textarea');$('.noti').css('opacity', 0);"  style="margin-top: -4px;height: 25px;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </li>
                                            <li class="uk-nestable-item">
                                                <div class="uk-nestable-panel">
                                                    <i class="fa fa-envelope"></i>
                                                    <span><strong>Email</strong></span>
                                                    <button class="mb-2 mr-2 btn-icon btn btn-danger  float-right" data-toggle="modal" data-target="#modal_inputs" onclick="$('#inputs_options').text('Opciones - Email');$('#create_input').val('email');$('.noti').css('opacity', 0);"  style="margin-top: -4px;height: 25px;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </li>
                                            <li class="uk-nestable-item">
                                                <div class="uk-nestable-panel">
                                                    <i class="fa fa-calendar"></i>
                                                    <span><strong>Date</strong></span>
                                                    <button class="mb-2 mr-2 btn-icon btn btn-danger  float-right" data-toggle="modal" data-target="#modal_inputs" onclick="$('#inputs_options').text('Opciones - Date');$('#create_input').val('date'); $('.noti').css('opacity', 1);"  style="margin-top: -4px;height: 25px;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </li>
                                            <li class="uk-nestable-item">
                                                <div class="uk-nestable-panel">
                                                    <i class="fa fa-clock"></i>
                                                    <span><strong>Time</strong></span>
                                                    <button class="mb-2 mr-2 btn-icon btn btn-danger  float-right" data-toggle="modal" data-target="#modal_inputs" onclick="$('#inputs_options').text('Opciones - Time');$('#create_input').val('time');$('.noti').css('opacity', 0);"  style="margin-top: -4px;height: 25px;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </li>
                                            <li class="uk-nestable-item">
                                                <div class="uk-nestable-panel">
                                                    <i class="fa fa-list"></i>
                                                    <span><strong>Select</strong></span>
                                                    <button class="mb-2 mr-2 btn-icon btn btn-danger  float-right" data-toggle="modal" data-target="#modal_select"style="margin-top: -4px;height: 25px;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </li>
                                            <li class="uk-nestable-item">
                                                <div class="uk-nestable-panel">
                                                    <i class="fa fa-check-circle"></i>
                                                    <span><strong>Radio</strong></span>
                                                    <button class="mb-2 mr-2 btn-icon btn btn-danger  float-right" data-toggle="modal" data-target="#modal_radio" style="margin-top: -4px;height: 25px;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </li>
                                            <li class="uk-nestable-item">
                                                <div class="uk-nestable-panel">
                                                    <i class="fa fa-check-square"></i>
                                                    <span><strong>Checkbox</strong></span>
                                                    <button class="mb-2 mr-2 btn-icon btn btn-danger  float-right" data-toggle="modal" data-target="#modal_check" style="margin-top: -4px;height: 25px;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </li>
                                            <li class="uk-nestable-item">
                                                <div class="uk-nestable-panel" >
                                                    <i class="fa fa-calendar"></i>
                                                    <span><strong>DOB</strong></span>
                                                    <button class="mb-2 mr-2 btn-icon btn btn-danger  float-right" data-toggle="modal" data-target="#modal_dob" onclick="$('.noti').css('opacity', 1);"  style="margin-top: -4px;height: 25px;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="m-accordion__item">
                                <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_7_item_3_head" data-toggle="collapse" href="#m_accordion_7_item_3_body" aria-expanded="    false">
                                    <span class="m-accordion__item-title tr" key="Layout">Layout</span>
                                    <span class="m-accordion__item-mode"></span>
                                </div>

                                <div class="m-accordion__item-body collapse" id="m_accordion_7_item_3_body" role="tabpanel" aria-labelledby="m_accordion_7_item_3_head" data-parent="#m_accordion_7">
                                    <div class="m-accordion__item-content">
                                        <ul class="uk-nestable">
                                            <br>
                                            <li class="uk-nestable-item">
                                                <div class="uk-nestable-panel">
                                                    <i class="fa fa-columns"></i>
                                                    <span><strong>Tabs</strong></span>
                                                    <button type="button"  onclick="forms_view.validate_layout();" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only  float-right" style="margin-top: -4px;height: 25px;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </li>
                                            <li class="uk-nestable-item">
                                                <div class="uk-nestable-panel">
                                                    <i class="fa fa-align-justify"></i>
                                                    <span><strong>Section</strong></span>
                                                    <button type="button" data-toggle="modal" data-target="#modal_add_section" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only  float-right" style="margin-top: -4px;height: 25px;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>                   
                    </div>                     
                </div>
            </div>
        </div>
    </div>
    <!-- Passing BASE URL to AJAX -->
    <input id="url" type="hidden" value="{{ \Request::url() }}">
    
    @section('modals')
    <!-- Modals -->
    <div class="modal fade" id="modal_inputs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="inputs_options"></span> <a href="#" id="btn2" class="btn btn-outline btn-light" data-toggle="modal" data-target="#modal3"><i class="fa fa-info"></i></a></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="create_input" value="">
                    <input type="hidden" id="space_input" value="m-grid">
                    <input type="hidden" id="required_input" value="required">
                    <input type="hidden" id="notification_event" value="">
                    <input type="hidden" id="id_field" value="">
                    <input type="hidden" id="oldClass" value="">
                    <div class="row">
                        <div class="col-sm-7">
                            <label class="label">Nombre</label>
                            <input type="text" id="name_input_data" class="form-control m-input" />
                        </div>
                        <div class="col-sm-3">
                            <label>Tamaño</label>
                            <select name="size" id="size" class="custom custom-select">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3" selected="">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Requerido?</label>
                            <label class="switch" for="req_data">
                                <input type="checkbox" id="req_data"  onchange="console.log($('#req_data').is(':checked'));
                                if ($('#req_data').is(':checked')) {
                                    $('#required_input').val('required');
                                } else {
                                    $('#required_input').val('');
                                }">
                                <span class="slider round "></span>
                            </label>
                        </div>
                        <div class="col-sm-3 noti">
                            <label class=" noti">Fecha Agenda</label>                        
                            <label class="switch noti" for="event_1">
                                <input type="checkbox" id="event_1"  onchange="if ($('#event_1').is(':checked')) {
                                    $('#notification_event').val('1');
                                } else {
                                    $('#notification_event').val('');
                                }">
                                <span class="slider round "></span>
                            </label>
                        </div>
                    </div>
                    <div class="m-form__group form-group row options_select" style="display: none;">
                        <div class="col-sm-12" >
                            <div style="white-space:nowrap; margin-bottom: 10px;">
                                <label>Cambiar opciones del select</label>
                                <button class="btn btn-info" type="button" id="savechangeselect">Guardar Cambios</button>
                            </div>
                            <div class="input-group">
                                <select name="options_select_edit" id="options_select_edit" class="custom-select m-input">
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" id="editoption">Editar</button>
                                    <button class="btn btn-danger" type="button" id="deleteoption">Eliminar</button>
                                    <button class="btn btn-success" type="button" id="addoption">Agregar</button>

                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-8 edit_option" style="display: none;">
                            <div class="input-group">
                                <input type="hidden" id="oldOption">
                                <input type="text" id="editOption" name="editOption" class="form-control m-input">

                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger" type="button" id="editnewoption">Guardar</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-8 new_option" style="display: none;">
                            <div class="input-group">
                                <input type="text" id="newOption" name="newOption" class="form-control m-input">

                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger" type="button" id="addnewoption">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="button_add_inputs" onclick="forms_view.add_field();" name="out_tab" type="button" class="btn btn-outline-warning m-btn m-btn--icon m-btn--outline-2x choice_button" >Agregar</button>
                    <button id="button_add_inputs_tabs" onclick="forms_view.add_field_tabs();" name="in_tab" type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--outline-2x choice_button" >Agregar al Tab</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Select -->
    <div class="modal fade" id="modal_select" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span>Select - Opciones</span> <a href="#" id="btn2" class="btn btn-outline btn-light" data-toggle="modal" data-target="#modal3"><i class="fa fa-info"></i></a></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="required_select" value="required">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Nombre</label>
                            <input type="text" id="add_select" name="add_select" class="form-control m-input" />
                        </div>
                        <div class="col-sm-2">
                            <label>Tamaño</label>
                            <select name="size" class="form-control m-select2" id="size_select">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3" selected="">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button id="btnCreateSelect" onclick="forms_view.add_select();" class="btn btn-primary" style="margin-top: 25px;margin-bottom:15px">Crear</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="field_select" style="display: flex; justify-content: center;margin-top: 20px">
                                Cargando...
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group row">
                        <div class="col-sm-6">
                            <label>Opción</label>
                            <input type="text" id="select_option" class="form-control m-input" maxlength="40"  required disabled="disabled" />
                        </div>
                        <div class="col-sm-3">
                            <button id="btn_agselect" onclick="forms_view.add_option_select();" class="btn btn-info" disabled="disabled" style="margin-top: 25px;margin-bottom:15px">Agregar Opción</button>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-3 col-form-label" for="req_data" >Requerido?</label>
                            <div class="col-3">                          
                                <label class="switch" for="req_data">
                                    <input type="checkbox" id="req_data"  onchange="console.log($('#req_data').is(':checked'));
                                    if ($('#req_data').is(':checked')) {
                                        $('#required_select').val('required');
                                    } else {
                                        $('#required_select').val('');
                                    }">
                                    <span class="slider round "></span>
                                </label>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="forms_view.close_select();">Cerrar</button>
                    <button id="button_add_inputs"onclick="forms_view.finish_select();" type="button" class="btn btn-outline-warning m-btn m-btn--icon m-btn--outline-2x" >Agregar</button>
                    <button id="button_add_inputs_tabs" onclick="forms_view.finish_select_tabs();" type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--outline-2x" >Agregar al Tab</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Radio -->
    <div class="modal fade" id="modal_radio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span>Radio - Opciones</span> <a href="#" id="btn2" class="btn btn-outline btn-light" data-toggle="modal" data-target="#modal3"><i class="fa fa-info"></i></a></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="required_radio" value="required">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Nombre</label>
                            <input type="text" id="add_radio" name="add_radio" class="form-control m-input" />
                        </div>
                        <div class="col-sm-4">
                            <label>Tamaño</label>
                            <select name="size" class="custom custom-select" id="size_radio">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3" selected="">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button id="btnCreateRadio" onclick="forms_view.add_radios();" class="btn btn-primary" style="margin-top: 25px;margin-bottom:15px">Crear</button>
                        </div>
                        <div class="col-sm-12">
                            <div id="field_radio" style="display: flex; justify-content: center;margin-top: 20px">
                                Cargando...
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group row">
                        <div class="col-sm-6">
                            <label>Opción</label>
                            <input type="text" id="radio_option" class="form-control m-input" maxlength="40"  required disabled="disabled" />
                        </div>
                        <div class="col-sm-3">
                            <button id="btn_agoption" onclick="forms_view.add_option_radio();" class="btn btn-info" disabled="disabled" style="margin-top: 25px;margin-bottom:15px">Agregar Opción</button>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-3 col-form-label" for="req_data" >Requerido?</label>
                            <div class="col-3">                          
                                <label class="switch" for="req_data">
                                    <input type="checkbox" id="req_data"  onchange="console.log($('#req_data').is(':checked'));
                                    if ($('#req_data').is(':checked')) {
                                        $('#required_radio').val('required');
                                    } else {
                                        $('#required_radio').val('');
                                    }">
                                    <span class="slider round "></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="forms_view.close_radios();">Cerrar</button>
                    <button id="button_add_inputs"onclick="forms_view.finish_radios();" type="button" class="btn btn-outline-warning m-btn m-btn--icon m-btn--outline-2x" >Agregar</button>
                    <button id="button_add_inputs_tabs" onclick="forms_view.finish_radios_tabs();" type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--outline-2x" >Agregar al Tab</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Checkbox -->
    <div class="modal fade" id="modal_check" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span>Checkbox - Opciones</span> <a href="#" id="btn2" class="btn btn-outline btn-light" data-toggle="modal" data-target="#modal3"><i class="fa fa-info"></i></a></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="required_check" value="required">
                    <input type="hidden" >
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Nombre</label>
                            <input type="text" id="add_check" name="add_check" class="form-control m-input" />
                        </div>
                        <div class="col-sm-4">
                            <label>Tamaño</label>
                            <select name="size" class="custom custom-select" id="size_check">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3" selected="">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button id="btnCreateCheck" onclick="forms_view.add_check();" class="btn m-btn btn-primary" style="margin-top: 25px;margin-bottom:15px">Crear</button>
                        </div>
                        <div class="col-sm-12">
                            <div id="field_check" style="display: flex; justify-content: center;margin-top: 20px">
                                Cargando...
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group row">
                        <div class="col-sm-6">
                            <label>Opción</label>
                            <input type="text" id="check_option" class="form-control m-input" maxlength="40"  required disabled="disabled" />
                        </div>
                        <div class="col-sm-3">
                            <button id="btn_agcheck" onclick="forms_view.add_option_check();" class="btn btn-info" disabled="disabled" style="margin-top: 25px;margin-bottom:15px">Agregar Opción</button>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-3 col-form-label" id="req_data" >Requerido?</label>
                            <div class="col-3">
                                <span class="m-switch m-switch--outline m-switch--success">
                                    <label>
                                        <input type="checkbox" checked="checked" id="req_data"  onchange="console.log($('#req_data').is(':checked'));
                                                if ($('#req_data').is(':checked')) {
                                                    $('#required_check').val('true');
                                                } else {
                                                    $('#required_check').val('false');
                                                }">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="forms_view.close_check();">Cerrar</button>
                    <button id="button_add_inputs"onclick="forms_view.finish_check();" type="button" class="btn btn-outline-warning m-btn m-btn--icon m-btn--outline-2x" >Agregar</button>
                    <button id="button_add_inputs_tabs" onclick="forms_view.finish_check_tabs();" type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--outline-2x" >Agregar al Tab</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Size -->
    <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('assets/images/grid.png')}}" alt="" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
    <!-- Modal DOB -->
    <div class="modal fade" id="modal_dob" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DOB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="required_dob" value="required">
                    <input type="hidden" id="notification_event" value="">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Nombre</label>
                            <input type="text" id="name_input_dob" class="form-control m-input" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Requerido?</label>
                            <label class="switch" for="req_data">
                                <input type="checkbox" id="req_data"  onchange="console.log($('#req_data').is(':checked'));
                                if ($('#req_data').is(':checked')) {
                                    $('#required_dob').val('required');
                                } else {
                                    $('#required_dob').val('');
                                }">
                                <span class="slider round "></span>
                            </label>
                        </div>
                        <div class="col-sm-3 noti">
                            <label class=" noti">Fecha Agenda</label>                        
                            <label class="switch noti" for="event_1">
                                <input type="checkbox" id="event_1"  onchange="if ($('#event_1').is(':checked')) {
                                    $('#notification_event').val('1');
                                } else {
                                    $('#notification_event').val('');
                                }">
                                <span class="slider round "></span>
                            </label>
                        </div>
                    </div>                     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="button_add_inputs" onclick="forms_view.dob_out_tab();" type="button" class="btn btn-outline-warning m-btn m-btn--icon m-btn--outline-2x" >Agregar</button>
                    <button id="button_add_inputs_tabs" onclick="forms_view.dob_in_tab();" type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--outline-2x" >Agregar al Tab</button>
                </div>
            </div>
        </div>
    </div>   
    <!-- Modal Tabs -->
    <div class="modal fade" id="modal_add_tabs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="title">Add Tab</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="payment_input" value="">
                    <div class="form-group m-form__group">
                        <label>Nombre del Tabs</label>
                        <input type="text" id="add_tabs" required class="form-control m-input" maxlength="40" />
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="button_add_inputs"onclick="forms_view.add_tabs();" type="button" class="btn btn-outline-warning m-btn m-btn--icon m-btn--outline-2x" >Agregar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Section -->
    <div class="modal fade" id="modal_add_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="title">Section</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Name Section</label>
                    <input type="text" id="add_name_section" required class="form-control m-input" maxlength="40" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="button_add_inputs"onclick="forms_view.add_section();" type="button" class="btn btn-outline-warning m-btn m-btn--icon m-btn--outline-2x" >Agregar</button>
                    <button id="button_add_inputs"onclick="forms_view.add_section_tabs();" type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--outline-2x" >Agregar dentro del tab</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modals  -->
    <script src="{{ asset('assets/scripts/js/forms_create.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".js-boton").mousedown(function (event) {
                event.preventDefault(); // Esto no es necesario, es por vicio xD
                var comando = $(this).attr('data-type');
                document.execCommand(comando, false, null);
            });
        });
    </script>
    @endsection
@endsection
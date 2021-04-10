@extends('layouts.backend')

@section('content')
 
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div><span class="lang" key="heading">Permisos</span>
                </div>
            </div>
            <div class="page-title-actions">                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if (session('notification'))
                <div class="alert alert-success notification">
                    {{ session('notification') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-block notification">
                    {{ session('error') }}
                </div>
            @endif
            <br>
            <div class="row">
                
                <div class="col-md-3">
                    <!-- Tabs nav -->
                    <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                       
                        @foreach ($roles as $item)
                        <a class="nav-link mb-3 p-3 shadow {{ $item->id == 1 ? 'active' : 'shadow' }}" id="v-pills-{{$item->id}}-tab" data-toggle="pill" href="#v-pills-{{$item->id}}" role="tab" aria-controls="v-pills-{{$item->id}}" aria-selected="true">
                            <i class="fa fa-user-circle-o mr-2"></i>
                            <span class="font-weight-bold small text-uppercase">{{ $item->display_name}}</span></a>
                            
                        @endforeach
                    </div>
                </div>


                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                           <h5>MENU</h5>
                        </div>
                        <div class="col-md-8">
                            <h5>PERMISOS</h5>
                           
                        </div>
                   </div>
                    <!-- Tabs content -->
                    <div class="tab-content" id="v-pills-tabContent">
                        @foreach ($roles as $item)
                            <div class="tab-pane fade shadow rounded bg-white {{ $item->id == 1 ? 'show active' : '' }} p-5" id="v-pills-{{$item->id}}" role="tabpanel" aria-labelledby="v-pills-{{$item->id}}-tab">
                                <div class="row list-group">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9 row">
                                                @foreach($permission as $value)
                                    
                                                <div class="col">
                                                    <div class="custom-control custom-checkbox check_{{$value->name}}" >
                                                        {{ Form::checkbox('check_permission', $value->id, false, array('class' => 'custom-control-input', 'id' => 'custom_check'.$value->id)) }}  
                                                        <label class="custom-control-label" for="custom_check{{$value->id}}">{{ $value->display_name }}</label>
                                                    </div>
                                                </div>
                                        
                                                @endforeach
                                                <div class="col">
                                                    <div class="custom-control custom-checkbox " id="check_all">
                                                        <input type="checkbox" value="" class="custom-control-input" id="custom_check">
                                                        <label class="custom-control-label" for="custom_check">Todas</label>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($menus as $item)                                       
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-md-3">{{ $item->name}}</div>
                                                    
                                                    <div class="col-md-9 row">    

                                                        @foreach($permission as $value)
                                                            <div class="col">
                                                                <div class="custom-control custom-checkbox ">
                                                                    {{ Form::checkbox('permission', $value->id, false, array('class' => 'custom-control-input input_'.$value->name, 'id' => 'inlineCheckbox'.$item->id)) }}  
                                                                    <label class="custom-control-label" for="inlineCheckbox{{$item->id}}"></label>
                                                                </div>
                                                            </div>     
                                                            <br/>   
                                                        @endforeach
                                                        <div class="col">
                                                            <div class="custom-control custom-checkbox ">
                                                                {{ Form::checkbox('permission', $value->id, false, array('class' => 'custom-control-input', 'id' => 'inlineCheckbox'.$item->id)) }}  
                                                                <label class="custom-control-label" for="inlineCheckbox{{$item->id}}"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </div>
                               </div>
                               <div class="mx-auto text-center">
                               <button type="button" class="btn btn-primary mt-3" id="btn-save" value="add">Guardar Cambios</button></div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    @section('modals')
    <!-- Passing BASE URL to AJAX -->
    <input id="url" type="hidden" value="{{ \Request::url() }}">

    
    <script src="{{ asset('assets/scripts/js/permission.js') }}"></script>
    @endsection
@endsection

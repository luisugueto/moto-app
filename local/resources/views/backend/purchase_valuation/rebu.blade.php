>@extends('layouts.backend')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-speaker icon-gradient bg-night-fade">
                </i>
            </div>
            <div><span class="lang" key="heading">Tasacion Motos</span>
                <div class="page-title-subheading">REBU.</div>
            </div>
        </div>
        <div class="page-title-actions">
             
            <div class="d-inline-block dropdown">
                <input type="hidden" name="idFicha" id="idFicha" value="{{$purchase_valuation->id}}">
                <a href="#" class="mb-2 mr-2 btn-icon btn-pill btn btn-primary" id="backFicha"> 
                    <i class="pe-7s-back btn-icon-wrapper"> </i>Regresar
                </a>                     
            </div>         
        </div>
    </div>
</div>
<br>
@if (session('notification'))
    <div class="alert alert-success notification">
        {!! session('notification') !!}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-block notification">
        {{ session('error') }}
    </div>
@endif
<br>
<div class="row" id="ficha">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">REBU
                </h5>    
                    
                    <hr>
                    {!! Form::open(['url' => 'purchase_valuation_interested/rebu', 'method' => 'post']) !!}      
                        <input type="hidden" name="purchase_valuation_id" value="{{ $purchase_valuation->id }}">   
                        <table style="width: 100%" id="tableResiduosREBU" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Residuo</th>
                                    <th>Precio</th>
                                    {{-- <th>Acciones</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    @if(isset($rebu[0]))
                                        <td><input type="text" name="residuo1" class="form-control" placeholder="residuo1" value="{{ $rebu[0]->name }}"></td>
                                        <td><input type="number" name="price1" class="form-control" placeholder="price1" step="0.1" value="{{ $rebu[0]->price }}"></td>
                                    @else
                                        <td><input type="text" name="residuo1" class="form-control" placeholder="residuo1" value="{{ old('residuo1') }}"></td>
                                        <td><input type="number" name="price1" class="form-control" placeholder="price1" step="0.1" value="{{ old('price1') }}"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>2</td>
                                    @if(isset($rebu[1]))
                                        <td><input type="text" name="residuo2" class="form-control" placeholder="residuo2" value="{{ $rebu[1]->name }}"></td>
                                        <td><input type="number" name="price2" class="form-control" placeholder="price2" step="0.1" value="{{ $rebu[1]->price }}"></td>
                                    @else
                                        <td><input type="text" name="residuo2" class="form-control" placeholder="residuo2" value="{{ old('residuo2') }}"></td>
                                        <td><input type="number" name="price2" class="form-control" placeholder="price2" step="0.1" value="{{ old('price2') }}"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>3</td>
                                    @if(isset($rebu[2]))
                                        <td><input type="text" name="residuo3" class="form-control" placeholder="residuo3" value="{{ $rebu[2]->name }}"></td>
                                        <td><input type="number" name="price3" class="form-control" placeholder="price3" step="0.1" value="{{ $rebu[2]->price }}"></td>
                                    @else
                                        <td><input type="text" name="residuo3" class="form-control" placeholder="residuo3" value="{{ old('residuo3') }}"></td>
                                        <td><input type="number" name="price3" class="form-control" placeholder="price3" step="0.1" value="{{ old('price3') }}"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>4</td>
                                    @if(isset($rebu[3]))
                                        <td><input type="text" name="residuo4" class="form-control" placeholder="residuo4" value="{{ $rebu[3]->name }}"></td>
                                        <td><input type="number" name="price4" class="form-control" placeholder="price4" step="0.1" value="{{ $rebu[3]->price }}"></td>
                                    @else
                                        <td><input type="text" name="residuo4" class="form-control" placeholder="residuo4" value="{{ old('residuo4') }}"></td>
                                        <td><input type="number" name="price4" class="form-control" placeholder="price4" step="0.1" value="{{ old('price4') }}"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>5</td>
                                    @if(isset($rebu[4]))
                                        <td><input type="text" name="residuo5" class="form-control" placeholder="residuo5" value="{{ $rebu[4]->name }}"></td>
                                        <td><input type="number" name="price5" class="form-control" placeholder="price5" step="0.1" value="{{ $rebu[4]->price }}"></td>
                                    @else
                                        <td><input type="text" name="residuo5" class="form-control" placeholder="residuo5" value="{{ old('residuo5') }}"></td>
                                        <td><input type="number" name="price5" class="form-control" placeholder="price5" step="0.1" value="{{ old('price5') }}"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>6</td>
                                    @if(isset($rebu[5]))
                                        <td><input type="text" name="residuo6" class="form-control" placeholder="residuo6" value="{{ $rebu[5]->name }}"></td>
                                        <td><input type="number" name="price6" class="form-control" placeholder="price6" step="0.1" value="{{ $rebu[5]->price }}"></td>
                                    @else
                                        <td><input type="text" name="residuo6" class="form-control" placeholder="residuo6" value="{{ old('residuo6') }}"></td>
                                        <td><input type="number" name="price6" class="form-control" placeholder="price6" step="0.1" value="{{ old('price6') }}"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>7</td>
                                    @if(isset($rebu[6]))
                                        <td><input type="text" name="residuo7" class="form-control" placeholder="residuo7" value="{{ $rebu[6]->name }}"></td>
                                        <td><input type="number" name="price7" class="form-control" placeholder="price7" step="0.1" value="{{ $rebu[6]->price }}"></td>
                                    @else
                                        <td><input type="text" name="residuo7" class="form-control" placeholder="residuo7" value="{{ old('residuo7') }}"></td>
                                        <td><input type="number" name="price7" class="form-control" placeholder="price7" step="0.1" value="{{ old('price7') }}"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>8</td>
                                    @if(isset($rebu[7]))
                                        <td><input type="text" name="residuo8" class="form-control" placeholder="residuo8" value="{{ $rebu[7]->name }}"></td>
                                        <td><input type="number" name="price8" class="form-control" placeholder="price8" step="0.1" value="{{ $rebu[7]->price }}"></td>
                                    @else
                                        <td><input type="text" name="residuo8" class="form-control" placeholder="residuo8" value="{{ old('residuo8') }}"></td>
                                        <td><input type="number" name="price8" class="form-control" placeholder="price8" step="0.1" value="{{ old('price8') }}"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>9</td>
                                    @if(isset($rebu[8]))
                                        <td><input type="text" name="residuo8" class="form-control" placeholder="residuo8" value="{{ $rebu[8]->name }}"></td>
                                        <td><input type="number" name="price8" class="form-control" placeholder="price8" step="0.1" value="{{ $rebu[8]->price }}"></td>
                                    @else
                                        <td><input type="text" name="residuo8" class="form-control" placeholder="residuo8" value="{{ old('residuo8') }}"></td>
                                        <td><input type="number" name="price8" class="form-control" placeholder="price8" step="0.1" value="{{ old('price8') }}"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>10</td>
                                    @if(isset($rebu[9]))
                                        <td><input type="text" name="residuo10" class="form-control" placeholder="residuo10" value="{{ $rebu[9]->name }}"></td>
                                        <td><input type="number" name="price10" class="form-control" placeholder="price10" step="0.1" value="{{ $rebu[9]->price }}"></td>
                                    @else
                                        <td><input type="text" name="residuo10" class="form-control" placeholder="residuo10" value="{{ old('residuo10') }}"></td>
                                        <td><input type="number" name="price10" class="form-control" placeholder="price10" step="0.1" value="{{ old('price10') }}"></td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    {!! Form::close() !!}

                
            </div>
        </div>
    </div>
</div>

<input id="url_index" type="hidden" value="{{ url('/') }}">
<script src="{{ asset('assets/scripts/js/purchase_valuation_rebu.js') }}"></script>
@endsection
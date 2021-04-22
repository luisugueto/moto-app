@extends('layouts.backend')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-speaker icon-gradient bg-night-fade">
                </i>
            </div>
            <div>Tasación Motos
                <div class="page-title-subheading">Listado de documentos.
                </div>
            </div>
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
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Documentos Tasación Motos</h5>
                <table width="100%" id="tableDocumentsTasacionMotos" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID de Tasación</th>
                            <th class="text-center">Nombre del Documento</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
 <!-- Passing BASE URL to AJAX -->
 <input id="url" type="hidden" value="{{ url('/documentos-gc') }}">
 {{ csrf_field() }}
 <script src="{{ asset('assets/scripts/js/documents_purchase_valuation.js') }}"></script>
 
@endsection
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-body">

                <div class="site-action">
                    <button onclick="window.location.href='{{ url('users/create') }}'"
                        class="site-action-toggle btn-raised btn btn-danger btn-floating" title="Agregar"><em
                            class="icon wb-plus animation-scale-up"></em></button>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h3>Mantenimiento de Usuarios</h3>
                    </div>
                </div>

                <br>

                <table class="table table-striped table-hover pag-table" width="100%" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Perfil</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ strtoupper($user->name) }}</td>
                            <td>{{ strtoupper($user->lastName) }}</td>
                            <td>{{ strtoupper($user->email) }}</td>
                            <td>{{ strtoupper($user->profile->description) }} </td>
                            <td>
                                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' =>'delete']) !!}
                                <a class="btn btn-outline btn-info btn-xs"
                                    href="{{ url('users/'.$user->id.'/edit') }}"> <em
                                        class="fa fa-pencil-square-o"></em> Editar</a>
                                <button class="btn btn-outline btn-xs btn-danger delete"><em
                                        class="fa fa-trash"></em> Eliminar</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
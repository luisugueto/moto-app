@extends('layouts.backend')

@section('content')
<div class="page animsition">

    <div class="page-content">
    @include('errors.errors')
        <div class="row">
            <div class="col-md-3">
                <link rel="stylesheet" href="{{ asset('themes/admin/css/pages/profile.css') }}">

                <div class="widget widget-shadow text-center">
                    <div class="widget-header">
                        <div class="widget-header-content">
                            <a class="avatar-profile" href="#">
                                @if (isset($user->user_image))
                                <img src="{{ asset('local/public/users/'.$user->user_image) }}" alt="{{$user->name}}" title="{{$user->name}}">
                                @else
                                <img src="{{ asset('themes/admin/images/avatar/default.png') }}" alt="Image" title="User Image">
                                @endif
                            </a>
                            <h4 class="profile-user">{{ ucwords($user->name)}}</h4>
                            <p class="profile-job">{{ $user->profile->description}}</p>

                            <hr>
                            <ul class="list-unstyled text-center">
                                <li>
                                    <p><em class="fa fa-user m-r-xs"></em><a href="#">
                                            {{ ucwords($user->name)}}</a></p>
                                </li>
                                <li>
                                    <p><em class="fa fa-envelope m-r-xs"></em><a href="#">
                                            {{ ucwords($user->email)}}</a>
                                    </p>
                                </li>
                                <hr>
                                <p class="text-center">
                                    <a class="btn btn-primary btn-raised" href="{{ route('change-image', $user->id )}}">
                                        Actualizar Foto
                                    </a>
                                </p>
                                <p class="text-center">
                                    <a class="btn btn-info btn-raised" href="{{ route('change-password', $user->id )}}">
                                        Cambiar Contraseña
                                    </a>
                                </p>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <h3>Cambia tu contraseña</h3><br />
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('update_password') }}"
                            enctype='multipart/form-data'>
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class='form-group  '>
                                <label for='password'
                                    class='col-sm-2 control-label'>Contraseña</label>
                                <div class='col-sm-10'>
                                    <input class='form-control ' id='userPassword'
                                        name='password' type='password' type='text' value='' required>
                                </div>
                            </div>
                            <div class='form-group  '>
                                <label for='password'
                                    class='col-sm-2 control-label'>Repetir Contraseña</label>
                                <div class='col-sm-10'>
                                    <input class='form-control ' id='userReptyPassword'
                                        name='reptyPassword' type='password' type='text' value='' required>
                                </div>
                            </div>
                            <div class='form-group '>
                                <div class='col-sm-2'></div>
                                <div class='col-sm-10'>
                                    <button class='btn btn-primary  btn-raised ladda-button'
                                        data-style='expand-left' data-plugin='ladda' id='save' name='save'
                                        type='submit'>
                                        <em class='fa fa-save'></em> Cambiar Contraseña
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
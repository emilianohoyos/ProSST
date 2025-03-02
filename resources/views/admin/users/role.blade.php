@extends('layouts.master')
@section('title')
    Editar Usuario
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Editar Usuario
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Editar Datos de usuario</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('userUpdate') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" placeholder="Ingrese Nombres"
                                            id="name" name="name" value={{ $user->name }}>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="identification_nit" class="form-label">N° identificacion</label>
                                        <input type="text" class="form-control"
                                            placeholder="Ingrese Identificacion o NIT" id="identification_nit"
                                            name="identification_nit" value={{ $user->identification_nit }}>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Numero Telefóno</label>
                                        <input type="text" class="form-control"
                                            placeholder="Ingrese Identificacion o NIT" id="phone_number" name="phone_number"
                                            value={{ $user->phone_number }}>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo</label>
                                        <input type="email" class="form-control" placeholder="Correo" name="email"
                                            id="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address_notification" class="form-label">Direccion de
                                            Notificación</label>
                                        <input type="address_notification" class="form-control" id="address_notification"
                                            name="address_notification" value="{{ $user->address_notification }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="department" class="form-label">Departamento <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('department') is-invalid @enderror"
                                            name="department" id="department" onchange="selectDeparment()">

                                            <option value="{{ $user->department }}">{{ $user->department }}</option>
                                        </select>
                                        @error('department')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="city" class="form-label">Ciudad <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('city') is-invalid @enderror" name="city"
                                            id="city">
                                            <option value="{{ $user->city }}">{{ $user->city }}</option>
                                        </select>
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div>
                                <button type="submit"
                                    class="btn btn-primary  w-25 position-relative top-100 start-50 translate-middle">Actualizar</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <!-- roles -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="card-title">Roles Asignados al Usuario: {{ $user->name }}.</h4>
                                <p class="card-title-desc">
                                    En esta seccion puedes Ver los Roles Asociados al Usuario: {{ $user->name }}.
                                </p>
                            </div>
                            {{-- <div class="col-md-2 ">
                            <a href="{{ route('roles.index') }}" type="button"
                                class="btn btn-primary waves-effect w-full waves-light">Ver Roles
                                Rol</a>
                        </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @if (Session::has('message-success'))
                                <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show"
                                    role="alert">
                                    <i
                                        class="mdi mdi-check-all label-icon"></i><strong>Exito</strong>-{{ Session::get('message-success') }}

                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (Session::has('message'))
                                <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show"
                                    role="alert">
                                    <i
                                        class="mdi mdi-block-helper label-icon"></i><strong>Error</strong>-{{ Session::get('message') }}

                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @forelse ($user->getRoleNames() as $user_role)
                                <form method="POST" action="{{ route('users.roles.remove', [$user->id, $user_role]) }}"
                                    class="d-inline-block"
                                    onsubmit="return confirm('Esta Seguro De Remover el Rol {{ $user_role }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-xs waves-effect waves-light">
                                        {{ $user_role }}<i
                                            class="mdi mdi-trash-can  font-size-16 d-inline-block"></i></button>
                                </form>

                            @empty
                                <span>No hay permisos asignados</span>
                            @endforelse

                        </div>

                        <div class="col-md-12 mt-5">
                            <form method="POST" action="{{ route('users.roles.assign', [$user->id]) }}">
                                @csrf
                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label">Rol</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="role" name="role">
                                            @foreach ($roles as $rol)
                                                <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">Asignar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!--end  roles -->
        <!--  permission -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="card-title">Permiso Asignados al usuario: {{ $user->name }}.</h4>
                                <p class="card-title-desc">
                                    En esta seccion puedes Ver los permisos Asociados al Usuario: {{ $user->name }}.
                                </p>
                            </div>
                            {{-- <div class="col-md-2 ">
                            <a href="{{ route('roles.index') }}" type="button"
                                class="btn btn-primary waves-effect w-full waves-light">Ver Roles
                                Rol</a>
                        </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @if (Session::has('message-success'))
                                <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show"
                                    role="alert">
                                    <i
                                        class="mdi mdi-check-all label-icon"></i><strong>Exito</strong>-{{ Session::get('message-success') }}

                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (Session::has('message'))
                                <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show"
                                    role="alert">
                                    <i
                                        class="mdi mdi-block-helper label-icon"></i><strong>Error</strong>-{{ Session::get('message') }}

                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @forelse ($user->permissions as $user_permission)
                                <form method="POST"
                                    action="{{ route('users.permissions.revoke', [$user->id, $user_permission->name]) }}"
                                    class="d-inline-block"
                                    onsubmit="return confirm('Esta Seguro De Remover el permiso {{ $user_permission->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-xs waves-effect waves-light">
                                        {{ $user_permission->name }}<i
                                            class="mdi mdi-trash-can  font-size-16 d-inline-block"></i></button>
                                </form>

                            @empty
                                <span>No hay permisos asignados</span>
                            @endforelse

                        </div>

                        <div class="col-md-12 mt-5">
                            <form method="POST" action="{{ route('users.permissions.give', $user->id) }}">
                                @csrf
                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label">Permiso</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="permission" name="permission">
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">Asignar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!--end  permission -->
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

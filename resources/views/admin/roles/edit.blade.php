@extends('layouts.master')
@section('title')
    Roles
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Roles
@endsection
@section('body')

    <body>
    @endsection
    @section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="card-title">Editar Rol</h4>
                                <p class="card-title-desc">
                                    En esta seccion puedes Editar un Rol.
                                </p>
                            </div>
                            <div class="col-md-2 ">
                                <a href="{{ route('admin.roles.index') }}" type="button"
                                    class="btn btn-primary waves-effect w-full waves-light">Ver Roles
                                    Rol</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label">Nombre Rol</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Ingrese el nombre de nuevo rol" id="name" name="name"
                                            value="{{ $role->name }}">
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="card-title">Permisos Asignados al Rol: {{ $role->name }}.</h4>
                                <p class="card-title-desc">
                                    En esta seccion puedes Ver los permisos Asociados al Rol: {{ $role->name }}.
                                </p>
                            </div>
                            {{-- <div class="col-md-2 ">
                            <a href="{{ route('admin.roles.index') }}" type="button"
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
                            @forelse ($role->permissions as $role_permission)
                                <form method="POST"
                                    action="{{ route('admin.roles.permissions.revoke', [$role->id, $role_permission->name]) }}"
                                    class="d-inline-block"
                                    onsubmit="return confirm('Esta Seguro De Remover el permiso {{ $role_permission->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-xs waves-effect waves-light">
                                        {{ $role_permission->name }}<i
                                            class="mdi mdi-trash-can  font-size-16 d-inline-block"></i></button>
                                </form>

                            @empty
                                <span>No hay permisos asignados</span>
                            @endforelse

                        </div>

                        <div class="col-md-12 mt-5">
                            <form method="POST" action="{{ route('admin.roles.permissions', $role->id) }}">
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
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

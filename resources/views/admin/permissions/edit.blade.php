@extends('layouts.master')
@section('title')
    Permisos
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Permisos
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
                                <h4 class="card-title">Editar nuevo Permiso</h4>
                                <p class="card-title-desc">
                                    En esta seccion puedes Crear un nuevo permiso.
                                </p>
                            </div>
                            <div class="col-md-2 ">
                                <a href="{{ route('permissions.index') }}" type="button"
                                    class="btn btn-primary waves-effect w-full waves-light">Ver Permisos</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-block-helper me-2"></i>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('permissions.update', $permission) }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label">Nombre Permiso</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Ingrese el nombre de nuevo rol" id="name" name="name"
                                            value="{{ $permission->name }}">
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">Actualizar</button>
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
                                <h4 class="card-title">Roles Asignados al permiso: {{ $permission->name }}.</h4>
                                <p class="card-title-desc">
                                    En esta seccion puedes Ver los permisos Asociados al Rol: {{ $permission->name }}.
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
                            @forelse ($permission->roles as $permission_role)
                                <form method="POST"
                                    action="{{ route('permissions.roles.remove', [$permission->id, $permission_role->name]) }}"
                                    class="d-inline-block"
                                    onsubmit="return confirm('Esta Seguro De Remover el permiso {{ $permission_role->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-xs waves-effect waves-light">
                                        {{ $permission_role->name }}<i
                                            class="mdi mdi-trash-can  font-size-16 d-inline-block"></i></button>
                                </form>

                            @empty
                                <span>No hay permisos asignados</span>
                            @endforelse

                        </div>

                        <div class="col-md-12 mt-5">
                            <form method="POST" action="{{ route('permissions.roles', $permission->id) }}">
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

    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

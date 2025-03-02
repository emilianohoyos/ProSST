@extends('layouts.master')
@section('title')
    Usuarios
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Usuarios
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
                                <h4 class="card-title">Gestión de Usuarios</h4>
                                <p class="card-title-desc">
                                    En esta seccion puedes ver,crear, editar y eliminar Usuarios.
                                </p>
                            </div>
                            <div class="col-md-2 ">
                                <a href="{{ route('roles.create') }}" type="button"
                                    class="btn btn-primary waves-effect w-full waves-light">Crear
                                    Usuario</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show"
                                role="alert">
                                <i
                                    class="mdi mdi-check-all label-icon"></i><strong>Exito</strong>-{{ Session::get('message') }}

                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Identificacion</th>
                                        <th>Telefono</th>
                                        <th>Correo</th>
                                        <th>Fecha Creacion</th>
                                        <th>Accion</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->identification_nit }}</td>
                                            <td>{{ $user->phone_number }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <a href="{{ route('users.edit', $user->id) }}" type="button"
                                                    class="btn btn-primary waves-effect btn-label waves-light d-inline-block"><i
                                                        class="mdi mdi-account-edit label-icon"></i>Editar </a>

                                                {{-- <a href="{{ route('users.edit', $user->id) }}" type="button"
                                                class="btn btn-warning waves-effect btn-label waves-light d-inline-block"><i
                                                    class="mdi mdi-account-multiple label-icon"></i> Roles</a>

                                            <a href="{{ route('users.edit', $user->id) }}" type="button"
                                                class="btn btn-success waves-effect btn-label waves-light d-inline-block"><i
                                                    class="mdi mdi-badge-account label-icon"></i> Permisos</a> --}}

                                                <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                                    class="d-inline-block"
                                                    onsubmit="return confirm('Esta Seguro De eliminar el Rol {{ $user->name }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger waves-effect btn-label waves-light d-inline-block"><i
                                                            class="mdi mdi-trash-can label-icon"></i>Eliminar </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            <br>
                            <!-- Enlaces de paginación -->
                            {{ $users->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

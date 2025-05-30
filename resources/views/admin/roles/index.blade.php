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
        <div class="col-12">
            <h2>Roles</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="card-title">Gestión de Roles</h4>
                                <p class="card-title-desc">
                                    En esta sección puedes ver, crear, editar y eliminar Roles.
                                </p>
                            </div>
                            <div class="col-md-2 ">
                                <a href="{{ route('roles.create') }}" type="button"
                                    class="btn btn-primary waves-effect w-full waves-light">Crear
                                    Rol</a>
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
                                        <th>Fecha Creación</th>
                                        <th>Acción</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($roles)
                                        @foreach ($roles as $rol)
                                            <tr>
                                                <th scope="row">{{ $rol->id }}</th>
                                                <td>{{ $rol->name }}</td>
                                                <td>{{ $rol->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('roles.edit', $rol->id) }}" type="button"
                                                        class="btn btn-success w-xs waves-effect waves-light d-inline-block"><i
                                                            class="mdi mdi-pencil d-block font-size-16"></i></a>
                                                    <form method="POST" action="{{ route('roles.destroy', $rol->id) }}"
                                                        class="d-inline-block"
                                                        onsubmit="return confirmRoleDelete(event, '{{ $rol->name }}');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger w-xs waves-effect waves-light"><i
                                                                class="mdi mdi-trash-can d-block font-size-16"></i> </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset



                                </tbody>
                            </table>
                            <br>
                            @isset($permissions)
                                <!-- Enlaces de paginación -->
                                {{ $permissions->links('pagination::bootstrap-5') }}
                            @endisset

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            function confirmRoleDelete(event, roleName) {
                event.preventDefault(); // Evita el envío inmediato del formulario

                Swal.fire({
                    title: '¿Eliminar Rol?',
                    text: `¿Está seguro de eliminar el rol "${roleName}"? Esta acción no se puede deshacer.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33', // Rojo para acciones destructivas
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    dangerMode: true, // Efecto adicional para acciones críticas
                    backdrop: `
                        rgba(220,53,69,0.4)
                        url("/images/alert-danger.png")
                        center top
                        no-repeat
                    `
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit(); // Envía el formulario si se confirma
                    }
                });

                return false;
            }
        </script>
    @endsection

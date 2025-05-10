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
                                <h4 class="card-title">Gestión de Permisos</h4>
                                <p class="card-title-desc">
                                    En esta sección puedes ver, crear, editar y eliminar Permisos.
                                </p>
                            </div>
                            <div class="col-md-2 ">
                                <a href="{{ route('permissions.create') }}" type="button"
                                    class="btn btn-primary waves-effect w-full waves-light">Crear
                                    Permiso</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show"
                                role="alert">
                                <i
                                    class="mdi mdi-check-all label-icon"></i><strong>Éxito</strong>-{{ Session::get('message') }}

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
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <th scope="row">{{ $permission->id }}</th>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->created_at }}</td>
                                            <td>
                                                <a href="{{ route('permissions.edit', $permission->id) }}" type="button"
                                                    class="btn btn-success w-xs waves-effect waves-light d-inline-block"><i
                                                        class="mdi mdi-pencil d-block font-size-16"></i></a>
                                                <form method="POST"
                                                    action="{{ route('permissions.destroy', $permission->id) }}"
                                                    class="d-inline-block"
                                                    onsubmit="return confirmDelete(event, '{{ $permission->name }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger w-xs waves-effect waves-light"><i
                                                            class="mdi mdi-trash-can d-block font-size-16"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            <br>
                            <!-- Enlaces de paginación -->
                            {{ $permissions->links('pagination::bootstrap-5') }}
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
            function confirmDelete(event, permissionName) {
                event.preventDefault(); // Previene el envío inmediato del formulario

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: `Esta seguro de eliminar el permiso ${permissionName}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, envía el formulario
                        event.target.submit();
                    }
                });

                return false; // Importante para evitar el envío del formulario
            }
        </script>
    @endsection

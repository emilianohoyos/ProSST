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
                                <a href="{{ route('register') }}" type="button"
                                    class="btn btn-primary waves-effect w-full waves-light">Crear
                                    Usuario</a>
                            </div>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show"
                            role="alert">
                            <i class="mdi mdi-check-all label-icon"></i><strong>Exito</strong>-{{ session('success') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Identificacion</th>
                                        <th>Correo</th>
                                        <th>Fecha Creacion</th>
                                        <th>Accion</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->identification }}</td>
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
                                                    class="d-inline-block form-delete"
                                                    data-name="{{ $user->first_name }} {{ $user->last_name }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-danger waves-effect btn-label waves-light btn-delete">
                                                        <i class="mdi mdi-trash-can label-icon"></i>Eliminar
                                                    </button>
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
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.btn-delete');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const form = this.closest('form');
                        const name = form.getAttribute('data-name');

                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: `¿Deseas eliminar el Usuario ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endsection

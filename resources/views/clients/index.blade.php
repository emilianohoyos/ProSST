@extends('layouts.master')
@section('title')
    Clientes
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Clientes
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Mis Clientes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <!-- table mb-0-->

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nit/Identificación</th>
                                        <th>Razón Social/Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>


                                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                                data-bs-placement="top" title="ver" data-bs-toggle="modal"
                                                data-bs-target=".bs-example-modal-lg">
                                                <i class="fa fa-eye font-size-16 "></i>
                                            </button>
                                            <button type="button" data-bs-placement="top" title="Editar"
                                                data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"
                                                class="btn btn-warning waves-effect waves-light">
                                                <i class="fa fa-pen font-size-16 "></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Eliminar" class="btn btn-danger waves-effect waves-light"
                                                onclick="confirmDelete(event)">
                                                <i class="fa fa-trash font-size-16 "></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>
                                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                                data-bs-placement="top" title="ver" data-bs-toggle="modal"
                                                data-bs-target=".bs-example-modal-lg">
                                                <i class="fa fa-eye font-size-16 "></i>
                                            </button>
                                            <button type="button" data-bs-placement="top" title="Editar"
                                                data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"
                                                class="btn btn-warning waves-effect waves-light">
                                                <i class="fa fa-pen font-size-16 "></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Eliminar" class="btn btn-danger waves-effect waves-light"
                                                onclick="confirmDelete(event)">
                                                <i class="fa fa-trash font-size-16 "></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>
                                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                                data-bs-placement="top" title="ver" data-bs-toggle="modal"
                                                data-bs-target=".bs-example-modal-lg">
                                                <i class="fa fa-eye font-size-16 "></i>
                                            </button>
                                            <button type="button" data-bs-placement="top" title="Editar"
                                                data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"
                                                class="btn btn-warning waves-effect waves-light">
                                                <i class="fa fa-pen font-size-16 "></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Eliminar" class="btn btn-danger waves-effect waves-light"
                                                onclick="confirmDelete(event)">
                                                <i class="fa fa-trash font-size-16 "></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Ver/editar Detalle Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('clients.form')
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    @endsection
    @section('scripts')
        <script>
            function confirmDelete(event) {
                // Previene la acción predeterminada del botón
                event.preventDefault();

                // Muestra una ventana de confirmación
                if (confirm("¿Desea eliminar este elemento?")) {
                    // Acción de eliminación aquí
                    console.log("Elemento eliminado");
                    // Aquí puedes agregar la lógica de eliminación
                } else {
                    console.log("Eliminación cancelada");
                }
            }
        </script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

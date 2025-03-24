@extends('layouts.master')
@section('title')
    Auditorias
@endsection
@section('css')

@endsection
@section('page-title')
    Auditorias
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Mis Auditorias</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table class="table mb-0" id="audits-table" class="table table-striped table-bordered dt-responsive nowrap">
                                <!-- table mb-0-->

                                <thead>
                                    <tr>
                                        <th>Paso</th>
                                        <th>Descripcion</th>
                                        <th>Total Preguntas</th>
                                        <th>Preguntas respondidas</th>
                                        <th>progreso</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
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
                        {{-- @include('clients.form') --}}
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

            $(document).ready(function() {
                $('#audits-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('audit.datatable.steps',['application_level'=>$application_level,'assessment_id'=>$assessment_id]) }}",
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'description', name: 'description' },
                        { data: 'total_questions', name: 'total_questions' },
                        { data: 'answered_questions', name: 'answered_questions' },
                        { data: 'progress', name: 'progress' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                    }
                });
            });
        </script>
        {{-- <script src="{{ URL::asset('build/js/app.js') }}"></script> --}}
    @endsection

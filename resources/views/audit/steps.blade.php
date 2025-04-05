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
                        <div id="footer-container" class="mt-3"></div>

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
                    ajax: 
                    {
                        url:"{{ route('audit.datatable.steps',['application_level'=>$application_level,'assessment_id'=>$assessment_id]) }}",
                        dataSrc: function(json) {
                        // Agregar el footer si está presente en la respuesta
                        if (json.footer) {
                            $('#footer-container').html(json.footer);
                        }
                        return json.data; // Devolver solo los datos de la tabla
                        }
                    },
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

            function finalizarAuditoria(auditoria_id) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Una vez finalizada, no podrás modificar esta auditoría.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, finalizar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("{{ route('audit.finalize') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ auditoria_id: auditoria_id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: "Finalizado",
                        text: "La auditoría ha sido finalizada correctamente.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = "{{ route('audit.index') }}"; // Redirige a audit.index
                    });
                } else {
                    Swal.fire("Error", "Hubo un problema al finalizar la auditoría.", "error");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire("Error", "Hubo un problema con la solicitud.", "error");
            });
        }
    });
}


        </script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

@extends('layouts.master')
@section('title')
    Planes de mejora PESV
@endsection
@section('css')
@endsection
@section('page-title')
    Mis Planes de mejora PESV
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Diligenciar Plan de mejora PESV</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0" id="improvement-table"
                                class="table table-striped table-bordered table-hover dt-responsive nowrap">
                                <!-- table mb-0-->
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Tipo de accion</th>
                                        <th>Desc. situacion detectada</th>
                                        <th>Analisis de causas</th>
                                        <th>Accion de mejora a emprender</th>
                                        <th>¿La Accion De Mejora Fue Eficaz?</th>
                                        <th>Estado de la accion </th>
                                        <th>Personas a las que se les comunicara la accion</th>
                                        <th>Mecanismo utilizado para difundir la accion </th>
                                        <th>Observacion</th>
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
        @include('improvement_plan.modal.edit')
    @endsection
    @section('scripts')
        <script>
            let table;
            const myModal = new bootstrap.Modal(document.getElementById('editModal'));
            $(document).ready(function() {
                table = $('#improvement-table').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    pageLength: 5,
                    fixedColumns: {
                        leftColumns: 2,
                        rightColumns: 1
                    },
                    ajax: "{{ route('improvement.details', ['assessment_id' => $assessment_id]) }}",
                    columns: [{
                            data: 'execution_date',
                            name: 'execution_date'
                        },
                        {
                            data: 'action_type',
                            name: 'action_type.name'
                        },
                        {
                            data: 'desc_detected_situation',
                            name: 'desc_detected_situation'
                        },
                        {
                            data: 'pesv_cause_improvement_plan',
                            name: 'pesv_cause_improvement_plan'
                        },
                        {
                            data: 'improvement_action',
                            name: 'improvement_action'
                        },
                        {
                            data: 'improvement_action_efficent',
                            name: 'improvement_action_efficent'
                        },
                        {
                            data: 'status_action',
                            name: 'status_action'
                        },
                        {
                            data: 'people_to_be_informed',
                            name: 'people_to_be_informed'
                        },

                        {
                            data: 'channel_diffusion_improvement_action',
                            name: 'channel_diffusion_improvement_action'
                        },
                        {
                            data: 'observation',
                            name: 'observation'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json'
                    }
                });

                $('#people_to_be_informed').select2({
                    placeholder: 'Seleccione las personas',
                    theme: 'bootstrap-5',
                    width: '100%',
                    dropdownParent: $(
                        '#editModal'
                    ) // Se indica el modal contenedor // para que ocupe todo el ancho del contenedor
                });

                $('#channel_diffusion_improvement_action').select2({
                    placeholder: 'Seleccione los Mecanismos',
                    theme: 'bootstrap-5',
                    width: '100%',
                    dropdownParent: $(
                        '#editModal'
                    ) // Se indica el modal contenedor // para que ocupe todo el ancho del contenedor
                });


            });

            function updateInfo(pesv_improvement_plan_answer_id) {
                fetch('/improvement-plan/' + pesv_improvement_plan_answer_id + '/edit')
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.data);
                        document.getElementById('pesv_improvement_plan_answer_id').value = pesv_improvement_plan_answer_id;
                        document.getElementById('execution_date').value = data.data[0].execution_date ?? '';
                        document.getElementById('action_type_id').value = data.data[0].action_type_id ?? null;
                        document.getElementById('desc_detected_situation').value = data.data[0].desc_detected_situation ??
                            null;
                        document.getElementById('pesv_cause_improvement_plan_id').value = data.data[0]
                            .pesv_cause_improvement_plan_id ?? '';
                        document.getElementById('improvement_action').value = data.data[0].improvement_action ?? null;
                        document.getElementById('improvement_action_id').value = data.data[0].improvement_action_id ?? '';
                        document.getElementById('status_action_id').value = data.data[0].status_action_id ?? '';

                        $('#people_to_be_informed').val(data.data[0].people_to_be_informed).trigger('change');
                        $('#channel_diffusion_improvement_action').val(data.data[0].channel_diffusion_improvement_action)
                            .trigger('change');

                        document.getElementById('observation').value = data.data[0].observation ?? '';

                        // document.getElementById('key_aspects').value = data.data.key_aspects ?? null;
                    });
                myModal.show();
            }

            function saveInfo() {
                event.preventDefault();
                let pesv_improvement_plan_answer_id = document.getElementById('pesv_improvement_plan_answer_id').value
                // const url = `/client/${client_user_id}`;
                const form = document.getElementById('editImprovementItemForm');
                const formData = new FormData(form);
                console.log(formData);
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Deseas guardar los datos?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, actualizar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/improvement-plan/${pesv_improvement_plan_answer_id}`, {
                                method: 'POST', // o 'PATCH'
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                },
                                body: formData
                            })

                            .then(response => response.json())
                            .then(data => {

                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "se ha actualizado Correctamente",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                table.ajax.reload(null, false);
                                myModal.hide();

                            })
                            .catch(error => console.error('Error:', error));
                    }
                })
            }
        </script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

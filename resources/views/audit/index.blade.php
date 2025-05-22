@extends('layouts.master')
@section('title')
    Auditoria y diagnóstico PESV
@endsection
@section('css')
@endsection
@section('page-title')
    Mis Auditoria y diagnóstico PESV
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Mis Auditoria y diagnóstico PESV</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="audits-table" class="table mb-0 table-striped table-bordered nowrap">
                                <!-- table mb-0-->

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Razón Social/Nombre</th>
                                        <th>Fecha de la auditoria</th>
                                        <th>Nivel</th>
                                        <th>Tipo Evaluacion</th>
                                        <th>Estado</th>
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
        @include('audit.modal.complement')
        @include('audit.modal.create_work_plan')
    @endsection
    @section('scripts')
        <script>
            const myModal = new bootstrap.Modal(document.getElementById('complementModal'));
            const createWorkPlanModal = new bootstrap.Modal(document.getElementById('createWorkPlanModal'));
            $(document).ready(function() {
                $('#audits-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('audit.datatable') }}",
                    columns: [{
                            data: 'assessment_id',
                            name: 'pesv_assesments.id'
                        },
                        {
                            data: 'client_name',
                            name: 'clients.name'
                        },
                        {
                            data: 'completed_at',
                            name: 'pesv_assesments.completed_at'
                        },
                        {
                            data: 'name_level',
                            name: 'application_levels.name_level'
                        },
                        {
                            data: 'assessment_types',
                            name: 'assessment_types'
                        },
                        {
                            data: 'state_name',
                            name: 'states.name'
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
            });

            function updateInfo(assessment_id) {
                fetch('/audit/' + assessment_id)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.data);

                        document.getElementById('assessment_id').value = assessment_id;
                        document.getElementById('participants').value = data.data.participants ?? null;
                        document.getElementById('key_aspects').value = data.data.key_aspects ?? null;
                    });
                myModal.show();
            }

            function saveComplementInfo() {
                event.preventDefault();
                let assessment_id = document.getElementById('assessment_id').value
                // const url = `/client/${client_user_id}`;
                const form = document.getElementById('ComplementInfoForm');
                const formData = new FormData(form);

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
                        fetch(`audit/${assessment_id}`, {
                                method: 'POST', // o 'PATCH'
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                },
                                body: formData
                            })

                            .then(response => response.json())
                            .then(data => {
                                console.log(data)
                                window.location.href = 'audit-inform/' + assessment_id;
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "se ha actualizado la auditoria y descargado el informe",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                myModal.hide();

                            })
                            .catch(error => console.error('Error:', error));
                    }
                })


            }

            function createWorkPlan(assessment_id) {

                document.getElementById('plan_assessment_id').value = assessment_id;
                createWorkPlanModal.show();
            }

            function saveWorkPlan() {
                event.preventDefault();
                let plan_assesment_id = document.getElementById('plan_assessment_id').value
                const form = document.getElementById('createWorkPlanForm');
                const formData = new FormData(form);
                console.log(formData);
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Deseas guardar los datos?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, Guardar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`work-plan-generate/${plan_assesment_id}`, {
                                method: 'POST', // o 'PATCH'
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                },
                                body: formData
                            })

                            .then(response => response.json())
                            .then(data => {
                                console.log(data)
                                if (data.status) {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "success",
                                        title: data.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                } else {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "error",
                                        title: data.message || 'Error al guardar',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }

                                createWorkPlanModal.hide();

                            })
                            .catch(error => console.error('Error:', error));
                    }
                })

            }
        </script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

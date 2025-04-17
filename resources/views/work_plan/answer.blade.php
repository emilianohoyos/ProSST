@extends('layouts.master')
@section('title')
    Planes de trabajo PESV
@endsection
@section('css')
    <style>
        #compliance-progress {
            transition: width 1s ease-in-out, background-color 0.5s ease;
        }

        #pesv-compliance-card {
            transition: border-color 0.5s ease;
        }
    </style>
@endsection
@section('page-title')
    Mis Planes de trabajo PESV
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Diligenciar Plan de trabajo PESV</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-success bg-opacity-10 border-success">
                                    <div class="card-body text-center">
                                        <h1 class="display-4 text-success" id="cumple-count">0</h1>
                                        <h5 class="text-success">Cumple</h5>
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar bg-success" id="cumple-progress" style="width: 0%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card bg-warning bg-opacity-10 border-warning">
                                    <div class="card-body text-center">
                                        <h1 class="display-4 text-warning" id="parcial-count">0</h1>
                                        <h5 class="text-warning">Cumple Parcialmente</h5>
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar bg-warning" id="parcial-progress" style="width: 0%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card bg-danger bg-opacity-10 border-danger">
                                    <div class="card-body text-center">
                                        <h1 class="display-4 text-danger" id="nocumple-count">0</h1>
                                        <h5 class="text-danger">No Cumple</h5>
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar bg-danger" id="nocumple-progress" style="width: 0%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="work-plan-table" class="table table-striped table-bordered table-hover  ">
                                <thead>
                                    <tr>
                                        <th rowspan="2">ACTIVIDAD</th>
                                        <th rowspan="2">RESPONSABLE</th>
                                        <th colspan="{{ count($mesesCronograma) }}" style="text-align: center;">CRONOGRAMA
                                        </th>
                                        <th colspan="3" style="text-align: center;">RECURSOS</th>
                                        <th rowspan="2">MODO DE VERIFICACIÓN</th>
                                        <th rowspan="2">SEG.</th>
                                        <th rowspan="2">Acciones</th>
                                    </tr>
                                    <tr>
                                        @foreach ($mesesCronograma as $mes)
                                            <th class="mes-header" title="{{ $mes['completo'] }}">{{ $mes['nombre'] }}</th>
                                        @endforeach
                                        <th>F</th>
                                        <th>E</th>
                                        <th>H</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Resumen de plan de trabajo</h4>
                    </div>
                    <div class="card-body">
                        <!-- Indicador principal de cumplimiento PESV -->
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card" id="pesv-compliance-card">
                                    <div class="card-body text-center py-4">
                                        <div class="mb-3">
                                            <i class="fas fa-check-circle fa-4x text-success d-none"
                                                id="compliant-icon"></i>
                                            <i class="fas fa-times-circle fa-4x text-danger d-none"
                                                id="noncompliant-icon"></i>
                                        </div>
                                        <h2 class="mb-3" id="compliance-title">Cargando...</h2>
                                        <div class="progress" style="height: 25px;">
                                            <div class="progress-bar" id="compliance-progress" role="progressbar"
                                                style="width: 0%"></div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <small>0%</small>
                                            <small id="current-percentage">0%</small>
                                            <small>100%</small>
                                        </div>
                                        <div class="mt-3">
                                            <span class="badge bg-light text-dark" id="compliance-detail">
                                                Evaluación en progreso...
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detalle de métricas -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Requisitos cumplidos</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h3 class="mb-0" id="compliant-count">0</h3>
                                                <small class="text-muted">de <span id="total-requirements">0</span>
                                                    requisitos</small>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-clipboard-check fa-2x text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Requisitos pendientes</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h3 class="mb-0" id="noncompliant-count">0</h3>
                                                <small class="text-muted">requisitos por atender</small>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('work_plan.modal.edit')
    @endsection
    @section('scripts')
        <script>
            let table;
            const myModal = new bootstrap.Modal(document.getElementById('editModal'));
            $(document).ready(function() {
                table = $('#work-plan-table').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    pageLength: 5,
                    fixedColumns: {
                        leftColumns: 2,
                        rightColumns: 1
                    },
                    ajax: "{{ route('work.plan.details', ['work_plan_id' => $work_plan_id]) }}",
                    columns: [{
                            data: 'activity',
                            name: 'activity'
                        },
                        {
                            data: 'responsible',
                            name: 'responsible'
                        },

                        {
                            data: 'month_1',
                            name: 'month_2'
                        },
                        {
                            data: 'month_2',
                            name: 'month_2'
                        },
                        {
                            data: 'month_3',
                            name: 'month_3'
                        },
                        {
                            data: 'month_4',
                            name: 'month_4'
                        },
                        {
                            data: 'month_5',
                            name: 'month_5'
                        },
                        {
                            data: 'month_6',
                            name: 'month_6'
                        },
                        {
                            data: 'month_7',
                            name: 'month_7'
                        },
                        {
                            data: 'month_8',
                            name: 'month_8'
                        },
                        {
                            data: 'month_9',
                            name: 'month_9'
                        },
                        {
                            data: 'month_10',
                            name: 'month_10'
                        },
                        {
                            data: 'month_11',
                            name: 'month_11'
                        },
                        {
                            data: 'month_12',
                            name: 'month_12'
                        },
                        {
                            data: 'resource_physical',
                            name: 'resource_physical'
                        },
                        {
                            data: 'resource_economic',
                            name: 'resource_economic'
                        },
                        {
                            data: 'resource_human',
                            name: 'resource_human'
                        },
                        {
                            data: 'verify_mode',
                            name: 'verify_mode'
                        },

                        {
                            data: 'follow_up',
                            name: 'follow_up'
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
                    },
                    initComplete: function() {
                        actualizarSemaforo()
                    },
                    drawCallback: function() {
                        actualizarSemaforo()
                    },
                });

                // $('#people_to_be_informed').select2({
                //     placeholder: 'Seleccione las personas',
                //     theme: 'bootstrap-5',
                //     width: '100%',
                //     dropdownParent: $(
                //         '#editModal'
                //     ) // Se indica el modal contenedor // para que ocupe todo el ancho del contenedor
                // });

                // $('#channel_diffusion_improvement_action').select2({
                //     placeholder: 'Seleccione los Mecanismos',
                //     theme: 'bootstrap-5',
                //     width: '100%',
                //     dropdownParent: $(
                //         '#editModal'
                //     ) // Se indica el modal contenedor // para que ocupe todo el ancho del contenedor
                // });


            });

            function updateInfo(work_plan_answer_id) {
                document.getElementById('editImprovementItemForm').reset();
                fetch('/work-plan/' + work_plan_answer_id + '/edit')
                    .then(response => response.json())
                    .then(data => {

                        document.getElementById('work_plan_answer_id').value = work_plan_answer_id;
                        document.getElementById('activity').value = data.data.activity ?? '';
                        document.getElementById('responsible').value = data.data.responsible ?? '';
                        for (let index = 1; index <= 12; index++) {
                            const checkbox = document.getElementById('month_' + index);
                            if (checkbox) {
                                // Accede a la propiedad dinámica del objeto data (ej: month_1, month_2, etc.)
                                checkbox.checked = data.data['month_' + index] || false;
                            }
                        }
                        const checkboxF = document.getElementById('resource_physical');
                        if (checkboxF) {

                            checkboxF.checked = data.data['resource_physical'] || false;
                        }
                        const checkboxE = document.getElementById('resource_economic');
                        if (checkboxE) {

                            checkboxE.checked = data.data['resource_economic'] || false;
                        }
                        const checkboxH = document.getElementById('resource_human');
                        if (checkboxH) {

                            checkboxH.checked = data.data['resource_human'] || false;
                        }

                        document.getElementById('verify_mode').value = data.data.verify_mode ?? '';
                        document.getElementById('follow_up').value = data.data.follow_up ?? '';

                    });
                myModal.show();
            }

            function saveInfo() {
                event.preventDefault();
                let work_plan_answer_id = document.getElementById('work_plan_answer_id').value
                // const url = `/client/${client_user_id}`;
                const form = document.getElementById('editImprovementItemForm');
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
                        fetch(`/work-plan/${work_plan_answer_id}`, {
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

            function actualizarSemaforo(work_plan_id) {
                // Estos datos vendrían de tu backend o de calcularlos en el frontend
                fetch("{{ route('work.plan.resume', ['work_plan_id' => $work_plan_id]) }}")
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.data);

                        // Actualizar números
                        $('#cumple-count').text(data.data.cumple);
                        $('#parcial-count').text(data.data.parcial);
                        $('#nocumple-count').text(data.data.noCumple);

                        // Actualizar barras de progreso (porcentaje)
                        $('#cumple-progress').css('width', (data.data.cumple / data.data.total * 100) + '%');
                        $('#parcial-progress').css('width', (data.data.parcial / data.data.total * 100) + '%');
                        $('#nocumple-progress').css('width', (data.data.noCumple / data.data.total * 100) + '%');
                        updatePESVCompliance(data.data.cumple, data.data.total)
                    });


            }

            function updatePESVCompliance(compliantCount, totalRequirements) {
                const percentage = Math.round((compliantCount / totalRequirements) * 100);
                const isCompliant = percentage >= 90;

                // Actualizar elementos visuales
                $('#current-percentage').text(percentage + '%');
                $('#compliance-progress').css('width', percentage + '%');
                $('#compliant-count').text(compliantCount);
                $('#noncompliant-count').text(totalRequirements - compliantCount);
                $('#total-requirements').text(totalRequirements);

                // Cambiar estilo según cumplimiento
                if (isCompliant) {
                    $('#compliance-title').text('¡Cumple con PESV!');
                    $('#compliance-progress').removeClass('bg-danger').addClass('bg-success');
                    $('#compliant-icon').removeClass('d-none');
                    $('#noncompliant-icon').addClass('d-none');
                    $('#pesv-compliance-card').removeClass('border-danger').addClass('border-success');
                    $('#compliance-detail').removeClass('bg-danger text-white').addClass('bg-success text-white')
                        .text('Cumple con el ' + percentage + '% de los requisitos PESV');
                } else {
                    $('#compliance-title').text('No cumple con PESV');
                    $('#compliance-progress').removeClass('bg-success').addClass('bg-danger');
                    $('#noncompliant-icon').removeClass('d-none');
                    $('#compliant-icon').addClass('d-none');
                    $('#pesv-compliance-card').removeClass('border-success').addClass('border-danger');
                    $('#compliance-detail').removeClass('bg-success text-white').addClass('bg-danger text-white')
                        .text('Falta el ' + (100 - percentage) + '% para cumplir con PESV');
                }
            }
        </script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

@extends('layouts.master')
@section('title')
    Evaluacion auditoria
@endsection
@section('css')
    <style>
        option[value="No aplica"] {
            color: gray;
        }

        option[value="0"] {
            color: red;
        }

        option[value="1"] {
            color: orange;
        }

        option[value="2"] {
            color: green;
        }
    </style>
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
    Evaluacion auditoria N° 1
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <form action="#">
                            <ul class="wizard-nav mb-5" style="display: none">
                                <li class="wizard-list-item">
                                    <div class="list-item">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Seller Details">
                                            <i class="bx bx-user-circle"></i>
                                        </div>
                                    </div>
                                </li>
                                <li class="wizard-list-item">
                                    <div class="list-item">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Company Document">
                                            <i class="bx bx-file"></i>
                                        </div>
                                    </div>
                                </li>

                                <li class="wizard-list-item">
                                    <div class="list-item">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Bank Details">
                                            <i class="bx bx-edit"></i>
                                        </div>
                                    </div>
                                </li>
                                <li class="wizard-list-item">
                                    <div class="list-item">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Bank Details">
                                            <i class="bx bx-edit"></i>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <!-- wizard-nav -->

                            <div class="wizard-tab">
                                <div class="text-center mb-4">
                                    <h5>Parte 1</h5>
                                    <p class="card-title-desc">Preguntas para evaluar el nivel general de la gestión del
                                        riesgo vial</p>
                                </div>
                                <div>
                                    <div class="row">
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿La Organización
                                                    se asegura de cumplir con los requisitos normativos aplicables al Plan
                                                    Estratégico de Seguridad Vial (PESV), demostrando conciencia sobre su
                                                    aplicabilidad y evidenciando interés por su cumplimiento?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿Se evidencia el
                                                    compromiso de la alta dirección en la definición , diseño e
                                                    implementacion del PESV de acuerdo a la misión y tamaño de la
                                                    organización?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿Se han
                                                    implementado acciones específicas para abordar las principales causas de
                                                    accidentes identificadas?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿Se priorizan las
                                                    medidas preventivas para evitar accidentes viales, emergencias y
                                                    enfermedades relacionadas
                                                    con la conducción?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿Se observa una
                                                    mejora en los indicadores de pérdida debido a los accidentes de
                                                    tráfico?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿Existen pruebas
                                                    de la participación de los trabajadores y contratistas en el diseño e
                                                    implementación del PESV?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿Se han
                                                    implementado estrategias para aumentar la conciencia sobre seguridad
                                                    vial y autocuidado entre los
                                                    empleados?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿Las auditorías
                                                    internas reflejan avances en la gestión del riesgo vial, pues las
                                                    recomendaciones, no
                                                    conformidades de otras evaluaciones han sido atendidas por la
                                                    Organización?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿Se evidencia
                                                    una integración entre el PESV y el Sistema de Gestión de Seguridad y
                                                    Salud en el Trabajo
                                                    (SGSST)?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿La
                                                    documentación del PESV se mantiene actualizada y se revisa
                                                    periódicamente?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿La estructura
                                                    documental del PESV está adaptada a las características específicas de
                                                    la Organización?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿Los requisitos
                                                    normativos que no aplican, son justificados por escrito?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">En caso de que
                                                    aplique, ¿Cada sede de trabajo con NIT diferente cuenta con evidencias
                                                    independientes de cumplimiento del PESV? </label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿Se presenta un
                                                    informe anual de implementación del PESV ante las autoridades
                                                    competentes? </label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿El diseño del
                                                    PESV sigue un enfoque sistemático basado en el ciclo PHVA (Planificar,
                                                    Hacer, Verificar, Actuar)?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">¿Se evidencian
                                                    nuevas propuestas o innovaciones que se presentan en el PESV y se
                                                    observan como un valor agregado?</label>

                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <select name="" class="form-control" id="">
                                                    <option value="No aplica">No aplica</option>
                                                    <option value="0">No cumple</option>
                                                    <option value="1">Cumple Párcialmente</option>
                                                    <option value="2">Cumple</option>
                                                </select>
                                            </div>
                                        </div><!-- end col -->
                                        <hr>


                                    </div><!-- end row -->


                                </div>

                            </div>
                            <!-- wizard-tab -->
                            <div class="wizard-tab">
                                <div>
                                    <div class="text-center mb-4">
                                        <h5>Paso 1</h5>
                                        <p class="card-title-desc">Líder del diseño e implementación del PESV.</p>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <h6> Paso 1. Líder del diseño e implementación del PESV.</h6>

                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿La
                                                        Organización tiene designada una persona para liderar el diseño e
                                                        implementación del PESV y articularlo con el SG-SST?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿El líder
                                                        designado es el responsable de completar el reporte de autogestión
                                                        anual y los resultados de la medición de los indicadores del
                                                        PESV?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿Están
                                                        claramente definidos los requisitos de competencia (conocimiento,
                                                        habilidad, experiencia) requeridas para ser líder del PESV?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>

                                        </div>
                                    </div><!-- end form -->
                                </div>
                            </div>
                            <!-- wizard-tab -->

                            <div class="wizard-tab">
                                <div>
                                    <div class="text-center mb-4">
                                        <h5>Paso 2</h5>
                                        <p class="card-title-desc">Comité de seguridad vial</p>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿El comité
                                                        de seguridad vial o el comité que haga sus veces está conformado,
                                                        mínimamente por 3 miembros designados por el nivel
                                                        directivo?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿El comité
                                                        incluye al líder del diseño e implementación del PESV?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿Existe
                                                        evidencia de los informes trimestrales de seguimiento del PESV
                                                        realizados por el Comité?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿Existe
                                                        evidencia de la definición y divulgación que el Comité realizó sobre
                                                        la visión, los objetivos y el alcance del PESV?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿Existe
                                                        evidencia de las reuniones realizadas por el Comité?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿Existe
                                                        evidencia de las actividades realizadas por el Comité para aportar a
                                                        la gestión del riesgo vial dentro de la organización?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿Existe
                                                        evidencia de un plan de trabajo claro y definido por parte del
                                                        Comité?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿Existe un
                                                        programa de capacitaciones para los integrantes del Comité?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿El comité
                                                        elabora informes periódicos que dan cuenta de las acciones
                                                        programadas, adelantadas y por ejecutar, analizando el impacto,
                                                        costo-beneficio y aporte en la generación de hábitos,
                                                        comportamientos y conductas favorables a la seguridad vial.?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿El comité
                                                        evalúa los requerimientos y la oferta disponible, frente a
                                                        proveedores y talleres para los procesos de diagnóstico,
                                                        mantenimiento preventivo y mantenimiento correctivo de los
                                                        vehículos?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                        </div>
                                    </div><!-- end form -->
                                </div>
                            </div>
                            <!-- wizard-tab -->

                            <div class="wizard-tab">
                                <div>
                                    <div class="text-center mb-4">
                                        <h5>Paso 3</h5>
                                        <p class="card-title-desc">Política de Seguridad Vial de la organización.</p>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿Se cuenta
                                                        con Política de Seguridad Vial documentada con alcance sobre los
                                                        desplazamientos laborales y los trayectos en itinere para los
                                                        colaboradores de la organización?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿La Política
                                                        de Seguridad Vial establece claramente el compromiso del nivel
                                                        directivo?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿La Política
                                                        de Seguridad Vial especifica acciones y estrategias concretas de
                                                        seguridad vial, que se traducen en objetivos claros de seguridad
                                                        vial?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿Incluye la
                                                        política un compromiso explícito con el cumplimiento de los
                                                        requisitos legales aplicables en materia de seguridad vial?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿Incluye la
                                                        política un compromiso explícito de mejora continua del
                                                        PESV?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿La política
                                                        es concisa, claramente redactada, fechada y firmada por el
                                                        representante legal de la organización?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">¿Existe
                                                        evidencia de la socialización de la política entre todos los niveles
                                                        de la organización?</label>

                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="mb-3">

                                                    <select name="" class="form-control" id="">
                                                        <option value="No aplica">No aplica</option>
                                                        <option value="0">No cumple</option>
                                                        <option value="1">Cumple Párcialmente</option>
                                                        <option value="2">Cumple</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- wizard-tab -->

                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" class="btn btn-primary w-sm" id="prevBtn"
                                    onclick="nextPrev(-1)">Anterior</button>
                                <button type="button" class="btn btn-primary w-sm ms-auto" id="nextBtn"
                                    onclick="nextPrev(1)">Siguiente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- datepicker js -->
        <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

        <!-- form wizard init -->
        <script src="{{ URL::asset('build/js/pages/form-wizard.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

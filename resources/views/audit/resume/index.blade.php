@extends('layouts.master')

@section('title')
    Resumen {{ $pesv_assesment->assessment_type }}
@endsection

@section('page-title')
    Resumen {{ $pesv_assesment->assessment_type }}
@endsection

@section('body')

    <body>
    @endsection

    @section('content')
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Basic Line Chart</h4>
                    </div>
                    <div class="card-body">
                        <div id="line_chart_basic" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Zoomable Timeseries</h4>
                    </div>
                    <div class="card-body">
                        <div id="line_chart_zoomable" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container">
            <h2 class="mb-4">Resumen {{ $pesv_assesment->assessment_type }} PESV</h2>

            <div class="card mb-4">
                <div class="card-header">Información General</div>
                <div class="card-body">
                    <p><strong>Cliente:</strong> {{ $pesv_assesment->client_name }}
                        ({{ $pesv_assesment->client_identification }})</p>
                    <p><strong>Representante:</strong> {{ $pesv_assesment->client_representative }}</p>
                    <p><strong>Sede:</strong> {{ $pesv_assesment->client_headquarters }}</p>
                    <p><strong>Nivel de Aplicación:</strong> {{ $pesv_assesment->application_level }}</p>
                    <p><strong>Fecha:</strong>{{ \Carbon\Carbon::parse($pesv_assesment->fecha_creacion)->format('d/m/Y') }}
                    </p>
                    <p><strong>Profesional:</strong> {{ $pesv_assesment->first_name }} {{ $pesv_assesment->last_name }}
                        ({{ $pesv_assesment->professional_card }})</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Nivel de Cumplimiento Promedio</div>
                <div class="card-body">
                    <h3>{{ $cumplimiento_promedio }}%</h3>
                    <div id="grafico_cumplimiento"></div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Resumen General</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Calificación</th>
                                <th>Cantidad</th>
                                <th>Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resumen_general as $item)
                                <tr>
                                    <td>{{ $item['calificacion'] }}</td>
                                    <td>{{ $item['cantidad'] }}</td>
                                    <td>{{ $item['porcentaje'] }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Desempeño por Pasos</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Paso</th>
                                <th>Cumple</th>
                                <th>Parcial</th>
                                <th>No Cumple</th>
                                <th>Evaluados</th>
                                <th>% Cumplimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($desempeno_pasos as $paso)
                                <tr>
                                    <td>{{ $paso->step_name }}</td>
                                    <td>{{ $paso->cumple_count }}</td>
                                    <td>{{ $paso->parcial_count }}</td>
                                    <td>{{ $paso->no_cumple_count }}</td>
                                    <td>{{ $paso->total_evaluados }}</td>
                                    <td>{{ $paso->porcentaje_cumplimiento }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/moment/min/moment.min.js') }}"></script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var options = {
                    chart: {
                        type: 'radialBar',
                        height: 350
                    },
                    series: [{{ $cumplimiento_promedio }}],
                    labels: ['Cumplimiento'],
                    colors: ['#28a745']
                };

                var chart = new ApexCharts(document.querySelector("#grafico_cumplimiento"), options);
                chart.render();
            });
        </script>
    @endsection

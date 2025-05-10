@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Dashboard
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-6">
                <div class="card h-100">
                    <div class="card-body pb-0">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-4">Auditorías</h5>
                            </div>
                            {{-- <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold">Sort By:</span>
                                        <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <div>
                            <div id="overview"
                                data-colors='["#e6ecf9", "#e6ecf9", "#e6ecf9","#e6ecf9", "#e6ecf9", "#e6ecf9","#e6ecf9","#e6ecf9","#e6ecf9","#1f58c7","#1f58c7", "#1f58c7"]'
                                class="apex-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="card-title mb-4 text-truncate">Estados de auditorías</h5>
                            </div>
                            {{-- <div class="flex-shrink-0 ms-2">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold">Sort By:</span> <span class="text-muted">Weekly<i
                                                class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <div id="saleing-categories" data-colors='["#0d6efd", "#0dcaf0 ","#198754"]' class="apex-charts"
                            dir="ltr"></div>

                        <div class="row mt-3 pt-1">
                            <div class="col-md-6">
                                <div class="px-2 mt-2">
                                    <div class="d-flex align-items-center mt-sm-0 mt-2">
                                        <i class="mdi mdi-circle font-size-10 text-primary"></i>
                                        <div class="flex-grow-1 ms-2 overflow-hidden">
                                            <p class="font-size-15 mb-1 text-truncate">Creado</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <span class="fw-bold">34.3%</span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mt-2">
                                        <i class="mdi mdi-circle font-size-10 text-info "></i>
                                        <div class="flex-grow-1 ms-2 overflow-hidden">
                                            <p class="font-size-15 mb-0 text-truncate">En Gestión</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <span class="fw-bold">25.7%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="px-2 mt-2">
                                    <div class="d-flex align-items-center mt-sm-0 mt-2">
                                        <i class="mdi mdi-circle font-size-10 text-success"></i>
                                        <div class="flex-grow-1 ms-2 overflow-hidden">
                                            <p class="font-size-15 mb-1 text-truncate">Finalizado</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <span class="fw-bold">18.6%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-soft-primary">
                                            <i class="bx bx-package font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">Auditorías</h6>
                                    </div>

                                    {{-- <div class="flex-shrink-0">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal text-muted font-size-22"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Yearly</a>
                                                <a class="dropdown-item" href="#">Monthly</a>
                                                <a class="dropdown-item" href="#">Weekly</a>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">10 </h4>
                                    <div class="d-flex mt-1 align-items-end overflow-hidden">
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-0 text-truncate">Total Auditoría</p>
                                        </div>
                                        {{-- <div class="flex-shrink-0">
                                            <div id="mini-3" data-colors='["#1f58c7"]' class="apex-charts"></div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-soft-primary">
                                            <i class="bx bx-rocket font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">Plan de mejora</h6>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">12</h4>
                                    <div class="d-flex mt-1 align-items-end overflow-hidden">
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-0 text-truncate">Total Plan de mejora</p>
                                        </div>
                                        {{-- <div class="flex-shrink-0">
                                            <div id="mini-4" data-colors='["#1f58c7"]' class="apex-charts"></div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-soft-primary">
                                            <i class="bx bx-check-shield font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">Diagnósticos</h6>
                                    </div>


                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">4<span
                                            class="text-success fw-medium font-size-13 align-middle"> </h4>
                                    <div class="d-flex mt-1 align-items-end overflow-hidden">
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-0 text-truncate">Total diagnosticos</p>
                                        </div>
                                        {{-- <div class="flex-shrink-0">
                                            <div id="mini-1" data-colors='["#1f58c7"]' class="apex-charts"></div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-soft-primary">
                                            <i class="bx bx-cart-alt font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">Plan de trabajo</h6>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">12 </h4>
                                    <div class="d-flex mt-1 align-items-end overflow-hidden">
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-0 text-truncate">Total Plan de trabajo</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Vector map-->
        <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>

        {{-- <script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script> --}}
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            /*
                                                                                                                                                                                                                                                                                                                                                        Template Name: webadmin - Admin & Dashboard Template
                                                                                                                                                                                                                                                                                                                                                        Author: Themesdesign
                                                                                                                                                                                                                                                                                                                                                        Website: https://Themesdesign.com/
                                                                                                                                                                                                                                                                                                                                                        Contact: Themesdesign@gmail.com
                                                                                                                                                                                                                                                                                                                                                        File: Dashboard Ecommerce
                                                                                                                                                                                                                                                                                                                                                        */



            // Chart Mini-1
            var barchartColors = getChartColorsArray("mini-1");
            var sparklineoptions1 = {
                series: [{
                    data: [12, 14, 2, 47, 42, 15, 47, 75, 65, 19, 14]
                }],
                chart: {
                    type: 'area',
                    width: 110,
                    height: 35,
                    sparkline: {
                        enabled: true
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        inverseColors: false,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [20, 100, 100, 100]
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                colors: barchartColors,
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function(seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            };

            var sparklinechart1 = new ApexCharts(document.querySelector("#mini-1"), sparklineoptions1);
            sparklinechart1.render();


            // Chart Mini-2
            var barchartColors = getChartColorsArray("mini-2");
            var sparklineoptions1 = {
                series: [{
                    data: [65, 14, 2, 47, 42, 15, 47, 75, 65, 19, 14]
                }],
                chart: {
                    type: 'area',
                    width: 110,
                    height: 35,
                    sparkline: {
                        enabled: true
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        inverseColors: false,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [20, 100, 100, 100]
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                colors: barchartColors,
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function(seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            };

            var sparklinechart1 = new ApexCharts(document.querySelector("#mini-2"), sparklineoptions1);
            sparklinechart1.render();

            // Chart Mini-3
            var barchartColors = getChartColorsArray("mini-3");
            var sparklineoptions1 = {
                series: [{
                    data: [12, 75, 2, 47, 42, 15, 47, 75, 65, 19, 14]
                }],
                chart: {
                    type: 'area',
                    width: 110,
                    height: 35,
                    sparkline: {
                        enabled: true
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        inverseColors: false,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [20, 100, 100, 100]
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                colors: barchartColors,
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function(seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            };

            var sparklinechart1 = new ApexCharts(document.querySelector("#mini-3"), sparklineoptions1);
            sparklinechart1.render();

            // Chart Mini-4
            var barchartColors = getChartColorsArray("mini-4");
            var sparklineoptions1 = {
                series: [{
                    data: [12, 14, 2, 47, 42, 15, 47, 75, 65, 19, 70]
                }],
                chart: {
                    type: 'area',
                    width: 110,
                    height: 35,
                    sparkline: {
                        enabled: true
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        inverseColors: false,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [20, 100, 100, 100]
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                colors: barchartColors,
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function(seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            };

            var sparklinechart1 = new ApexCharts(document.querySelector("#mini-4"), sparklineoptions1);
            sparklinechart1.render();


            //  Sales Statistics
            var barchartColors = getChartColorsArray("overview");
            var options = {
                series: [{
                    data: [4, 6, 10, 17, 15, 19, 23, 27, 29, 25, 32, 35]
                }],
                chart: {
                    toolbar: {
                        show: false,
                    },
                    height: 323,
                    type: 'bar',
                    events: {
                        click: function(chart, w, e) {}
                    }
                },

                plotOptions: {
                    bar: {
                        columnWidth: '80%',
                        distributed: true,
                        borderRadius: 8,

                    }
                },

                fill: {
                    opacity: 1,
                },

                stroke: {
                    show: false,
                },
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: false
                },
                colors: barchartColors,
                xaxis: {
                    categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                }
            };

            var chart = new ApexCharts(document.querySelector("#overview"), options);
            chart.render();


            // Diagrama de Barras

            var barchartColors = getChartColorsArray("saleing-categories");
            var options = {
                chart: {
                    height: 350,
                    type: 'donut',
                },
                series: [24, 18, 13],
                labels: ["Creado", "En gestión", "Finalizado"],
                colors: barchartColors,
                plotOptions: {
                    pie: {
                        startAngle: 25,
                        donut: {
                            size: '72%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Estados',
                                    fontSize: '22px',
                                    fontFamily: 'Montserrat,sans-serif',
                                    fontWeight: 600,
                                }
                            }
                        }
                    }
                },

                legend: {
                    show: false,
                    position: 'bottom',
                    horizontalAlign: 'center',
                    verticalAlign: 'middle',
                    floating: false,
                    fontSize: '14px',
                    offsetX: 0,

                },

                dataLabels: {
                    style: {
                        fontSize: '11px',
                        fontFamily: 'Montserrat,sans-serif',
                        fontWeight: 'bold',
                        colors: undefined
                    },

                    background: {
                        enabled: true,
                        foreColor: '#fff',
                        padding: 4,
                        borderRadius: 2,
                        borderWidth: 1,
                        borderColor: '#fff',
                        opacity: 1,
                    },
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        chart: {
                            height: 240
                        },
                        legend: {
                            show: false
                        },
                    }
                }]
            }

            var chart = new ApexCharts(
                document.querySelector("#saleing-categories"),
                options
            );

            chart.render();


            function getChartColorsArray(chartId) {
                if (document.getElementById(chartId) !== null) {
                    var colors = document.getElementById(chartId).getAttribute("data-colors");
                    colors = JSON.parse(colors);
                    return colors.map(function(value) {
                        var newValue = value.replace(" ", "");
                        if (newValue.indexOf("--") != -1) {
                            var color = getComputedStyle(document.documentElement).getPropertyValue(
                                newValue
                            );
                            if (color) return color;
                        } else {
                            return newValue;
                        }
                    });
                }
            }
        </script>
    @endsection

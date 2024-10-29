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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Crear Cliente</h4>
                    </div>
                    <div class="card-body">
                        @include('clients.form')
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>



        </div>
    @endsection
    @section('scripts')
    @endsection

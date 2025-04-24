@extends('layouts.master')
@section('title')
    Permisos
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Permisos
@endsection
@section('body')

    <body>
    @endsection
    @section('content')


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="card-title">Regisrar nuevo Permiso</h4>
                                <p class="card-title-desc">
                                    En esta seccion puedes registrar un nuevo permiso.
                                </p>
                            </div>
                            <div class="col-md-2 ">
                                <a href="{{ route('permissions.index') }}" type="button"
                                    class="btn btn-primary waves-effect w-full waves-light">Ver Permisos</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6">


                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-block-helper me-2"></i>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('permissions.store') }}">
                                @csrf
                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label">Nombre Permiso</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Ingrese el nombre de nuevo Permiso" id="name" name="name"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

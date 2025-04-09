@extends('layouts.master')

@section('title', 'Clientes')

@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-title', 'Clientes')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Registrar Cliente</h4>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Por favor corrige los siguientes errores:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('client.store') }}" class="auth-input">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="document_type_id" class="form-label">Tipo Documento <span
                                            class="text-danger">*</span></label>
                                    <select name="document_type_id" id="document_type_id" class="form-control">
                                        @foreach ($document_type as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="identification" class="form-label">Identificación <span
                                            class="text-danger">*</span></label>
                                    <input id="identification" type="text" name="identification"
                                        class="form-control @error('identification') is-invalid @enderror"
                                        value="{{ old('identification') }}" required placeholder="Ingrese Identificación">
                                    @error('identification')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre/Razón Social <span
                                            class="text-danger">*</span></label>
                                    <input id="name" type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        required placeholder="Ingrese nombres">
                                    @error('name')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="person_type_id" class="form-label">Tipo Persona <span
                                            class="text-danger">*</span></label>
                                    <select name="person_type_id" id="person_type_id" class="form-control">
                                        @foreach ($person_type as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo <span
                                            class="text-danger">*</span></label>
                                    <input id="email" type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required placeholder="Ingrese Correo">
                                    @error('email')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="headquarters" class="form-label">Sede <span
                                            class="text-danger">*</span></label>
                                    <input name="headquarters" id="headquarters" type="text" class="form-control"
                                        placeholder="Ingrese Sede" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="representative" class="form-label">Representante <span
                                            class="text-danger">*</span></label>
                                    <input id="representative" type="text" name="representative"
                                        class="form-control @error('representative') is-invalid @enderror"
                                        value="{{ old('representative') }}" required placeholder="Ingrese Representante">
                                    @error('representative')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary w-100" type="submit">Crear</button>
                        </div>
                    </form>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

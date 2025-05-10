@extends('layouts.master')
@section('title')
    Auditoria y diagnóstico PESV
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Auditoria y diagnóstico PESV
@endsection
@section('body')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Crear Evaluacion PESV</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('audit.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="assessment_type_id" class="form-label">Tipo De Evaluacion</label>
                                    <select name="assessment_type_id"
                                        class="form-control @error('assessment_type_id') is-invalid @enderror"
                                        id="assessment_type_id">
                                        @foreach ($assessment_types as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('assessment_type_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="client_id" class="form-label">Cliente</label>
                                    <select name="client_id" class="form-control @error('client_id') is-invalid @enderror"
                                        id="client_id">
                                        @foreach ($users as $item)
                                            <option value="{{ $item->client_id }}"
                                                {{ old('client_id') == $item->client_id ? 'selected' : '' }}>
                                                Identificacion: {{ $item->identification }}-Razón Social:
                                                {{ $item->name }}-Sede:{{ $item->headquarters }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="completed_at" class="form-label">Fecha de realización</label>
                                    <input type="date" class="form-control @error('completed_at') is-invalid @enderror"
                                        placeholder="Ingrese Fecha de realización" name="completed_at" id="completed_at"
                                        value="{{ old('completed_at') }}">
                                    @error('completed_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="number_vehicles" class="form-label">Número de vehículos</label>
                                    <input type="number"
                                        class="form-control @error('number_vehicles') is-invalid @enderror"
                                        placeholder="Ingrese el número de vehículos" id="number_vehicles"
                                        name="number_vehicles" value="{{ old('number_vehicles') }}">
                                    @error('number_vehicles')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="application_level_id" class="form-label">Nivel del PESV Aplicar</label>
                                    <select name="application_level_id"
                                        class="form-control @error('application_level_id') is-invalid @enderror"
                                        id="application_level_id">
                                        @foreach ($levels as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('application_level_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name_level }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('application_level_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit"
                                    class="btn btn-primary btn-lg waves-effect waves-light">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>



    </div>
@endsection
@endsection
@section('scripts')
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
@if (session('status'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const status = "{{ session('status') }}";
        const messages = {
            success: {
                title: '¡Éxito!',
                text: 'Operación realizada correctamente',
                icon: 'success'
            },
            error: {
                title: '¡Error!',
                text: 'Ocurrió un problema',
                icon: 'error'
            },
            warning: {
                title: 'Advertencia',
                text: 'Complete todos los campos',
                icon: 'warning'
            }
        };

        if (messages[status]) {
            Swal.fire({
                title: messages[status].title,
                text: messages[status].text,
                icon: messages[status].icon,
                confirmButtonText: 'Aceptar',
                timer: 3000 // Cierra automáticamente después de 3 segundos
            });
        }
    });
</script>
@endif

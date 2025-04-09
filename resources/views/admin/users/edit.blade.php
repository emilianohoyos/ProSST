@extends('layouts.master')
@section('title')
    Editar Perfil
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Editar Perfil
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Editar Perfil</h4>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show"
                            role="alert">
                            <i class="mdi mdi-check-all label-icon"></i><strong>Exito</strong>-{{ session('success') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}" class="auth-input">
                            @csrf
                            @method('PUT') <!-- Esto es esencial para indicar que es un update -->
                            <div class="row">
                                <div class="col md-6">
                                    <div class="mb-3">
                                        <label for="document_type_id" class="form-label">Tipo Documento<span
                                                class="text-danger">*</span></label>
                                        <select name="document_type_id" id="document_type_id" class="form-control">
                                            @foreach ($document_type as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $user->document_type_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Identificacion <span
                                                class="text-danger">*</span></label>
                                        <input id="name" type="text"
                                            class="form-control @error('identification') is-invalid @enderror"
                                            name="identification" value="{{ old('identification', $user->identification) }}"
                                            required autocomplete="identification" autofocus
                                            placeholder="Ingrese Identificacion ">
                                        @error('identification')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">Ingrese nombres <span
                                                class="text-danger">*</span></label>
                                        <input id="first_name" type="text"
                                            class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                            value="{{ old('first_name', $user->first_name) }}" required
                                            autocomplete="first_name" autofocus placeholder="Ingrese nombres">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Ingrese apellidos <span
                                                class="text-danger">*</span></label>
                                        <input id="last_name" type="text"
                                            class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                            value="{{ old('last_name', $user->last_name) }}" required
                                            autocomplete="last_name" autofocus placeholder="Ingrese nombres">
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col md-6">
                                    <div class="mb-3">
                                        <label for="person_type_id" class="form-label">Tipo persona<span
                                                class="text-danger">*</span></label>
                                        <select name="person_type_id" id="person_type_id" class="form-control">
                                            @foreach ($person_type as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $user->person_type_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Correo<span
                                            class="text-danger">*</span></label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', $user->email) }}" required autocomplete="email"
                                        placeholder="Ingrese Correo">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cellphone" class="form-label">Celular <span
                                                class="text-danger">*</span></label>
                                        <input id="cellphone" type="text"
                                            class="form-control @error('cellphone') is-invalid @enderror" name="cellphone"
                                            value="{{ old('cellphone', $user->cellphone) }}" required
                                            autocomplete="cellphone" autofocus placeholder="Ingrese Celular ">
                                        @error('cellphone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="professional_card" class="form-label">Numero tarjeta
                                            profesional<span class="text-danger">*</span></label>
                                        <input id="professional_card" type="professional_card"
                                            class="form-control @error('professional_card') is-invalid @enderror"
                                            name="professional_card"
                                            value="{{ old('professional_card', $user->professional_card) }}" required
                                            autocomplete="professional_card" placeholder="Ingrese tarjeta profesonal">
                                        @error('professional_card')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="row">



                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="department" class="form-label">Departamento
                                            <span class="text-danger">*</span></label>
                                        <select name="department" id="department" class="form-control">
                                            <option value="Antioquia"
                                                {{ $user->department == 'Antioquia' ? 'selected' : '' }}>Antioquia</option>
                                            <option value="Cundinamarca"
                                                {{ $user->department == 'Cundinamarca' ? 'selected' : '' }}>Cundinamarca
                                            </option>
                                            <option value="Amazonas"
                                                {{ $user->department == 'Amazonas' ? 'selected' : '' }}>Amazonas</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Ciudad
                                            <span class="text-danger">*</span></label>
                                        <select name="city" id="city" class="form-control">
                                            <option value="Medellin"
                                                {{ $user->department == 'Medellin' ? 'selected' : '' }}>Medellin</option>
                                            <option value="Bello" {{ $user->department == 'Bello' ? 'selected' : '' }}>
                                                Bello</option>
                                            <option value="Itagui" {{ $user->department == 'Itagui' ? 'selected' : '' }}>
                                                Itagui</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Barrio <span
                                                class="text-danger">*</span></label>
                                        <input id="neighborhood" type="text"
                                            class="form-control @error('neighborhood') is-invalid @enderror"
                                            name="neighborhood" value="{{ old('neighborhood', $user->neighborhood) }}"
                                            required autocomplete="neighborhood" autofocus placeholder="Ingrese Barrio">
                                        @error('neighborhood')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Dirección<span
                                                class="text-danger">*</span></label>
                                        <input id="address" type="text"
                                            class="form-control @error('address') is-invalid @enderror" name="address"
                                            value="{{ old('address', $user->address) }}" required
                                            placeholder="Ingrese dirección">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>




                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Contraseña <span
                                                class="text-danger">*</span></label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            id="password-input" placeholder="Ingrese la contraseña">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="password-confirm">Confirm
                                            Password <span class="text-danger">*</span></label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password_confirmation" id="password-confirm"
                                            placeholder="Confirme contraseña">
                                    </div>
                                </div>
                            </div>



                            <div class="mt-4">
                                <button class="btn btn-primary w-100" type="submit">Actualizar</button>
                            </div>




                            {{-- <div class="mt-4 text-center">
                                <p class="mb-0">Tiene una Cuenta? <a href="{{ route('login') }}"
                                        class="fw-medium text-primary"> Inicio de sesion</a></p>
                            </div> --}}
                        </form>
                    </div>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
            <div class="col-xl-12">
                <div class="card mt-4">
                    <div class="card-header bg-danger text-white rounded-0 rounded-top">
                        <h4 class="card-title mb-0">Eliminar Cuenta</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Si eliminas tu cuenta, no podrás recuperar la información asociada.</p>
                        <form id="delete-account-form" method="POST" action="{{ route('users.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger rounded-pill" id="delete-account-btn">
                                <i class="mdi mdi-delete-outline"></i> Eliminar Cuenta
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            document.getElementById('delete-account-btn').addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Esta acción eliminará tu cuenta de forma permanente!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, eliminar cuenta',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-account-form').submit();
                    }
                });
            });
        </script>
    @endsection

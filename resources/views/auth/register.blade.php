@extends('layouts.master-without-nav')
@section('title')
    Registro
@endsection
@section('page-title')
    Registro
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="authentication-bg min-vh-100">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-12 col-lg-12 col-xl-12">

                            <div class="mb-4 pb-2">
                                <a href="index" class="d-block auth-logo">
                                    <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="30"
                                        class="auth-logo-dark me-start">
                                    <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="30"
                                        class="auth-logo-light me-start">
                                </a>
                            </div>

                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                        <h5>Registro Usuario</h5>

                                    </div>
                                    <div class="p-2 mt-4">
                                        <form method="POST" action="{{ route('register') }}" class="auth-input">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Identificacion <span
                                                                class="text-danger">*</span></label>
                                                        <input id="name" type="text"
                                                            class="form-control @error('identification') is-invalid @enderror"
                                                            name="identification" value="{{ old('identification') }}"
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
                                                        <label for="name" class="form-label">Ingrese Nombres <span
                                                                class="text-danger">*</span></label>
                                                        <input id="name" type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" value="{{ old('name') }}" required
                                                            autocomplete="name" autofocus placeholder="Ingrese nombres">
                                                        @error('name')
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
                                                        <label for="name" class="form-label">Celular <span
                                                                class="text-danger">*</span></label>
                                                        <input id="name" type="text"
                                                            class="form-control @error('cellphone') is-invalid @enderror"
                                                            name="cellphone" value="{{ old('cellphone') }}" required
                                                            autocomplete="cellphone" autofocus
                                                            placeholder="Ingrese Celular ">
                                                        @error('Telefono')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Fecha Nacimiento<span
                                                                class="text-danger">*</span></label>
                                                        <input id="birth_date" type="date"
                                                            class="form-control @error('birth_date') is-invalid @enderror"
                                                            name="birth_date" value="{{ old('birth_date') }}" required
                                                            autocomplete="birth_date" autofocus
                                                            placeholder="Ingrese Fecha nacimiento">
                                                        @error('birth_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Correo<span
                                                            class="text-danger">*</span></label>
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email" placeholder="Ingrese Correo">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Numero tarjeta
                                                            profesional<span class="text-danger">*</span></label>
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}" required
                                                            autocomplete="email" placeholder="Ingrese Correo">
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Departamento
                                                            <span class="text-danger">*</span></label>
                                                        <select name="department" id="department" class="form-control">
                                                            <option value="Antioquia">Antioquia</option>
                                                            <option value="Antioquia">Cundinamarca</option>
                                                            <option value="Antioquia">Amazonas</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Ciudad
                                                            <span class="text-danger">*</span></label>
                                                        <select name="city" id="city" class="form-control">
                                                            <option value="Medellin">Medellin</option>
                                                            <option value="Bello">Bello</option>
                                                            <option value="Itagui">Itagui</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Barrio <span
                                                                class="text-danger">*</span></label>
                                                        <input id="neighborhood" type="text"
                                                            class="form-control @error('neighborhood') is-invalid @enderror"
                                                            name="neighborhood" value="{{ old('neighborhood') }}"
                                                            required autocomplete="neighborhood" autofocus
                                                            placeholder="Ingrese Barrio">
                                                        @error('neighborhood')
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
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" required id="password-input"
                                                            placeholder="Ingrese la contraseña">
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
                                                            name="password_confirmation" required id="password-confirm"
                                                            placeholder="Confirme contraseña">
                                                    </div>
                                                </div>
                                            </div>



                                            <div>
                                                <p class="mb-0">Al registrar acepta nuestros terminos y condiciones
                                                    <a href="#" class="text-primary">Terminos y Condiciones</a>
                                                </p>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Registrar</button>
                                            </div>




                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Tiene una Cuenta? <a href="{{ route('login') }}"
                                                        class="fw-medium text-primary"> Inicio de sesion</a></p>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center p-4">
                                <p>©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script> webadmin. Crafted with <i
                                        class="mdi mdi-heart text-danger"></i> by Themesdesign
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- end container -->
        </div>
        <!-- end authentication section -->
    @endsection
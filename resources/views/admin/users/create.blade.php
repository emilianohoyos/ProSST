@extends('layouts.master')
@section('title')
    Crear Usuario
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Crear Usuario
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Registrar usuario</h4>
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
                        <form method="POST" action="{{ route('register') }}" id="user-form" class="auth-input">
                            @csrf
                            <div class="row">
                                <div class="col md-6">
                                    <div class="mb-3">
                                        <label for="document_type_id" class="form-label">Tipo Documento<span
                                                class="text-danger">*</span></label>
                                        <select name="document_type_id" id="document_type_id" class="form-control">
                                            @foreach ($document_type as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Identificacion <span
                                                class="text-danger">*</span></label>
                                        <input id="identification" type="text"
                                            class="form-control @error('identification') is-invalid @enderror"
                                            name="identification" value="{{ old('identification') }}" required
                                            autocomplete="identification" autofocus placeholder="Ingrese Identificacion ">
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
                                            value="{{ old('first_name') }}" required autocomplete="first_name" autofocus
                                            placeholder="Ingrese nombres">
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
                                            value="{{ old('last_name') }}" required autocomplete="last_name" autofocus
                                            placeholder="Ingrese Apellidos">
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
                                                <option value="{{ $item->id }}">{{ $item->name }}
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
                                        value="{{ old('email') }}" required autocomplete="email"
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
                                            value="{{ old('cellphone') }}" required autocomplete="cellphone" autofocus
                                            placeholder="Ingrese Celular ">
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
                                            name="professional_card" value="{{ old('professional_card') }}" required
                                            autocomplete="professional_card"
                                            placeholder="Ingrese Numero tarjeta profesional">
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
                                            <option value="Antioquia">Antioquia</option>
                                            <option value="Antioquia">Cundinamarca</option>
                                            <option value="Antioquia">Amazonas</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">Ciudad
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
                                            name="neighborhood" value="{{ old('neighborhood') }}" required
                                            autocomplete="neighborhood" autofocus placeholder="Ingrese Barrio">
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
                                            value="{{ old('address') }}" required placeholder="Ingrese dirección">
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
                                            required id="password-input" placeholder="Ingrese la contraseña">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="password_confirmation">Confirm
                                            Password <span class="text-danger">*</span></label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" required id="password_confirmation"
                                            placeholder="Confirme contraseña">
                                    </div>
                                </div>
                            </div>



                            {{-- <div>
                                <p class="mb-0">Al registrar acepta nuestros terminos y condiciones
                                    <a href="#" class="text-primary">Terminos y Condiciones</a>
                                </p>
                            </div> --}}

                            <div class="mt-4">
                                <button class="btn btn-primary w-100" type="submit">Crear</button>
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
        </div>
        <!-- end col -->
    @endsection
    @section('scripts')
        <script>
            const validation = new JustValidate('#user-form', {
                validateBeforeSubmitting: true,
                errorFieldCssClass: 'is-invalid',
                errorLabelStyle: {
                    color: '#dc3545',
                    fontSize: '0.875em',
                },
            });

            validation
                .addField('#document_type_id', [{
                    rule: 'required',
                    errorMessage: 'Seleccione un tipo de documento',
                }])
                .addField('#identification', [{
                        rule: 'required',
                        errorMessage: 'Ingrese el número de documento',
                    },
                    {
                        rule: 'customRegexp',
                        value: /^\d+$/, // Solo números (0-9)
                        errorMessage: 'Solo se permiten números (0-9)',
                    },
                    {
                        rule: 'maxLength',
                        value: 191,
                        errorMessage: 'Máximo 191 caracteres',
                    }
                ])
                .addField('#first_name', [{
                        rule: 'required',
                        errorMessage: 'Ingrese su nombre',
                    },
                    {
                        rule: 'maxLength',
                        value: 191,
                        errorMessage: 'Máximo 191 caracteres',
                    }
                ])
                .addField('#last_name', [{
                        rule: 'required',
                        errorMessage: 'Ingrese su apellido',
                    },
                    {
                        rule: 'maxLength',
                        value: 191,
                        errorMessage: 'Máximo 191 caracteres',
                    }
                ])
                .addField('#email', [{
                        rule: 'required',
                        errorMessage: 'Ingrese un correo',
                    },
                    {
                        rule: 'email',
                        errorMessage: 'Correo inválido',
                    },
                    {
                        rule: 'maxLength',
                        value: 191,
                        errorMessage: 'Máximo 191 caracteres',
                    }
                ])
                .addField('#cellphone', [{
                        rule: 'required',
                        errorMessage: 'Ingrese su celular',
                    },
                    {
                        rule: 'customRegexp',
                        value: /^\d{10}$/,
                        errorMessage: 'Debe tener  10 dígitos',
                    },
                    {
                        rule: 'maxLength',
                        value: 191,
                        errorMessage: 'Máximo 191 caracteres',
                    }
                ])
                .addField('#professional_card', [{
                        rule: 'required',
                        errorMessage: 'Ingrese la tarjeta profesional',
                    },
                    {
                        rule: 'maxLength',
                        value: 191,
                        errorMessage: 'Máximo 191 caracteres',
                    }
                ])
                .addField('#department', [{
                        rule: 'required',
                        errorMessage: 'Seleccione un Departamento',
                    },
                    {
                        rule: 'maxLength',
                        value: 191,
                        errorMessage: 'Máximo 191 caracteres',
                    }
                ])
                .addField('#city', [{
                        rule: 'required',
                        errorMessage: 'Seleccione una ciudad',
                    },
                    {
                        rule: 'maxLength',
                        value: 191,
                        errorMessage: 'Máximo 191 caracteres',
                    }
                ])
                .addField('#neighborhood', [{
                        rule: 'required',
                        errorMessage: 'Ingrese el barrio',
                    },
                    {
                        rule: 'maxLength',
                        value: 191,
                        errorMessage: 'Máximo 191 caracteres',
                    }
                ])
                .addField('#address', [{
                        rule: 'required',
                        errorMessage: 'Ingrese la dirección',
                    },
                    {
                        rule: 'maxLength',
                        value: 191,
                        errorMessage: 'Máximo 191 caracteres',
                    }
                ])
                .addField('#password-input', [{
                        rule: 'required',
                        errorMessage: 'La contraseña es obligatoria',
                    },
                    {
                        rule: 'minLength',
                        value: 8,
                        errorMessage: 'Mínimo 8 caracteres',
                    },
                    {
                        rule: 'maxLength',
                        value: 191,
                        errorMessage: 'Máximo 191 caracteres',
                    },
                    {
                        rule: 'customRegexp',
                        value: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/,
                        errorMessage: 'Debe tener: 8+ caracteres, 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial',
                    },
                ])
                .addField('#password_confirmation', [{
                        validator: (value, fields) => {
                            return value === fields['#password-input'].elem.value;
                        },
                        errorMessage: 'Las contraseñas no coinciden',
                    },

                ]).onSuccess(() => {
                    document.getElementById('user-form').submit();
                });;
        </script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

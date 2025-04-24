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
                                    @if ($errors->any())
                                        <div style="color: red;">
                                            <strong>Por favor corrige los siguientes errores:</strong>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="p-2 mt-4">
                                        <form method="POST" action="{{ route('register') }}" id="user-form"
                                            class="auth-input">
                                            @csrf
                                            <div class="row">
                                                <div class="col md-6">
                                                    <div class="mb-3">
                                                        <label for="document_type_id" class="form-label">Tipo Documento<span
                                                                class="text-danger">*</span></label>
                                                        <select name="document_type_id" id="document_type_id"
                                                            class="form-control">
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
                                                        <label for="first_name" class="form-label">Ingrese nombres <span
                                                                class="text-danger">*</span></label>
                                                        <input id="first_name" type="text"
                                                            class="form-control @error('first_name') is-invalid @enderror"
                                                            name="first_name" value="{{ old('first_name') }}" required
                                                            autocomplete="first_name" autofocus
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
                                                            class="form-control @error('last_name') is-invalid @enderror"
                                                            name="last_name" value="{{ old('last_name') }}" required
                                                            autocomplete="last_name" autofocus
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
                                                        <select name="person_type_id" id="person_type_id"
                                                            class="form-control">
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
                                                        <label for="cellphone" class="form-label">Celular <span
                                                                class="text-danger">*</span></label>
                                                        <input id="cellphone" type="text"
                                                            class="form-control @error('cellphone') is-invalid @enderror"
                                                            name="cellphone" value="{{ old('cellphone') }}" required
                                                            autocomplete="cellphone" autofocus
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
                                                            name="professional_card"
                                                            value="{{ old('professional_card') }}" required
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
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Dirección<span
                                                                class="text-danger">*</span></label>
                                                        <input id="address" type="text"
                                                            class="form-control @error('address') is-invalid @enderror"
                                                            name="address" value="{{ old('address') }}" required
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
                                                        <label class="form-label" for="password">Contraseña <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" required id="password" autocomplete="false"
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
                                                        <label class="form-label" for="password_confirmation">Confirm
                                                            Password <span class="text-danger">*</span></label>
                                                        <input type="password"
                                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                                            name="password_confirmation" required
                                                            id="password_confirmation" placeholder="Confirme contraseña"
                                                            autocomplete="false">
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
                            </div>

                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center p-4">
                                <p>©<span id="year-container"></span>
                                    <script>
                                        document.getElementById("year-container").textContent = new Date().getFullYear();
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
                        value: 10,
                        errorMessage: 'Máximo 10 números',
                    }
                ])
                .addField('#first_name', [{
                        rule: 'required',
                        errorMessage: 'Ingrese su nombre',
                    }, {
                        rule: 'customRegexp',
                        value: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/,
                        errorMessage: 'Solo se permiten letras y espacios',
                    },
                    {
                        rule: 'maxLength',
                        value: 20,
                        errorMessage: 'Máximo 20 caracteres',
                    }
                ])
                .addField('#last_name', [{
                        rule: 'required',
                        errorMessage: 'Ingrese su apellido',
                    }, {
                        rule: 'customRegexp',
                        value: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/,
                        errorMessage: 'Solo se permiten letras y espacios',
                    },
                    {
                        rule: 'maxLength',
                        value: 20,
                        errorMessage: 'Máximo 20 caracteres',
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
                        value: 50,
                        errorMessage: 'Máximo 50 caracteres',
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
                        value: 20,
                        errorMessage: 'Máximo 20 caracteres',
                    }
                ])
                .addField('#professional_card', [{
                        rule: 'required',
                        errorMessage: 'Ingrese la tarjeta profesional',
                    },
                    {
                        rule: 'maxLength',
                        value: 20,
                        errorMessage: 'Máximo 20 caracteres',
                    }
                ])
                .addField('#department', [{
                        rule: 'required',
                        errorMessage: 'Seleccione un Departamento',
                    },
                    {
                        rule: 'maxLength',
                        value: 20,
                        errorMessage: 'Máximo 20 caracteres',
                    }
                ])
                .addField('#city', [{
                        rule: 'required',
                        errorMessage: 'Seleccione una ciudad',
                    },
                    {
                        rule: 'maxLength',
                        value: 20,
                        errorMessage: 'Máximo 20 caracteres',
                    }
                ])
                .addField('#neighborhood', [{
                        rule: 'required',
                        errorMessage: 'Ingrese el barrio',
                    },
                    {
                        rule: 'maxLength',
                        value: 20,
                        errorMessage: 'Máximo 20 caracteres',
                    }
                ])
                .addField('#address', [{
                        rule: 'required',
                        errorMessage: 'Ingrese la dirección',
                    },
                    {
                        rule: 'maxLength',
                        value: 100,
                        errorMessage: 'Máximo 100 caracteres',
                    }
                ])
                .addField('#password', [{
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
                        value: 20,
                        errorMessage: 'Máximo 20 caracteres',
                    },
                    {
                        rule: 'customRegexp',
                        value: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/,
                        errorMessage: 'Debe tener: 8+ caracteres, 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial',
                    },
                ])
                .addField('#password_confirmation', [{
                        validator: (value, fields) => {
                            return value === fields['#password'].elem.value;
                        },
                        errorMessage: 'Las contraseñas no coinciden',
                    },

                ])
                .onSuccess(() => {
                    document.getElementById('user-form').submit();
                });;
        </script>
    @endsection

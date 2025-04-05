@extends('layouts.master')
@section('title')
    Editar Usuario
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Editar Usuario
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Editar Datos de usuario</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" class="auth-input">
                        @csrf

                        <div class="row">
                            <div class="col md-6">
                                <div class="mb-3">
                                    <label for="document_type_id" class="form-label">Tipo Documento<span
                                            class="text-danger">*</span></label>
                                    <select name="document_type_id" id="document_type_id" class="form-control">
                                        @foreach ($document_type as $item)
                                            <option value="{{ $item->id }}" {{ $user->document_type_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
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
                                        name="identification" value="{{ old('identification', $user->identification) }}" required
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
                                        value="{{ old('first_name', $user->first_name) }}" required autocomplete="first_name" autofocus
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
                                        value="{{ old('last_name',$user->last_name) }}" required autocomplete="last_name" autofocus
                                        placeholder="Ingrese nombres">
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
                                            <option value="{{ $item->id }}" {{ $user->person_type_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Correo<span class="text-danger">*</span></label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email',$user->email) }}" required autocomplete="email" placeholder="Ingrese Correo">
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
                                        value="{{ old('cellphone', $user->cellphone) }}" required autocomplete="cellphone" autofocus
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
                                        name="professional_card" value="{{ old('professional_card', $user->professional_card) }}" required
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
                                        <option value="Antioquia" {{ $user->department == "Antioquia" ? 'selected' : '' }}>Antioquia</option>
                                        <option value="Cundinamarca" {{ $user->department == "Cundinamarca" ? 'selected' : '' }}>Cundinamarca</option>
                                        <option value="Amazonas" {{ $user->department == "Amazonas" ? 'selected' : '' }}>Amazonas</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Ciudad
                                        <span class="text-danger">*</span></label>
                                    <select name="city" id="city" class="form-control">
                                        <option value="Medellin" {{ $user->department == "Medellin" ? 'selected' : '' }}>Medellin</option>
                                        <option value="Bello" {{ $user->department == "Bello" ? 'selected' : '' }}>Bello</option>
                                        <option value="Itagui" {{ $user->department == "Itagui" ? 'selected' : '' }}>Itagui</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Barrio <span
                                            class="text-danger">*</span></label>
                                    <input id="neighborhood" type="text"
                                        class="form-control @error('neighborhood') is-invalid @enderror"
                                        name="neighborhood" value="{{ old('neighborhood', $user->neighborhood) }}" required
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
                                        value="{{ old('address', $user->address) }}" required placeholder="Ingrese dirección">
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
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required id="password-input" placeholder="Ingrese la contraseña">
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
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password_confirmation" required id="password-confirm"
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
    </div>
    <!-- end col -->

    <!-- roles -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Roles Asignados al Usuario: {{ $user->name }}.</h4>
                            <p class="card-title-desc">
                                En esta seccion puedes Ver los Roles Asociados al Usuario: {{ $user->name }}.
                            </p>
                        </div>
                        {{-- <div class="col-md-2 ">
                            <a href="{{ route('admin.roles.index') }}" type="button"
                                class="btn btn-primary waves-effect w-full waves-light">Ver Roles
                                Rol</a>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @if (Session::has('message-success'))
                            <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show"
                                role="alert">
                                <i
                                    class="mdi mdi-check-all label-icon"></i><strong>Exito</strong>-{{ Session::get('message-success') }}

                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (Session::has('message'))
                            <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show"
                                role="alert">
                                <i
                                    class="mdi mdi-block-helper label-icon"></i><strong>Error</strong>-{{ Session::get('message') }}

                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @forelse ($user->getRoleNames() as $user_role)
                            <form method="POST" action="{{ route('users.roles.remove', [$user->id, $user_role]) }}"
                                class="d-inline-block"
                                onsubmit="return confirm('Esta Seguro De Remover el Rol {{ $user_role }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-xs waves-effect waves-light">
                                    {{ $user_role }}<i
                                        class="mdi mdi-trash-can  font-size-16 d-inline-block"></i></button>
                            </form>

                        @empty
                            <span>No hay permisos asignados</span>
                        @endforelse

                    </div>

                    <div class="col-md-12 mt-5">
                        <form method="POST" action="{{ route('users.roles.assign', [$user->id]) }}">
                            @csrf
                            <div class="row mb-4">
                                <label for="name" class="col-sm-3 col-form-label">Rol</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="role" name="role">
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Asignar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--end  roles -->
    <!--  permission -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Permiso Asignados al usuario: {{ $user->name }}.</h4>
                            <p class="card-title-desc">
                                En esta seccion puedes Ver los permisos Asociados al Usuario: {{ $user->name }}.
                            </p>
                        </div>
                        {{-- <div class="col-md-2 ">
                            <a href="{{ route('admin.roles.index') }}" type="button"
                                class="btn btn-primary waves-effect w-full waves-light">Ver Roles
                                Rol</a>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @if (Session::has('message-success'))
                            <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show"
                                role="alert">
                                <i
                                    class="mdi mdi-check-all label-icon"></i><strong>Exito</strong>-{{ Session::get('message-success') }}

                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (Session::has('message'))
                            <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show"
                                role="alert">
                                <i
                                    class="mdi mdi-block-helper label-icon"></i><strong>Error</strong>-{{ Session::get('message') }}

                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @forelse ($user->permissions as $user_permission)
                            <form method="POST"
                                action="{{ route('users.permissions.revoke', [$user->id, $user_permission->name]) }}"
                                class="d-inline-block"
                                onsubmit="return confirm('Esta Seguro De Remover el permiso {{ $user_permission->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-xs waves-effect waves-light">
                                    {{ $user_permission->name }}<i
                                        class="mdi mdi-trash-can  font-size-16 d-inline-block"></i></button>
                            </form>

                        @empty
                            <span>No hay permisos asignados</span>
                        @endforelse

                    </div>

                    <div class="col-md-12 mt-5">
                        <form method="POST" action="{{ route('users.permissions.give', $user->id) }}">
                            @csrf
                            <div class="row mb-4">
                                <label for="name" class="col-sm-3 col-form-label">Permiso</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="permission" name="permission">
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Asignar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--end  permission -->
@endsection
@section('scripts')
    <!-- App js -->
    {{-- <script src="{{ URL::asset('build/js/app.js') }}"></script> --}}
    <script>
        var deparments = [];
        var repet = [];
        fetch('/build/js/deparmentsandcities.json').then(data => data.json()).then(data => {
            deparments = data;
            @isset($user)
                document.querySelector("#department").innerHTML =
                    ' <option value="{{ $user->department }}">{{ $user->department }}</option>';
            @endisset

            deparments?.map(e => {
                if (!repet.find(i => i.departamento == e.departamento)) {
                    document.querySelector("#department").insertAdjacentHTML('beforeend',
                        `<option value="${e.departamento}">${e.departamento}</"option">`);
                    repet.push(e);
                }
            });
        });

        function selectDeparment() {
            document.querySelector("#city").innerHTML = '<option value="">Seleccione</option>';
            deparments?.map(e => {
                if (e.departamento == document.querySelector("#department").value) {
                    document.querySelector("#city").insertAdjacentHTML('beforeend',
                        `<option value="${e.municipio}">${e.municipio}</"option">`);
                }
            });
        }
    </script>
@endsection

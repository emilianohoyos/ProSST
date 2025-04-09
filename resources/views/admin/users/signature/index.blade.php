@extends('layouts.master')
@section('title')
    Usuarios
@endsection
@section('css')
@endsection
@section('page-title')
    Usuarios
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
                                <h4 class="card-title">Gestión de Firma</h4>
                                <p class="card-title-desc">
                                    En esta seccion puedes ver,crear, actualizar tu firma.
                                </p>
                            </div>

                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show"
                            role="alert">
                            <i class="mdi mdi-check-all label-icon"></i><strong>Exito</strong>-{{ session('success') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.updateSignature', $user->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="sign" class="form-label">Firma</label><br>

                                @if ($user->sign_path)
                                    <img src="{{ asset('storage/' . $user->sign_path) }}" alt="Firma del usuario"
                                        class="img-thumbnail mb-2" style="max-width: 200px;">
                                @else
                                    <p class="text-muted">No hay firma registrada.</p>
                                @endif

                                <input class="form-control" type="file" id="sign" name="sign" accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar Firma</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

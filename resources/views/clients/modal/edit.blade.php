<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Ver/editar Detalle Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editClientForm" onsubmit="return false;" class="auth-input">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="client_user_id" id="client_user_id">
                    <input type="hidden" name="client_id" id="client_id">
                    <div class="row">
                        <div class="col md-6">
                            <div class="mb-3">
                                <label for="document_type_id" class="form-label">Tipo
                                    Documento<span class="text-danger">*</span></label>
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

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Ingrese nombre/Razón
                                    social <span class="text-danger">*</span></label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" id="name" required autocomplete="name" autofocus
                                    placeholder="Ingrese nombres">
                                @error('name')
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
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo<span class="text-danger">*</span></label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" placeholder="Ingrese Correo">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col md-6">
                            <div class="mb-3">
                                <label for="headquarters" class="form-label">Sede<span
                                        class="text-danger">*</span></label>
                                <input name="headquarters" id="headquarters" type="text" class="form-control"
                                    placeholder="Ingrese Sede" />
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label for="representative" class="form-label">Representante<span
                                    class="text-danger">*</span></label>
                            <input id="representative" type="representative"
                                class="form-control @error('representative') is-invalid @enderror"
                                name="representative" value="{{ old('representative') }}" required
                                placeholder="Ingrese Representante">
                            @error('representative')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary " type="button" onclick="actualizarDatos()">Editar</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

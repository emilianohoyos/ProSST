<div class="modal fade" id="complementModal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Complementar Informacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="ComplementInfoForm" onsubmit="return false;" class="auth-input">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="assessment_id" id="assessment_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="participants" class="form-label">Participantes<span
                                        class="text-danger">*</span></label>
                                <textarea id="participants" class="form-control @error('participants') is-invalid @enderror" name="participants"
                                    required autofocus rows="3">{{ old('participants') }}</textarea>
                                @error('participants')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="key_aspects" class="form-label">Aspectos a Resaltar<span
                                        class="text-danger">*</span></label>
                                <textarea id="key_aspects" class="form-control @error('key_aspects') is-invalid @enderror" name="key_aspects" required
                                    autofocus rows="3">{{ old('key_aspects') }}</textarea>
                                @error('key_aspects')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary " type="button" onclick="saveComplementInfo()">Guardar y Descargar
                    Acta</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

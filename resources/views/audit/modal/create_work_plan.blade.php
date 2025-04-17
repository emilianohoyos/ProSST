<div class="modal fade" id="createWorkPlanModal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Crear plan de trabajo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createWorkPlanForm" onsubmit="return false;" class="auth-input">
                    @csrf

                    <input type="hidden" name="plan_assessment_id" id="plan_assessment_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Fecha Inicio<span
                                        class="text-danger">*</span></label>
                                <input id="start_date" class="form-control @error('start_date') is-invalid @enderror"
                                    name="start_date" required autofocus type="date"
                                    value="{{ old('start_date') }}" />
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="preparation_date" class="form-label">Fecha Elaboracion<span
                                        class="text-danger">*</span></label>
                                <input id="preparation_date"
                                    class="form-control @error('preparation_date') is-invalid @enderror"
                                    name="preparation_date" required autofocus type="date"
                                    value="{{ old('preparation_date') }}" />
                                @error('preparation_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name_president_committee" class="form-label">Nombre del presidente del
                                    comité<span class="text-danger">*</span></label>
                                <input id="name_president_committee"
                                    class="form-control @error('name_president_committee') is-invalid @enderror"
                                    name="name_president_committee" required autofocus type="text"
                                    value="{{ old('name_president_committee') }}" />
                                @error('name_president_committee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="reviewed_by" class="form-label">Nombre de quien revisa<span
                                        class="text-danger">*</span></label>
                                <input id="reviewed_by" class="form-control @error('reviewed_by') is-invalid @enderror"
                                    name="reviewed_by" required autofocus type="text"
                                    value="{{ old('reviewed_by') }}" />
                                @error('reviewed_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="approved_by" class="form-label">Nombre de quien Aprueba<span
                                        class="text-danger">*</span></label>
                                <input id="approved_by" class="form-control @error('approved_by') is-invalid @enderror"
                                    name="approved_by" required autofocus type="text"
                                    value="{{ old('approved_by') }}" />
                                @error('approved_by')
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
                <button class="btn btn-primary " type="button" onclick="saveWorkPlan()">Crear
                    Plan</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

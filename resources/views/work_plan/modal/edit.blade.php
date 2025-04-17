<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Editar Detalle Plan de trabajo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editImprovementItemForm" onsubmit="return false;" class="auth-input">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="work_plan_answer_id" id="work_plan_answer_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="activity" class="form-label">
                                    Actividad<span class="text-danger">*</span>
                                </label>
                                <textarea id="activity" class="form-control @error('activity') is-invalid @enderror" name="activity" disable>{{ old('activity') }}</textarea>
                                @error('activity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="responsible" class="form-label">
                                    Responsable<span class="text-danger">*</span>
                                </label>
                                <textarea id="responsible" class="form-control @error('responsible') is-invalid @enderror" name="responsible" disabled>{{ old('responsible') }}</textarea>
                                @error('responsible')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="responsible" class="form-label">
                                    Meses de ejecucion de la actividad<span class="text-danger">*</span>
                                </label>
                                <div class="table-responsive">
                                    <table id="work-plan-table"
                                        class="table table-striped table-bordered table-hover  ">
                                        <thead>
                                            <tr>

                                                <th colspan="{{ count($mesesCronograma) }}" style="text-align: center;">
                                                    CRONOGRAMA
                                                </th>
                                            </tr>
                                            <tr>
                                                @foreach ($mesesCronograma as $mes)
                                                    <th class="mes-header" title="{{ $mes['completo'] }}">
                                                        {{ $mes['nombre'] }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <td class="text-center align-middle">
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input month-checkbox"
                                                                type="checkbox" id="month_{{ $i }}"
                                                                name="month_{{ $i }}"
                                                                data-month="{{ $i }}"
                                                                style="width: 1.5em; height: 1.5em; cursor: pointer;">
                                                            <label class="form-check-label d-none"
                                                                for="month_{{ $i }}">Mes
                                                                {{ $i }}</label>
                                                        </div>
                                                    </td>
                                                @endfor
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="responsible" class="form-label">
                                    Recursos Necesarios<span class="text-danger">*</span>
                                </label>
                                <div class="table-responsive">
                                    <table id="work-plan-table"
                                        class="table table-striped table-bordered table-hover  ">
                                        <thead>
                                            <tr>

                                                <th colspan="3" style="text-align: center;">
                                                    RECURSOS
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">FISICOS</th>
                                                <th class="text-center">ECONOMICOS</th>
                                                <th class="text-center">HUMANOS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input month-checkbox" type="checkbox"
                                                            id="resource_physical" name="resource_physical"
                                                            style="width: 1.5em; height: 1.5em; cursor: pointer;">
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input month-checkbox" type="checkbox"
                                                            id="resource_economic" name="resource_economic"
                                                            style="width: 1.5em; height: 1.5em; cursor: pointer;">
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input month-checkbox" type="checkbox"
                                                            id="resource_human" name="resource_human"
                                                            style="width: 1.5em; height: 1.5em; cursor: pointer;">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="verify_mode" class="form-label">
                                    Modo de verificacion<span class="text-danger">*</span>
                                </label>
                                <textarea id="verify_mode" class="form-control @error('verify_mode') is-invalid @enderror" name="verify_mode"
                                    disabled>{{ old('verify_mode') }}</textarea>
                                @error('verify_mode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="follow_up" class="form-label">Seleccione el Seguimiento<span
                                        class="text-danger">*</span></label>
                                <select name="follow_up" id="follow_up" class="form-control">
                                    <option value="">Seleccione una Opcion</option>
                                    <option value="NO CUMPLE">NO CUMPLE</option>
                                    <option value="CUMPLE PARCIALMENTE">CUMPLE PARCIALMENTE</option>
                                    <option value="CUMPLE">CUMPLE</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary " type="button" onclick="saveInfo()">Editar</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

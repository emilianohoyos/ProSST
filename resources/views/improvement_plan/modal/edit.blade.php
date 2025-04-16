<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Editar Detalle Mejora</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editImprovementItemForm" onsubmit="return false;" class="auth-input">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="pesv_improvement_plan_answer_id" id="pesv_improvement_plan_answer_id">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="execution_date" class="form-label">Fecha<span
                                    class="text-danger">*</span></label>
                            <input id="execution_date" type="date"
                                class="form-control @error('execution_date') is-invalid @enderror" name="execution_date"
                                value="{{ old('execution_date') }}" required>
                            @error('execution_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="action_type_id" class="form-label">Tipo
                                    Acción<span class="text-danger">*</span></label>
                                <select name="action_type_id" id="action_type_id" class="form-control">
                                    @foreach ($action_types as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="desc_detected_situation" class="form-label">
                                    Descripcion de la
                                    situación
                                    detectada <span class="text-danger">*</span>
                                </label>
                                <textarea id="desc_detected_situation" class="form-control @error('desc_detected_situation') is-invalid @enderror"
                                    name="desc_detected_situation" disabled placeholder="Ingrese Identificación">{{ old('desc_detected_situation') }}</textarea>
                                @error('desc_detected_situation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="pesv_cause_improvement_plan_id" class="form-label">Analisis de Causa<span
                                        class="text-danger">*</span></label>
                                <select name="pesv_cause_improvement_plan_id" id="pesv_cause_improvement_plan_id"
                                    class="form-control">
                                    <option value="">Seleccione una Opción</option>
                                    @foreach ($pesv_cause_improvement_plans as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="improvement_action" class="form-label">
                                    Accion de Mejora a Emprender<span class="text-danger">*</span>
                                </label>
                                <textarea id="improvement_action" class="form-control @error('improvement_action') is-invalid @enderror"
                                    name="improvement_action" disabled placeholder="Ingrese Identificación">{{ old('improvement_action') }}</textarea>
                                @error('improvement_action')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="improvement_action_id" class="form-label">¿La Acción de mejora fue
                                    eficaz?<span class="text-danger">*</span></label>
                                <select name="improvement_action_id" id="improvement_action_id" class="form-control">
                                    <option value="">Seleccione una Opción</option>
                                    @foreach ($improvementActions as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status_action_id" class="form-label">Estado de la acción<span
                                        class="text-danger">*</span></label>
                                <select name="status_action_id" id="status_action_id" class="form-control">
                                    <option value="">Seleccione una Opción</option>
                                    @foreach ($statusActions as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="people_to_be_informed" class="form-label">
                                    Personas a las que se les comunicará la acción <span class="text-danger">*</span>
                                </label>
                                <select name="people_to_be_informed[]" id="people_to_be_informed"
                                    class="form-control" multiple>
                                    @foreach ($personasInformar as $item)
                                        <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="channel_diffusion_improvement_action" class="form-label">
                                    mecanismo utilizado paar difundir la acción de mejora<span
                                        class="text-danger">*</span>
                                </label>
                                <select name="channel_diffusion_improvement_action[]"
                                    id="channel_diffusion_improvement_action" class="form-control" multiple>
                                    @foreach ($canalesDifusion as $item)
                                        <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="observation" class="form-label">
                                    Observación<span class="text-danger">*</span>
                                </label>
                                <textarea id="observation" class="form-control @error('observation') is-invalid @enderror" name="observation"
                                    placeholder="Ingrese Identificación">{{ old('observation') }}</textarea>
                                @error('observation')
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
                <button class="btn btn-primary " type="button" onclick="saveInfo()">Editar</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

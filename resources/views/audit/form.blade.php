<form>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nit" class="form-label">Cliente</label>
                <select name="client_id" class="form-control" id="client_id">
                    @foreach ($users as $item)
                    <option value="{{ $item->client_id }}">{{$item->name}}</option>
                    @endforeach
                </select>
             </div>
        </div>
    

        <div class="col-md-6">
            <div class="mb-3">
                <label for="nit" class="form-label">Fecha de realización </label>
                <input type="date" class="form-control" placeholder="Ingrese Fecha de realización" id="nit">
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-3">
                <label for="number_vehicles" class="form-label">Numero de vehiculos</label>
                <input type="number" class="form-control" placeholder="Ingrese Fecha de realización" id="number_vehicles">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="application_level_id" class="form-label">Nivel del PESV Aplicar</label>
                <select name="application_level_id" class="form-control" id="application_level_id">
                    @foreach ($levels as $item)
                    <option value="{{ $item->client_id }}">{{$item->name_level}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-grid gap-2">
            <button type="button" class="btn btn-primary btn-lg waves-effect waves-light">Guardar</button>
        </div>

    </div>




</form>

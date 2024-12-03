<div class="mb-3">
    <label for="projectName" class="form-label">Nombre del Proyecto</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa el nombre del proyecto" value="{{ old('name', $project->name) }}">
</div>

<!-- Cliente -->
<div class="mb-3">
  <label for="client" class="form-label">Cliente</label>
  <div class="input-group">
    <!-- Campo oculto para enviar el ID del cliente -->
    @if(Route::currentRouteName() == 'project.create')
    <input type="hidden" id="client_id" name="client_id" value="{{ old('client_id', $project->client_id) }}">
    <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Selecciona un cliente" readonly value="{{ old('client_name', $project->client->organization->name ?? '') }}">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clientModal">
          <i class="bi bi-search"></i> Buscar Cliente
      </button>
    @else
      <label for="#">{{ $project->client->organization->name}}</label>
    @endif
  </div>
</div>

<!-- Fecha de Inicio y Fin -->
<div class="row mb-4">
  <div class="col-md-6">
      <label for="start_date" class="form-label">Fecha de Inicio</label>
      <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $project->start_date) }}">
  </div>
  <div class="col-md-6">
      <label for="end_date" class="form-label">Fecha de Fin</label>
      <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $project->end_date) }}">
  </div>
</div>

<!-- Costo del Proyecto -->
<div class="row mb-3">
  <div class="col-md-4">
    <label for="subtotal" class="form-label">Subtotal</label>
    <div class="input-group">
      <span class="input-group-text">$</span>
      <input type="number" class="form-control" id="subtotal" name="subtotal" placeholder="0.00" step="0.01" min="0" oninput="limitDecimals(this)" value="{{ old('subtotal', $project->subtotal) }}">
    </div>
  </div>
  <div class="col-md-8">
    <label for="concept" class="form-label">Concepto</label>
    <input type="text" class="form-control" id="concept" name="concept" value="{{ old('concept', $project->concept) }}" placeholder="Ingresa el concepto">
  </div>
  <div class="col-md-4">
    <label for="status" class="form-label">Estado</label>
    <select class="form-select" id="status" name="status">
      <option value="a" {{ old('status', $project->status) == 'a' ? 'selected' : '' }}>Activo</option>
      <option value="i" {{ old('status', $project->status) == 'i' ? 'selected' : '' }}>Inactivo</option>
      <option value="t" {{ old('status', $project->status) == 't' ? 'selected' : '' }}>Terminado</option>
    </select>
  </div>
</div>

<!-- Comentarios-->
<div class="mb-3">
    <label for="projectDescription" class="form-label">Comentarios</label>
    <textarea class="form-control" id="comments" name="comments" rows="3" placeholder="Comentarios/Notas">{{ old('comments', $project->comments) }}</textarea>
</div>

<!-- Botones -->
<div class="row">
  <div class="col-md-6">
    <button type="submit" class="btn btn-primary w-100">Guardar Proyecto</button>
  </div>
  <div class="col-md-6">
    <a href="{{ route('project.index') }}" class="btn btn-secondary w-100">Cancelar</a>
  </div>
</div>
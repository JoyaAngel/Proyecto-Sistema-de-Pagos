<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <!-- Card principal -->
      <div class="card shadow-sm">
        <div class="card-header text-center bg-primary text-white">
            <h4>Registro de Proyecto</h4>
        </div>
        <div class="card-body">
          <form action="{{route('project.store')}}" method="POST">
            @csrf
            <!-- Nombre del Proyecto -->
            <div class="mb-3">
                <label for="projectName" class="form-label">Nombre del Proyecto</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa el nombre del proyecto" value="{{ old('name', $project->name) }}">
            </div>

            <!-- Cliente -->
            <div class="mb-3">
              <label for="client" class="form-label">Cliente</label>
              <div class="input-group">
                <input type="text" class="form-control" id="cliente_id" name="cliente_id" placeholder="Selecciona un cliente" readonly value="{{ old('client_id', $project->client_id)}}">
                
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clientModal">
                    <i class="bi bi-search"></i> Buscar Cliente
                </button>
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
                <select class="form-select" id="concept" name="concept">
                  <option value="" selected disabled>Selecciona un concepto</option>
                  <option value="1" {{ old('concept', $project->concept) == '1' ? 'selected' : '' }}>Opción 1</option>
                  <option value="2" {{ old('concept', $project->concept) == '2' ? 'selected' : '' }}>Opción 2</option>
                  <option value="3" {{ old('concept', $project->concept) == '3' ? 'selected' : '' }}>Opción 3</option>
                </select>
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
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal para Buscar Cliente -->
<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="clientModalLabel">Seleccionar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody id="clientTableBody">
              @foreach ($clients as $client)
                <tr>
                  <td>{{ $client->id }}</td>
                  <td>{{ $client->organization->name }}</td>
                  <td>
                    <button type="button" class="btn btn-primary select-client"
                            data-id="{{ $client->id }}"
                            data-name="{{ $client->organization->name }}">
                      Seleccionar
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectButtons = document.querySelectorAll('.select-client');
        
        selectButtons.forEach(button => {
            button.addEventListener('click', function() {
                var clientId = this.getAttribute('data-id');

                document.getElementById('client_id').value = clientId;

                // Cerrar el modal
                var modalElement = document.getElementById('clientModal');
                var modal = new bootstrap.Modal(modalElement);
                modal.hide();  // Cierra el modal
            });
        });
    });
</script>

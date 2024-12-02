@extends('layouts.app')

@section('content')

<!-- Mensaje de éxito al agregar proveedores-->
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>¡Éxito!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if(session('warning'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Advertencia!</strong> {{ session('warning') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

  </div>
  <div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="display-4"><i class="fas fa-building"></i> Projects Overview</h1>
      @if (Auth::user()->type === 'a')

        <a href="{{ route('project.create') }}" class="btn btn-outline-secondary btn-lg">
            <i class="fas fa-plus-circle"></i> New Project
        </a>
      @endif
  </div>
    


  <!-- Filtros -->
  <div class="row my-4">
    <div class="col-lg-6">
      <div class="btn-group" role="group" aria-label="Filtros de proyecto">
        <a href="#" 
          class="btn btn-outline-primary">
            Proyectos Activos
        </a>
        <a href="#" 
           class="btn btn-outline-secondary">
          Proyectos Terminados
        </a>
        <a href="#" 
           class="btn btn-outline-dark">
          Todos
        </a>
      </div>
    </div>
  </div>

  <!-- Tabla de Proyectos -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">List</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Client</th>
                  <th>Status</th>
                  <th>Beginning</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($projects as $project)
                  <!-- Modal para Asignar Proveedores -->
                  <div class="modal fade" id="assignSupplierModal" tabindex="-1" aria-labelledby="assignSupplierModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                          <h5 class="modal-title" id="assignSupplierModalLabel">Asignar Proveedor</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('project.assign.supplier', $project) }}" method="POST">
                          @csrf
                          <div class="modal-body">
                            <input type="hidden" id="modalProjectId" name="project_id">
                            <p>Asignar proveedores al proyecto: <strong id="modalProjectName"></strong></p>
                            <div class="form-group">
                              <label for="suppliers" class="form-label">Proveedores</label>
                              <select class="form-select" id="suppliers" name="supplier_ids[]" multiple>
                                @foreach($suppliers as $supplier)
                                  <option value="{{ $supplier->id }}">{{ $supplier->organization->name }}</option>
                                @endforeach
                              </select>
                              <small class="text-muted">Mantén presionada la tecla <strong>Ctrl</strong> (o <strong>Cmd</strong> en Mac) para seleccionar múltiples proveedores.</small>
                            </div>
                           <!-- Campo para el monto a asignar -->
                            <div class="form-group mt-3">
                              <label for="service_cost" class="form-label">Cantidad a Pagar</label>
                              <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="service_cost" name="service_cost" required min="0" step="0.01">
                              </div>
                              <small class="text-muted">Ingresa la cantidad total a pagar que se asignará a los proveedores seleccionados.</small>
                            </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Asignar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->client->organization->name ?? 'N/A' }}</td>
                    <td>
                      <span class="badge 
                        {{ $project->status === 'a' ? 'bg-success' : ($project->status === 'i' ? 'bg-warning' : 'bg-secondary') }}">
                        {{ $project->status === 'a' ? 'Activo' : ($project->status === 'i' ? 'Inactivo' : 'Terminado') }}

                      </span>
                    </td>
                    <td>{{ $project->start_date }}</td>
                    <td>
                      <a href="{{ route('project.show', $project->id) }}" class="btn btn-info btn-sm">
                        <i class="bi bi-eye"></i> Ver
                      </a>
                      @if (Auth::user()->type === 'a')
                      <a href="{{ route('project.edit', $project->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> Editar
                      </a>
                      <button type="button" class="btn btn-primary btn-sm assign-supplier-btn" 
                              data-id="{{ $project->id }}" data-name="{{ $project->name }}" 
                              data-bs-toggle="modal" data-bs-target="#assignSupplierModal">
                        <i class="bi bi-link"></i> Asignar Proveedor
                      </button>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center">No hay proyectos disponibles</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $projects->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  // Configurar el modal para asignar proveedores
  document.addEventListener('DOMContentLoaded', function () {
    const assignButtons = document.querySelectorAll('.assign-supplier-btn');
    const modalProjectId = document.getElementById('modalProjectId');
    const modalProjectName = document.getElementById('modalProjectName');

    assignButtons.forEach(button => {
      button.addEventListener('click', function () {
        const projectId = button.getAttribute('data-id');
        const projectName = button.getAttribute('data-name');

        modalProjectId.value = projectId;
        modalProjectName.textContent = projectName;
      });
    });
  });
</script>
@endsection

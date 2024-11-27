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

<div class="container mt-5">
  <div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center">
      <h1 class="text-primary">Gestión de Proyectos</h1>
      <a href="{{ route('project.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Nuevo Proyecto
      </a>
    </div>
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
          <h5 class="mb-0">Lista de Proyectos</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Cliente</th>
                  <th>Estado</th>
                  <th>Fecha Inicio</th>
                  <th>Acciones</th>
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
                                  <option value="{{ $supplier->idSupplier }}">{{ $supplier->organization->name }}</option>
                                @endforeach
                              </select>
                              <small class="text-muted">Mantén presionada la tecla <strong>Ctrl</strong> (o <strong>Cmd</strong> en Mac) para seleccionar múltiples proveedores.</small>
                            </div>
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
                    <td>{{ $project->idProject }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->client->organization->name ?? 'N/A' }}</td>
                    <td>
                      <span class="badge 
                        {{ $project->idProject === 1 ? 'bg-success' : 'bg-secondary' }}">
                        {{ $project->status === 'a' ? 'Activo' : ($project->status === 'i' ? 'Inactivo' : 'Terminado') }}

                      </span>
                    </td>
                    <td>{{ $project->start_date }}</td>
                    <td>
                      <a href="{{ route('project.show', $project->idProject) }}" class="btn btn-info btn-sm">
                        <i class="bi bi-eye"></i> Ver
                      </a>
                      <a href="{{ route('project.edit', $project->idProject) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> Editar
                      </a>
                      <button type="button" class="btn btn-primary btn-sm assign-supplier-btn" 
                              data-id="{{ $project->idProject }}" data-name="{{ $project->name }}" 
                              data-bs-toggle="modal" data-bs-target="#assignSupplierModal">
                        <i class="bi bi-link"></i> Asignar Proveedor
                      </button>
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
        <div class="card-footer text-muted">
          {{ $projects->links() }} <!-- Paginación -->
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

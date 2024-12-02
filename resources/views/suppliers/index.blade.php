@extends('layouts.app')

@section('content')
  <div class="container mt-5">
    <!-- Título -->
    <div class="row mt-5">
      <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary">Gestión de Proveedores</h1>
        <a href="{{ route('supplier.create', ['type' => 'supplier']) }}" class="btn btn-success">
          <i class="bi bi-plus-circle"></i> Nuevo Proveedor
        </a>
      </div>
    </div>

    <!-- Tabla de Proveedores -->
    <div class="row flex-grow-1">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Lista de Proveedores</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>RFC</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($organizations as $organization)
                  <tr>
                    <td>{{ $organization->id }}</td>
                    <td>{{ $organization->name }}</td>
                    <td>{{ $organization->rfc }}</td>
                    <td>{{ $organization->email }}</td>
                    <td>{{ $organization->phone }}</td>
                    <td>{{ $organization->address }}</td>
                    <td>
                      <a href="{{ route('organization.edit', ['organization' => $organization->id, 'type' => 'supplier']) }}" class="btn btn-primary">Editar</a>
                      @include('organizations.partials.eliminacion')
                      <form style="display: inline;">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminacion_{{ $organization->id }}">
                          Eliminar
                        </button>
                      </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="7" class="text-center">No hay proveedores disponibles</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Paginador -->
    <div class="row mt-auto">
      <div class="col-12 d-flex justify-content-center mt-4">
        {{ $organizations->links('pagination::bootstrap-4') }}
      </div>
    </div>
  </div>
@endsection


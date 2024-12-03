@extends('layouts.app')

@section('content')
  <div class="container mt-5">
    <!-- Título -->
    <div class="row mb-4">
      <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="display-4"><i class="bi bi-person-check"></i> Gestión de Proveedores</h1>
        @if(Auth::user()->type === 'a')
        <a href="{{ route('supplier.create', ['type' => 'supplier']) }}" class="btn btn-outline-secondary btn-lg">
          <i class="bi bi-plus-circle"></i> Nuevo Proveedor
        </a>
        @endif
      </div>
    </div>

    <!-- Tabla de Proveedores -->
    <div class="row">
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
                    @if(Auth::user()->type === 'a')
                      <th>Acciones</th>
                    @endif
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

                    @if (Auth::user()->type === 'a')
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('organization.edit', ['organization' => $organization->id, 'type' => 'supplier']) }}" class="btn btn-warning btn-sm">
                          <i class="bi bi-pencil"></i> Editar
                        </a>
                        @include('organizations.partials.eliminacion')
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminacion_{{ $organization->id }}">
                          <i class="bi bi-trash"></i> Eliminar
                        </button>
                        <a href="{{ route('supplier.show', $organization->supplier) }}" class="btn btn-info btn-sm">
                          <i class="bi bi-info-circle"></i> Detalle
                        </a>
                      </div>
                    </td>
                    @endif
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
@extends('layouts.app')

@section('content')

<!-- Título -->
<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="display-4"><i class="bi bi-people"></i> Gestión de Clientes</h1>
    @if (Auth::user()->type === 'a')
      <a href="{{ route('client.create', ['type' => 'client']) }}" class="btn btn-outline-secondary btn-lg">
        <i class="bi bi-plus-circle"></i> Nuevo Cliente
      </a>
    @endif
  </div>

  <!-- Tabla de Clientes -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Lista de Clientes</h5>
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
                  @if (Auth::user()->type === 'a')
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
                          <a href="{{ route('organization.edit', ['organization' => $organization->id, 'type' => 'client']) }}" 
                             class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Editar
                          </a>
                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                                  data-bs-target="#eliminacion_{{ $organization->id }}">
                            <i class="bi bi-trash"></i> Eliminar
                          </button>
                          @include('organizations.partials.eliminacion')
                        </div>
                      </td>
                    @endif
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center">No hay clientes disponibles</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
          {{ $organizations->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
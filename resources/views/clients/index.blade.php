@extends('layouts.app')
@section('content')
  <!-- Título -->

  <div class="container mt-5">
    <div class="row">
      <div class="col-12 d-flex justify-content-between align-items-center">
      <h1 class="text-primary">Gestión de Clientes</h1>
      @if (Auth::user()->type === 'a')
      <a href="{{ route('client.create', ['type' => 'client']) }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Nuevo Cliente
      </a>
      @endif
      </div>
    </div>

  <!-- Tabla de Proyectos -->

  <div class="row flex-grow-1">
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
            <th scope="col">Actions</th>
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
            <a href="{{ route('organization.edit', ['organization' => $organization->id, 'type' => 'client']) }}" class="btn btn-primary">Edit</a>                      
            @include('organizations.partials.eliminacion')
            <form style="display: inline;">
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminacion_{{ $organization->id }}">
                Delete
              </button>
            </form>
          </td>
          @endif
          </tr>

        @empty
          <tr>
          <td colspan="6" class="text-center">No hay clientes disponibles</td>
          </tr>
        @endforelse
        </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
          {{ $organizations->links('pagination::bootstrap-4') }}
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
@endsection

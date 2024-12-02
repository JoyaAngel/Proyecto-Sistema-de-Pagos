@extends('...layouts.app')

@section('content')
    <!-- Título -->

    <div class="container mt-5">
        <div class="row">
          <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="text-primary">Gestión de Provedores</h1>
            <a href="{{ route('supplier.create', ['type' => 'supplier']) }}" class="btn btn-success">
              <i class="bi bi-plus-circle"></i> Nuevo Proovedor
            </a>
          </div>
        </div>

    <!-- Tabla de Proyectos -->

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
                    <th scope="col">Actions</th>
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
                      <a href="{{ route('organization.edit', ['organization' => $organization->id, 'type' => 'supplier']) }}" class="btn btn-primary">Edit</a>                      
                      @include('organizations.partials.eliminacion')
                      <form style="display: inline;">
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminacion">
                              Delete
                          </button>
                      </form>
                  </td>
                  </tr>

                @empty
                  <tr>
                    <td colspan="6" class="text-center">No hay proveedores disponibles</td>
                  </tr>
                @endforelse
                    


@endsection

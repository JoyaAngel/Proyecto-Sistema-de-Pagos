@extends('...layouts.app')

@section('content')
    <!-- Título -->

    <div class="container mt-5">
        <div class="row">
          <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="text-primary">Gestión de Clientes</h1>
            <a href="{{ route('client.create') }}" class="btn btn-success">
              <i class="bi bi-plus-circle"></i> Nuevo Cliente
            </a>
          </div>
        </div>

    <!-- Tabla de Proyectos -->

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
                    </tr>
                </thead>
                <tbody>
                  @forelse($organizations as $organization)
                  <!-- Modal para Asignar Proveedores -->
                  <tr>
                    <td>{{ $organization->id }}</td>
                    <td>{{ $organization->name }}</td>
                    <td>{{ $organization->rfc }}</td>
                    <td>{{ $organization->email }}</td>
                    <td>{{ $organization->phone }}</td>
                    <td>{{ $organization->address }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center">No hay proyectos disponibles</td>
                  </tr>
                @endforelse
                    


@endsection

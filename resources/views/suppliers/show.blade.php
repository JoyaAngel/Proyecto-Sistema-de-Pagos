@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="display-4"><i class="fas fa-building"></i> Desglose de Proveedor</h1>

    <div class="container mt-5">
        <!-- Tarjeta con la información del proveedor -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">{{ $supplier->organization->name }} - Deuda Total: {{ number_format($deudaTotal, 2) }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Nombre del Proveedor:</strong> {{ $supplier->organization->name }}</p>
                <p><strong>Deuda Total:</strong> {{ number_format($deudaTotal, 2) }}</p>
            </div>
        </div>

        <!-- Tabla de proyectos asignados al proveedor -->
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Proyectos Asignados</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre del Proyecto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($proyectos as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="1" class="text-center">No hay proyectos asignados</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

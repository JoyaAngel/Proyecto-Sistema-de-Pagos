@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="text-primary">{{ $project->name }}</h1>
            <a href="{{ route('project.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver a la lista de proyectos
            </a>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Detalles del Proyecto</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID del Proyecto</dt>
                        <dd class="col-sm-8">{{ $project->idProject }}</dd>

                        <dt class="col-sm-4">Cliente</dt>
                        <dd class="col-sm-8">{{ $project->client->organization->name ?? 'No asignado' }}</dd>

                        <dt class="col-sm-4">Fecha de Inicio</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($project->start_date)->format('d-m-Y') }}</dd>

                        <dt class="col-sm-4">Fecha de Finalización</dt>
                        <dd class="col-sm-8">
                            @if($project->end_date)
                                {{ \Carbon\Carbon::parse($project->end_date)->format('d-m-Y') }}
                            @else
                                <span class="text-muted">Sin fecha de finalización</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Estado</dt>
                        <dd class="col-sm-8">
                            <span class="badge 
                                {{ $project->end_date ? ($project->end_date >= now() ? 'bg-success' : 'bg-secondary') : 'bg-warning' }}">
                                {{ $project->end_date ? ($project->end_date >= now() ? 'Activo' : 'Terminado') : 'En Progreso' }}
                            </span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Proveedores Asignados</h5>
                </div>
                <div class="card-body">
                    @if($project->supplier->isEmpty())
                        <p>No se han asignado proveedores a este proyecto.</p>
                    @else
                        <ul class="list-group">
                            @foreach($project->supplier as $supplier)
                                <li class="list-group-item">
                                    <strong>{{ $supplier->organization->name }}</strong>
                                    <p class="mb-0 text-muted">{{ $supplier->organization->email?? 'Información no disponible' }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Comentarios -->
    <div class="row my-4">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Comentarios</h5>
                </div>
                <div class="card-body">
                    @if(!empty($project->comments))
                        <p>{{ $project->comments }}</p>
                    @else
                        <p>No hay comentarios para este proyecto.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

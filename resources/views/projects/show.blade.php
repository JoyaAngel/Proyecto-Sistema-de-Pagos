@extends('layouts.app')

@section('content')
<div class="container my4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-4"><i class="fas fa-building"></i> Project <span class="text-secondary">{{ $project->name }}</span></h1>
        </div>
        <a href="{{ route('project.index') }}" class="btn btn-outline-secondary btn-lg">
            <i class="fas fa-plus-circle"></i> Back
        </a>
    </div>

    <div class="row my-4">
    <!-- Primera tarjeta (Detalles del Proyecto) -->
    <div class="col-lg-6">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detalles del Proyecto</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4 text-muted">ID del Proyecto</dt>
                    <dd class="col-sm-8">{{ $project->id }}</dd>

                    <dt class="col-sm-4 text-muted">Cliente</dt>
                    <dd class="col-sm-8">{{ $project->client->organization->name ?? 'No asignado' }}</dd>

                    <dt class="col-sm-4 text-muted">Fecha de Inicio</dt>
                    <dd class="col-sm-8">{{ \Carbon\Carbon::parse($project->start_date)->format('d-m-Y') }}</dd>

                    <dt class="col-sm-4 text-muted">Fecha de Finalización</dt>
                    <dd class="col-sm-8">
                        @if($project->end_date)
                            {{ \Carbon\Carbon::parse($project->end_date)->format('d-m-Y') }}
                        @else
                            <span class="text-muted">Sin fecha de finalización</span>
                        @endif
                    </dd>

                    <dt class="col-sm-4 text-muted">Estado</dt>
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

    <!-- Segunda tarjeta (Detalles Financieros del Proyecto) -->
    <div class="col-lg-6">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Detalles Financieros del Proyecto</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <!-- Subtotal -->
                    <dt class="col-sm-4 text-muted">Subtotal</dt>
                    <dd class="col-sm-8">${{ number_format($project->subtotal, 2) }}</dd>

                    <!-- Impuesto (Tax) -->
                    <dt class="col-sm-4 text-muted">Impuesto (Tax)</dt>
                    <dd class="col-sm-8">${{ number_format($project->tax, 2) }}</dd>

                    <!-- Total -->
                    <dt class="col-sm-4 text-muted">Total</dt>
                    <dd class="col-sm-8">${{ number_format($project->total, 2) }}</dd>

                    <!-- Anticipos -->
                    <dt class="col-sm-4 text-muted">Anticipos Realizados</dt>
                    <dd class="col-sm-8">${{ number_format($totalAdvance, 2) }}</dd>

                    <!-- Total después de Anticipos -->
                    <dt class="col-sm-4 text-muted">Total después de Anticipos</dt>
                    <dd class="col-sm-8">${{ number_format($diff, 2) }}</dd>
                </dl>
                    <div class="d-flex justify-content-start mt-3">
                        
                        <a href="{{route('project.advances.show', $project)}}" class="btn btn-outline-primary btn-md" >
                            Ver Anticipos Recibidos
                        </a>
                        @if(Auth::user()->type === 'a')
                        <button class="btn btn-outline-primary btn-md ms-2" data-bs-toggle="modal" data-bs-target="#advanceModal">
                            Registrar Anticipo del Cliente
                        </button>
                        @endif
                    </div>
                
            </div>
        </div>
    </div>
</div>



    <div class="row my-4">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Proveedores Asignados</h5>
                </div>
                <div class="card-body">
                    @if($project->suppliers->isEmpty())
                        <p class="text-muted">No se han asignado proveedores a este proyecto.</p>
                    @else
                        <div class="list-group">
                            @foreach($project->suppliers as $supplier)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $supplier->organization->name }}</strong>
                                        <p class="mb-0 text-muted">{{ $supplier->organization->email ?? 'Información no disponible' }}</p>
                                    </div>

                                    <!-- Acciones para Administradores -->
                                        <div>
                                            @if(Auth::user()->type === 'a')
                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#paymentModal_{{ $supplier->id }}">
                                                Registrar Pago
                                            </button>
                                            @endif
                                            <a href="{{ route('payments.show', ['supplier' => $supplier->id]) }}" class="btn btn-outline-info btn-sm ms-2">
                                                Ver Pagos Realizados
                                            </a>
                                            
                                        </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para registrar pago a proveedor -->
    @foreach($project->suppliers as $supplier)
        <div class="modal fade" id="paymentModal_{{ $supplier->id }}" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">Registrar Pago a {{ $supplier->organization->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('payment.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <div class="mb-2">
                                <label for="amount_{{ $supplier->id }}" class="form-label">Monto del Pago</label>
                                <input type="number" name="amount" id="amount_{{ $supplier->id }}" class="form-control" step="0.01" required>
                            </div>
                            <div class="mb-2">
                                <label for="date_{{ $supplier->id }}" class="form-label">Fecha del Pago</label>
                                <input type="date" name="date" id="date_{{ $supplier->id }}" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label for="payment_method_{{ $supplier->id }}" class="form-label">Método de Pago</label>
                                <select name="payment_method" id="payment_method_{{ $supplier->id }}" class="form-select" required>
                                    <option value="cash">Cash</option>
                                    <option value="debit">Debit</option>
                                    <option value="credit">Credit</option>
                                    <option value="check">Check</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar Pago</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal para registrar anticipo del cliente -->
    <div class="modal fade" id="advanceModal" tabindex="-1" aria-labelledby="advanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="advanceModalLabel">Registrar Anticipo del Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('advance.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="mb-2">
                            <label for="advance_amount" class="form-label">Monto del Anticipo</label>
                            <input type="number" name="amount" id="advance_amount" class="form-control" step="0.01" required>
                        </div>
                        <div class="mb-2">
                            <label for="date" class="form-label">Fecha del Anticipo</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Método de Pago</label>
                            <select name="payment_method" id="payment_method" class="form-select" required>
                                <option value="cash">Cash</option>
                                <option value="debit">Debit</option>
                                <option value="credit">Credit</option>
                                <option value="check">Check</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Registrar Anticipo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Comentarios -->
    <div class="row my-4">
        <div class="col-lg-12">
            <div class="card shadow-lg">
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

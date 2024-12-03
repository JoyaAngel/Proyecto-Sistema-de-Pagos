@extends('...layouts.app')

@section('content')
<div class="container my-4">
    <h1>Pagos realizados al proveedor: {{ $supplier->organization->name }}</h1>

    <h3>Costo total del servicio: ${{ number_format($serviceCost, 2) }}</h3>

    @if($payments->isEmpty())
        <p class="text-muted">No se han registrado pagos para este proveedor.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Proyecto</th>
                    <th>Método de Pago</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d-m-Y') }}</td>
                        <td>${{ number_format($payment->amount, 2) }}</td>
                        <td>{{ ucfirst($payment->payment_method) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection


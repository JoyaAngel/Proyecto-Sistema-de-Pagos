@extends('...layouts.app')

@section('content')
<div class="container my-4">
    <h1>Pagos realizados al proveedor: {{ $supplier->organization->name }}</h1>

    <p> Costo del servicio: {{ $projectSupplier->service_cost}} </p>
    <p> Por pagar: ${{ $diff}}</p>
    @if($payments->isEmpty())
        <p class="text-muted">No se han registrado pagos para este proveedor.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Método de Pago</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d-m-Y') }}</td>
                        <td>${{ number_format($payment->transaction->amount, 2) }}</td>
                        <td>{{ ucfirst($payment->transaction->payment_method) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

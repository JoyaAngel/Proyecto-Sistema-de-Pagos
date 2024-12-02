@extends('layouts.app')
@section('content')
<div class="container my-4">
    <h1 class="display-4"><i class="fas fa-building"></i> Payments Overview</h1>

    @if($payments->isEmpty())
        <p class="text-muted">No hay pagos registrados.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Supplier</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->transaction->id ?? 'Sin id'}}</td>
                        <td>{{ $payment->projectSupplier->supplier->organization->name ?? 'Sin organización' }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d-m-Y') }}</td>
                        <td>${{ number_format($payment->transaction->amount, 2) }}</td>
                        <td>{{ ucfirst($payment->transaction->payment_method) }}</td>
                        <td>
                            @include('payments.partials.eliminacion')
                            <form style="display: inline;">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminacion">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $payments->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
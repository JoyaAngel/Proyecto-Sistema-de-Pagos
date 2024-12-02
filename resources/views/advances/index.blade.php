@extends('layouts.app')
@section('content')
<div class="container my-4">
    <h1 class="display-4"><i class="fas fa-building"></i> Advances Overview</h1>

    @if($advances->isEmpty())
        <p class="text-muted">No hay anticipos registrados.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($advances as $advance)
                    <tr>
                        <td>{{ $advance->transaction->id ?? 'Sin id'}}</td>
                        <td>{{ $advance->project->client->organization->name ?? 'Sin organización' }}</td>
                        <td>{{ \Carbon\Carbon::parse($advance->created_at)->format('d-m-Y') }}</td>
                        <td>${{ number_format($advance->transaction->amount, 2) }}</td>
                        <td>{{ ucfirst($advance->transaction->payment_method) }}</td>
                        <td>
                            @include('advances.partials.eliminacion')
                            <form style="display: inline;">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminacion{{ $advance->id }}">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $advances->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
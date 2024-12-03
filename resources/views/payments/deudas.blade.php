@extends('layouts.app')
@section('content')
<div class="container my-4">
    <h1 class="display-4"><i class="fas fa-building"></i> Deudas pendientes por organización</h1>
<div class="container mt-5">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre de la Organización</th>
                <th>Deuda Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ number_format($row->deudaTotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
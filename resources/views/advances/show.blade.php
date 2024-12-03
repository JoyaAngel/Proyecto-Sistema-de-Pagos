@extends('layouts.app')
@section('content')
<div class="container my-4">
    <h1 class="display-4"><i class="fas fa-building"></i> Anticipos recibidos</h1>
<div class="container mt-5">
    <thead>
        <tr>
            <h2 class="display-8"><i class="fas fa-building"></i>{{$project->name}} Anticipos Totales: {{number_format($anticipoTotal, 2)}}</h3>
        </tr>
    </thead>
    <tbody>
        <table class="table table-bordered">
            <thead>
                <td>Anticipos</td>
                <td>Fecha</td>
                <td>Método de pago</td>
                <td>Referencia</td>
            </thead>
            <body>
                @foreach($advances as $advance)
                <tr>
                    <td>{{ number_format($advance->amount, 2) }}</td>
                    <td>{{ $advance->date}}</td>
                    <td>{{ $advance->payment_method}}</td>
                    <td>{{ $advance->reference}}</td>
                </tr>
                @endforeach
        </body>
        </table>
    </tbody>
</div>
</div>
@endsection
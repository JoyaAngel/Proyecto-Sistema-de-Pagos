@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="jumbotron">
        <h1 class="display-4">Bienvenido a PayFlow!</h1>
        <p class="lead">La mejor plataforma para gestionar tus proyectos y transacciones.</p>
        <p>Enlaces de inicio rápido:</p>
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('client.index') }}">Clientes</a></li>
            <li class="list-group-item"><a href="{{ route('supplier.index') }}">Proveedores</a></li>
            <li class="list-group-item"><a href="{{ route('payment.index') }}">Pagos</a></li>
            <li class="list-group-item"><a href="{{ route('advance.index') }}">Adelantos</a></li>
        </ul>
    </div>
</div>
@endsection
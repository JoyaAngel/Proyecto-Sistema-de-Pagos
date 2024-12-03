@extends('layouts.app')
@section('content')
<div class="container my-4">
    <h1 class="display-4"><i class="fas fa-building"></i> Desglose de organización</h1>
<div class="container mt-5">
    <thead>
        <tr>
            <h2 class="display-8"><i class="fas fa-building"></i>{{$supplier->organization->name}} Deuda Total: {{number_format($deudaTotal, 2)}}</h3>
        </tr>
    </thead>
    <tbody>
        <table class="table table-bordered">
            <thead>
                <td>Nombre del proveedor</td>
                <td>Deuda total</td>
                <td>Proyectos</td>
            </thead>
            <tr>
                <td>{{ $supplier->organization->name }}</td>
                <td>{{ number_format($deudaTotal, 2) }}</td>
                @foreach ($proyectos as $project)
                    <td>{{$project->name}}</td>
                @endforeach
            </tr>
        </table>
    </tbody>
</div>
</div>
@endsection
@extends('layouts.app')
@section('content')
<div class="container my-4">
    <h1 class="display-4"><i class="fas fa-building"></i> Anticipos recibidos</h1>
<div class="container mt-5">
    <thead>
        <tr>
            <h2 class="display-8"><i class="fas fa-building"></i>{{$advance->name}} Anticipos Totales: {{number_format($anticipoTotal, 2)}}</h3>
        </tr>
    </thead>
    <tbody>
        <table class="table table-bordered">
            <thead>
                <td>Nombre del cliente</td>
                <td>Anticipos</td>
                <td>Fecha</td>
            </thead>
            <tr>
                @forelse ($projects as $project)
                <td>{{ $project->client->name }}</td>
                <td>{{ number_format($anticipoTotal, 2) }}</td>
                <td>{{date_format($project->advance->transaction->date)}}</td>
                @empty
                    <td colspan="7" class="text-center">No hay Anticipos disponibles</td>
                @endforelse
            </tr>
        </table>
    </tbody>
</div>
</div>
@endsection
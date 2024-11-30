@extends('layouts.app')
@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4"><i class="fas fa-building"></i> Clients Overview</h1>
        <a href="{{ route('client.create') }}" class="btn btn-outline-secondary btn-lg">
            <i class="fas fa-plus-circle"></i> Add Client
        </a>
    </div>
</div>
@include('organizations.show')
@endsection

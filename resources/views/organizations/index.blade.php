@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4"><i class="fas fa-building"></i> Organizations Overview</h1>
    </div>
    @include('organizations.show')
</div>
@endsection
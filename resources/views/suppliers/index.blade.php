@extends('...layouts.app')
@section('content')
<div class="container d-flex col-md-12 mb-4">
    <a href="{{ route('supplier.create') }}" class="btn btn-primary">Add</a>
</div>
    @include('...organizations.show')
@endsection
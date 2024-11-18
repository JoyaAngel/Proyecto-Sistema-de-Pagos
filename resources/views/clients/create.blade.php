@extends('...layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <form class="row g-2 w-70" method="POST" action="{{ route('client.store') }}">
        @include('organizations.partials._form_organizations')
    </form>
</div>
@endsection
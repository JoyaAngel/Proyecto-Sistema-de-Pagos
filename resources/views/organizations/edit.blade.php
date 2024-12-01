@extends('...layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <form class="row g-2 w-70" method="POST" 
            action="{{ route('organization.update', ['organization' => $organization->id, 'type' => 'supplier']) }}">
            @method('PUT')
            @include('..organizations.partials._form_organizations', ['flag' => $organization->flag])
        </form>
    </div>
@endsection

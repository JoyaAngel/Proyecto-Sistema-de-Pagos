@extends('...layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <form class="row g-2 w-70" method="POST" action="{{ route('transaction.store') }}">
        @include('...partials.transactions._form_transactions', ['type' => $type])
    </form>
</div>
@endsection
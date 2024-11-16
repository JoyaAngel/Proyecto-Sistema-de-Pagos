@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="jumbotron">
        <h1 class="display-4">Welcome to PayFlow!</h1>
        <p class="lead">The best platform to manage your financial transactions.</p>
        <p>Here are some quick links to get you started:</p>
        <ul class="list-group">
            <li class="list-group-item"><a href="#">View Clients</a></li>
            <li class="list-group-item"><a href="#">View Suppliers</a></li>
            <li class="list-group-item"><a href="#">Make a Payment</a></li>
            <li class="list-group-item"><a href="#">Request an Advance</a></li>
        </ul>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
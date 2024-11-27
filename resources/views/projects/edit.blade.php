@extends('...layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <form class="row g-2 w-70" method="POST" action="{{ route('project.update', $project->idProject) }}">
            @method('PUT')
            @include('..projects.partials._form_projects')
        </form>
    </div>
@endsection
@extends('...layouts.app')

@section('content')
    <div class="container d-flex justify-content-center col-md-12">
        <table class="table table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type of Person</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($organizations as $organization)
                    <tr>
                        <th scope="row">{{ $organization->idOrganization }}</th>
                        <td>{{ $organization->name }}</td>
                        <td>
                            @if($organization->person == 'l')
                                Legal
                            @else
                                Natural
                            @endif
                        </td>
                        <td>{{ $organization->email }}</td>
                        <td>{{ $organization->phone }}</td>
                        <td>{{ $organization->address }}</td>
                        <td>
                            <a href="{{ route('organization.edit', $organization->idOrganization) }}" class="btn btn-primary">Edit</a>
                            @include('organizations.partials.eliminacion')
                            <form style="display: inline;">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminacion">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

     <div class="d-flex justify-content-center">
        {{ $organizations->appends(['search' => request('search'), 'search_by' => request('search_by'), 'type' => $type])->links() }}

    </div>
@endsection
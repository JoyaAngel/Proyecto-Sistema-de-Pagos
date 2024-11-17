@extends('...layouts.app')

@section('content')
    <div class="container d-flex col-md-12 mb-4">
        <a href="{{ route('organization.create') }}" class="btn btn-primary">Add</a>
    </div>
    <div class="container d-flex justify-content-center col-md-12">
        <table class="table table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
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
                        <td>{{ $organization->email }}</td>
                        <td>{{ $organization->phone }}</td>
                        <td>{{ $organization->address }}</td>
                        <td>
                            <a href="{{ route('organization.edit', $organization->idOrganization) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('organization.destroy', $organization->idOrganization) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
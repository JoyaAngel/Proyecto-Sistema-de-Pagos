@extends('...layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mb-4">
        <h1 class="display-4">
            @if($type == 'c')
                Clients
            @else
                Suppliers
            @endif
        </h1>
    </div>
    <div class="container d-flex justify-content-between align-items-center mb-4">
        <!-- Botón Add -->
        <a href="{{ route('organization.create', ['type' => $type]) }}" class="btn btn-primary">Add</a>
    
        <!-- Barra de Búsqueda -->
        <form action="{{ route('organization.index') }}" method="GET" class="d-flex">
            <!-- Selección del campo de búsqueda -->
            <select name="search_by" class="form-select me-2" style="max-width: 150px;">
                <option value="name" {{ request('search_by') == 'name' ? 'selected' : '' }}>Name</option>
                <option value="email" {{ request('search_by') == 'email' ? 'selected' : '' }}>Email</option>
                <option value="phone" {{ request('search_by') == 'phone' ? 'selected' : '' }}>Phone</option>
                <option value="address" {{ request('search_by') == 'address' ? 'selected' : '' }}>Address</option>
            </select>
    
            <div class="input-group" style="max-width: 400px;">
                <!-- Campo de búsqueda -->
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
    
                <!-- Campo hidden para el tipo -->
                <input type="hidden" name="type" value="{{ $type }}">
    
                <!-- Botón de búsqueda -->
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>
    </div>
    
    
    </div>
    </div>
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
                            @include('..partials.eliminacion')
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
     <!-- Paginación -->
     <div class="d-flex justify-content-center">
        {{ $organizations->appends(['search' => request('search'), 'search_by' => request('search_by'), 'type' => $type])->links() }}

    </div>
@endsection
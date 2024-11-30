<div class="container d-flex justify-content-center col-md-12">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="border">ID</th>
                    <th scope="col" class="border">Name</th>
                    <th scope="col" class="border">Email</th>
                    <th scope="col" class="border">Phone</th>
                    <th scope="col" class="border">Address</th>
                    <th scope="col" class="border" style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($organizations as $organization)
                    <tr>
                        <th scope="row" class="border">{{ $organization->id }}</th>
                        <td class="border">{{ $organization->name }}</td>
                        <td class="border">{{ $organization->email }}</td>
                        <td class="border">{{ $organization->phone }}</td>
                        <td class="border">{{ $organization->address }}</td>
                        <td class="border">
                            <a href="{{ route('organization.edit', $organization->id) }}" class="btn btn-primary">Edit</a>
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
</div>
<div class="d-flex justify-content-center mt-4">
    {{ $organizations->links('pagination::bootstrap-4') }}
</div>
@extends('layouts.app')

@section('content')
<div class="container my-4">
    <!-- Título principal -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4"><i class="fas fa-users"></i> Gestión de Usuarios</h1>
    </div>

    <!-- Tabla de usuarios -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-list"></i> Lista de Usuarios</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->type === 'a' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $user->type === 'a' ? 'Administrador' : 'Usuario' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- Botón para editar usuario -->
                                    <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal-{{ $user->id }}">
                                        <i class="bi bi-pencil"></i> Editar
                                    </button>

                                    <!-- Botón para restablecer contraseña -->
                                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#PasswordResetModal-{{ $user->id }}">
                                        <i class="bi bi-key"></i> Restablecer Contraseña
                                    </button>
                                    @include('users.partials.pass_reset_modal')

                                    <!-- Botón para eliminar usuario -->
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $user->id }}">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                    @include('users.partials.delete_user_modal')
                                </div>
                            </td>
                        </tr>

                        <!-- Modal para editar usuario -->
                        <div class="modal fade" id="editUserModal-{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel-{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning text-white">
                                        <h5 class="modal-title" id="editUserModalLabel-{{ $user->id }}">Editar Usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('user.update', $user) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name-{{ $user->id }}" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="name-{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="last_name-{{ $user->id }}" class="form-label">Apellido</label>
                                                <input type="text" class="form-control" id="last_name-{{ $user->id }}" name="last_name" value="{{ $user->last_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email-{{ $user->id }}" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email-{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="type-{{ $user->id }}" class="form-label">Tipo de Usuario</label>
                                                <select class="form-select" id="type-{{ $user->id }}" name="type" required>
                                                    <option value="a" {{ $user->type === 'a' ? 'selected' : '' }}>Administrador</option>
                                                    <option value="u" {{ $user->type === 'u' ? 'selected' : '' }}>Usuario</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay usuarios registrados</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection


@push('scripts')

@if(session('password'))

<script>
    // Crear el modal dinámicamente
    var modalHTML = `
        <div class="modal fade show" id="passwordReseted" tabindex="-1" aria-labelledby="passwordReseted" style="display: block;" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="passwordReseted">¡Contraseña Restablecida Exitosamente!</h5>
                        <button type="button" class="btn-close" id="closeModalButton" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>La nueva contraseña generada para el usuario es:</strong></p>
                        <div class="input-group">
                            <!-- Área de texto que contiene la contraseña -->
                            <input type="text" class="form-control" id="passwordText" value="{{ session('password') }}" readonly>
                            <!-- Botón para copiar al portapapeles -->
                            <button class="btn btn-outline-secondary" type="button" id="copyBtn">Copiar</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeBtn" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast para mostrar el mensaje de éxito -->
        <div class="toast-container p-3" id="toastContainer" style="position: absolute; top: 40%; left: 50%; transform: translateX(-50%);">
            <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Contraseña Copiada</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    La nueva contraseña ha sido copiada al portapapeles.
                </div>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', modalHTML);

    const myModal = new bootstrap.Modal(document.getElementById('passwordReseted'));

    myModal.show();

    const closeButton = document.getElementById('closeModalButton');
    const closeBtn = document.getElementById('closeBtn');

    function handleCloseButtonClick() {
        myModal.hide();
    }

    closeButton.addEventListener('click', handleCloseButtonClick);
    closeBtn.addEventListener('click', handleCloseButtonClick);

    document.getElementById('copyBtn').addEventListener('click', function() {
        var passwordField = document.getElementById('passwordText');
        passwordField.select();
        passwordField.setSelectionRange(0, 99999); // Para dispositivos móviles
        document.execCommand('copy');
        var toast = new bootstrap.Toast(document.getElementById('toast'), {
            delay: 3000
        });
        toast.show();
    });
</script>
@endif
@endpush
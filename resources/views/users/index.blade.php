@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <h1>Gestión de Usuarios</h1>
  <table class="caption-top table align-middle table-bordered table-striped-columns table-dark table-hover table-borderless">
    <caption>Lista de usuarios</caption>
      <thead class="bg-primary text-white table-light">
          <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Tipo</th>
              <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
          <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->type === 'a' ? 'Administrador' : 'Usuario' }}</td>
              <td>
                  <div class="d-flex align-items-center gap-2">
                      <!-- Botón para abrir el modal de edición -->
                      <button class="btn btn-md btn-outline-primary w-40" data-bs-toggle="modal" data-bs-target="#editUserModal-{{ $user->id }}">
                          Editar
                      </button>
                      
                      <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#PasswordResetModal">
                          Restablecer Contraseña
                      </button>
                      @include('users.partials.pass_reset_modal')

                      <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        Eliminar
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
                      <form action="{{ route('user.update', $user->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="modal-body">
                              <!-- Nombre -->
                              <div class="mb-3">
                                  <label for="name-{{ $user->id }}" class="form-label">Nombre</label>
                                  <input type="text" class="form-control" id="name-{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                              </div>

                              <!-- Email -->
                              <div class="mb-3">
                                  <label for="email-{{ $user->id }}" class="form-label">Email</label>
                                  <input type="email" class="form-control" id="email-{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                              </div>

                              <!-- Tipo -->
                              <div class="mb-3">
                                  <label for="type-{{ $user->id }}" class="form-label">Tipo de Usuario</label>
                                  <select class="form-control" id="type-{{ $user->id }}" name="type" required>
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
          @endforeach
      </tbody>
  </table>
</div>
@endsection

@push('scripts')

@if(session('password'))

<script>
    // Crear el modal dinámicamente
    var modalHTML = `
        <div class="modal fade show" id="passwordResetModal" tabindex="-1" aria-labelledby="passwordResetModalLabel" style="display: block;" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="passwordResetModalLabel">¡Contraseña Restablecida Exitosamente!</h5>
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

    const myModal = new bootstrap.Modal(document.getElementById('passwordResetModal'));

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
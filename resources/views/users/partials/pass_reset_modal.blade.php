<!-- Modal de confirmación -->
<div class="modal fade" id="PasswordResetModal" tabindex="-1" aria-labelledby="PasswordResetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="PasswordResetModalLabel">¿Estás seguro que desea continuar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-black">
                Confirme si desea restablecer la contraseña del usuario.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('user.passwordReset', $user) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>

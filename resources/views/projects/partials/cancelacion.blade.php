<!-- Modal para cancelar proyecto -->
<div class="modal fade" id="cancelProjectModal_{{ $project->id }}" tabindex="-1" aria-labelledby="cancelProjectModalLabel_{{ $project->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="cancelProjectModalLabel_{{ $project->id }}">Cancelar Proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('project.cancel', ['project' => $project->id]) }}">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas cancelar este proyecto? Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Confirmar Cancelación</button>
                </div>
            </form>
        </div>
    </div>
</div>




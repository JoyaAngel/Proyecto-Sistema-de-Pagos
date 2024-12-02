<!-- Modal -->
<div class="modal fade" id="eliminacion{{ $advance->id }}" tabindex="-1" aria-labelledby="eliminacion{{ $advance->id }}" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="eliminacionTitulo">Eliminación de Registro</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <p>¿Está seguro de que quiere eliminar este registro?</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <form action="{{ route('advance.destroy', $advance->id) }}" method="POST">           
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger">Eliminar</button>
              </form>
          </div>
      </div>
  </div>
</div>

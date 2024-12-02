<div class="modal fade" id="eliminacion" tabindex="-1" aria-labelledby="eliminacion" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="eliminacionTitulo">Eliminación de Registro</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>¿Esta seguro de que quiere eliminar este registro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="{{ route('payment.destroy', $payment->id) }}" method="POST">           
                @csrf
                <button class="btn btn-danger">Eliminar</button>
                @method('DELETE')
        </form>
        </div>
      </div>
    </div>
  </div>

  {{--se tiene que crear xd--}}
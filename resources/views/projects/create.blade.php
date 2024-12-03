@extends('...layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <!-- Card principal -->
      <div class="card shadow-sm">
        <div class="card-header text-center bg-primary text-white">
            <h4>Registro de Proyecto</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('project.store') }}" method="POST">
            @csrf
            @include('projects.partials._form_projects')
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Buscar Cliente -->
<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="clientModalLabel">Seleccionar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody id="clientTableBody">
                @foreach ($clients as $client)
                <tr>
                  <td>{{ $client->id }}</td>
                  <td>{{ $client->organization->name }}</td>
                  <td>
                  <button type="button" class="btn btn-primary select-client"
                      data-id="{{ $client->id }}"
                      data-name="{{ $client->organization->name }}" data-bs-dismiss="modal">
                    Seleccionar
                  </button>
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="d-flex justify-content-center">
          {{ $clients->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function attachSelectClientEvents() {
            const selectButtons = document.querySelectorAll('.select-client');
            const clientIdInput = document.getElementById('client_id');
            const clientNameInput = document.getElementById('client_name');

            selectButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const clientId = this.getAttribute('data-id');
                    const clientName = this.getAttribute('data-name');

                    // Actualiza el campo hidden con el ID del cliente
                    clientIdInput.value = clientId;
                    // Actualiza el campo de texto visible con el nombre del cliente
                    clientNameInput.value = clientName;

                    // Cierra el modal
                    const modalElement = document.getElementById('clientModal');
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    modal.hide();
                });
            });
        }

        function attachPaginationEvents() {
            const paginationLinks = document.querySelectorAll('.pagination a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    const url = this.getAttribute('href');
                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            const newModalContent = new DOMParser().parseFromString(html, 'text/html').querySelector('.modal-content');
                            document.querySelector('#clientModal .modal-content').innerHTML = newModalContent.innerHTML;
                            attachSelectClientEvents(); // Re-attach events after content update
                            attachPaginationEvents(); // Re-attach pagination events after content update
                        });
                });
            });
        }

        attachSelectClientEvents();
        attachPaginationEvents();

        // Re-attach events when the modal is shown
        const modal = document.getElementById('clientModal');
        modal.addEventListener('shown.bs.modal', function () {
            attachSelectClientEvents();
            attachPaginationEvents();
        });
    });
</script>
@endsection
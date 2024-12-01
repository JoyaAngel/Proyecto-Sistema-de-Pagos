<div class="container-fluid">
  <div class="row">
      <div class="col-12">
          <!-- Card principal -->
          <div class="card shadow-sm">
              <div class="card-header text-center bg-primary text-white">
                  <h4>Registro de Cliente</h4>
              </div>
              <div class="card-body">
                  <form action="{{route('client.store')}}" method="POST">
                      @csrf
                      <!-- Campos del formulario -->
                      <div class="row">
                          <!-- Nombre del Cliente -->
                          <div class="mb-3 col-md-12">
                              <label for="clientName" class="form-label">Nombre del Cliente</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa el nombre del cliente" value="{{ old('name', $organization->name) }}">
                          </div>
                          <!-- Tipo de Cliente -->
                          <div class="mb-3 col-md-12">
                              <label for="person" class="form-label">Persona</label>
                              <select class="form-select" id="person" name="person">
                                  <option value="f" {{ old('status', $organization->person) == 'f' ? 'selected' : '' }}>Física</option>
                                  <option value="m" {{ old('status', $organization->person) == 'm' ? 'selected' : '' }}>Moral</option>
                              </select>
                          </div>
                      </div>
                      <div class="row">
                          <!-- Dirección del Cliente -->
                          <div class="mb-3 col-md-12">
                              <label for="clientAddress" class="form-label">Dirección del Cliente</label>
                              <input type="text" class="form-control" id="address" name="address" placeholder="Ingresa la dirección del cliente" value="{{ old('address', $organization->address) }}">
                          </div>
                          <!-- Email del Cliente -->
                          <div class="mb-3 col-md-12">
                              <label for="clientEmail" class="form-label">Email del Cliente</label>
                              <input type="text" class="form-control" id="email" name="email" placeholder="Ingresa el email del cliente" value="{{ old('email', $organization->email) }}">
                          </div>
                      </div>
                      <div class="row">
                          <!-- RFC del Cliente -->
                          <div class="mb-3 col-md-12">
                              <label for="clientRFC" class="form-label">RFC del Cliente</label>
                              <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Ingresa el RFC del cliente" value="{{ old('rfc', $organization->rfc) }}">
                          </div>
                          <!-- Teléfono del Cliente -->
                          <div class="mb-3 col-md-12">
                              <label for="clientPhone" class="form-label">Teléfono del Cliente</label>
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="Ingresa el teléfono del cliente" value="{{ old('phone', $organization->phone) }}">
                          </div>
                      </div>
                      <!-- Botones -->
                      <div class="row">
                          <div class="col-md-6">
                              <button type="submit" class="btn btn-primary w-100">Guardar Cliente</button>
                          </div>
                          <div class="col-md-6">
                              <a href="{{ route('client.index') }}" class="btn btn-secondary w-100">Cancelar</a>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

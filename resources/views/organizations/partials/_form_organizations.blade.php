<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Card principal -->
            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h4>
                        <?php 
                        
                        $type = $_GET['type'];
                        
                        if ($type == 'client') {

                            echo "Registro de Cliente";

                        } else {

                            echo "Registro de Proveedor";

                        }
                        
                        ?></h4>
                </div>
                <div class="card-body">
                    <form action=
                        <?php 
                        
                        $type = $_GET['type'];
                        
                        if ($type == 'client') {

                            echo "{{route('client.store')}}";

                        } else {

                            echo "{{route('supplier.store')}}";

                        }
                        
                        ?> method="POST">
                        @csrf
                        <!-- Campos del formulario -->
                        <div class="row">
                            <!-- Nombre -->
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa el nombre" value="{{ old('name', $organization->name) }}">
                            </div>
                            <!-- Tipo -->
                            <div class="mb-3 col-md-12">
                                <label for="person" class="form-label">Persona</label>
                                <select class="form-select" id="person" name="person">
                                    <option value="n" {{ old('status', $organization->person) == 'n' ? 'selected' : '' }}>Física</option>
                                    <option value="l" {{ old('status', $organization->person) == 'l' ? 'selected' : '' }}>Moral</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Dirección -->
                            <div class="mb-3 col-md-12">
                                <label for="address" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Ingresa la dirección" value="{{ old('address', $organization->address) }}">
                            </div>
                            <!-- Email -->
                            <div class="mb-3 col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Ingresa el email" value="{{ old('email', $organization->email) }}">
                            </div>
                        </div>
                        <div class="row">
                            <!-- RFC -->
                            <div class="mb-3 col-md-12">
                                <label for="rfc" class="form-label">RFC</label>
                                <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Ingresa el RFC" value="{{ old('rfc', $organization->rfc) }}">
                            </div>
                            <!-- Teléfono -->
                            <div class="mb-3 col-md-12">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Ingresa el teléfono" value="{{ old('phone', $organization->phone) }}">
                            </div>
                        </div>
                        <!-- Botones -->
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary w-100">Guardar</button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ $type === 'client' ? route('client.index') : route('supplier.index') }}" class="btn btn-secondary w-100">Cancelar</a>                        
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
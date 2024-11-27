    @csrf
    <div class="col-md-6">
        <label for="inputName" class="form-label">Name</label>
        <input type="name" class="form-control" name="name" value="{{ old('name', $organization->name) }}">
      </div>
      <div class="col-md-6">
        <label for="inputPerson" class="form-label">Person</label>
        <select class="form-select" aria-label="Person" name="person">
          <option selected disabled>Select the type of person</option>
          <option value="l" {{ old('person', $organization->person) == 'l' ? 'selected' : '' }}>Legal</option>
          <option value="n" {{ old('person', $organization->person) == 'n' ? 'selected' : '' }}>Natural</option>
        </select>    </div>
      <div class="col-12">
        <label for="inputAddress" class="form-label">Address</label>
        <input type="text" class="form-control" name="address" value="{{ old('address', $organization->address) }}">
      </div>
      <div class="col-12">
        <label for="inputAddress2" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="{{ old('email', $organization->email) }}">
      </div>
      <div class="col-md-6">
        <label for="inputRFC" class="form-label">RFC</label>
        <input type="char" class="form-control" name="rfc" value="{{ old('rfc', $organization->rfc) }}">
      </div>
      <div class="col-md-6">
        <label for="inputPhone" class="form-label">Phone</label>
        <input type="tel" class="form-control" name="phone" value="{{ old('phone', $organization->phone) }}">
      </div>
      <input type="hidden" id="type" name="type" value="{{ isset($type) ? $type : $organization->type }}">    <div class="col-6">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      <div class="col-6">
        <a href="{{ url('/')}}" class="btn btn-secondary">Cancel</a>
    </div>
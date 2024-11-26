@csrf
<div class="col-md-6">
    <label for="inputName" class="form-label">Transaction Name</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $transaction->name ?? '') }}">
</div>
<div class="col-md-6">
    <label for="inputAmount" class="form-label">Amount</label>
    <input type="number" step="0.01" class="form-control" name="amount" value="{{ old('amount', $transaction->amount ?? '') }}">
</div>
<div class="col-md-6">
    <label for="inputType" class="form-label">Type</label>
    <select class="form-select" aria-label="Transaction Type" name="type">
        <option selected disabled>Select the type</option>
        <option value="PAGO" {{ old('type', $transaction->type ?? '') == 'PAGO' ? 'selected' : '' }}>PAGO</option>
        <option value="ANTICIPO" {{ old('type', $transaction->type ?? '') == 'ANTICIPO' ? 'selected' : '' }}>ANTICIPO</option>
    </select>
</div>
<div class="col-md-6">
    <label for="inputDate" class="form-label">Date</label>
    <input type="date" class="form-control" name="date" value="{{ old('date', $transaction->date ?? '') }}">
</div>
<div class="col-md-6">
    <label for="inputMethod" class="form-label">Method</label>
    <select class="form-select" aria-label="Method" name="method">
        <option selected disabled>Select the method</option>
        <option value="OPTION1" {{ old('method', $transaction->method ?? '') == 'OPTION1' ? 'selected' : '' }}>OPTION1</option>
        <option value="OPTION2" {{ old('method', $transaction->method ?? '') == 'OPTION2' ? 'selected' : '' }}>OPTION2</option>
    </select>
</div>
<div class="col-md-6">
    <label for="inputReference" class="form-label">Reference (Optional)</label>
    <input type="text" class="form-control" name="reference" value="{{ old('reference', $transaction->reference ?? '') }}">
</div>
<div class="col-md-6">
    <label for="inputOrganization" class="form-label">Organization ID</label>
    <input type="number" class="form-control" name="organization_id" value="{{ old('organization_id', $transaction->organization_id ?? '') }}">
</div>
<div class="col-6">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
<div class="col-6">
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
</div>

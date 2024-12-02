<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Organization;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::whereHas('supplier')->paginate(10);
        return view('suppliers.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organization = new Organization();
        return view('suppliers.create', compact('organization'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request)
    {

        $validatedData = $request->validated();

        $organization = Organization::create(
            [
            'name' => $validatedData['name'],
            'person' => $validatedData['person'],
            'rfc' => $validatedData['rfc'],
            'address' => $validatedData['address'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone']
            ]
        );

        $supplier = new Supplier();
        $organization->supplier()->save($supplier);
        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

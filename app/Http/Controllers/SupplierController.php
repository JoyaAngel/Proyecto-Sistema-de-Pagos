<?php

namespace App\Http\Controllers;

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
        $organizations = Supplier::with('organization')
        ->get()
        ->pluck('organization');
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
    public function store(Request $request)
    {
        $organization = Organization::create(
            [
                'name' => $request->name,
                'person' => $request->person,
                'rfc' => $request->rfc,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone
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

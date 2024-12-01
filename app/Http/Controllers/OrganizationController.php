<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use App\Models\Client;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $organizations = Organization::paginate(10);
        return view('organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->query('type');
        $organization = new Organization();
        return view('dashboard.organizations.create', compact('type', 'organization'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request)
    {
        $organization = $request->validated();

        Organization::create($organization);

        return back()->with('status', 'Organization created successfully');
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
    public function edit(Organization $organization)
    {
        $type = url()->previous() === 'supplier' ? 'supplier' : 'client';
        return view('organizations.edit', compact('organization', 'type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrganizationRequest $request, Organization $organization)
    {
        $data = $request->validated();

        $organization->update($data);

        if(str_contains(url()->previous(), 'client')) {
            return redirect()->route('client.index');
        } elseif(str_contains(url()->previous(), 'supplier')) {
            return redirect()->route('supplier.index');
        } else {
            dd("Error");
        }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        return back()->with('status', 'Organization deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtiene el tipo de organización (clientes o proveedores)
        $type = $request->query('type') ?? session('type');
    
        // Obtiene el término de búsqueda y el campo por el cual se va a buscar
        $search = $request->query('search');
        $searchBy = $request->query('search_by', 'name'); // Por defecto busca por "name"
    
        // Construir la consulta base para el tipo de organización
        $organizations = Organization::where('type', $type);
    
        // Si hay un término de búsqueda y un campo para buscar, filtrar por el campo seleccionado
        if ($search && $searchBy) {
            $organizations = $organizations->where($searchBy, 'like', '%' . $search . '%');
        }
    
        // Obtener las organizaciones con paginación
        $organizations = $organizations->paginate(10);
    
        // Retornar la vista con las organizaciones y los parámetros
        return view('dashboard.organizations.index', compact('organizations', 'type', 'search', 'searchBy'));
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
        return view('dashboard.organizations.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrganizationRequest $request, Organization $organization)
    {
        $data = $request->validated();

        $organization->update($data);

        return redirect()->route('organization.index', ['type' => $organization->type])->with('status', 'Organization updated successfully');
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\Supplier;
use App\Models\Transaction;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $status = $request->input('status');
    $query = Project::query();

    // Aplicar filtros según el estado
    if ($status === 'active') {
        $query->where('status', 'a');
    } elseif ($status === 'inactive') {
        $query->where('status', 'i');
    } elseif ($status === 'finished') {
        $query->where('status', 'f');
    }  elseif ($status === '') {
        // Excluir proyectos 
        $query->where('status', '!=', 'c');
    }
    $projects = $query->where('status', '!=', 'c')
                      ->orderBy('end_date', 'asc')->paginate(10)->appends(['status' => $status]);

    return view('projects.index', [
        'projects' => $projects,
        'suppliers' => Supplier::all(),
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get clients whose ID is not assigned to any project
        $clients = Client::whereDoesntHave('projects')->paginate(10);
        $project = new Project();
        $client_name = '';
        return view('projects.create', compact('clients', 'project', 'client_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        // validate the request
        $validated = $request->validated();
        
        $project = new Project($request->validated());
        $project->tax =  $project->subtotal * 0.16;
        $project->total = $project->subtotal + $project->tax;
        $project->save();

        return redirect()->route('project.index')->with('status', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);

        $totalAdvance = Transaction::whereHas('advance', function ($query) use ($id) {
            $query->where('project_id', $id); // Filtrar por el proyecto
        })->sum('amount');

        $diff = $project->total - $totalAdvance;
        
        return view('projects.show', compact('project', 'totalAdvance', 'diff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        $client_name = $project->client->organization->name;
        $clients = Client::paginate(10);
        return view('projects.edit', compact('project', 'clients', 'client_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $data['tax'] = $data['subtotal'] * 0.16;
        $data['total'] = $data['subtotal'] + $data['tax'];

        $project->update($data);

        return redirect()->route('project.index')->with('status', 'El proyecto ha sido actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function assignSupplier(Request $request)
    {
        $project = Project::find($request->project_id);

        $amount = $request->input('service_cost');

        if($project->status != 'a'){
            return back()->with('error', 'The project is not active');
        }

        $errorMessage = null;
        $successMessage = null;

        foreach ($request->supplier_ids as $supplierId) {
            
            if ($project->suppliers->contains($supplierId)) {
                $project->suppliers()->updateExistingPivot($supplierId, ['service_cost' => $amount]);
                $errorMessage = 'Uno o más proveedores ya estaban asignados al proyecto.';
            } else {
                // Asigna el proveedor si no está ya asignado
                $project->suppliers()->syncWithoutDetaching([$supplierId => ['service_cost' => $amount]]);
                // Actualizar el monto asignado en la tabla intermedia
                $project->suppliers()->updateExistingPivot($supplierId, ['service_cost' => $amount]);
                $successMessage = 'Proveedores asignados exitosamente.';
            }
        }

        if ($errorMessage) {
            return redirect()->route('project.index')->with('error', $errorMessage);
        }

        return redirect()->route('project.index')->with('status', $successMessage ?? 'No se asignaron proveedores nuevos.');
    }

    public function cancel(Request $request, Project $project)
    {
        // Validar si el estado no es ya 'cancelado'
        if ($project->status === 'c') {
            return redirect()->route('project.index')->with('warning', 'Este proyecto ya está cancelado.');
        }

        // Cambiar el estado del proyecto a 'c' (cancelado)
        $project->update(['status' => 'c']);

        return redirect()->route('project.index')->with('success', 'El proyecto ha sido cancelado exitosamente.');
    }


}

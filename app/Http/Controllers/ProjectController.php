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
        $clients = Client::paginate(10);
        $project = new Project();
        return view('projects.create', compact('clients', 'project'));
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
        $clients = Client::paginate(10);
        return view('projects.edit', compact('project', 'clients'));
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

        $amount = $request->input('amount');

        foreach ($request->supplier_ids as $supplierId) {
            
            if ($project->suppliers->contains($supplierId)) {

                $project->suppliers()->updateExistingPivot($supplierId, ['amount_assigned' => $amount]);
                $message = 'Uno o más proveedores ya estaban asignados al proyecto.';
            } else {
                // Asigna el proveedor si no está ya asignado
                $project->suppliers()->syncWithoutDetaching([$supplierId]);
                 // Actualizar el monto asignado en la tabla intermedia
                $project->suppliers()->updateExistingPivot($supplierId, ['amount_assigned' => $amount]);
                $message = 'Proveedores asignados exitosamente.';
            }
        }

        // Si no hubo mensaje, es porque no se asignó nada
        if (empty($message)) {
            $message = 'No se asignaron proveedores nuevos.';
        }

        // Envía el mensaje de retroalimentación al usuario
        session()->flash('success', $message);


        return redirect()->route('project.index');
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

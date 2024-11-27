<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\Supplier;
use Illuminate\Contracts\Cache\Store;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects.index', ['projects' => Project::paginate(10), 'suppliers' => Supplier::all()]);
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
        return view('projects.show', ['project' => Project::find($id)]);
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

        return redirect()->route('project.index')->with('status', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function assignSupplier(Project $project, Request $request)
    {
        foreach ($request->supplier_ids as $supplierId) {
            
            if ($project->supplier->contains($supplierId)) {
                $message = 'Uno o más proveedores ya estaban asignados al proyecto.';
            } else {
                // Asigna el proveedor si no está ya asignado
                $project->supplier()->syncWithoutDetaching([$supplierId]);
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
}

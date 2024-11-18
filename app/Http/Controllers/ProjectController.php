<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\Supplier;

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
        return view('projects.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tax = $request->subtotal * 0.16;
        $total = $request->subtotal + $tax;

        // append the new fields to the request
        $request->request->add(['tax' => $tax, 'total' => $total]);

        // create the project using eloquent matching the fields
        Project::create($request->all());

        return redirect()->route('project.index');
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

    public function assignSupplier(Project $project)
    {
        $suppliers = Supplier::all();
        return view('projects.assign-supplier', compact('suppliers'));
    }
}

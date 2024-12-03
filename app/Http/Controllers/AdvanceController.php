<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Advance;
use App\Models\Project;

class AdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $advances = Advance::with(['project.client.organization', 'transaction'])->paginate(10);
        return view('advances.index', compact('advances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $project = Project::find(request('project_id'));
        $id = $project->id;
        $totalAdvance = Transaction::whereHas('advance', function ($query) use ($id) {
            $query->where('project_id', $id); // Filtrar por el proyecto
        })->sum('amount');

        if($project->status != 'a'){
            return back()->with('error', 'The project is not active');
        }
        if ($totalAdvance + $request->amount > $project->total) {
            return back()->with('error', 'The total advance exceeds the project total');
        }

        $transaction = Transaction::create($request->all());

        $advance = new Advance();
        $advance->project_id = request('project_id');

        $transaction->advance()->save($advance);

        return back()->with('status', 'Advance registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advance $advance)
    {
        //
        dd($advance);
        $project = Advance::where('advance_id', $advance->project->total);
        $cliente = Project::where('client_id', $advance->project->client_id);
        $anticipoTotal = Advance::where('transaction_id', $advance->transaction_id->id)->sum('amount');
        return view('advances.show', compact('project', 'anticipototal'));
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

    public function showAdvances(String $project)
    {
        $project = Project::find($project);
        $advances = Transaction::whereHas('advance', function ($query) use ($project) {
            $query->where('project_id', $project->id);
        })->get();

        $anticipoTotal = $advances->sum('amount');

        //dd($advances);

        return view('advances.show', compact('project', 'advances', 'anticipoTotal'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Advance;

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
        $transaction = Transaction::create($request->all());

        $advance = new Advance();
        $advance->project_id = request('project_id');

        $transaction->advance()->save($advance);

        return back()->with('status', 'Advance registered successfully');
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
    public function destroy(Advance $advance)
    {
        //
        $advance->delete();

        // Redirigir a la lista de pagos con un mensaje de éxito
        return back()->with('status', 'Advance deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Advance;
use Illuminate\Support\Facades\DB;

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
        $results = DB::select('
            SELECT p.id, o.name,
                   SUM(total) AS cobroTotal
            FROM proyecto_is.projects AS p
            INNER JOIN proyecto_is.clients AS c ON p.client_id = c.id
            INNER JOIN proyecto_is.organizations AS o ON c.organization_id = o.id
            GROUP BY p.id, o.name;
        ');

        // Pasar los resultados a la vista
        return view('advance.deudas', ['results' => $results], compact('results'));
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectSupplier;
use App\Models\Transaction;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $supplier_id = $request->supplier_id;
        $project_id = $request->project_id;
        $project_supplier = ProjectSupplier::where('project_id', $project_id)    
                ->where('supplier_id', $supplier_id)
                ->first();

        $transaction = Transaction::create($request->all());

        $payment = new Payment();
        $payment->project_supplier_id = $project_supplier->id;
        $transaction->payment()->save($payment);

        return back()->with('status', 'Payment registered successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd($id);
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
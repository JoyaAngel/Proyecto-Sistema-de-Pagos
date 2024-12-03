<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectSupplier;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $payments = Payment::with('projectSupplier.supplier', 'transaction')->paginate(10);

        //dd($payments);

        // Pasar los pagos a la vista
        return view('payments.index_all', compact('payments'));
        //Mira joyita, es esto uwu
    }

    public function deudas()
    {
        $results = DB::select('
            SELECT o.name, SUM(amount_assigned) AS deudaTotal
            FROM proyecto_is.project_supplier AS ps
            INNER JOIN proyecto_is.suppliers AS s ON (ps.supplier_id = s.id)
            INNER JOIN proyecto_is.organizations AS o ON (s.organization_id = o.id)
            GROUP BY o.name
        ');

        return view('payments.deudas', ['results' => $results]);
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
    public function show($supplierId)
{
    $supplier = Supplier::findOrFail($supplierId);

    // Obtener los project_supplier_id relacionados con el proveedor
    $projectSupplierIds = ProjectSupplier::where('supplier_id', $supplierId)->pluck('id');

    // Obtener los pagos relacionados con esos project_supplier_id
    $payments = Payment::whereIn('project_supplier_id', $projectSupplierIds)->get();

    return view('payments.index', compact('supplier', 'payments'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
        $payment->delete();

        // Redirigir a la lista de pagos con un mensaje de éxito
        return back()->with('status', 'Payment deleted successfully');
    }

}

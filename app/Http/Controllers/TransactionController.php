<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index(Request $request)
    {
        $type = $request->query('type') ?? session('type');
    
        $search = $request->query('search');
        $searchBy = $request->query('search_by', 'name');
    
        $transactions = Organization::where('type', $type);
    
        if ($search && $searchBy) {
            $transactions = $transactions->where($searchBy, 'like', '%' . $search . '%');
        }
    
        $transactions = $transactions->paginate(10);
    
        //return view('dashboard.organizations.index', compact('organizations', 'type', 'search', 'searchBy'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = $request->query('type');
        $transaction = new Transaction();
        return view()
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transaction = $request->validated();

        Transaction::create($transaction);

        return back()->with('status', 'Transaction created successfully');
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
        return view('dashboard.transactions.edit', compact('transaction '));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validated();

        $transaction->update($data);

        return redirect()->route('transaction.index', ['type' => $transaction->type])->with('status', 'Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction->delete();

        return back()->with('status', 'Transaction deleted successfully');
    }
}

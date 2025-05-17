<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Expense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('admin.pages.expenses.index', [
            'expenses' => $expenses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $types = ExpenseType::all();
        $expense = new Expense();
        return view('admin.pages.expenses.create', [
            'companies' => $companies,
            'types' => $types,
            'expense' => $expense,
            'title' => 'Tambah Pengeluran',
            'route' => route('expenses.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'expense_type_id' => 'required|exists:expense_types,id',
            'date' => 'required|date',
            'nominal' => 'required',
            'notes' => 'nullable',
        ]);

        $userId = Auth::id();
        $input['created_by'] = $userId;
        $input['updated_by'] = $userId;
        Expense::create($input);
        return redirect()->route('expenses.index')->with('success','Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $companies = Company::all();
        $types = ExpenseType::all();
        return view('admin.pages.expenses.create', [
            'companies' => $companies,
            'types' => $types,
            'expense' => $expense,
            'title' => 'Edit Pengeluran',
            'route' => route('expenses.update', $expense->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $input = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'expense_type_id' => 'required|exists:expense_types,id',
            'date' => 'required|date',
            'nominal' => 'required',
            'notes' => 'nullable',
        ]);

        $userId = Auth::id();
        $input['nominal'] = (int) $input['nominal'];
        $input['updated_by'] = $userId;
        $expense->update($input);
        return redirect()->route('expenses.index')->with('success','Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $userId = Auth::id();
        $expense->update([
            'updated_by' => $userId,
            'deleted_by' => $userId
        ]);
        $expense->delete();
        return response()->json([
            'message' => 'Data berhasil diubah.'
        ]);
    }
}

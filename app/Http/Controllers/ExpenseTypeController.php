<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseTypeController extends Controller
{
    public function index()
    {
        $expenseTypes = ExpenseType::all();
        return view('admin.pages.expense-types.index', [
            'expenseTypes' => $expenseTypes
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $expenseType = ExpenseType::create(['name' => $request->name]);
        return response()->json([
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $expenseType
        ]);
    }

    public function update(Request $request, ExpenseType $expenseType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:expense_types,name,'.$expenseType->name.',name'
            ,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $expenseType->update(['name' => $request->name]);
        return response()->json([
            'message' => 'Data Berhasil Diubah!',
            'data'    => $expenseType
        ]);
    }

    public function destroy(ExpenseType $expenseType)
    {
        $expenseType->delete();
        return response()->json(['message' => 'Jenis Biaya Berhasil Dihapus!']);
    }
}

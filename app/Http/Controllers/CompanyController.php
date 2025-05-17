<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    function selected(Request $request){
        $input = $request->validate([
            'company_id' => 'required|exists:companies,id'
        ]);
        $company = Company::where('id', $input['company_id'])->first();
        $company->update(['is_selected' => true]);
        Company::where('id','!=' , $company->id)->update(['is_selected' => false]);
        return redirect()->back()->with('message', 'Perusahaan Berhasil dipilih');
    }
}

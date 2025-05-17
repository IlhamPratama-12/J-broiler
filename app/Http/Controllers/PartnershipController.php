<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PartnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partnerships = Partnership::latest()->paginate(10);
        return view('admin.pages.partnerships.index', compact('partnerships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partnership = new Partnership();
        return view('admin.pages.partnerships.create', [
            'partnership' => $partnership,
            'title' => 'Tambah Partnership',
            'route' => route('partnerships.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'type' => 'required|in:MITRA,CUSTOMER',
            'full_name' => 'required',
            'phone' => 'required|numeric',
            'business_name' => 'nullable',
            'business_address' => 'nullable',
            'social_media' => 'nullable',
            'notes' => 'nullable',
        ]);
        Partnership::create($input);
        return redirect()->route('partnerships.index')->with('success','Partner Baru berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partnership $partnership)
    {
        return view('admin.pages.partnerships.show', [
            'partnership' => $partnership,
            'title' => 'Detail Partnership',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partnership $partnership)
    {
        return view('admin.pages.partnerships.create', [
            'partnership' => $partnership,
            'title' => 'Ubah Partnership',
            'route' => route('partnerships.update', $partnership->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partnership $partnership)
    {
        $input = $request->validate([
            'type' => 'required|in:MITRA,CUSTOMER',
            'full_name' => 'required',
            'phone' => 'required|numeric',
            'business_name' => 'nullable',
            'business_address' => 'nullable',
            'social_media' => 'nullable',
            'notes' => 'nullable',
        ]);
        $partnership->update($input);
        return redirect()->route('partnerships.index')->with('success','Data Partner berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partnership $partnership)
    {
        $partnership->delete();
        return response()->json(['message','Partner berhasil dihapus.']);
    }
}

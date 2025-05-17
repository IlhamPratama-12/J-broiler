<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Partnership;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guest::latest()->paginate(10);
        return view('admin.pages.guests.index', compact('guests'));
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
        $input = $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        Guest::create($input);
        return redirect()->route('guests.index')->with('success','Tamu Baru berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        // return view('admin.pages.guests.index', compact('guest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        return view('admin.pages.guests.create', [
            'title' => 'Ubah Tamu',
            'guest' => $guest,
            'route' => route('guests.update', $guest->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $input = $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        $guest->update($input);
        return redirect()->route('guests.index')->with('success','Data Tamu berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json(['message' => 'Data Tamu berhasil Hapus.']);
    }

    public function addPartnership(Request $request, Guest $guest)
    {
        $input = $request->validate([
            'type' => 'required|in:MITRA,CUSTOMER',
        ]);

        Partnership::create([
            'type' => $input['type'],
            'full_name' => $guest->full_name,
            'phone' => $guest->phone,
        ]);
        $guest->delete();
        return redirect()->route('guests.index')->with('success','Data Tamu berhasil ditambahkan sebagai Partnership.');
    }
}

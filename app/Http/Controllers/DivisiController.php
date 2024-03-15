<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\User;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $divisions = Divisi::orderBy('name_divisi')->get();
        $divisions = Divisi::with(['user'])->orderBy('name_divisi')->get();
        $users = User::orderBy('name')->get();

        return response()->view('backend.divisions.index', [
            'title' => 'Data Divisi',
            'divisions' => $divisions,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validate = $request->validate([
        //     'id' => 'required',
        //     'name_divisi' => 'required|unique:divisi'
        // ]);
        // ddd($request);
        Divisi::create([
            'id' => $request->id,
            'name_divisi' => $request->name_divisi,
        ]);

        return redirect(route('divisions.index'))->with('message', 'Data Divisi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisi $divisi, $id)
    {
        $divisi = Divisi::with(['user'])->where('id', $id)->first();
        
        return view('backend.divisions.show', [
            'title' => 'Detail User',
            'divisi' => $divisi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Divisi $divisi, $id)
    {
        $divisi = Divisi::where('id', $id)->first();
        $users = User::where('role', 'ketua')->get();
        return view('backend.divisions.edit', [
            'title' => 'Edit Divisi',
            'divisi' => $divisi,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Divisi $divisi, $id)
    {
        $validate = $request->validate([
            'id' => 'required',
            'name_divisi' => 'required',
            'head' => 'required'
        ]);
        Divisi::findOrFail($id)->update($validate);

        return redirect(route('divisions.index'))->with('message', 'Data Divisi berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisi $divisi, $id)
    {
        Divisi::findOrFail($id)->delete();

        return redirect(route('divisions.index'))->with('message', 'Data Divisi berhasil dihapus');
    }
}

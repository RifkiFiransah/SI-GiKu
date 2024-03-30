<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Proker;
use Illuminate\Http\Request;

class ProkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prokers = Proker::with(['divisi', 'user'])->orderBy('name_proker')->get();
        $divisions = Divisi::orderBy('name_divisi')->get();

        return view('backend.prokers.index', [
            'title' => 'Proker Genbi',
            'prokers' => $prokers,
            'divisions' => $divisions
        ]);
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
        $validate = $request->validate([
            'id' => 'required|uuid',
            'name_proker' => 'required|string|unique:prokers',
            'divisi_id' => 'required|uuid',
            'description' => 'required|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'status' => 'required'
        ]);

        $proker = Proker::create($validate);

        if(!$proker){
            return redirect(route('prokers.index'))->with('message', 'Data Proker Gagal ditambahkan');
        }

        return redirect(route('prokers.index'))->with('message', 'Data Proker Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proker $proker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proker $proker)
    {
        $divisions = Divisi::orderBy('name_divisi')->get();

        return view('backend.prokers.edit', [
            'title' => 'Edit Proker',
            'proker' => $proker,
            'divisions' => $divisions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proker $proker)
    {
        $validate = $request->validate([
            'id' => 'required|uuid',
            'name_proker' => 'required|string',
            'divisi_id' => 'required|uuid',
            'description' => 'required|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'status' => 'required'
        ]); 

        $proker_update = $proker->update($validate);
        if(!$proker_update){
            return redirect(route('prokers.index'))->with('message', 'Data Proker Gagal di update');
        }

        return redirect(route('prokers.index'))->with('message', 'Data Proker Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proker $proker)
    {
        $proker_delete = $proker->delete();
        if(!$proker_delete){
            return redirect(route('prokers.index'))->with('message', 'Data Proker Gagal dihapus');
        }

        return redirect(route('prokers.index'))->with('message', 'Data Proker Berhasil dihapus');
    
    }
}

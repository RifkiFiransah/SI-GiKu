<?php

namespace App\Http\Controllers;

use App\Models\Genbi;
use Illuminate\Http\Request;

class GenbiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genbiers = Genbi::orderBy('name_genbi')->get();

        return view('backend.genbiers.index', [
            'title' => 'Data Genbi',
            'genbiers' => $genbiers
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
            'id' => 'required',
            'name_genbi' => 'required|unique:genbis',
            'ketua_umum' => 'required|unique:genbis',
            'address' => 'required'
        ]);

        $genbi = Genbi::create($validate);

        if(!$genbi){
            return redirect(route('genbiers.index'))->with('message', 'Data Genbi gagal ditambahkan');
        }

        return redirect(route('genbiers.index'))->with('message', 'Data Genbi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genbi $genbi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genbi $genbi, $id)
    {
        $genbi = Genbi::where('id', $id)->first();

        // ddd($genbi);
        return view('backend.genbiers.edit', [
            'title' => 'Edit Genbi',
            'genbi' => $genbi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genbi $genbi, $id)
    {
        $validate = $request->validate([
            'id' => 'required',
            'name_genbi' => 'required',
            'ketua_umum' => 'required',
            'address' => 'required'
        ]);

        $genbi = Genbi::findOrFail($id)->update($validate);
        if(!$genbi){
            return redirect(route('genbiers.index'))->with('message', 'Data Genbi gagal diupdate');
        }
        return redirect(route('genbiers.index'))->with('message', 'Data Genbi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genbi $genbi, $id)
    {
        $genbi = Genbi::findOrFail($id)->delete();

        if(!$genbi){
            return redirect(route('genbiers.index'))->with('message', 'Data Genbi gagal dihapus');
        }
        return redirect(route('genbiers.index'))->with('message', 'Data Genbi berhasil dihapus');
    }
}

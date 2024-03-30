<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Acara;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $acara = Acara::latest()->first();
        $acaras = Acara::latest()->get()->except($acara->id);
        return view('backend.absensis.index', [
            'title' => 'Absensi Kegiatan',
            'acaras' => $acaras,
            'acara' => $acara
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
            'name_kegiatan' => 'required|min:3|max:100',
            'tgl_kegiatan' => 'required',
            'image' => 'required|file|max:2048'
        ]);
        if($request->file('image')){
            $validate['image'] = $request->file('image')->store('acara-images');
        }

        $acara = Acara::create([
            'id' => $request->id,
            'name_kegiatan' => $request->name_kegiatan,
            'tgl_kegiatan' => $request->tgl_kegiatan,
            'foto_kegiatan' => $validate['image'],
        ]);
        if(!$acara){
            return redirect(route('absensi.index'))->with('message', 'Data Absensi Gagal ditambahkan');
        }
        return redirect(route('absensi.index'))->with('message', 'Data Absensi Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Acara $absensi)
    {
        return view('backend.absensis.edit', [
            'title' => 'Edit Absensi',
            'acara' => $absensi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Acara $absensi)
    {
        $validate = $request->validate([
            'id' => 'required',
            'name_kegiatan' => 'required|min:3|max:100',
            'tgl_kegiatan' => 'required',
        ]);
        if($request->file('image')){
            $image = $request->file('image')->store('acara-images');
        } else {
            $image = $request->foto_kegiatan_old;
        }
        $update = $absensi->update([
            'name_kegiatan' => $validate['name_kegiatan'],
            'tgl_kegiatan' => $validate['tgl_kegiatan'],
            'foto_kegiatan' => $image,
        ]);
        if(!$update){
            return redirect(route('absensi.index'))->with('message', 'Data Absensi Gagal ditambahkan');
        }
        return redirect(route('absensi.index'))->with('message', 'Data Absensi Berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acara $absensi)
    {
        $absensi->delete();

        return redirect(route('absensi.index'))->with('message', 'Data Absensi berhasil di hapus');
    }
}

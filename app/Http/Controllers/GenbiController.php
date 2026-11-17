<?php

namespace App\Http\Controllers;

use App\Models\Genbi;
use Illuminate\Http\Request;

class GenbiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $term = '%'.addcslashes($search, '%_\\').'%';
        $genbiers = Genbi::query()
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($term) {
                $query->where('name_genbi', 'like', $term)
                    ->orWhere('ketua_umum', 'like', $term)
                    ->orWhere('address', 'like', $term);
            }))
            ->orderBy('name_genbi')
            ->paginate(5)
            ->withQueryString();

        return view('backend.genbiers.index', [
            'title' => 'Data Genbi',
            'genbiers' => $genbiers,
            'search' => $search,
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
            'address' => 'required',
            'logo' => 'nullable|string|max:255|regex:/^[A-Za-z0-9._-]*$/',
            'is_current' => 'boolean',
        ]);

        $validate['is_current'] = (bool) ($validate['is_current'] ?? false);

        if ($validate['is_current']) {
            Genbi::query()->where('is_current', true)->update(['is_current' => false]);
        }

        $genbi = Genbi::create($validate);

        if (! $genbi) {
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
            'genbi' => $genbi,
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
            'address' => 'required',
            'logo' => 'nullable|string|max:255|regex:/^[A-Za-z0-9._-]*$/',
            'is_current' => 'boolean',
        ]);

        $validate['is_current'] = (bool) ($validate['is_current'] ?? false);

        if ($validate['is_current']) {
            Genbi::query()
                ->where('is_current', true)
                ->where('id', '!=', $id)
                ->update(['is_current' => false]);
        }

        $genbi = Genbi::findOrFail($id)->update($validate);
        if (! $genbi) {
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

        if (! $genbi) {
            return redirect(route('genbiers.index'))->with('message', 'Data Genbi gagal dihapus');
        }

        return redirect(route('genbiers.index'))->with('message', 'Data Genbi berhasil dihapus');
    }
}

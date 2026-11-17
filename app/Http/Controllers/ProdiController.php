<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $term = '%'.addcslashes($search, '%_\\').'%';
        $prodis = Prodi::query()
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($term) {
                $query->where('name_prodi', 'like', $term)
                    ->orWhere('name_fakultas', 'like', $term);
            }))
            ->orderBy('name_prodi')
            ->paginate(5)
            ->withQueryString();

        return view('backend.prodis.index', [
            'title' => 'Data Prodi',
            'prodis' => $prodis,
            'search' => $search,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required|uuid',
            'name_prodi' => 'required|string|unique:prodis',
            'name_fakultas' => 'nullable|string|max:255',
        ]);

        $prodi = Prodi::create($validate);

        if (! $prodi) {
            return redirect(route('prodis.index'))->with('message', 'Data Prodi gagal ditambahkan');
        }

        return redirect(route('prodis.index'))->with('message', 'Data Prodi berhasil ditambahkan');
    }

    public function show(Prodi $prodi)
    {
        //
    }

    public function edit(Prodi $prodi)
    {
        return view('backend.prodis.edit', [
            'title' => 'Edit Prodi',
            'prodi' => $prodi,
        ]);
    }

    public function update(Request $request, Prodi $prodi)
    {
        $validate = $request->validate([
            'id' => 'required|uuid',
            'name_prodi' => [
                'required',
                'string',
                Rule::unique('prodis', 'name_prodi')->ignore($prodi->id, 'id'),
            ],
            'name_fakultas' => 'nullable|string|max:255',
        ]);

        $updated = $prodi->update($validate);

        if (! $updated) {
            return redirect(route('prodis.index'))->with('message', 'Data Prodi gagal diupdate');
        }

        return redirect(route('prodis.index'))->with('message', 'Data Prodi berhasil diupdate');
    }

    public function destroy(Prodi $prodi)
    {
        $deleted = $prodi->delete();

        if (! $deleted) {
            return redirect(route('prodis.index'))->with('message', 'Data Prodi gagal dihapus');
        }

        return redirect(route('prodis.index'))->with('message', 'Data Prodi berhasil dihapus');
    }
}

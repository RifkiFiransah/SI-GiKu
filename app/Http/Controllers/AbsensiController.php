<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Acara;
use App\Models\Divisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $term = '%'.addcslashes($search, '%_\\').'%';
        $query = Acara::query()
            ->when($search !== '', fn ($query) => $query->where('name_kegiatan', 'like', $term))
            ->orderByDesc('tgl_kegiatan');
        $acara = (clone $query)->first();
        $acaras = (clone $query)
            ->when($acara, fn ($query) => $query->whereKeyNot($acara->id))
            ->paginate(5)
            ->withQueryString();
        $acaraIds = $acaras->pluck('id');
        if ($acara) {
            $acaraIds->push($acara->id);
        }
        $absensiCounts = Absensi::query()
            ->whereIn('acara_id', $acaraIds)
            ->selectRaw('acara_id, count(*) as total')
            ->groupBy('acara_id')
            ->pluck('total', 'acara_id');

        return view('backend.absensis.index', [
            'title' => 'Absensi Kegiatan',
            'acaras' => $acaras,
            'acara' => $acara,
            'search' => $search,
            'absensiCounts' => $absensiCounts,
            'users' => User::orderBy('name')->get(),
            'divisions' => Divisi::orderBy('name_divisi')->get(),
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
            'name_kegiatan' => 'required|min:3|max:100',
            'tgl_kegiatan' => 'required|date',
            'image' => 'required|file|max:2048|mimes:jpg,jpeg,png,webp',
        ]);
        $validate['image'] = $request->file('image')->store('acara-images');

        $acara = Acara::create([
            'name_kegiatan' => $validate['name_kegiatan'],
            'tgl_kegiatan' => $validate['tgl_kegiatan'],
            'foto_kegiatan' => $validate['image'],
        ]);
        if (! $acara) {
            return redirect(route('absensi.index'))->with('message', 'Data Absensi Gagal ditambahkan');
        }

        return redirect(route('absensi.index'))->with('message', 'Data Absensi Berhasil ditambahkan');
    }

    public function hadir(Request $request, Acara $acara)
    {
        if (! $acara->bisa_absen) {
            throw ValidationException::withMessages([
                'tgl_kegiatan' => 'Absensi hanya tersedia mulai hari kegiatan sampai 7 hari setelahnya.',
            ]);
        }

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'divisi_id' => ['required', 'exists:divisis,id'],
            'resume_kegiatan' => ['nullable', 'string', 'max:1000'],
            'bukti_kegiatan' => ['nullable', 'file', 'max:2048', 'mimes:jpg,jpeg,png,pdf'],
        ]);

        $absensi = Absensi::updateOrCreate(
            ['acara_id' => $acara->id, 'user_id' => $validated['user_id']],
            [
                'divisi_id' => $validated['divisi_id'],
                'resume_kegiatan' => $validated['resume_kegiatan'] ?? null,
            ]
        );

        if ($request->hasFile('bukti_kegiatan')) {
            $absensi->update([
                'bukti_kegiatan' => $request->file('bukti_kegiatan')->store('bukti-absensi'),
            ]);
        }

        return redirect(route('absensi.index'))->with('message', 'Absensi berhasil disimpan');
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
            'acara' => $absensi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Acara $absensi)
    {
        $validate = $request->validate([
            'name_kegiatan' => 'required|min:3|max:100',
            'tgl_kegiatan' => 'required|date',
            'image' => 'nullable|file|max:2048|mimes:jpg,jpeg,png,webp',
        ]);
        $image = $request->hasFile('image')
            ? $request->file('image')->store('acara-images')
            : $absensi->foto_kegiatan;

        $update = $absensi->update([
            'name_kegiatan' => $validate['name_kegiatan'],
            'tgl_kegiatan' => $validate['tgl_kegiatan'],
            'foto_kegiatan' => $image,
        ]);
        if (! $update) {
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

<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['prodi', 'divisi'])->orderBy('name')->get();
        $prodies = Prodi::orderBy('name_prodi')->get();
        $divisions = Divisi::orderBy('name_divisi')->get();

        return response()->view('backend.users.index', [
            'title' => 'Data user',
            'users' => $users,
            'prodies' => $prodies,
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
            'id' => 'required',
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'prodi_id' => 'required',
            'divisi_id' => 'required',
            'address' => 'required',
            'no_telp' => 'required',
            'role' => 'required',
            'password' => 'required|min:3'
        ]);

        User::create($validate);

        return redirect(route('users.index'))->with('message', 'Data Berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->view('backend.users.show', [
            'title' => 'Detail User',
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // $users = User::with(['prodi', 'divisi'])->orderBy('name')->get();
        $prodies = Prodi::orderBy('name_prodi')->get();
        $divisions = Divisi::orderBy('name_divisi')->get();

        return response()->view('backend.users.edit', [
            'title' => 'Edit User',
            'user' => $user,
            'prodies' => $prodies,
            'divisions' => $divisions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'id' => 'required',
            'name' => 'required|min:3|max:50',
            'email' => "required|email",
            'prodi_id' => 'required',
            'divisi_id' => 'required',
            'address' => 'required',
            'no_telp' => 'required',
            'role' => 'required',
        ]);

        User::findOrFail($user->id)->update($validate);

        return redirect(route('users.index'))->with('message', 'Data user berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::where('id', $user->id)->delete();

        return redirect(route('users.index'))->with('message', 'Data berhasil di hapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Divisi;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
// use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Mpdf\Mpdf;
use Barryvdh\DomPDF\Facade\Pdf;
// use Spatie\LaravelPdf\Facades\Pdf;

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

    public function table()
    {
        $users = User::with(['prodi', 'divisi'])->orderBy('name')->get();

        return response()->view('backend.users.table', [
            'title' => 'Data user',
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

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

    public function export_excel()
    {
        return Excel::download(new UsersExport, 'anggota_genbiUniku.xlsx');
    }
    
    public function export_csv()
    {
        return Excel::download(new UsersExport, 'anggota_genbiUniku.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
      ]);
    }

    public function export_pdf()
    {
        // return PDF::download(new UsersExport, 'anggota_genbiUniku.pdf');
        $users = User::with(['divisi', 'prodi'])->orderBy('name')->get();
        // return Excel::download(new UsersExport, 'anggota_genbiUniku.xlsx');

        // return Excel::download(new UsersExport, 'anggota_genbiUniku.pdf', \Maatwebsite\Excel\Excel::MPDF);
        // ddd($users);
        // $pdf = Pdf::loadView('backend.users.table', ['users' => $users]);
        // return $pdf->save('anggotaGenbi.pdf');
        // return Pdf::view('pdfs.invoice', ['users' => $users])
        //     ->format('a4')
        //     ->name('your-invoice.pdf');
        $mpdf = new \Mpdf\Mpdf();
        // $mpdf->WriteHTML(view('backend.users.table', ['users' => $users]));
        $mpdf->WriteHTML('<h1>Hello World</h1>');
        $mpdf->Output('anggotaGenbi.pdf', 'D');
        // $mpdf->Output();
        // ddd($mpdf);
        // return view('backend.users.table', ['users' => $users]);
        // $pdf = PDF::loadView('');
    }
}

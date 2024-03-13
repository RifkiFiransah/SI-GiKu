<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View as ViewView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
// use Barryvdh\DomPDF\Concerns\FromView;
use Illuminate\View\View;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): ViewView
    {
        $users = User::with(['divisi', 'prodi'])->orderBy('name')->get();
        return view('backend.users.table', ['title' => 'Export Anggota', 'users' => $users]);
    }
}

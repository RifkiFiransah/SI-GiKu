@extends('backend.layouts.main')
@section('content')
    <div class="row card">
        <div class="col-lg-12 align-items-stretch card-body">
            <h3 class="mt-4 card-title fw-semibold fs-5">Detail User</h3>
            <div class="mt-4 w-100 card">
                <div class="card-header">
                    {{ $user->email }}
                </div>
                <div class="p-4 card-body">
                    <h5 class="mb-3 card-title">{{ $user->name }}</h5>
                    <p class="card-title">Program Studi : {{ $user->Prodi->name_prodi }}</p>
                    <p class="card-title">Divisi : {{ $user->Divisi->name_divisi }}</p>
                    <p class="card-title">Jabatan : {{ $user->role }}</p>
                    <p class="card-text">{{ $user->no_telp }}</p>
                    <p class="card-text">{{ $user->address }}</p>
                    <a href="{{ route('users.index') }}" class="btn btn-danger">Back</a>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit Data</a>
                </div>
            </div>
        </div>
    </div>
@endsection

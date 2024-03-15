@extends('backend.layouts.main')
@section('content')
    <div class="row card">
      <div class="col-lg-12 align-items-stretch card-body">
        <h3 class="mt-4 card-title fw-semibold">Detail Divisi</h3>
        <div class="mt-4 w-100 card">
          <div class="card-header">
              {{ $divisi->name_divisi }}
          </div>
          <div class="p-4 card-body">
              <h5 class="mb-3 card-title">Ketua : {{ $divisi->head }}</h5>
              <p class="mb-3 card-title">Anggota : </p>
              @forelse ($divisi->User as $user)
                <p class="mb-3 card-title">{{ $user->name }}</p>
              @empty
                <p class="mb-3 card-title">Anggota belum ada</p>
              @endforelse
              <a href="{{ route('divisions.index') }}" class="btn btn-danger">Back</a>
              <a href="{{ route('divisions.edit', $divisi) }}" class="btn btn-primary">Edit Data</a>
          </div>
      </div>
      </div>
    </div>
@endsection
@extends('backend.layouts.main')
@section('content')
    <div class="row card">
      <div class="col-lg-12 align-item-stretch card-body">
        <h2 class="mt-4 card-title fw-semi-bold">Edit Divisi</h2>
        <div class="mt-4 w-100 card">
          <div class="p-4 card-body">
            <form action="{{ route('divisions.update', $divisi) }}" method="post">
                @method('PUT')
                @csrf
                {{-- <input type="hidden" name="password" value=""> --}}
                <input type="hidden" name="id" value="{{ $divisi->id }}">
                <div class="mb-3 row">
                  <div class="col-12">
                      <label for="name_divisi" class="form-label">Nama</label>
                      <input type="text" class="form-control" id="name_divisi" name="name_divisi" value="{{ $divisi->name_divisi }}">
                      @error('name_divisi')
                          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                      @enderror
                  </div>
                </div>
                <div class="mb-3 row">
                  <div class="col-12">
                      <label for="head" class="form-label">Ketua</label>
                      <select name="head" id="head" class="form-select">
                        @forelse ($users as $user)
                          @if ($user->name == $divisi->head)
                            <option value="{{ $user->name }}" selected>{{ $user->name }}</option>
                          @else
                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                          @endif
                        @empty
                          <option disabled >Data Belum tersedia</option>
                        @endforelse
                          {{-- <option value="wakil ketua">Wakil Ketua</option>
                          <option value="sekertaris">Sekertaris</option>
                          <option value="anggota">Anggota</option> --}}
                      </select>
                      @error('head')
                          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                      @enderror
                </div>
                {{-- <label for="password" class="form-label">Password</label> --}}
                <div class="mt-3 row">
                  <div class="col-12">
                    <a href="{{ route('divisions.index') }}" class="btn btn-danger">Back</a>
                    <button type="submit" class="btn btn-primary">Edit Data</button>
                  </div>
                </div>
            </form>
        </div>
        </div>
      </div>
    </div>
@endsection
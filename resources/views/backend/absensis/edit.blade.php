@extends('backend.layouts.main')
@section('content')
    <div class="row card">
      <div class="col-lg-12 align-item-stretch card-body">
        <h2 class="mt-4 card-title fw-semi-bold">Edit Absensi</h2>
        <div class="mt-4 w-100 card">
          <div class="p-4 card-body">
            <form action="{{ route('absensi.update', $acara) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $acara->id }}">
                <input type="hidden" name="foto_kegiatan_old" value="{{ $acara->foto_kegiatan }}">
                <div class="mb-3 row">
                  <div class="col-12">
                      <label for="name_kegiatan" class="form-label">Nama Kegiatan</label>
                      <input type="text" class="form-control" id="name_kegiatan" name="name_kegiatan" value="{{ $acara->name_kegiatan }}">
                      @error('name_kegiatan')
                          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                      @enderror
                  </div>
                </div>
                <div class="mb-3 row">
                  <div class="col-12">
                      <label for="tgl_kegiatan" class="form-label">Tanggal Kegiatan</label>
                      <input type="date" class="form-control" id="tgl_kegiatan" name="tgl_kegiatan" value="{{ $acara->tgl_kegiatan }}">
                      @error('tgl_kegiatan')
                          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                      @enderror
                  </div>
                </div>
                <div class="mb-3 row">
                  <div class="col-12">
                      <label for="image" class="form-label">Foto Kegiatan</label>
                      <input type="file" class="form-control" id="image" name="image">
                      @error('image')
                          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                      @enderror
                  </div>
                </div>
                <div class="mt-3 row">
                  <div class="col-12">
                    <a href="{{ route('absensi.index') }}" class="btn btn-danger">Back</a>
                    <button type="submit" class="btn btn-primary">Edit Data</button>
                  </div>
                </div>
            </form>
        </div>
        </div>
      </div>
    </div>
@endsection
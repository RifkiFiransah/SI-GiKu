@extends('backend.layouts.main')
@section('content')
    <div class="row card">
        <div class="col-lg-12 card-body">
            <h3 class="mt-4 font-semibold fs-5 card-title">Edit Program Kerja</h3>
            <div class="mt-4 card w-100">
                <div class="p-4 card-body">
                    <form action="{{ route('prokers.update', $proker->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row g-3">
                            <input type="hidden" name="id" value="{{ $proker->id }}">
                            <div class="col-12">
                                <label for="name_proker" class="form-label">Program Kerja</label>
                                <input type="text" class="form-control" id="name_proker" name="name_proker" value="{{ $proker->name_proker }}">
                                @error('name_proker')
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{ $proker->description }}</textarea>
                                @error('password')
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="divisi_id" class="form-label">Divisi</label>
                                <select name="divisi_id" id="divisi_id" class="form-select">
                                    <option selected disabled>------------------ Pilih Divisi ------------------</option>
                                    @forelse ($divisions as $divisi)
                                      @if ($divisi->id == $proker->divisi_id)
                                        <option value="{{ $divisi->id }}" selected>{{ $divisi->name_divisi }}</option>
                                      @else
                                        <option value="{{ $divisi->id }}">{{ $divisi->name_divisi }}</option>
                                      @endif
                                    @empty
                                        <option disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-12">
                              <label for="status" class="form-label">Status</label>
                              <input type="text" class="form-control" id="status" name="status" value="{{ $proker->status ?? '' }}">
                              @error('status')
                                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                              @enderror
                          </div>
                            <div class="col-12">
                                <label for="tanggal_pelaksanaan" class="form-label">TGL Pelaksanaan</label>
                                <input type="date" class="form-control" id="tanggal_pelaksanaan"
                                    value="{{ $proker->tanggal_pelaksanaan }}" name="tanggal_pelaksanaan">
                                @error('tanggal_pelaksanaan')
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                @enderror
                            </div>
                            <div class="col-6">
                              <a href="{{ route('prokers.index') }}" class="btn btn-danger">Close</a>
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

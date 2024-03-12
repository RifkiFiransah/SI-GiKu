@extends('backend.layouts.main')
@section('content')
    <div class="row card">
        <div class="col-lg-12 align-items-stretch card-body">
            <h3 class="mt-4 card-title fw-semibold fs-5">Edit User</h3>
            <div class="mt-4 w-100 card">
                <div class="p-4 card-body">
                    <form action="{{ route('users.update', $user) }}" method="post">
                        @method('PUT')
                        @csrf
                        {{-- <input type="hidden" name="password" value=""> --}}
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="mb-3 row">
                          <div class="col-6">
                              <label for="name" class="form-label">Nama</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                              @error('name')
                                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                              @enderror
                          </div>
                          <div class="col-6">
                              <label for="exampleInputEmail1" class="form-label">Email address</label>
                              <input type="email" class="form-control" id="exampleInputEmail1" value="{{ $user->email }}" name="email">
                              @error('email')
                                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                              @enderror
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <div class="col-6">
                              <label for="prodi_id" class="form-label">Program Studi</label>
                              <select name="prodi_id" id="prodi_id" class="form-select">
                                  <option selected disabled>Pilih Data Program Studi</option>
                                  @forelse ($prodies as $prodi)
                                    @if ($prodi->id == $user->prodi_id)
                                      <option value="{{ $prodi->id }}" selected>{{ $prodi->name_prodi }}</option>
                                    @else 
                                      <option value="{{ $prodi->id }}">{{ $prodi->name_prodi }}</option>
                                    @endif
                                  @empty
                                      <option disabled>data belum tersedia</option>
                                  @endforelse
                              </select>
                              @error('prodi')
                                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                              @enderror
                          </div>
                          <div class="col-6">
                              <label for="divisi_id" class="form-label">Divisi</label>
                              <select name="divisi_id" id="divisi_id" class="form-select">
                                  <option selected disabled>Pilih Data Divisi</option>
                                  @forelse ($divisions as $divisi)
                                    @if ($divisi->id == $user->divisi_id)
                                      <option value="{{ $divisi->id }}" selected>{{ $divisi->name_divisi }}</option>
                                    @else 
                                      <option value="{{ $divisi->id }}">{{ $divisi->name_divisi }}</option>
                                    @endif
                                  @empty
                                      <option disabled>data belum tersedia</option>
                                  @endforelse
                              </select>
                              @error('divisi')
                                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                              @enderror
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <div class="col-6">
                              <label for="role" class="form-label">Jabatan</label>
                              <select name="role" id="role" class="form-select">
                                  <option {{ ($user->role === 'ketua') ? 'selected' : '' }} value="ketua">Ketua</option>
                                  <option {{ ($user->role === 'wakil ketua') ? 'selected' : '' }} value="wakil ketua">Wakil Ketua</option>
                                  <option {{ ($user->role === 'bendahara') ? 'selected' : '' }} value="bendahara">Bendahara</option>
                                  <option {{ ($user->role === 'sekertaris') ? 'selected' : '' }} value="sekertaris">Sekertaris</option>
                                  <option {{ ($user->role === 'anggota') ? 'selected' : '' }} value="anggota">Anggota</option>
                              </select>
                              @error('role')
                                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                              @enderror
                          </div>
                          <div class="col-6">
                              <label for="no_telp" class="form-label">No Telp</label>
                              <input type="number" name="no_telp" class="form-control" id="no_telp"
                              value="{{ $user->no_telp }}">
                              @error('no_telp')
                                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                              @enderror
                          </div>
                        </div>
                        {{-- <label for="password" class="form-label">Password</label> --}}
                        <div class="mb-3 row">
                          <div class="col-12">
                              <label for="address" class="form-label">Alamat</label>
                              <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ $user->address }}</textarea>
                              @error('password')
                                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                              @enderror
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <div class="col-12">
                            <a href="{{ route('users.index') }}" class="btn btn-danger">Back</a>
                            <button type="submit" class="btn btn-primary">Edit Data</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

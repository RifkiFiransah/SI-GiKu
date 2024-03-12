@extends('backend.layouts.main')
@section('content')
    <div class="row card">
        <div class="col-lg-12 align-items-stretch card-body">
            <h3 class="mt-4 card-title fw-semibold fs-5">Data User</h3>
            <div class="flex-wrap px-1 py-2 d-flex justify-content-end">
                <button type="button" class="ms-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="ti ti-user-plus"></i> Tambah
                    Data</button>
                <button type="button" class="ms-2 btn btn-danger"><i class="ti ti-printer"></i> Print</button>
                <a href="{{ route('users.excel') }}" target="__blank" class="ms-2 btn btn-success"><i class="ti ti-file-spreadsheet"></i> Excel</a>
                <button type="button" class="ms-2 btn btn-warning"><i class="ti ti-report-analytics"></i> CSV</button>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <div class="mt-4 card w-100">
                <div class="p-4 card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle text-nowrap">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Prodi</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Divisi</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Jabatan</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="mb-0 fw-semibold">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="mb-1 fw-semibold">{{ $user->name }}</h6>
                                            <span class="fw-normal">{{ $user->email }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $user->Prodi->name_prodi ?? '' }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $user->Divisi->name_divisi ?? ''}}</p>
                                            {{-- <div class="gap-2 d-flex align-items-center">
                                            <span class="badge bg-primary rounded-3 fw-semibold">Low</span>
                                        </div> --}}
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $user->role }}</p>
                                            {{-- <h6 class="mb-0 fw-semibold fs-4"></h6> --}}
                                        </td>
                                        <td class="border-bottom-0">
                                            <a href="{{ route('users.show', $user) }}" class="p-2 me-1 badge bg-success"><i
                                                    class="ti ti-eye"></i></a>
                                            <a href="{{ route('users.edit', $user->id) }}" class="p-2 me-1 badge bg-secondary"><i
                                                    class="ti ti-edit"></i></a>
                                            <form action="{{ route('users.destroy', $user) }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="p-2 border-0 outline-0 me-1 badge bg-danger" onclick="return confirm('Apakah anda yakin ingin mengahpus')"><i
                                                    class="ti ti-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Data Belum tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Tambah Data -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="ti ti-user"></i> Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="modal-body row g-3">
                        <input type="hidden" name="id" value="{{ Str::Uuid() }}">
                        <div class="col-6">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                            @error('email')
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="prodi_id" class="form-label">Program Studi</label>
                            <select name="prodi_id" id="prodi_id" class="form-select">
                                <option selected disabled>Pilih Data Program Studi</option>
                                @forelse ($prodies as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->name_prodi }}</option>
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
                                    <option value="{{ $divisi->id }}">{{ $divisi->name_divisi }}</option>
                                @empty
                                    <option disabled>data belum tersedia</option>
                                @endforelse
                            </select>
                            @error('divisi')
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="role" class="form-label">Jabatan</label>
                            <select name="role" id="role" class="form-select">
                                <option value="ketua">Ketua</option>
                                <option value="wakil ketua">Wakil Ketua</option>
                                <option value="bendahara">Bendahara</option>
                                <option value="sekertaris">Sekertaris</option>
                                <option value="anggota">Anggota</option>
                            </select>
                            @error('role')
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="no_telp" class="form-label">No Telp</label>
                            <input type="number" name="no_telp" class="form-control" id="no_telp"
                                aria-describedby="emailHelp">
                            @error('no_telp')
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control"></textarea>
                            @error('password')
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                            @error('password')
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

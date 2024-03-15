@extends('backend.layouts.main')
@section('content')
    <div class="row card">
        <div class="col-lg-12 card-body">
            <h3 class="mt-4 card-title fw-semibold fs-5">Data Genbi Wilayah</h3>
            <div class="flex-wrap px-1 py-2 d-flex justify-content-end">
                <button type="button" class="ms-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="ti ti-user-plus"></i> Tambah
                    Data</button>
                <a href="{{ route('users.pdf') }}" target="__blank" class="ms-2 btn btn-danger"><i class="ti ti-printer"></i>
                    Print</a>
                <a href="{{ route('users.excel') }}" target="__blank" class="ms-2 btn btn-success"><i
                        class="ti ti-file-spreadsheet"></i> Excel</a>
                <a href="{{ route('users.csv') }}" target="__blank" class="ms-2 btn btn-warning"><i
                        class="ti ti-report-analytics"></i> CSV</a>
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
                                        <h6 class="mb-0 fw-semibold">Name Genbi</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Ketua Umum</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Alamat</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($genbiers as $genbi)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="mb-0 fw-semibold">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="mb-1 fw-semibold">{{ $genbi->name_genbi }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $genbi->ketua_umum ?? '' }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $genbi->address }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a href="{{ route('genbiers.edit', $genbi) }}"
                                                class="p-2 me-1 badge bg-secondary"><i class="ti ti-edit"></i></a>
                                            <form action="{{ route('genbiers.destroy', $genbi) }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="p-2 border-0 outline-0 me-1 badge bg-danger"
                                                    onclick="return confirm('Apakah anda yakin ingin mengahpus')"><i
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
        <div class="modal-dialog modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="ti ti-user"></i> Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('genbiers.store') }}" method="post">
                    @csrf
                    <div class="modal-body row g-3">
                        <input type="hidden" name="id" value="{{ Str::Uuid() }}">
                        <div class="col-12">
                            <label for="name_genbi" class="form-label">Nama Genbi</label>
                            <input type="text" class="form-control" id="name_genbi" name="name_genbi">
                            @error('name_genbi')
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="ketua_umum" class="form-label">Ketua Umum</label>
                            <input type="text" class="form-control" id="ketua_umum" aria-describedby="emailHelp"
                                name="ketua_umum">
                            @error('ketua_umum')
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

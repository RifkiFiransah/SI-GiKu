@extends('backend.layouts.main')
@section('content')
    <div class="row card">
        <div class="col-lg-12 card-body">
            <h3 class="mt-4 card-title fw-semibold fs-5">Data Prodi</h3>
            <div class="flex-wrap px-1 py-2 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="ti ti-plus"></i> Tambah Data</button>
            </div>
            <form method="GET" action="{{ route('prodis.index') }}" class="row g-2 align-items-center mb-3">
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="search-prodis" class="visually-hidden">Cari prodi</label>
                    <input type="search" id="search-prodis" name="search" value="{{ $search }}" class="form-control"
                        placeholder="Cari program studi atau fakultas">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i> Cari</button>
                    @if ($search !== '')
                        <a href="{{ route('prodis.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
                @if ($search !== '')
                    <div class="col-12">
                        <p class="mb-0 small text-muted">Hasil pencarian "{{ $search }}": {{ $prodis->total() }} data.</p>
                    </div>
                @endif
            </form>
            @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <div class="mt-4 card w-100">
                <div class="p-4 card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Program Studi</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Fakultas</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($prodis as $prodi)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="mb-0 fw-semibold">{{ $prodis->firstItem() + $loop->index }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="mb-1 fw-semibold">{{ $prodi->name_prodi }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <span class="badge bg-light text-dark border rounded-3 fw-semibold">{{ $prodi->name_fakultas ?? 'Belum diisi' }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a href="{{ route('prodis.edit', $prodi) }}"
                                                class="p-2 me-1 badge bg-secondary"><i class="ti ti-edit"></i></a>
                                            <form action="{{ route('prodis.destroy', $prodi) }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="p-2 border-0 outline-0 me-1 badge bg-danger"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i
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
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $prodis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="ti ti-school"></i> Tambah Prodi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('prodis.store') }}" method="post">
                    @csrf
                    <div class="modal-body row g-3">
                        <input type="hidden" name="id" value="{{ Str::uuid() }}">
                        <div class="col-12">
                            <label for="name_prodi" class="form-label">Program Studi</label>
                            <input type="text" class="form-control" id="name_prodi" name="name_prodi" required>
                            @error('name_prodi')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="name_fakultas" class="form-label">Fakultas</label>
                            <input type="text" class="form-control" id="name_fakultas" name="name_fakultas">
                            @error('name_fakultas')
                                <div class="form-text">{{ $message }}</div>
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

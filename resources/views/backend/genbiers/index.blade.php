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
            <form method="GET" action="{{ route('genbiers.index') }}" class="row g-2 align-items-center mb-3">
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="search-genbiers" class="visually-hidden">Cari genbi</label>
                    <input type="search" id="search-genbiers" name="search" value="{{ $search }}" class="form-control"
                        placeholder="Cari nama, ketua umum, atau alamat">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i> Cari</button>
                    @if ($search !== '')
                        <a href="{{ route('genbiers.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
                @if ($search !== '')
                    <div class="col-12">
                        <p class="mb-0 small text-muted">Hasil pencarian "{{ $search }}": {{ $genbiers->total() }} data.</p>
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
                                        <h6 class="mb-0 fw-semibold">Status</h6>
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
                                            <h6 class="mb-0 fw-semibold">{{ $genbiers->firstItem() + $loop->index }}</h6>
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
                                            @if ($genbi->is_current)
                                                <span class="badge bg-success rounded-3 fw-semibold">Komisariat saat ini</span>
                                            @else
                                                <span class="badge bg-secondary rounded-3 fw-semibold">Komisariat</span>
                                            @endif
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
                                        <td colspan="6">Data Belum tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $genbiers->links() }}
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
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="ketua_umum" class="form-label">Ketua Umum</label>
                            <input type="text" class="form-control" id="ketua_umum" aria-describedby="emailHelp"
                                name="ketua_umum">
                            @error('ketua_umum')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control"></textarea>
                            @error('address')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="logo" class="form-label">Logo (nama file di assets/images/logos)</label>
                            <input type="text" class="form-control" id="logo" name="logo">
                            @error('logo')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Komisariat saat ini</label>
                            <div class="form-check">
                                <input type="hidden" name="is_current" value="0">
                                <input class="form-check-input" type="checkbox" id="is_current" name="is_current" value="1">
                                <label class="form-check-label" for="is_current">Tandai sebagai komisariat saat ini</label>
                            </div>
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

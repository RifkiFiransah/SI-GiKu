@extends('backend.layouts.main')
@section('content')
    <div class="row card">
        <div class="col-lg-12 align-items-stretch card-body">
            @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <div class="mt-3 row">
                <div class="flex-wrap px-1 py-2 d-flex justify-content-between">
                    <h3 class="mb-3 ms-2 card-title fw-semibold fs-5">Kegiatan Hari ini</h3>
                    <button type="button" class="mb-3 btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"><i class="ti ti-user-plus"></i> Tambah
                        Data</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    @if ($acara)
                    <div class="overflow-hidden card rounded-2">
                        <div class="position-relative">
                            <a href="javascript:void(0)"><img src="{{ asset('storage/'.$acara->foto_kegiatan) }}"
                                    class="card-img-top rounded-0" alt="{{ $acara->name_kegiatan }}"></a>
                            <a href="javascript:void(0)"
                                class="bottom-0 p-2 text-white fs-2 bg-primary rounded-circle d-inline-flex position-absolute end-0 mb-n3 me-3">
                                <i class="ti ti-id-badge fs-4"></i>
                            </a>
                        </div>
                        <div class="p-4 pt-3 card-body">
                            <h6 class="mb-3 fw-semibold fs-4">{{ $acara->name_kegiatan }}</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 fw-normal text-muted fs-3">{{ $acara->tgl_kegiatan }}</h6>
                            </div>
                            <div class="gap-2 mt-4 d-flex justify-content-end">
                                <a href="{{ route('absensi.edit', $acara) }}" class="badge bg-warning"><i class="ti ti-edit"></i></a>
                                <form action="{{ route('absensi.destroy', $acara) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="border-0 outline-0 badge bg-danger" onclick="return confirm('Apakah anda yakin untuk menghapus')"><i class="ti ti-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="overflow-hidden card rounded-2">
                        <div class="p-2 py-3 card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 fw-semibold fs-3">Belum terdapat Acara</h6>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="mt-3 row">
                <h3 class="mb-3 card-title fw-semibold fs-5">Kegiatan Sebelumnya</h3>
                @forelse ($acaras as $acr)
                   <div class="col-sm-6 col-xl-3">
                    <div class="overflow-hidden card rounded-2">
                        <div class="position-relative">
                            <a href="javascript:void(0)"><img src="../assets/images/products/s5.jpg"
                                    class="card-img-top rounded-0" alt="..."></a>
                            <a href="javascript:void(0)"
                                class="bottom-0 p-2 text-white bg-primary rounded-circle d-inline-flex position-absolute end-0 mb-n3 me-3"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i
                                    class="ti ti-id-badge fs-4"></i></a>
                        </div>
                        <div class="p-4 pt-3 card-body">
                            <h6 class="fw-semibold fs-4">{{ $acr->name_kegiatan }}</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 fw-normal text-muted fs-3">{{ $acr->tgl_kegiatan }}</h6>
                            </div>
                            <div class="gap-2 mt-4 d-flex justify-content-end">
                                <a href="{{ route('absensi.edit', $acr) }}" class="badge bg-warning"><i class="ti ti-edit"></i></a>
                                <form action="{{ route('absensi.destroy', $acr) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="border-0 outline-0 badge bg-danger" onclick="return confirm('Apakah anda yakin untuk menghapus')" ><i class="ti ti-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>   
                @empty
                <div class="overflow-hidden card rounded-2">
                    <div class="p-2 py-3 card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="mb-0 fw-semibold fs-3">Belum terdapat Acara</h6>
                        </div>
                    </div>
                </div> 
                @endforelse 
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
                <form action="{{ route('absensi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body g-3">
                        <input type="hidden" name="id" value="{{ Str::Uuid() }}">
                        <div class="mb-3">
                            <label for="name_kegiatan" class="form-label">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="name_kegiatan" name="name_kegiatan" required>
                            @error('name_kegiatan')
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Background</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                            @error('image')
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tgl_kegiatan" class="form-label">Tanggal</label>
                            <input type="date" name="tgl_kegiatan" class="form-control" id="tgl_kegiatan">
                            @error('tgl_kegiatan')
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

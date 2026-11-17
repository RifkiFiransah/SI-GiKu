@extends('backend.layouts.main')
@section('content')
    <div class="row card">
        <div class="col-lg-12 align-items-stretch card-body">
            @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <form method="GET" action="{{ route('absensi.index') }}" class="row g-2 align-items-center mb-3">
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="search-kegiatan" class="visually-hidden">Cari kegiatan</label>
                    <input type="search" id="search-kegiatan" name="search" value="{{ $search }}" class="form-control"
                        placeholder="Cari nama kegiatan">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i> Cari</button>
                    @if ($search !== '')
                        <a href="{{ route('absensi.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
                @if ($search !== '')
                    <div class="col-12">
                        <p class="mb-0 small text-muted">Hasil pencarian "{{ $search }}": {{ $acaras->total() + ($acara ? 1 : 0) }} data.</p>
                    </div>
                @endif
            </form>
            <div class="mt-3 row">
                <div class="flex-wrap px-1 py-2 d-flex justify-content-between">
                    <h3 class="mb-3 ms-2 card-title fw-semibold fs-5">{{ $search !== '' ? 'Hasil pencarian' : 'Kegiatan terbaru' }}</h3>
                    <button type="button" class="mb-3 btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"><i class="ti ti-calendar-plus"></i> Tambah Kegiatan</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    @if ($acara)
                    <div class="overflow-hidden card rounded-2">
                        <div class="position-relative">
                            @if ($acara->foto_kegiatan)
                                <img src="{{ asset('storage/'.$acara->foto_kegiatan) }}"
                                    class="card-img-top rounded-0" alt="{{ $acara->name_kegiatan }}">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px">
                                    <i class="ti ti-photo text-muted fs-6"></i>
                                </div>
                            @endif
                            <span class="bottom-0 p-2 text-white fs-2 bg-primary rounded-circle d-inline-flex position-absolute end-0 mb-n3 me-3"
                                aria-label="Kegiatan tercatat">
                                <i class="ti ti-id-badge fs-4"></i>
                            </span>
                        </div>
                        <div class="p-4 pt-3 card-body">
                            <h6 class="mb-3 fw-semibold fs-4">{{ $acara->name_kegiatan }}</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="badge bg-light text-dark border rounded-3 fw-semibold">{{ $acara->tgl_kegiatan }}</span>
                                <span class="badge bg-primary rounded-3 fw-semibold">{{ $absensiCounts[$acara->id] ?? 0 }} hadir</span>
                            </div>
                            <div class="gap-2 mt-4 d-flex justify-content-end align-items-center flex-wrap">
                                @if ($acara->bisa_absen)
                                    <button type="button" class="px-3 py-2 btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#absenModal" data-acara-id="{{ $acara->id }}"
                                        data-acara-name="{{ $acara->name_kegiatan }}"
                                        data-acara-tgl="{{ $acara->tgl_kegiatan }}"
                                        aria-label="Absen {{ $acara->name_kegiatan }}">
                                        <i class="ti ti-check" aria-hidden="true"></i> Absen
                                    </button>
                                @else
                                    <span class="mb-0 badge bg-light text-dark border rounded-3 fw-semibold"
                                        title="Absensi dibuka mulai hari kegiatan sampai 7 hari setelahnya">Absen ditutup</span>
                                @endif
                                <a href="{{ route('absensi.edit', $acara) }}" class="px-2 py-2 btn btn-sm btn-warning text-dark"
                                    aria-label="Edit {{ $acara->name_kegiatan }}" title="Edit">
                                    <i class="ti ti-edit fs-4" aria-hidden="true"></i>
                                </a>
                                <form action="{{ route('absensi.destroy', $acara) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="px-2 py-2 btn btn-sm btn-danger"
                                        aria-label="Hapus {{ $acara->name_kegiatan }}" title="Hapus"
                                        onclick="return confirm('Hapus kegiatan ini?')">
                                        <i class="ti ti-trash fs-4" aria-hidden="true"></i>
                                    </button>
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
                            @if ($acr->foto_kegiatan)
                                <img src="{{ asset('storage/'.$acr->foto_kegiatan) }}" class="card-img-top rounded-0"
                                    alt="{{ $acr->name_kegiatan }}">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px">
                                    <i class="ti ti-photo text-muted fs-6"></i>
                                </div>
                            @endif
                            <span class="bottom-0 p-2 text-white bg-primary rounded-circle d-inline-flex position-absolute end-0 mb-n3 me-3"
                                aria-label="Kegiatan tercatat">
                                <i class="ti ti-id-badge fs-4"></i>
                            </span>
                        </div>
                        <div class="p-4 pt-3 card-body">
                            <h6 class="fw-semibold fs-4">{{ $acr->name_kegiatan }}</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="badge bg-light text-dark border rounded-3 fw-semibold">{{ $acr->tgl_kegiatan }}</span>
                                <span class="badge bg-primary rounded-3 fw-semibold">{{ $absensiCounts[$acr->id] ?? 0 }} hadir</span>
                            </div>
                            <div class="gap-2 mt-4 d-flex justify-content-end align-items-center flex-wrap">
                                @if ($acr->bisa_absen)
                                    <button type="button" class="px-3 py-2 btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#absenModal" data-acara-id="{{ $acr->id }}"
                                        data-acara-name="{{ $acr->name_kegiatan }}"
                                        data-acara-tgl="{{ $acr->tgl_kegiatan }}"
                                        aria-label="Absen {{ $acr->name_kegiatan }}">
                                        <i class="ti ti-check" aria-hidden="true"></i> Absen
                                    </button>
                                @else
                                    <span class="mb-0 badge bg-light text-dark border rounded-3 fw-semibold"
                                        title="Absensi dibuka mulai hari kegiatan sampai 7 hari setelahnya">Absen ditutup</span>
                                @endif
                                <a href="{{ route('absensi.edit', $acr) }}" class="px-2 py-2 btn btn-sm btn-warning text-dark"
                                    aria-label="Edit {{ $acr->name_kegiatan }}" title="Edit">
                                    <i class="ti ti-edit fs-4" aria-hidden="true"></i>
                                </a>
                                <form action="{{ route('absensi.destroy', $acr) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="px-2 py-2 btn btn-sm btn-danger"
                                        aria-label="Hapus {{ $acr->name_kegiatan }}" title="Hapus"
                                        onclick="return confirm('Hapus kegiatan ini?')">
                                        <i class="ti ti-trash fs-4" aria-hidden="true"></i>
                                    </button>
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
            <div class="mt-3 d-flex justify-content-end">
                {{ $acaras->links() }}
            </div>
        </div>
    </div>

    <!-- Form Tambah Data -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="ti ti-calendar-plus"></i> Tambah Kegiatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('absensi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body g-3">
                        <div class="mb-3">
                            <label for="name_kegiatan" class="form-label">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="name_kegiatan" name="name_kegiatan" required>
                            @error('name_kegiatan')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Background</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                            @error('image')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tgl_kegiatan" class="form-label">Tanggal</label>
                            <input type="date" name="tgl_kegiatan" class="form-control" id="tgl_kegiatan">
                            @error('tgl_kegiatan')
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

    <!-- Form Absen -->
    <div class="modal fade" id="absenModal" tabindex="-1" aria-labelledby="absenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form id="absenForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tgl_kegiatan" id="absen-tgl" value="">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="absenModalLabel"><i class="ti ti-check"></i> Absen Kegiatan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3 text-muted" id="absenAcaraName"></p>
                        <p class="mb-3 small text-muted">Absensi hanya tersedia mulai hari kegiatan sampai 7 hari setelahnya.</p>
                        <div class="mb-3">
                            <label for="absen-user" class="form-label">Anggota</label>
                            <select class="form-select" id="absen-user" name="user_id" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @selected($user->id === auth()->id())>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="absen-divisi" class="form-label">Divisi</label>
                            <select class="form-select" id="absen-divisi" name="divisi_id" required>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}" @selected($division->id === auth()->user()?->divisi_id)>{{ $division->name_divisi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="absen-resume" class="form-label">Ringkasan Kegiatan</label>
                            <textarea class="form-control" id="absen-resume" name="resume_kegiatan" rows="3" maxlength="1000"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="absen-bukti" class="form-label">Bukti Kegiatan</label>
                            <input class="form-control" type="file" id="absen-bukti" name="bukti_kegiatan"
                                accept=".jpg,.jpeg,.png,.pdf">
                            <div class="form-text">Opsional, maksimal 2 MB.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Absensi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const absenModal = document.getElementById('absenModal');
            absenModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const form = document.getElementById('absenForm');

                form.reset();
                form.action = '{{ route('absensi.hadir', '__ACARA__') }}'.replace('__ACARA__', button.dataset.acaraId);
                document.getElementById('absenAcaraName').textContent = button.dataset.acaraName;
                document.getElementById('absen-tgl').value = button.dataset.acaraTgl;
                form.querySelectorAll('.modal-submit-error').forEach(function (node) {
                    node.remove();
                });
                form.querySelectorAll('.is-invalid').forEach(function (node) {
                    node.classList.remove('is-invalid');
                });
            });
        </script>
    @endpush
@endsection

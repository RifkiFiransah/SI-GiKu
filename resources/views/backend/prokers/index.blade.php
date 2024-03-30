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
                                        <h6 class="mb-0 fw-semibold">Proker</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Divisi</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Status</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">TGL Pelaksanaan</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($prokers as $proker)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="mb-0 fw-semibold">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="mb-1 fw-semibold">{{ $proker->name_proker }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $proker->Divisi->name_divisi ?? '' }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 rounded-4 fw-normal badge bg-primary">{{ $proker->status }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $proker->tanggal_pelaksanaan }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a href="{{ route('prokers.show', $proker) }}"
                                                class="p-2 me-1 badge bg-success"><i class="ti ti-eye"></i></a>
                                            <a href="{{ route('prokers.edit', $proker) }}"
                                                class="p-2 me-1 badge bg-secondary"><i class="ti ti-edit"></i></a>
                                            <form action="{{ route('prokers.destroy', $proker) }}" method="post"
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
              <form action="{{ route('prokers.store') }}" method="post">
                  @csrf
                  <div class="modal-body row g-3">
                      <input type="hidden" name="id" value="{{ Str::Uuid() }}">
                      <input type="hidden" name="status" value="belum">
                      <div class="col-12">
                          <label for="name_proker" class="form-label">Program Kerja</label>
                          <input type="text" class="form-control" id="name_proker" name="name_proker">
                          @error('name_proker')
                              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                          @enderror
                      </div>
                      <div class="col-12">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                        @error('password')
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        @enderror
                      </div>
                      <div class="col-12">
                          <label for="divisi_id" class="form-label">Divisi</label>
                          <select name="divisi_id" id="divisi_id" class="form-select">
                            <option selected disabled>------------------ Pilih Divisi ------------------</option>
                            @forelse ($divisions as $divisi)
                                <option value="{{ $divisi->id }}">{{ $divisi->name_divisi }}</option>
                            @empty
                                <option disabled>Data Belum Tersedia</option>
                            @endforelse
                          </select>
                      </div>
                      <div class="col-12">
                          <label for="tanggal_pelaksanaan" class="form-label">TGL Pelaksanaan</label>
                          <input type="date" class="form-control" id="tanggal_pelaksanaan" aria-describedby="emailHelp"
                              name="tanggal_pelaksanaan">
                          @error('tanggal_pelaksanaan')
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

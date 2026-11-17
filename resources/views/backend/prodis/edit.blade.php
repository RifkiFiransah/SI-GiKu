@extends('backend.layouts.main')
@section('content')
    <div class="row card">
        <div class="col-lg-12 card-body">
            <h3 class="mt-4 card-title fw-semibold fs-5">Edit Prodi</h3>
            <div class="mt-4 card w-100">
                <div class="p-4 card-body">
                    <form action="{{ route('prodis.update', $prodi->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row g-3">
                            <input type="hidden" name="id" value="{{ $prodi->id }}">
                            <div class="col-12">
                                <label for="name_prodi" class="form-label">Program Studi</label>
                                <input type="text" class="form-control" id="name_prodi" name="name_prodi"
                                    value="{{ $prodi->name_prodi }}" required>
                                @error('name_prodi')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="name_fakultas" class="form-label">Fakultas</label>
                                <input type="text" class="form-control" id="name_fakultas" name="name_fakultas"
                                    value="{{ $prodi->name_fakultas }}">
                                @error('name_fakultas')
                                    <div class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <a href="{{ route('prodis.index') }}" class="btn btn-danger">Close</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

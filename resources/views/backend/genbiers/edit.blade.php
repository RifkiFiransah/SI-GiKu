@extends('backend.layouts.main')
@section('content')
    <div class="row card">
        <div class="col-lg-12 card-body">
            <h3 class="mt-4 font-semibold card-title fs-5">Edit Genbi</h3>
            <div class="mt-4 card w-100">
                <div class="p-4 card-body">
                    <form action="{{ route('genbiers.update', $genbi->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $genbi->id }}">
                        <div class="mb-3 col-12">
                            <label for="name_genbi" class="form-label">Nama Genbi</label>
                            <input type="text" class="form-control" id="name_genbi" name="name_genbi" value="{{ $genbi->name_genbi }}">
                            @error('name_genbi')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12">
                            <label for="ketua_umum" class="form-label">Ketua Umum</label>
                            <input type="text" class="form-control" id="ketua_umum" value="{{ $genbi->ketua_umum }}"
                                name="ketua_umum">
                            @error('ketua_umum')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ $genbi->address }}</textarea>
                            @error('address')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12">
                            <label for="logo" class="form-label">Logo (nama file di assets/images/logos)</label>
                            <input type="text" class="form-control" id="logo" name="logo" value="{{ $genbi->logo }}">
                            @error('logo')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12">
                            <label class="form-label">Komisariat saat ini</label>
                            <div class="form-check">
                                <input type="hidden" name="is_current" value="0">
                                <input class="form-check-input" type="checkbox" id="is_current" name="is_current" value="1" @checked($genbi->is_current)>
                                <label class="form-check-label" for="is_current">Tandai sebagai komisariat saat ini</label>
                            </div>
                        </div>
                        <div class="my-3">
                            <a href="{{ route('genbiers.index') }}" class="btn btn-danger">Close</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

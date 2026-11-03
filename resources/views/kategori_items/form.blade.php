@extends('layouts.app')

@section('content')
<div class="container">

    <h3>{{ $method == 'new' ? 'Tambah Kategori' : 'Edit Kategori' }}</h3>

    <div class="card">
        <div class="card-body">

            <form method="POST"
                action="{{ url('kategori-items/form-submit/' . $method . ($method == 'edit' ? '/' . $kategori->id : '')) }}">

                @csrf

                <div class="form-group mb-3">
                    <label>Kode Kategori</label>
                    <input type="text"
                        name="kode"
                        class="form-control"
                        value="{{ old('kode', $kategori->kode) }}"
                        required>

                    @error('kode')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Nama Kategori</label>
                    <input type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama', $kategori->nama) }}"
                        required>

                    @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ url('kategori-items') }}"
                    class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
@endsection
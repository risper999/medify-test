@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Kategori Items</h3>

        <a href="{{ url('kategori-items/form/new') }}"
            class="btn btn-primary">
            Tambah Kategori
        </a>
    </div>

    <form method="GET" action="{{ url('kategori-items') }}">
        <div class="row mb-3">

            <div class="col-md-4">
                <label>Kode Kategori</label>
                <input type="text"
                    name="kode"
                    class="form-control"
                    value="{{ request('kode') }}"
                    placeholder="Cari kode kategori">
            </div>

            <div class="col-md-4">
                <label>Nama Kategori</label>
                <input type="text"
                    name="nama"
                    class="form-control"
                    value="{{ request('nama') }}"
                    placeholder="Cari nama kategori">
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    Cari
                </button>

                <a href="{{ url('kategori-items') }}"
                    class="btn btn-secondary">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Kode</th>
                        <th>Nama Kategori</th>
                        <th width="200">View</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data_kategori as $index => $kategori)
                    <tr>
                        <td>{{ $data_kategori->firstItem() + $index }}</td>
                        <td>{{ $kategori->kode }}</td>
                        <td>{{ $kategori->nama }}</td>
                        <td>
                            <a href="{{ url('kategori-items/view/' . $kategori->id) }}"
                                class="btn btn-sm btn-primary">
                                View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            Data kategori belum tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $data_kategori->links() }}
        </div>
    </div>

</div>
@endsection
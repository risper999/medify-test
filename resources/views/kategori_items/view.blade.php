@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Detail Kategori</h3>

        <a href="{{ url('kategori-items/print/' . $kategori->id) }}"
            class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Download PDF
        </a>

        <a href="{{ url('kategori-items') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-2">
                    <strong>Kode</strong>
                </div>
                <div class="col-md-10">
                    {{ $kategori->kode }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <strong>Nama</strong>
                </div>
                <div class="col-md-10">
                    {{ $kategori->nama }}
                </div>
            </div>

            <div>
                <a href="{{ url('kategori-items/form/edit/' . $kategori->id) }}"
                    class="btn btn-sm btn-warning">
                    Edit
                </a>

                <form action="{{ url('kategori-items/delete/' . $kategori->id) }}"
                    method="GET"
                    class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                    <button type="submit" class="btn btn-sm btn-danger">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <h5>Daftar Items</h5>

    <div class="card">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Kode Item</th>
                        <th>Nama Item</th>
                        <th>Jenis</th>
                        <th>Harga Beli</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kategori->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Belum ada item pada kategori ini.
                        </td>
                    </tr>
                    @endforelse


                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
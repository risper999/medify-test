<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class KategoriItemController extends Controller
{
    public function index(Request $request)
    {
        $data_search = KategoriItem::query();

        if (!empty($request->nama)) {
            $data_search->where('nama', 'LIKE', '%' . $request->nama . '%');
        }

        if (!empty($request->kode)) {
            $data_search->where('kode', 'LIKE', '%' . $request->kode . '%');
        }

        $data_kategori = $data_search
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('kategori_items.index', compact('data_kategori'));
    }

    public function view($id)
    {
        $kategori = KategoriItem::with('items')->findOrFail($id);

        return view('kategori_items.view', compact('kategori'));
    }

    public function form($method, $id = 0)
    {
        if ($method == 'new') {
            $kategori = new KategoriItem;
        } else {
            $kategori = KategoriItem::findOrFail($id);
        }

        return view('kategori_items.form', compact('method', 'kategori'));
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {
        $kategori = $method == 'new'
            ? new KategoriItem
            : KategoriItem::findOrFail($id);

        $request->validate([
            'kode' => [
                'required',
                'max:50',
                Rule::unique('kategori_items', 'kode')->ignore($kategori->id),
            ],
            'nama' => 'required|max:255',
        ]);

        $kategori->kode = $request->kode;
        $kategori->nama = $request->nama;
        $kategori->save();

        return redirect('kategori-items');
    }

    public function delete($id)
    {
        $kategori = KategoriItem::findOrFail($id);
        $kategori->delete();

        return redirect('kategori-items');
    }

    public function printPdf($id)
    {
        $kategori = KategoriItem::with('items')->findOrFail($id);

        $tanggal_cetak = Carbon::now('Asia/Jakarta')
            ->format('d-m-Y H:i:s');

        $pdf = Pdf::loadView('kategori_items.pdf', [
            'kategori' => $kategori,
            'tanggal_cetak' => $tanggal_cetak,
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download(
            'Kategori-' . $kategori->kode . '.pdf'
        );
    }
}

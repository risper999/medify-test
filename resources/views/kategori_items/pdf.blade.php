<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Kategori Item</title>

    <style>
        @page {
            margin: 35px 35px 65px 35px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .header h2 {
            margin: 0 0 5px;
        }

        .info {
            margin-bottom: 20px;
            line-height: 1.8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #777;
            padding: 8px;
        }

        th {
            background-color: #eeeeee;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            position: fixed;
            bottom: -40px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid #999;
            padding-top: 8px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>LAPORAN KATEGORI ITEM</h2>
        <p>Detail Kategori Master Items</p>
    </div>

    <div class="info">
        <table style="border: none;">
            <tr>
                <td style="border: none; width: 120px;">
                    <strong>Kode Kategori</strong>
                </td>
                <td style="border: none; width: 10px;">:</td>
                <td style="border: none;">
                    {{ $kategori->kode }}
                </td>
            </tr>
            <tr>
                <td style="border: none;">
                    <strong>Nama Kategori</strong>
                </td>
                <td style="border: none;">:</td>
                <td style="border: none;">
                    {{ $kategori->nama }}
                </td>
            </tr>
        </table>
    </div>

    <h4>Daftar Item</h4>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode Item</th>
                <th width="30%">Nama Item</th>
                <th width="15%">Jenis</th>
                <th width="20%">Harga Beli</th>
            </tr>
        </thead>

        <tbody>
            @forelse($kategori->items as $index => $item)
            <tr>
                <td class="text-center">
                    {{ $index + 1 }}
                </td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jenis }}</td>
                <td class="text-right">
                    Rp {{ number_format($item->harga_beli, 0, ',', '.') }}
                </td>
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

    <p>
        <strong>Total Item:</strong>
        {{ $kategori->items->count() }} item
    </p>

    <div class="footer">
        Dicetak pada: {{ $tanggal_cetak }}
    </div>

</body>

</html>
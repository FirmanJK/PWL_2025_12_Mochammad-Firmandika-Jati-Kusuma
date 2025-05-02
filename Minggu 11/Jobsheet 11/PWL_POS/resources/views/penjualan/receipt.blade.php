<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: "Courier New", Courier, monospace;
            font-size: 11px;
            margin: 5px;
        }
        .text-center { text-align: center; }
        .text-right  { text-align: right; }
        .text-left   { text-align: left; }
        .border-top { border-top: 1px dashed #000; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 2px 4px; }
        .title {
            font-size: 13px;
            font-weight: bold;
        }
        .highlight {
            background: #eee;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <div class="title">ALFA DURO</div>
        <div>Jl. Malang, Madiun</div>
        <div>Telp: 0877-6555-6596</div>
        <div class="border-top"></div>
        <div><strong>STRUK PENJUALAN</strong></div>
    </div>

    <table style="margin-top: 5px;">
        <tr>
            <td width="30%">Kode</td>
            <td>: {{ $penjualan->penjualan_kode }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: {{ \Carbon\Carbon::parse($penjualan->penjualan_tanggal)->format('d-m-Y H:i') }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td>: {{ $penjualan->user->username }}</td>
        </tr>
        <tr>
            <td>Pembeli</td>
            <td>: {{ $penjualan->pembeli ?? '-' }}</td>
        </tr>
    </table>

    <div class="border-top"></div>

    <table>
        <thead class="highlight">
            <tr>
                <th class="text-left">Barang</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan->penjualanDetail as $detail)
            <tr>
                <td>{{ $detail->barang->barang_nama }}</td>
                <td class="text-center">{{ $detail->jumlah }}</td>
                <td class="text-right">{{ number_format($detail->barang->harga_jual, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($detail->harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="highlight">
                <td colspan="3" class="text-right"><strong>Total</strong></td>
                <td class="text-right"><strong>{{ number_format($penjualan->penjualanDetail->sum('harga'), 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="border-top"></div>

    <div class="text-center" style="margin-top: 10px;">
        <em>Terima kasih atas kunjungan Anda!</em><br>
        <small>Barang yang sudah dibeli tidak dapat dikembalikan</small>
    </div>
</body>
</html>
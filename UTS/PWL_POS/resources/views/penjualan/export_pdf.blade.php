<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
    body{
        font-family: "Times New Roman", Times, serif;
        margin: 6px 20px 5px 20px;
        line-height: 15px;
    }
    table {
        width:100%;
        border-collapse: collapse;
    }
    td, th {
        padding: 4px 3px;
    }
    th{
        text-align: left;
    }
    .d-block{
        display: block;
    }
    img.image{
        width: auto;
        height: 80px;
        max-width: 150px;
        max-height: 150px;
    }
    .text-right {
        text-align: right;
    }
    .text-center {
        text-align: center;
    }
    .font-10{
        font-size: 10pt;
    }
    .font-11{
        font-size: 11pt;
    }
    .font-13{
        font-size: 13pt;
    }
    .border-bottom-header{
        border-bottom: 1px solid;
    }
    .border-all, .border-all th, .border-all td{
        border: 1px solid;
    }
    </style>
</head>
<body>
    {{-- HEADER --}}
    <table class="border-bottom-header">
        <tr>
            <td width="15%" class="text-center">
                <img src="{{ asset('image/polinema-bw.jpeg') }}" class="image">
            </td>
            <td width="85%">
                <span class="text-center d-block font-11 font-bold">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span>
                <span class="text-center d-block font-13 font-bold">POLITEKNIK NEGERI MALANG</span>
                <span class="text-center d-block font-10">Jl. Soekarno-Hatta No. 9 Malang 65141</span>
                <span class="text-center d-block font-10">Telp (0341) 404424 Pes. 101-105, Fax (0341) 404420</span>
                <span class="text-center d-block font-10">Laman: www.polinema.ac.id</span>
            </td>
        </tr>
    </table>

    {{-- JUDUL LAPORAN --}}
    <h3 class="text-center">LAPORAN DATA PENJUALAN</h3>

    {{-- TABEL PENJUALAN --}}
    <table class="border-all">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Kode Penjualan</th>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Pembeli</th>
                <th class="text-center">Jumlah Item</th>
                <th class="text-right">Total Bayar (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan as $p)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $p->penjualan_kode }}</td>
                <td>{{ $p->user->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($p->penjualan_tanggal)->format('Y-m-d H:i') }}</td>
                <td>{{ $p->pembeli }}</td>
                <td class="text-center">
                    {{ $p->penjualanDetail->count('detail_id') }}
                </td>
                <td class="text-right">
                    {{ number_format($p->penjualanDetail->sum('harga'), 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
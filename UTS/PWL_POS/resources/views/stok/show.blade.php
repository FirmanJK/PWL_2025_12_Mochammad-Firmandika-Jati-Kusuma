@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-sm">
            <tr>
                <th>ID</th>
                <td>{{ $stok->stok_id }}</td>
            </tr>
            <tr>
                <th>Barang</th>
                <td>{{ $stok->barang->barang_nama }}</td>
            </tr>
            <tr>
                <th>User</th>
                <td>{{ $stok->user->nama }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $stok->stok_tanggal }}</td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>{{ $stok->stok_jumlah }}</td>
            </tr>
        </table>

        <a href="{{ url('stok') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection

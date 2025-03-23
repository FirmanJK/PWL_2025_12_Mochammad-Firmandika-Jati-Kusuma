@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Kategori</h2>
    <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kodeKategori" class="form-label">Kode Kategori</label>
            <input type="text" class="form-control" id="kodeKategori" name="kodeKategori"
                value="{{ $kategori->kode_kategori) }}" required>
        </div>

        <div class="form-group">
            <label for="namaKategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="namaKategori" name="namaKategori"
                value="{{ $kategori->nama_kategori) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection

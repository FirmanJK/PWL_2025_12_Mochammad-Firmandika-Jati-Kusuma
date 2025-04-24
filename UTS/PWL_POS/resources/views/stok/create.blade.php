@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('stok') }}">
            @csrf
            <div class="form-group row">
                <label class="col-2">Barang</label>
                <div class="col-10">
                    <select class="form-control" name="barang_id" required>
                        <option value="">- Pilih Barang -</option>
                        @foreach($barang as $item)
                            <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2">Tanggal</label>
                <div class="col-10">
                    <input type="datetime-local" class="form-control" name="stok_tanggal" required>
                    @error('stok_tanggal')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2">Jumlah</label>
                <div class="col-10">
                    <input type="number" class="form-control" name="stok_jumlah" required>
                    @error('stok_jumlah')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            <a href="{{ url('stok') }}" class="btn btn-sm btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection

@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($supplier)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
            <a href="{{ url('supplier') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
            <form method="POST" action="{{ url('/supplier/'.$supplier->supplier_id) }}" class="form-horizontal">
                @csrf
                @method('PUT') <!-- Menggunakan method PUT untuk update -->
                    
                <div class="form-group row">
                    <label class="col-2 col-form-label">Kode Supplier</label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="supplier_kode" 
                            value="{{ old('supplier_kode', $supplier->supplier_kode) }}" required>
                        @error('supplier_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>   

                <div class="form-group row">
                    <label class="col-2 col-form-label">Nama Supplier</label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="supplier_nama" 
                            value="{{ old('supplier_nama', $supplier->supplier_nama) }}" required>
                        @error('supplier_nama')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>  

                <div class="form-group row">
                    <label class="col-2 col-form-label">Alamat Supplier</label>
                    <div class="col-10">
                        <textarea class="form-control" name="supplier_alamat" rows="3" required>{{ old('supplier_alamat', $supplier->supplier_alamat) }}</textarea>
                        @error('supplier_alamat')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>      

                <div class="form-group row">
                    <label class="col-2 col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a href="{{ url('supplier') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                    </div>
                </div>
            </form>
        @endempty
    </div>
</div>
@endsection

@push('css')
@endpush
@push('js')
@endpush
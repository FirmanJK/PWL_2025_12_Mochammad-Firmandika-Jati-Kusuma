@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($penjualan)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
            <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
        <form method="POST" action="{{ url('penjualan/'.$penjualan->penjualan_id) }}" class="form-horizontal">
            @csrf
            {!! method_field('PUT') !!}

            <!-- Pilihan User -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">User</label>
                <div class="col-11">
                    <select class="form-control" name="user_id" id="user_id" required>
                        <option value="">- Pilih User -</option>
                        @foreach($users as $user)
                            <option value="{{ $user->user_id }}"
                                {{ (old('user_id', $penjualan->user_id) == $user->user_id) ? 'selected' : '' }}>
                                {{ $user->username }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Pembeli -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Pembeli</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="pembeli" name="pembeli" value="{{ old('pembeli', $penjualan->pembeli) }}" required>
                    @error('pembeli')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Penjualan Kode -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Kode Penjualan</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode" value="{{ old('penjualan_kode', $penjualan->penjualan_kode) }}" required>
                    @error('penjualan_kode')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Penjualan Tanggal -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Tanggal Penjualan</label>
                <div class="col-11">
                    <input type="datetime-local" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal" value="{{ old('penjualan_tanggal', date('Y-m-d\TH:i', strtotime($penjualan->penjualan_tanggal))) }}" required>
                    @error('penjualan_tanggal')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
            </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label"></label>
                <div class="col-11">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
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
@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Edit')


@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Kategori</h3>
            </div>

            <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="kategoriKode" class="form-label">Kode Kategori</label>
                        <input type="text" class="form-control" id="kategoriKode" name="kategoriKode"
                            value="{{ old('kategoriKode', $kategori->kategori_kode ?? '') }}" required>
                    </div>

                    <div class="form-group ">
                        <label for="kategoriNama" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="kategoriNama" name="kategoriNama"
                            value="{{ old('kategoriNama', $kategori->kategori_nama ?? '') }}" required>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
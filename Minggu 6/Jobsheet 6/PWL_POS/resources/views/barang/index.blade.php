@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Tambah</a>               
            </div>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif          

            <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }
    var dataBarang;
        $(document).ready(function () {
             dataBarang = $('#table_barang').DataTable({
                serverside: true,
                processing: true,
                ajax: {
                    url: "{{ url('barang/list') }}",
                    "dataType": "json",
                    "type": "POST"
                   
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'barang_kode',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'barang_nama',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'harga_beli',
                        orderable: true,
                        searchable: true,
                        className: 'text-right'
                    },
                    {
                        data: 'harga_jual',
                        orderable: true,
                        searchable: true,
                        className: 'text-right'
                    },
                    {
                        data: 'kategori_id',
                        orderable: true,
                        searchable: true,
                        className: 'text-right'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        searchable: false
                    },]
            });           
        });
    </script>
@endpush
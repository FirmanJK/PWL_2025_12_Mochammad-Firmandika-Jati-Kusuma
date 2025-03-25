@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('supplier/create') }}">Tambah</a>
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
            <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode supplier</th>
                        <th>Nama supplier</th>
                        <th>Supplier Alamat</th>
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
    var dataSupplier;
        $(document).ready(function () {
             dataSupplier = $('#table_supplier').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('supplier/list') }}",
                    "dataType": "json",
                    "type": "POST"
                },
                columns: [
                    // nomor urut dari laravel datatable addIndexColumn()
                    {
                        data: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'supplier_kode',
                        className: '',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'supplier_nama',
                        className: '',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'supplier_alamat',
                        className: '',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'aksi',
                        className: '',
                        orderable: false,
                        searchable: false
                    },]
            });
        });
    </script>
@endpush
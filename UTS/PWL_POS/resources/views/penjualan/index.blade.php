@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/penjualan/import') }}')" class="btn btn-sm btn-info mt-1">Import Penjualan</button>
            {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan/create') }}">Tambah</a> --}}
            <a href="{{ url('/penjualan/export_excel') }}" class="btn btn-sm btn-primary mt-1"><i class="fa fa-file-excel"></i> Export Penjualan</a>
            <a href="{{ url('/penjualan/export_pdf') }}" class="btn btn-sm btn-warning mr-1"><i class="fa fa-file-pdf"></i> Export Penjualan</a>
            <button onclick="modalAction('{{ url('/penjualan/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Filter Berdasarkan User -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="user_id" name="user_id">
                            <option value="">- Semua -</option>
                            @foreach($users as $user)
                                <option value="{{ $user->user_id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Filter berdasarkan User</small>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
            <thead>
                <tr>
                <th>ID</th>
                <th>Penjualan Kode</th>
                <th>Nama User</th>
                <th>Pembeli</th>
                <th>Penjualan Tanggal</th>
                <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static"data-keyboard="false" data-width="75%" aria-hidden="true"></div>
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

        var dataPenjualan;
    $(document).ready(function() {
        dataPenjualan = $('#table_penjualan').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
            "url": "{{ url('penjualan/list') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(d) {
                d.user_id = $('#user_id').val();
            }
            },
            searchDelay: 1000,
            columns: [
            {
                data: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false
            },
            {
                data: "penjualan_kode",
                orderable: true,
                searchable: true
            },
            {
                data: "user.nama",
                orderable: false,
                searchable: true
            },
            {
                data: "pembeli",
                orderable: true,
                searchable: true
            },
            {
                data: "penjualan_tanggal",
                orderable: true,
                searchable: true
            },
            {
                data: "aksi",
                orderable: false,
                searchable: false
            }
            ]
        });

        // Reload DataTables ketika filter user berubah
        $('#user_id').on('change', function() {
            dataPenjualan.ajax.reload();
        });
    });
</script>
@endpush
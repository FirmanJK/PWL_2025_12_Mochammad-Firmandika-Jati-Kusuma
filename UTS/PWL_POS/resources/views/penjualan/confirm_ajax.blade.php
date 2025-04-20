@empty($penjualan)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <button type="button" data-dismiss="modal" class="btn btn-warning">Tutup</button>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/penjualan/' . $penjualan->penjualan_id . '/delete_ajax') }}" method="POST" id="form-delete">
        @csrf
        @method('DELETE')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h5><i class="icon fas fa-ban"></i> Konfirmasi!!!</h5>
                        Apakah Anda ingin menghapus data penjualan berikut beserta semua detailnya?
                    </div>
                    <!-- Data penjualan -->
                    <table class="table table-bordered table-striped table-hover table-sm">
                        <tr>
                            <th>ID Penjualan</th>
                            <td>{{ $penjualan->penjualan_id }}</td>
                        </tr>
                        <tr>
                            <th>Kode Penjualan</th>
                            <td>{{ $penjualan->penjualan_kode }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pegawai</th>
                            <td>{{ $penjualan->user->nama }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pembeli</th>
                            <td>{{ $penjualan->pembeli }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Penjualan</th>
                            <td>{{ \Carbon\Carbon::parse($penjualan->penjualan_tanggal)->translatedFormat('d F Y H:i:s') }}</td>
                        </tr>
                    </table>
                    <!-- Detail penjualan -->
                    @if($penjualan->penjualanDetail->isNotEmpty())
                        <h5>Daftar Detail Penjualan</h5>
                        <table class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>ID Detail</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualan->penjualanDetail as $detail)
                                    <tr>
                                        <td>{{ $detail->detail_id }}</td>
                                        <td>{{ $detail->barang->barang_nama }}</td>
                                        <td>{{ $detail->jumlah }}</td>
                                        <td>{{ 'Rp ' . number_format($detail->harga, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">Tidak ditemukan detail penjualan.</div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $("#form-delete").validate({
                rules: {},
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataPenjualan.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty
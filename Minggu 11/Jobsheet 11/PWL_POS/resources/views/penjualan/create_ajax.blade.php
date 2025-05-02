<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{ url('penjualan/ajax') }}" method="POST" id="form-tambah">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Tambah Penjualan Beserta Detailnya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Data Penjualan -->
                <div class="form-group">
                    <label>Pembeli</label>
                    <input type="text" name="pembeli" id="pembeli" class="form-control" required>
                    <small id="error-pembeli" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Kode Penjualan</label>
                    <input type="text" name="penjualan_kode" id="penjualan_kode" class="form-control" required>
                    <small id="error-penjualan_kode" class="error-text form-text text-danger"></small>
                </div>

                <!-- Bagian Detail Penjualan -->
                <h5>Detail Penjualan</h5>
                <table class="table" id="detailTable">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Stok Tersedia</th>
                            <th>Jumlah</th>
                            <th>Harga (Otomatis)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Baris detail akan ditambahkan secara dinamis --}}
                    </tbody>
                </table>
                <button type="button" id="addDetail" class="btn btn-info mb-3">Tambah Barang</button>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Penjualan</button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function(){
    var barangs = @json($barangs);
    var detailIndex = 0;

    function addDetailRow(){
        let row = `<tr data-index="${detailIndex}">
            <td>
                <select name="details[${detailIndex}][barang_id]" class="form-control barang-select" required>
                    <option value="">- Pilih Barang -</option>`;
        $.each(barangs, function(i, barang){
            row += `<option value="${barang.barang_id}" data-harga="${barang.harga_jual}" data-stok="${barang.barang_stok ?? 0}">
                        ${barang.barang_nama} (Rp. ${Number(barang.harga_jual).toLocaleString()})
                    </option>`;
        });
        row += `</select>
                <small class="error-text form-text text-danger" id="error-details_${detailIndex}_barang_id"></small>
            </td>
            <td>
                <span class="stok-text">0</span>
            </td>
            <td>
                <input type="number" name="details[${detailIndex}][jumlah]" class="form-control jumlah-input" required min="1">
                <small class="error-text form-text text-danger" id="error-details_${detailIndex}_jumlah"></small>
            </td>
            <td>
                <input type="text" name="details[${detailIndex}][harga]" class="form-control harga-input" readonly required>
                <small class="error-text form-text text-danger" id="error-details_${detailIndex}_harga"></small>
            </td>
            <td>
                <button type="button" class="btn btn-danger removeDetail">Hapus</button>
            </td>
        </tr>`;
        $('#detailTable tbody').append(row);
        detailIndex++;
    }

    $('#addDetail').on('click', function(){
        addDetailRow();
    });

    $('#detailTable').on('change', '.barang-select', function(){
        var selectedOption = $(this).find(':selected');
        var stok = selectedOption.data('stok') || 0;
        var harga = parseFloat(selectedOption.data('harga')) || 0;
        var row = $(this).closest('tr');
        row.find('.stok-text').text(stok);

        var jumlah = parseFloat(row.find('.jumlah-input').val()) || 0;
        row.find('.harga-input').val(harga * jumlah);
    });

    $('#detailTable').on('input', '.jumlah-input', function(){
        var jumlah = parseFloat($(this).val()) || 0;
        var row = $(this).closest('tr');
        var selectedOption = row.find('.barang-select').find(':selected');
        var harga = parseFloat(selectedOption.data('harga')) || 0;
        row.find('.harga-input').val(harga * jumlah);
    });

    $('#detailTable').on('click', '.removeDetail', function(){
        $(this).closest('tr').remove();
    });

    $("#form-tambah").validate({
        rules: {
            user_id: { required: true, number: true },
            pembeli: { required: true, minlength: 3, maxlength: 100 },
            penjualan_kode: { required: true, minlength: 3, maxlength: 20 },
            penjualan_tanggal: { required: true, date: true }
        },
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
                        if (typeof dataPenjualan !== 'undefined') {
                            dataPenjualan.ajax.reload();
                        }
                    } else {
                        $(".error-text").text("");
                        $.each(response.msgField, function(prefix, val) {
                            $("#error-" + prefix).text(val[0]);
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
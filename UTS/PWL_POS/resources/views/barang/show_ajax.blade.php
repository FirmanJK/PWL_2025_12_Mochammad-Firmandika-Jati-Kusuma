@empty($barang)
     <div id="modal-master" class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                         aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body">
                 <div class="alert alert-danger">
                     <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                     Data yang Anda cari tidak ditemukan.
                 </div>
                 <a href="{{ url('/barang') }}" class="btn btn-warning">Kembali</a>
             </div>
         </div>
     </div>
 @else
     <div id="modal-master" class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Detail Data Barang</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                         aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body">
                 <table class="table table-bordered table-striped">
                     <tr>
                         <th>ID</th>
                         <td>{{ $barang->barang_id }}</td>
                     </tr>
                     <tr>
                         <th>Kategori</th>
                         <td>{{ $barang->kategori ? $barang->kategori->kategori_nama : '-' }}</td>
                     </tr>
                     <tr>
                         <th>Kode Barang</th>
                         <td>{{ $barang->barang_kode }}</td>
                     </tr>
                     <tr>
                         <th>Nama Barang</th>
                         <td>{{ $barang->barang_nama }}</td>
                     </tr>
                     <tr>
                         <th>Harga Beli</th>
                         <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                     </tr>
                     <tr>
                         <th>Harga Jual</th>
                         <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                     </tr>
                 </table>
             </div>
             <div class="modal-footer">
                 <button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button>
             </div>
         </div>
     </div>
 @endempty
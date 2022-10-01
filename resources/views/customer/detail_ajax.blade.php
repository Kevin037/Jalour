
   <div class="container-fluid hasil_detail">
    <a href="" class="klik_histori" id="histori">Histori Pesanan</a><a href="#">Detail Pesanan</a>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Pemesanan</h3>

            <div class="card-tools">
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table  text-nowrap">
              <thead>
                <tr>
                  <th></th>
                  <th>Jenis Produk</th>
                  <th>Nama</th>
                  <th>Ukuran</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_atc as $data_atc)
                <tr>
                  <td><img class="card-img img-fluid" src="{{ url('img/testing/katalog/T-shirt/'.$data_atc->gambar_list1) }}" alt="Card image cap" id="product-detail" width="1%"></td>
                  <td>{{ $data_atc->nama_jenis }}</td>
                  <td>{{ $data_atc->nama_produk }}</td>
                  <td>{{ $data_atc->nama_ukuran }}</td>
                  <td><span class="tag tag-success">{{ $data_atc->jumlah_produk_keranjang }}</span></td>
                  <td>@currency($data_atc->harga_produk2)</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
   </div>

   TES DICOBA
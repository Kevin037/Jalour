@extends('admin.main')
@section('isi')
@foreach ($data_transaksi as $data_transaksi)
@foreach ($provinsi_kota as $provinsi_kota)
<div class="wrapper">
  <!-- Navbar -->
 <!-- Preloader -->
 <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../admin/dist/img/logo.png" alt="AdminLTELogo" width="10%">
  </div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Pesanan {{ $data_transaksi->kode_transaksi }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home-admin">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Pesanan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><h6 class="font-weight-bold">Data Customer</h6></strong>
                    <p>{{ $data_transaksi->nama }},&nbsp;{{ $data_transaksi->no_wa }}</p><br>
                    <strong><h6 class="font-weight-bold">Data Alamat</h6></strong>
                    <p>{{ $data_transaksi->alamat_tujuan }},&nbsp;{{ $provinsi_kota->nama_kota }},&nbsp;{{ $provinsi_kota->nama_provinsi }},&nbsp;{{ $data_transaksi->kode_pos }}</p><br>
                    <strong><h6 class="font-weight-bold">Catatan tambahan(request) :</h6></strong>
                    @if ($data_transaksi->catatan_tambahan == null)
                    <p>(tidak ada)</p>
                    @elseif ($data_transaksi->catatan_tambahan != null)
                    <p>{{ $data_transaksi->catatan_tambahan }}</p>
                    @endif
                    <br>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Waktu transaksi</th>
                          <th>Waktu kirim</th>
                          <th>Waktu Selesai</th>
                          <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>{{ $data_transaksi->tgl_transaksi }}</td>
                          <td>{{ $data_transaksi->tgl_kirim }}</td>
                          <td>{{ $data_transaksi->tgl_selesai }}</td>
                          <td>{{ $data_transaksi->status_transaksi }}</td>
                        </tr>
                        </tbody>
                      </table>
                </div>
                <!-- /.card-body -->
              </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail Produk Pesanan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Gambar</th>
                    <th>Jenis Produk</th>
                    <th>Nama</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_produk as $data_produk)
                  <tr>
                    <td>
                      @if ($data_produk->jenis_produk_id == '1')
                      <img src="{{ url('img/testing/katalog/T-shirt/'.$data_produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="20%">
                      @elseif ($data_produk->jenis_produk_id == '2')
                      <img src="{{ url('img/testing/katalog/Hoodie/'.$data_produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="20%">
                      @elseif ($data_produk->jenis_produk_id == '3')
                      <img src="{{ url('img/testing/katalog/Crewneck/'.$data_produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="20%">
                      @elseif ($data_produk->jenis_produk_id == '4' || '5')
                      <img src="{{ url('img/testing/katalog/Case/'.$data_produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="20%">
                      @endif
                    </td>
                    <td>{{ $data_produk->nama_jenis }}</td>
                    <td>{{ $data_produk->nama_produk }}</td>
                    <td>{{ $data_produk->nama_ukuran }}</td>
                    <td><span class="tag tag-success">{{ $data_produk->jumlah_produk_keranjang }}</span></td>
                    <td>@currency($data_produk->harga_produk2)</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@endforeach
@endforeach
@endsection
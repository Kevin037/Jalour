@extends('admin.main')
@section('isi')
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
            <h1>Pesanan On Progress</h1>
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
                <h3 class="card-title">Data Pesanan Customer</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Waktu transaksi</th>
                    <th>Waktu kirim</th>
                    <th>Kode transaksi</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>No resi</th>
                    <th>Tindakan</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_pesanan_diproses as $data_pesanan_diproses)
                  <tr>
                    <td>{{ $data_pesanan_diproses->tgl_transaksi }}</td>
                    <td>{{ $data_pesanan_diproses->tgl_kirim }}</td>
                    <td>{{ $data_pesanan_diproses->kode_transaksi }}</td>
                    <td>{{ $data_pesanan_diproses->nama }}</td>
                    <td>{{ $data_pesanan_diproses->status_transaksi }}</td>
                    <td>{{ $data_pesanan_diproses->no_resi_transaksi }}</td>
                    <td>
                      @if ($data_pesanan_diproses->status_transaksi == 'pesanan diproses')
                      <a href="/form_resi{{ $data_pesanan_diproses->id }}" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;Masukkan no resi</a>
                      @elseif($data_pesanan_diproses->status_transaksi == 'pesanan dikirim')
                        <a href="/pesanan_selesai{{ $data_pesanan_diproses->id }}" class="btn btn-warning">Berhasil</a>
                        <a href="/hapus_pesanan{{ $data_pesanan_diproses->id }}" onclick="return confirm('Yakin hapus pesanan?')" data-kode="{{ $data_pesanan_diproses->kode_transaksi }}" data-id="{{ $data_pesanan_diproses->id }}" class="btn btn-danger pesanan_batal">Batal</a>
                      @endif
                      <a href="/detail_pesanan{{ $data_pesanan_diproses->id }}" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></a>
                    </td>
                   
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
@endsection
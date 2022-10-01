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
            <h1>Pesanan masuk</h1>
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
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Quick Example</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @foreach ($data_transaksi as $data_transaksi)
                    <form method="POST" action="/simpan_resi{{ $data_transaksi->id }}">
                      @csrf
                      <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Waktu</label>
                            <input type="text" class="form-control" value="{{ $data_transaksi->tgl_transaksi }}" id="exampleInputEmail1" readonly>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Kode transaksi</label>
                            <input type="text" class="form-control" value="{{ $data_transaksi->kode_transaksi }}" id="exampleInputEmail1" readonly>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Biaya transaksi</label>
                            <input type="text" class="form-control" value="{{ $data_transaksi->biaya_transaksi }}" id="exampleInputEmail1" readonly>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Biaya ongkir</label>
                            <input type="text" class="form-control" value="{{ $data_transaksi->biaya_ongkir }}" id="exampleInputEmail1" readonly>
                          </div>
                          <div class="form-group">
                            <label for="net_profit">Net profit</label>
                            <input type="text" class="form-control" value="{{ $data_transaksi->net_profit }}" name="net_profit" id="net_profit" placeholder="net profit" readonly>
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">No resi</label>
                          <input type="text" class="form-control" name="no_resi" id="exampleInputEmail1" placeholder="Masukkan no.resi">
                        </div>
                        
                      </div>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <!-- /.card-body -->
                    </form>
                    @endforeach
                  </div>
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
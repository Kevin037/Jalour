@extends('main')
@section('judul')
<title>JALOUR | Konfirmasi Pembayaran</title>
@endsection
@section('isi')
@foreach ($data as $data)
<link rel="stylesheet" href="css/checkout.css">
<section class="full">
  <center>
    <h3>KONFIRMASI PEMBAYARAN</h3><br><br>
  </center>
         
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-7 bawah">
              <div class="">
                  <!-- /.card-header -->
                  <div class="card-body">
                   
                    <form class="row g-3" action="/update_pembayaran{{ $data->id }}" enctype="multipart/form-data" method="POST">
                      @csrf
                      <div class="col-md-12">
                        <label for="inputNama" class="form-label">Kode transaksi</label>
                        <input type="text" class="form-control" name="nama_customer" value="{{ $data->kode_transaksi }}" id="inputNama" readonly>
                      </div>
                      <div class="col-md-12">
                        <label for="inputNama" class="form-label">Tgl transaksi</label>
                        <input type="text" class="form-control" value="{{ $data->tgl_transaksi }}" name="nama_customer" id="inputNama" readonly>
                      </div>
                      <div class="col-md-5">
                        <label for="inputNama" class="form-label">Metode pembayaran</label>
                        <input type="text" class="form-control" value="{{ $data->metode_pembayaran }}" name="nama_customer" id="inputNama" readonly>
                      </div>
                      <div class="col-md-7">
                        <label for="nama_pengirim" class="form-label">Nama Rek.Pengirim</label>
                        <input type="text" class="form-control" name="nama_rek_pengirim" id="nama_pengirim" required>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                              <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                              </ul>
                            </div>
                        @endif
                        <label for="bukti_pembayaran" class="form-label">Bukti pembayaran&nbsp;(max.900kb)</label>
                        <input type="file" class="form-control" name="bill" title="jpg,jpeg,png(max.900kb)" id="bukti_pembayaran" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
                      </div>
                    <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
                    
                  </form>
                    <!-- /.row -->
                    <!-- /.row -->
                  </div>
                  <!-- /.card-body -->
                </div>
          </div>
          <div class="col-md-5 kanan kanan-konfirm">
              <div class="container-fluid">
                  <div class="row total" >
                    @foreach ($data_produk_konfirmasi as $data_produk_konfirmasi)
                      <div class="col-2">
                          @if ($data_produk_konfirmasi->jenis_produk_id == '1')
                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/T-shirt/'.$data_produk_konfirmasi->gambar_list1) }}" alt="Card image cap" width="140%" height="100px">
                          @elseif ($data_produk_konfirmasi->jenis_produk_id == '2')
                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Hoodie/'.$data_produk_konfirmasi->gambar_list1) }}" alt="Card image cap" width="140%" height="100px">
                          @elseif ($data_produk_konfirmasi->jenis_produk_id == '3')
                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Crewneck/'.$data_produk_konfirmasi->gambar_list1) }}" alt="Card image cap" width="140%" height="100px">
                          @elseif ($data_produk_konfirmasi->jenis_produk_id == '4' || '5')
                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Case/'.$data_produk_konfirmasi->gambar_list1) }}" alt="Card image cap"  width="140%" height="100px">
                          @endif
                         
                      </div>
                      <div class="col-5">
                        {{ Str::limit($data_produk_konfirmasi->nama_produk, 20) }}
                      </div>
                      <div class="col-2">
                        (x{{ $data_produk_konfirmasi->jumlah_produk_keranjang }})
                      </div>
                      <div class="col-3" id="harga-produk-div">@currency($data_produk_konfirmasi->biaya_keranjang)</div>
                      @endforeach
                      {{-- <p>{{ $data_berat }}</p> --}}
                  </div>
                  
                 <div class="ikoiko">
                  <div class="row iko">
                    <div class="col-9">Biaya Ongkir</div>
                    <div class="col-3" id="hasil_ongkir">@currency($data->biaya_ongkir)</div>
                  </div>
                  <div class="row iko">
                    <div class="col-9">Biaya Tambahan</div>
                    <div class="col-3" id="hasil_ongkir">@currency($data->biaya_tambahan)</div>
                  </div>
                 </div>
                  <div class="row iko">
                      <div class="col-8">
                         <p class="fw-bold"><h4>TOTAL</h4></p> 
                      </div>
                      <div class="col-4 fw-bold" id="hasil_total"><h4>@currency($data->biaya_transaksi)</h4></div>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>

</section>
@endforeach
@endsection
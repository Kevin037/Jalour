@extends('customer.include_checkout')
@section('judul')
<title>JALOUR | Checkout</title>
@endsection
@section('isi')
<section class="full">
    <center><a href="/home-user"><img src="img/testing/logofix2.png" width="20%" alt=""></a> <br><br>
    <div>
        <h5> Checkout > Pengiriman & Pembayaran > <a href="#" class="pilih" style="color: rgb(175, 175, 175)">Selesai</a></h5>   
    </div>
    </center>
    
    <div class="container-fluid isi">
        <div class="row halaman_info_bayar">
            <div class="col-md-12 kiri">
                @foreach ($transaksi_baru as $transaksi_baru)
                    
                
                <h5><img src="img/testing/berhasil_checkout.jpg" alt="" width="5%">&nbsp;{{ $transaksi_baru->kode_transaksi }}</h5>
                        <h3>Terimakasih {{ $transaksi_baru->nama }}, Pesanan berhasil tersimpan.</h3><br>
                <p>Silakan melakukan pembayaran sebesar... <h3 class="fw-bold fst-italic text-center">-- @currency($transaksi_baru->biaya_transaksi) --</h5>
                    maksimal 1X24 jam setelah melakukan pemesanan(Sebelum {{ $transaksi_baru->tgl_jatuh_tempo }}&nbsp;WIB)</p>
                <div class="info_bayar">
                    <!-- /.card-header -->
                    <div class="card-body uinfo-bayar">
                        
                        
                        <h5>Berikut tata cara pembayaran melalui {{ $transaksi_baru->metode_pembayaran }}:</h5>
                        @if ($transaksi_baru->metode_pembayaran == 'Alfamart')
                        <ol >
                            <ul class="list-group list-group-numbered" style="border: none">
                            <li>Anda akan menerima kode pembayaran Alfamart melalui WA dari admin & Menu histori Pesanan</li>
                            <li>Datangi Alfamart terdekat dilokasi anda, sampaikan kepada kasir perihal "Pembayaran Plasamall"</li>
                            <li>Berikan kode pembayaran pada kasir</li>
                            <li>Lakukan pembayaran sesuai nominal (tambahan biaya admin ditanggung customer)</li>
                            <li>Foto bukti pembayaran</li>
                            <li>Konfirmasi pembayaran pada menu Histori Pesanan/ melalui admin WA</li>
                            </ul>
                        </ol>
                        @elseif ($transaksi_baru->metode_pembayaran == 'QRIS')
                        <ol>
                            <ul class="list-group list-group-numbered" style="border: none">
                                <li>Anda akan menerima kode QRIS melalui WA dari admin</li>
                                <li>Scan kode QR yang diterima</li>
                                <li>Screenshoot bukti pembayaran</li>
                                <li>Konfirmasi pembayaran pada menu Histori Pesanan/ melalui admin WA</li>
                            </ul>
                        </ol>
                        @elseif ($transaksi_baru->metode_pembayaran == 'BNI')
                        <ol>
                            <ul class="list-group list-group-numbered" style="border: none">
                                <li>Silakan transfer pada no rekening <div class="fw-bold">&nbsp;&nbsp;&nbsp;&nbsp; 453942730 (a.n Kevin Satria)</div></li>
                                <li>Transfer sesuai nominal pembayaran</li>
                                <li>Foto/screenshoot bukti pembayaran</li>
                                <li>Konfirmasi pembayaran pada menu Histori Pesanan/ melalui admin WA</li>
                            </ul>
                        </ol>
                        @elseif ($transaksi_baru->metode_pembayaran == 'Ovo')
                        <ol>
                            <ul class="list-group list-group-numbered" style="border: none">
                                <li>Silakan transfer pada No.Ovo <div class="fw-bold">&nbsp;&nbsp;&nbsp;&nbsp; 0895365417030 (a.n Kevin Satria)</div></li>
                                <li>Transfer sesuai nominal pembayaran</li>
                                <li>Foto/screenshoot bukti pembayaran</li>
                                <li>Konfirmasi pembayaran pada menu Histori Pesanan/ melalui admin WA</li>
                            </ul>
                        </ol> 
                         @endif
                    </div>
                    <!-- /.card-body -->
                  </div><br>
                  <center>
                    <div style="background: rgb(189, 218, 218);border-radius:3px;width:85%">
                        <p style="padding: 6px" >
                          Jika terdapat perubahan/kesalahan data, segera menghubungi admin 
                        </p>
                    </div>
                  </center>
                  <h5> Konfirmasi pembayaran dan detail pesanan bisa anda akses <a href="/histori_pesanan">disini</a> </h5><br>
                  <div class="row">
                      <div class="col-12 text-center">
                        <form action="/home-user" method="GET">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Piih produk lainnya</button>
                          </form>
                      </div>
                  </div>
                  @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
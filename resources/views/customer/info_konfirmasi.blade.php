@extends('main')
@section('judul')
<title>JALOUR | Info Konfirmasi Pembayaran </title>
@endsection
@section('isi')
<div class="container-fluid" style="padding: 5% 15%">
    <center><h1>Petunjuk Konfirmasi Pembayaran</h1></center><br>
    <ol class="list-group list-group-numbered" style="border: none"> 
     <li>Masuk ke menu “Histori Pemesanan”<br><img src="img/testing/a.jpg" width="30%" alt=""></li>
     <li>Terdapat berbagai macam data transaksi tergambarkan pada kolom “status”. Untuk yang belum dilakukan pembayaran, akan secara otomasi muncul tombol “Konfirmasi Pembayaran”. Selanjutnya klik tombol tersebut
 <br> <img src="img/testing/b.jpg" alt=""><br>
     </li>
     <li>Data pesanan akan tampil pada form, silakan tinggal upload gambar bukti transfer pada form yang tersedia, setelah itu klik “Konfirmasi Pembayaran”<div class="br"></div>
        <img src="img/testing/c.jpg" alt=""><br>
     </li>
     <li>Konfiramsi pembayaran sedang diproses, customer akan mendapatkan pesan melalui WA sebagai bukti konfirmasi pembayaran telah tervalidasi oleh admin.</li>
     <li>Customer menunggu pesanan diproses, no resi akan tercantum pada menu “Histori Pesanan”.</li>
     </ol>
    
</div>
@endsection
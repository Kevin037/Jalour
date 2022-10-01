@extends('main')
@section('judul')
<title>JALOUR | Alur Pemesanan </title>
@endsection
@section('isi')
<style>
.alur ol li{
  margin-top: 20px;
}
.kotak-catatan{
  background: rgb(208, 226, 226);
  border-radius: 10px;
  margin: 20px;
}
ol .catatan{
  padding: 10px;
}
</style>
<section class="container-fluid alur" style="padding: 5% 15%">
    <center><h1>Petunjuk Alur Pemesanan</h1></center><br>
    <ol class="list-group list-group-numbered" style="border: none"> 
     <li>Silakan login terlebih dahulu untuk bisa melakukan pemesanan</li>
     <li>Pilih produk yang kalian suka<br><img src="img/testing/asset/2.jpg" width="50%" alt=""></li>
     <li>Silakan pilih jumlah dan ukuran yang sesuai (sizechart tersedia dengan klik tombol “panduan ukuran” )<img src="img/testing/asset/3.jpg" width="50%" alt=""></li><br>
     <li>Jika terdapat request desain khusus, silakan klik “Request custom” untuk melanjutkan konsultasi dengan admin mengenai desain yang diinginkan. Selesai berkonsultasi, customer dapat kembali ke website untuk melakukan pemesanan.<br><img src="img/testing/asset/4.jpg" width="50%" alt=""></li>
        
        <div class="kotak-catatan">
          <div class="catatan">
            Catatan : untuk pemesanan Case(hardcase/softcase), klik”Tanyakan Stok” terlebih dahulu untuk memastikan ketersediaan stok pada tipe hp yang diinginkan. Setelah itu, lanjut ke tahap berikutnya
          </div>
        </div>
        <br>&nbsp;&nbsp;<img src="img/testing/asset/case_stok.jpg" width="50%" alt="">
      <li>Jika produk tersedia, silakan lanjut klik “Tambahkan ke Keranjang”<br><img src="img/testing/asset/5.jpg" width="50%" alt=""></li>
      <li>Produk berhasil ditambahkan ke keranjang.  Customer bisa menambahkan produk lainnya untuk mendapatkan special diskon dari JALOUR.</li>
      <li>Jika sudah cukup silakan klik “Checkout” untuk melanjutkan pemesanan<br><img src="img/testing/asset/7.jpg" width="50%" alt=""></li>
      <li>Pada form yang tersedia, silakan dilengkapi dengan data yang benar dan pastikan sudah sesuai pesanan.<br><img src="img/testing/asset/8.jpg" width="50%" alt=""></li>
      <div class="kotak-catatan">
        <div class="catatan">
      Catatan: jika pilihan kurir pada alamat yang telah diisikan tidak tersedia/tidak ada. Silakan bisa menghubungi admin pada kontak yang telah tersedia.
        </div>
      </div>
      <br>&nbsp;&nbsp;<img src="img/testing/asset/tanya_admin.jpg" width="50%" alt="">
      <li>Setelah data sudah dilengkapi, Klik “Pesan Sekarang” untuk menyelesaikan pemesanan.<br><img src="img/testing/asset/9.jpg" width="50%" alt=""></li>
      <li>Pesanan berhasil disimpan, daftar pesanan dapat dilihat pada menu “Histori Pesanan”.<br><img src="img/testing/asset/10.jpg" width="50%" alt=""></li>
        
     </ol>
    
</section>
@endsection
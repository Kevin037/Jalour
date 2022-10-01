<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
   <link rel="stylesheet" href="css/bootstrap@5.min.css" >

<link rel="stylesheet" href="css/templatemo.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="baru.css">
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="mobile-501-600.css">
    <link rel="stylesheet" href="mobile-401-500.css">
    <link rel="stylesheet" href="mobile-201-400.css">
    <link rel="stylesheet" href="web.css">
    <link rel="stylesheet" href="css/checkout.css">
    
    <link rel="stylesheet" href="web-801.css">
    <link rel="stylesheet" href="css/googleapis.css">
    <link rel="stylesheet" href="css/font-awesome4.7.min.css">
   <link rel="stylesheet" href="css/fontawesome.min.css">

    <link rel="stylesheet" href="css/new/slick.css">
    <link rel="stylesheet" href="css/LineIcons.css">
    <link rel="stylesheet" type="text/css" href="css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/carousel/ms.css">
    <link rel="stylesheet" href="css/tabs.css">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/sweetalert2.css">
    <link rel="stylesheet" href="css/kuantiti__keranjang.css">
    <link rel="icon" type="image/png" href="img/testing/logo.png">
  
    @yield('judul')
  </head>
    <body>
      

@yield('isi')      
</body>
</html>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="js/bootstrap@5.bundle.min.js"></script>
  <script src="js/sweet.js"></script>
  
  <script src="js/jquery-migrate-1.2.1.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/templatemo.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/zoom.js"></script>
  <script src="js/kuantiti_keranjang.js"></script>
  <script src="js/owl-carousel/owl.carousel.js"></script>
 @yield('js')
  <script>
    $(".hapus_keranjang").click(function(){
    var id_keranjang = $(".hapus_keranjang").attr('data-id');
    var gambar_keranjang =  $(".hapus_keranjang").attr('data-gambar');
    var jenis_produk =  $(".hapus_keranjang").attr('data-jenis');
    Swal.fire({
title: 'Yakin?',
text: "Hapus produk dari keranjang",
imageUrl: 'img/testing/katalog/'+jenis_produk+'/'+gambar_keranjang+'',
imageWidth: 170,
imageHeight: 200,
// icon: 'url(img/testing/katalog/T-shirt/kk1.jpg)',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Ya, hapus'
}).then((result) => {
if (result.isConfirmed) {
  window.location = "/hapus_keranjang"+id_keranjang+""
  Swal.fire(
    'Berhasil dihapus!',
    'dari keranjang.',
    'success'
  )
}
})
  });


  $(document).ready(function(){
    $('input[name="ukuran_id"]').on('change', function(){
          let produk = $('input[name="produk_id"]').val();
          let ukuran = document.querySelector('input[name=ukuran_id]:checked').value;
          if(produk){
              $.ajax({
                  url: '/produk/'+produk+'/ukuran/'+ukuran,
                  type:"GET",
                  dataType:"json",
                  success:function(data){
                    $.each(data, function(key, value){
                      if (value == null) {
                        $('#tampilan_stok').text('0');
                      }else{
                        $('#tampilan_stok').text(value);
                      }
                      });
                    }
                  });
          }else{
            $('select[name="kota_tujuan"]').empty();
          }
      });
});
  </script>

<script>
  $(function() {
      $('a[href*=\\#]:not([href=\\#])').on('click', function() {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.substr(1) +']');
          if (target.length) {
              $('html,body').animate({
                  scrollTop: target.offset().top
              }, 500);
              return false;
          }
      });
  });


  function validasi_pembayaran(){

var metode_pembayaran = document.getElementsByName('metode_pembayaran');
var metode_pembayaranValue = false;

for(var i=0; i<metode_pembayaran.length;i++){
    if(metode_pembayaran[i].checked == true){
      metode_pembayaranValue = true;    
    }
}
if(!metode_pembayaranValue){
    alert("Pilih metode pembayaran");
    return false;
}

}
  </script>

<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="123">
</script>
<script>

  $("#tambah_checkout").submit(function (event){
    alert({{ config('services.facebook.client_secret') }});
    return false;
    // event.preventDefault();
      // $.ajax({
      //   url: '{{ url('/test') }}',
      //   type:"POST",
      //   data: {
      //     // _token = '{{ csrf_token() }}',
      //     // data_kurir = $('#data_kurir').val(),
      //     // input_ongkir = $('input#input_ongkir').val(),
      //     // biaya_tambahan = $('input#biaya_tambahan').val(),
      //     // biaya_final = $('input#biaya_final').val(),
      //     // input_diskon = $('input#input_diskon').val(),
      //     // catatan_tambahan = $('textarea.catatan_tambahan').val(),
      //     // nama = $('input#nama').val(),
      //     // no_wa = $('input#no_wa').val(),
      //     // alamat_tujuan = $('input#alamat_tujuan').val(),
      //     // kota_tujuan = $('input#kota_tujuan').val(),
      //     // provinsi_tujuan = $('input#provinsi_tujuan').val(),
      //     kode_pos = $('input#kode_pos2').val(),
      //   },
      //   dataType:"json",
      //   success:function(data){
      //     alert(kode_pos);
      //     // return false;
      //   }
      //   });
          // $.each(data, function(key, value){
          //   if (value == null) {
          //     $('#tampilan_stok').text('0');
          //   }else{
          //     $('#tampilan_stok').text(value);
          //   }
          //   });
          
    // $.post("/bayar_midtrans", {
    //   _method: 'POST',
    //   _token = '{{ csrf_token() }}',
    //   data_kurir = $('#data_kurir').val(),
    //   input_ongkir = $('input#input_ongkir').val(),
    //   biaya_tambahan = $('input#biaya_tambahan').val(),
    //   biaya_final = $('input#biaya_final').val(),
    //   input_diskon = $('input#input_diskon').val(),
    //   catatan_tambahan = $('textarea.catatan_tambahan').val(),
    //   nama = $('input#nama').val(),
    //   no_wa = $('input#no_wa').val(),
    //   alamat_tujuan = $('input#alamat_tujuan').val(),
    //   kota_tujuan = $('input#kota_tujuan').val(),
    //   provinsi_tujuan = $('input#provinsi_tujuan').val(),
    //   kode_pos = $('input#kode_pos2').val(),
    // },
    // function (data, status){
    //   snap.pay(data.snap_token, {
    //     onSuccess: function(result){
    //       location.reload();
    //     }, 
    //     onPending: function(result){
    //       location.reload();
    //     }, 
    //     onError: function(result){
    //       location.reload();
    //     }
    //   });
    //   return false;
    // }
    // )
  })
</script>
 
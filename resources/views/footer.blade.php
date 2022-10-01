
@include('sweetalert::alert')
<section id="kaki">
  <div class="row">
    <div class="col-md-4"><h4><strong>KONTAK KAMI</strong></h4>
      <div class="">
        <div class="col-8 mb-3">
            <div class="w-100 my-3 border-top border-light"></div>
        </div>
        <div class="col-auto me-auto kontak">
          Info lebih lanjut: <br><br>
                    <a class="text-light text-decoration-none" target="_blank" href="#"><i class="fab fa-whatsapp fa-lg fa-fw fa-3x"></i></a>
                    {{-- <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/jalour_project/"><i class="fab fa-instagram fa-lg fa-fw fa-3x"></i></a> --}}
        </div>
    </div>
    </div>
    <div class="col-md-4"><h4><strong>ALAMAT</strong></h4>
      <div class="col-8 mb-3">
        <div class="w-100 my-3 border-top border-light"></div>
    </div>
      Jl. Gotong Royong I No.29B, RT.5/RW.2, Ragunan, Kec. Ps. Minggu
    </div>
    <div class="col-md-4 pusat_bantuan"><h4><strong>PUSAT BANTUAN</strong></h4>
      <div class="col-8 mb-3">
        <div class="w-100 my-3 border-top border-light"></div>
    </div>
    {{-- <ul>
      <li><a href="">Alur Pemesanan</a></li>
      <li><a href="">Garansi & Retur</a></li>
      <li><a href="">Konfirmasi Pembayaran</a></li>
      <li><a href="">Kurir & Pembayaran</a></li>
    </ul> --}}
    <a href="/alur_pemesanan">Alur Pemesanan</a><br>
    <a href="garansi_retur">Garansi & Retur</a><br>
    <a href="/info_konfirmasi">Konfirmasi Pembayaran</a><br>
    <a href="/kurir">Kurir & Pengiriman</a>
  </div>
  </div>
  {{-- <img src="img/testing/logofix1.png" width="15%" alt="" style="margin-top: 3%"> --}}
  <div style="margin-bottom:-3%;margin-top:3%">
    <p>Copyright2021<i class="far fa-copyright"></i> Jalour</p>
  </div>
</div>
</section>
</body>
</html>
<script>
      // const navbar = document.getElemenById('navbarSupportedContent');
      // const sidebar = document.getElementByClass('sidebar');
      // const cancel = document.getElementById('cancel');
      // document.onclick = function(e){
      //   if(e.target.class !== 'sidebar' && e.target.id !== 'cancel')
      //   {
      //     const cek = document.getElementById('check');
      //     cek.checked = false;
      //   });});  
  </script>
  {{-- <script src="js/jquery-1.11.0.min.js"></script> --}}
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  {{-- <script src="https://code.jquery.com/jquery-migrate-3.3.2.js" integrity="sha256-BDmtN+79VRrkfamzD16UnAoJP8zMitAz093tvZATdiE=" crossorigin="anonymous"></script> --}}
  {{-- <script
  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
  crossorigin="anonymous"></script> --}}
  {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
      
      {{-- https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js --}}
  <script src="js/bootstrap@5.bundle.min.js"></script>
  <script src="js/sweet.js"></script>
  
  <script src="js/jquery-migrate-1.2.1.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/templatemo.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/zoom.js"></script>
  <script src="js/checkout.js"></script>
  <script src="js/kuantiti_keranjang.js"></script>
  <script src="js/owl-carousel/owl.carousel.js"></script>
  <script>
    $(document).ready(function() {
      var owl = $('.testi');
      owl.owlCarousel({
        items: 2,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true
      });
      owl.trigger('play.owl.autoplay', [2500])
    });

    $(document).ready(function() {
      var owl = $('.banner_hero');
      owl.owlCarousel({
        items: 1,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 10000,
        autoplayHoverPause: true
      });
      owl.trigger('play.owl.autoplay', [5000])
    });
//   </script>


  <script>
    $('.produk-terlaris').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
});

$('.produk-rekom').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:6
        }
    }
});

$('.produk').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1200:{
            items:4
        }
    }
});

$('.testi').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        550:{
            items:2
        },
        850:{
          items:3
        },
        1150:{
            items:4
        }
    }
});

$('.banner_hero').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
  </script>
  <script>

    $(".hapus_keranjang").click(function(){
      document.getElementById("check").checked = false;
    var id_keranjang = $(this).attr('data-id');
    // console.log(id_keranjang);
    var gambar_keranjang =  $(this).attr('data-gambar');
    var jenis_produk =  $(this).attr('data-jenis');
    Swal.fire({
    title: 'Yakin?',
    text: "Hapus produk dari keranjang",
    imageUrl: 'img/testing/katalog/'+jenis_produk+'/'+gambar_keranjang+'',
    imageWidth: 170,
    imageHeight: 230,
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
                    // console.log('iso');
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

{{-- <script type="text/javascript">
	$(document).ready(function(){
		$('.klik_detail').click(function(){
      var id_user = $("#detail").attr('data-user');
      var id_transaksi = $("#detail").attr('data-transaksi');
			var menu = $(this).attr('id');
			if(menu == "detail"){
				$('.hasil_detail').load('/coba_detail'+id_transaksi+'/'+id_user);						
			}
		});

    $('.klik_histori').click(function(){
      var id_user = $("#detail").attr('data-user');
      var id_transaksi = $("#detail").attr('data-transaksi');
			var menu = $(this).attr('id');
			if(menu == "histori"){
				$('.hasil_detail').load('/histori_pesanan');						
			}
		});
	});
</script> --}}
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
  </script>
  <script>
    function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
  </script>
  <script>
    $('.tanyastok').click(function(){
    /* Inputan Formulir */
    var nama_produk_tanya = $("#nama_produk_tanya").val();
    var    tipe_case_tanya = $("#tipe_case_tanya").val();

    var walink      = 'https://web.whatsapp.com/send';
    var    phone       = '62895365417030';
    var    text        = 'Halo admin, case dengan model berikut apakah ada? ';
 
    /* Smartphone Support */
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        var walink = 'whatsapp://send';
    }
 
    if(nama_produk_tanya != "" && tipe_case_tanya != ""){
        /* Whatsapp URL */
        var checkout_whatsapp = walink + '?phone=' + phone + '&text=' + text + '%0A%0A' +
            '*Nama produk* : ' + nama_produk_tanya + '%0A' +
            '*Tipe Case* : ' + tipe_case_tanya + '%0A';
 
        /* Whatsapp Window Open */
        window.open(checkout_whatsapp,'_blank');
        document.getElementById("text-info").innerHTML = '<div class="alert alert-success">'+text_yes+'</div>';
    } else {
        document.getElementById("text-info").innerHTML = '<div class="alert alert-danger">'+text_no+'</div>';
    }
});



$('.request').click(function(){
    /* Inputan Formulir */
    var nama_produk_request = $("#nama_produk_request").val();
    var kode_produk_request = $("#kode_produk_request").val();

    var walink      = 'https://web.whatsapp.com/send';
    var    phone       = '62895365417030';
    var    text        = 'Halo admin, Saya ingin request custom produk ini, bisa? ';
 
    /* Smartphone Support */
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        var walink = 'whatsapp://send';
    }
 
    if(nama_produk_request != "" && kode_produk_request != ""){
        /* Whatsapp URL */
        var checkout_whatsapp = walink + '?phone=' + phone + '&text=' + text + '%0A%0A' +
            '*Nama produk* : ' + nama_produk_request + '%0A' +
            '*Kode produk* : ' + kode_produk_request + '%0A';
 
        /* Whatsapp Window Open */
        window.open(checkout_whatsapp,'_blank');
        document.getElementById("text-info").innerHTML = '<div class="alert alert-success">'+text_yes+'</div>';
    } else {
        document.getElementById("text-info").innerHTML = '<div class="alert alert-danger">'+text_no+'</div>';
    }
});
  </script>

<script type="text/javascript">
  function validasi_ukuran(){

      var ukuran = document.getElementsByName('ukuran_id');
      var ukuranValue = false;

      for(var i=0; i<ukuran.length;i++){
          if(ukuran[i].checked == true){
            ukuranValue = true;    
          }
      }
      if(!ukuranValue){
          alert("Silakan pilih ukuran dulu");
          return false;
      }

  }

</script>
{{-- <script>
  $("#atc").click(function(){
    document.getElementById("check").checked = true;
  });
</script> --}}

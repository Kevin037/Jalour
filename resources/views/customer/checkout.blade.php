@extends('customer.include_checkout')
@section('judul')
<title>JALOUR | Checkout</title>
@endsection
@section('isi')
<section class="full">
    <center><a href="/home-user"><img src="img/testing/logofix2.png" width="20%" alt=""></a> <br><br>
    <div>
        @if ($status=='cekongkir')
        <h5> Checkout <a href="#" class="pilih" style="color: rgb(175, 175, 175)">> Pengiriman & Pembayaran </a> > Selesai</h5>
        @elseif($status=='belum_cekongkir')
        <a href="#" class="pilih" style="color: rgb(175, 175, 175)"><h5> Checkout</a> > Pengiriman & Pembayaran > Selesai</h5>
        <center><div class="btn-promo text-center" type="button" data-toggle="modal" data-target="#modal_promo_checkout">
          <p class="teks-promo"><i class='fas fa-bullhorn'></i>&nbsp;Spesial cashback Hingga 20k, KLIK DISINI !!</p>
        </div></center>
        @elseif($status=='selesai_checkout')
        <h5> Checkout > Pengiriman & Pembayaran > <a href="#" class="pilih" style="color: rgb(175, 175, 175)">Selesai</a></h5>
        @endif
        
    </div>
    </center>
    
    <div class="container-fluid isi">
        <div class="row">
            <div class="col-md-7 kiri">
                <div class="">
                    <!-- /.card-header -->
                    <div class="card-body">
                     @if ($status == 'belum_cekongkir')
                     
                     <form class="row g-3" action="/pengiriman_pembayaran" method="POST">
                        @csrf

                        <div class="col-md-6">
                          <label for="inputNama" class="form-label">Nama</label>
                          <input type="text" class="form-control" name="nama_customer" id="inputNama" required>
                        </div>
                        <div class="col-md-6">
                          <label for="inputNohp" class="form-label">No. Whatsapp</label>
                          <input type="number" class="form-control" name="no_wa_customer" id="inputNohp" required>
                        </div>
                        <div class="col-md-6">
                              <label for="provinsi">Provinsi tujuan</label>
                              <select class="form-select" id="provinsi" name="provinsi_tujuan" required>
                                <option value="">-Pilih Provinsi-</option>
                                @foreach ($provinces as $province => $value)
                                <option value="{{ $province }}">{{ $value }}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="col-md-4">
                              <label>Kota tujuan</label>
                              <select class="form-select" name="kota_tujuan" required>
                                <option>-Pilih Kota-</option>
                              </select>
                            </div>
                            <div class="col-md-2">
                              <label for="">Kode pos</label>
                              <input type="number" name="kode_pos" class="form-control" id="kode_pos" value="" required>
                            </div>
                            <div class="col-md-12">
                              <label for="">Alamat (Jln, Rt, Rt, No, Kelurahan, Kecamatan)</label>
                              <textarea class="form-control" name="alamat_tujuan" id="exampleFormControlTextarea1" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                              <label>Pilih Kurir</label>
                              <select class="form-select" name="kurir" required>
                                <option value="">-Pilih Kurir-</option>
                                @foreach ($couriers as $courier => $value)
                                <option value="{{ $courier }}">{{ $value }}</option>
                                @endforeach
                              </select>   
                            </div>

                            <div class="col-md-6">
                              <label for="">Berat</label>
                              <input type="number" name="berat" class="form-control" id="berat" value="{{ $data_berat }}" readonly>
                            </div>
                            <p>(Note: jika opsi kurir tidak tersedia, silakan menghubungi admin)</p>
                        <!-- /.col -->
                      <input type="hidden" name="biaya_total" value="{{ $biaya_total}}">
                      <button type="submit" class="btn btn-primary">Lanjut Pembayaran&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></button>
                    
                    </form>
                     @elseif($status == 'cekongkir')
                     {{-- <script type = "text/javascript" >
                      function preventBack(){window.history.forward();}
                      setTimeout("preventBack()", 0);
                      window.onunload=function(){null};
                      </script> --}}
                     {{-- <form action="/tambah_checkout" method="POST" class="row g-3"> --}}
                      <form action="#" id="tambah_checkout" method="POST" class="row g-3">
                         @csrf
                         <input type="hidden" name="nama" id="nama" value="{{ $nama }}">
                         <input type="hidden" name="no_wa" id="no_wa" value="{{ $no_wa }}">
                         <input type="hidden" name="alamat_tujuan" id="alamat_tujuan" value="{{ $alamat_tujuan }}">
                         <input type="hidden" name="kota_tujuan" id="kota_tujuan" value="{{ $kota_tujuan }}">
                         <input type="hidden" name="provinsi_tujuan" id="provinsi_tujuan" value="{{ $provinsi_tujuan }}">
                         <input type="hidden" name="kode_pos" id="kode_pos2" value="{{ $kode_pos }}">
                         <input type="hidden" name="data_kurir" id="data_kurir" value="{{ $kurir }}">
                         <input type="hidden" name="jumlah_pembelian" id="jumlah_pembelian" value="{{ $jumlah_pembelian }}">
                         

                         <div class="col-md-12 hasil_data_customer">
                           <div class="isi_hasil_data_customer">
                              <p>Data Customer :</p>
                              <ul>
                                <li>{{ $nama }}&nbsp;({{ $no_wa }})</li>
                              </ul>
                              <p>Data Alamat :</p>
                              <ul>
                                @foreach ($provinsi_kota as $provinsi_kota) 
                                <li>{{ $alamat_tujuan }},&nbsp;{{ $provinsi_kota->nama_kota }},&nbsp;{{ $provinsi_kota->nama_provinsi }},&nbsp;{{ $kode_pos }}</li>
                                @endforeach
                              </ul>
                           </div>
                         </div>
                         <div class="col-md-6">
                          <label>Paket Pengiriman</label>
                          <select class="form-select" name="paket" id="paket" required>
                            <option value="">-Pilih paket-</option>
                            @foreach ($hasil as $hasil)
                            <option value="{{ $hasil['cost'][0]['value'] }}">{{ $hasil['service'] }} - @currency($hasil['cost'][0]['value'])</option>
                            @endforeach
                          </select>
                          {{-- <label for="">Total</label>
                          <input type="text" value="" class="form-control" id="total" name="total"> --}}
                        </div>
                         <div class="col-md-6">
                            <label for="">Berat</label>
                            <input type="number" name="berat" class="form-control" value="{{ $berat }}" id="berat" readonly> 
                          </div>
                          <div class="col-md-12">
                            <label for="">Catatan tambahan (Opsional)</label>
                            <textarea class="form-control catatan_tambahan" name="catatan_tambahan"  rows="2"></textarea>
                          </div>
                          <div class="col-md-9">
                            <label for="">Pilih Metode Pembayaran</label>
                            <div class="radiobtn">
                              <input type="radio" id="huey"
                                     name="metode_pembayaran" value="BNI" />
                              <label for="huey">Transfer Bank (BNI)</label>
                            </div>
                          
                            <div class="radiobtn">
                              <input type="radio" id="dewey"
                                     name="metode_pembayaran" value="Ovo" />
                              <label for="dewey">Ovo</label>
                            </div>
                          
                            <div class="radiobtn">
                              <input type="radio" id="louie"
                                     name="metode_pembayaran" value="QRIS" />
                              <label for="louie">QRIS</label>
                            </div>
                            <div class="radiobtn">
                              <input type="radio" id="alfa"
                                     name="metode_pembayaran" value="Alfamart" />
                              <label for="alfa">Alfamart</label>
                            </div>
                          </div>
                          <input type="hidden" name="input_ongkir" id="input_ongkir" value="0">
                          <input type="hidden" name="input_diskon" id="input_diskon" value="0">
                          <input type="hidden" name="biaya_tambahan" id="biaya_tambahan" value="0">
                          <input type="hidden" name="biaya_final" id="biaya_final" data-id="" value="">
                          <button type="submit" class="btn btn-success" id="btn-pesan">Pesan Sekarang</button>
                          {{-- <button type="submit" class="btn btn-success" onclick="return validasi_pembayaran();">Pesan Sekarang</button> --}}
                          {{-- @method(‘PUT’) --}}
                        </form>
                        @endif
                      <!-- /.row -->
                      <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>
            {{-- <div class="">
              test --}}
            <div class="col-md-5 kanan">
              {{-- <a href="/tshirt_produk" class="btn btn-secondary"><i class="fas fa-plus"></i>&nbsp;Tambah produk</a> --}}
                <div class="container-fluid">
                    <div class="row total" >
                      @foreach ($data_keranjang as $data_keranjang)
                        <div class="col-2">
                            
                            @if ($data_keranjang->jenis_produk_id == '1')
                            <img class="card-img img-fluid" src="{{ url('img/testing/katalog/T-shirt/'.$data_keranjang->gambar_list1) }}" alt="Card image cap" width="140%" height="100px">
                            @elseif ($data_keranjang->jenis_produk_id == '2')
                            <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Hoodie/'.$data_keranjang->gambar_list1) }}" alt="Card image cap" width="140%" height="100px">
                            @elseif ($data_keranjang->jenis_produk_id == '3')
                            <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Crewneck/'.$data_keranjang->gambar_list1) }}" alt="Card image cap" width="140%" height="100px">
                            @elseif ($data_keranjang->jenis_produk_id == '4' || '5')
                            <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Case/'.$data_keranjang->gambar_list1) }}" alt="Card image cap"  width="140%" height="100px">
                            @endif
                           
                        </div>
                        <div class="col-5">
                          {{ Str::limit($data_keranjang->nama_produk, 20) }}({{ $data_keranjang->nama_ukuran }})
                        </div>
                        <div class="col-2">
                          x{{ $data_keranjang->jumlah_produk_keranjang }}
                        </div>
                        <div class="col-3" id="harga-produk-div">@currency($data_keranjang->biaya_keranjang)</div>
                        @endforeach
                        {{-- <p>{{ $data_berat }}</p> --}}
                    </div>
                   @if ($status == 'belum_cekongkir')
                   <div class="row iko">
                    <div class="col-9">Biaya Produk</div>
                    <div class="col-3">@currency($biaya_total)</div>
                  </div>
                   @elseif($status =='cekongkir')
                   <div class="ikoiko">
                    <div class="row iko">
                      <div class="col-9">Biaya Produk</div>
                      <div class="col-3" id="biaya-produk-div"></div>
                      <input type="hidden" name="biaya-produk-input" value="{{ $biaya_total }}">
                    </div>
                    <div class="row iko">
                      <div class="col-9">Biaya Ongkir</div>
                      <div class="col-3" id="hasil_ongkir"></div>
                      
                    </div>
                    <div class="row iko" id="diskon"></div>
                    <div class="row iko" id="biaya_tambahan_div"></div>
                   </div>
                    <div class="row iko">
                        <div class="col-8">
                           <p class="fw-bold">TOTAL</p> 
                        </div>
                        <div class="col-4" id="hasil_total"></div>
                       
                        <input id="biaya_produk" type="hidden" value="{{ $biaya_total }}">
                    </div>
                  
                   @endif
                </div>
            {{-- </div> --}}
          </div>
        </div>
    </div>

    <div class="modal fade" id="modal_promo_checkout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <center><h4 class="modal-title">SPESIAL PROMO!!</h4></center>
          </div>
          <div class="modal-body">
            <img src="img/testing/promo.jpg" alt="" class="img-responsive" width="100%">
          </div>
          <div class="modal-footer">
            {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	 --}}
            <a href="/tshirt_produk" class="btn btn-danger btn-block">Klaim Promo</a>
          </div>
        </div>
      </div>
    </div>

</section>
@section('js')
    <script>
         $(document).ready(function(){
  
        $('select[name="provinsi_tujuan"]').on('change', function(){
            
            let provinceId = $(this).val();
            if(provinceId){
                
                $.ajax({
                    url: '/provinsi/'+provinceId+'/kota',
                    type:"GET",
                    dataType:"json",
                    
                    success:function(data){
                        // console.log('iso');    
                      $('select[name="kota_tujuan"]').empty();
                      $.each(data, function(key, value){
                        $('select[name="kota_tujuan"]').append('<option value="'+key+'">' +value+'</option>');
                      });
                    },
                });
            }else{
              $('select[name="kota_tujuan"]').empty();
            }
        });
  
    });
  
    $('#paket').on('change', function(){
    const price = parseInt($('#paket option:selected').val());
    const berat = parseInt($('[name=berat]').val());
    const produk = parseInt($('#biaya_produk').val());
    const biaya_produk_input = parseInt($('[name=biaya-produk-input]').val());
    const jumlah_pembelian = parseInt($('[name=jumlah_pembelian').val());
     
    //  const harga_produk_div = parseInt($('[name=harga-produk-input]').val());
     const formatRupiah = (money) => {
      return new Intl.NumberFormat('id-ID',
        {style:'currency',currency:'IDR', minimumFractionDigits: 0 }
      ).format(money);
    }
    
    if (berat <= '1000') {
      const n = 1;
      const total = price * n;
      var total2 =parseInt(total)  + produk;
      
    $('#input_ongkir').val(total);
   
    var hasil_ongkir = document.getElementById("hasil_ongkir");
    var biaya_produk = document.getElementById("biaya-produk-div");
    var hasil_total = document.getElementById("hasil_total");
    var diskon = document.getElementById("diskon");
    
    hasil_ongkir.innerHTML = formatRupiah(total); 
    biaya_produk.innerHTML = formatRupiah(biaya_produk_input); 

      if(jumlah_pembelian == '2'){
        // const nominal_diskon = produk * 0.1;
        var total2_diskon = parseInt(total2) - 15000;
        $('#biaya_final').val(total2_diskon);
        $('#input_diskon').val(15000);
        $("#biaya_final").attr('data-id',total2_diskon);

        diskon.innerHTML ="<div class='col-9'>Diskon&nbsp;<i class='fa fa-info-circle' type='button' data-toggle='modal' data-target='#modal_promo_checkout' aria-hidden='true'></i></div><div class='col-3'>-"+formatRupiah(15000)+"</div>";
        hasil_total.innerHTML = "<p class='fw-bold'>"+formatRupiah(total2_diskon)+"</p>";

      }
      else if(jumlah_pembelian >= '3'){
        var total2_diskon = parseInt(total2) - 20000;
        $('#biaya_final').val(total2_diskon);
        $('#input_diskon').val(20000);
        $("#biaya_final").attr('data-id',total2_diskon);

        diskon.innerHTML ="<div class='col-9'>Diskon&nbsp;<i class='fa fa-info-circle' type='button' data-toggle='modal' data-target='#modal_promo_checkout' aria-hidden='true'></i></div><div class='col-3'>-"+formatRupiah(20000)+"</div>";
        hasil_total.innerHTML = "<p class='fw-bold'>"+formatRupiah(total2_diskon)+"</p>";
      }
      else{
        $('#biaya_final').val(total2);
        $("#biaya_final").attr('data-id',total2);
        
        diskon.innerHTML ="<div class='col-9'>Diskon&nbsp;<i class='fa fa-info-circle' type='button' data-toggle='modal' data-target='#modal_promo_checkout' aria-hidden='true'></i></div><div class='col-3'>-"+formatRupiah(0)+"</div>"; 
        hasil_total.innerHTML = "<p class='fw-bold'>"+formatRupiah(total2)+"</p>";
      }
      
    }


    else if(berat > '1000' && berat <= '2000'){
      const n = 2;
      const total = price * n;
      var total2 =parseInt(total)  + produk;
 
    $('#input_ongkir').val(total);

    var hasil_ongkir = document.getElementById("hasil_ongkir");
    var biaya_produk = document.getElementById("biaya-produk-div");
    var hasil_total = document.getElementById("hasil_total");
    var diskon = document.getElementById("diskon");
    
    hasil_ongkir.innerHTML = formatRupiah(total); 
    biaya_produk.innerHTML = formatRupiah(biaya_produk_input); 

      if(jumlah_pembelian == '2'){
        var total2_diskon = parseInt(total2) - 15000;
        $('#biaya_final').val(total2_diskon);
        $('#input_diskon').val(15000);
        $("#biaya_final").attr('data-id',total2_diskon);

        diskon.innerHTML ="<div class='col-9'>Diskon&nbsp;<i class='fa fa-info-circle' type='button' data-toggle='modal' data-target='#modal_promo_checkout' aria-hidden='true'></i></div><div class='col-3'>-"+formatRupiah(15000)+"</div>";
        hasil_total.innerHTML = "<p class='fw-bold'>"+formatRupiah(total2_diskon)+"</p>";
      }
      else if(jumlah_pembelian >= '3'){
        var total2_diskon = parseInt(total2) - 20000;
        $('#biaya_final').val(total2_diskon);
        $('#input_diskon').val(20000);
        $("#biaya_final").attr('data-id',total2_diskon);

        diskon.innerHTML ="<div class='col-9'>Diskon&nbsp;<i class='fa fa-info-circle' type='button' data-toggle='modal' data-target='#modal_promo_checkout' aria-hidden='true'></i></div><div class='col-3'>-"+formatRupiah(20000)+"</div>";
        hasil_total.innerHTML = "<p class='fw-bold'>"+formatRupiah(total2_diskon)+"</p>";
      }
      else{
        $('#biaya_final').val(total2);
        $("#biaya_final").attr('data-id',total2);
        
        diskon.innerHTML ="<div class='col-9'>Diskon&nbsp;<i class='fa fa-info-circle' type='button' data-toggle='modal' data-target='#modal_promo_checkout' aria-hidden='true'></i></div><div class='col-3'>-"+formatRupiah(0)+"</div>"; 
        hasil_total.innerHTML = "<p class='fw-bold'>"+formatRupiah(total2)+"</p>";
      }
    }


    else if(berat > '2000' && berat <= '3000'){
      var n = 3;
      var total = price * n;
      var total2 =parseInt(total)  + produk;
 
      $('#input_ongkir').val(total);
   
      var hasil_ongkir = document.getElementById("hasil_ongkir");
      var biaya_produk = document.getElementById("biaya-produk-div");
      var hasil_total = document.getElementById("hasil_total");
      var diskon = document.getElementById("diskon");
      
      hasil_ongkir.innerHTML = formatRupiah(total); 
      biaya_produk.innerHTML = formatRupiah(biaya_produk_input); 

     if(jumlah_pembelian == '2'){
       var total2_diskon = parseInt(total2) - 15000;
       $('#biaya_final').val(total2_diskon);
       $('#input_diskon').val(15000);
       $("#biaya_final").attr('data-id',total2_diskon);

       diskon.innerHTML ="<div class='col-9'>Diskon&nbsp;<i class='fa fa-info-circle' type='button' data-toggle='modal' data-target='#modal_promo_checkout' aria-hidden='true'></i></div><div class='col-3'>-"+formatRupiah(15000)+"</div>";
       hasil_total.innerHTML = "<p class='fw-bold'>"+formatRupiah(total2_diskon)+"</p>";
     }
     else if(jumlah_pembelian >= '3'){
        var total2_diskon = parseInt(total2) - 20000;
        $('#biaya_final').val(total2_diskon);
        $('#input_diskon').val(20000);
        $("#biaya_final").attr('data-id',total2_diskon);

        diskon.innerHTML ="<div class='col-9'>Diskon&nbsp;<i class='fa fa-info-circle' type='button' data-toggle='modal' data-target='#modal_promo_checkout' aria-hidden='true'></i></div><div class='col-3'>-"+formatRupiah(20000)+"</div>";
        hasil_total.innerHTML = "<p class='fw-bold'>"+formatRupiah(total2_diskon)+"</p>";
      }
     else{
       $('#biaya_final').val(total2);
       $("#biaya_final").attr('data-id',total2);
       
       diskon.innerHTML ="<div class='col-9'>Diskon&nbsp;<i class='fa fa-info-circle' type='button' data-toggle='modal' data-target='#modal_promo_checkout' aria-hidden='true'></i></div><div class='col-3'>-"+formatRupiah(0)+"</div>"; 
       hasil_total.innerHTML = "<p class='fw-bold'>"+formatRupiah(total2)+"</p>";
     }
    }
    else if(berat > '3000' && berat <= '4000'){
      const n = 4;
      const total = price * n;
      var total2 =parseInt(total)  + produk;
 
      $('#input_ongkir').val(total);
   
      var hasil_ongkir = document.getElementById("hasil_ongkir");
      var biaya_produk = document.getElementById("biaya-produk-div");
      var hasil_total = document.getElementById("hasil_total");
      var diskon = document.getElementById("diskon");
      
      hasil_ongkir.innerHTML = formatRupiah(total); 
      biaya_produk.innerHTML = formatRupiah(biaya_produk_input); 

     if(jumlah_pembelian == '2'){
       var total2_diskon = parseInt(total2) - 15000;
       $('#biaya_final').val(total2_diskon);
       $('#input_diskon').val(15000);
       $("#biaya_final").attr('data-id',total2_diskon);

       diskon.innerHTML ="<div class='col-9'>Diskon&nbsp;<i class='fa fa-info-circle' type='button' data-toggle='modal' data-target='#modal_promo_checkout' aria-hidden='true'></i></div><div class='col-3'>-"+formatRupiah(15000)+"</div>";
       hasil_total.innerHTML = "<p class='fw-bold'>"+formatRupiah(total2_diskon)+"</p>";
     }
     else if(jumlah_pembelian >= '3'){
        var total2_diskon = parseInt(total2) - 20000;
        $('#biaya_final').val(total2_diskon);
        $('#input_diskon').val(20000);
        $("#biaya_final").attr('data-id',total2_diskon);

        diskon.innerHTML ="<div class='col-9'>Diskon&nbsp;<i class='fa fa-info-circle' type='button' data-toggle='modal' data-target='#modal_promo_checkout' aria-hidden='true'></i></div><div class='col-3'>-"+formatRupiah(20000)+"</div>";
        hasil_total.innerHTML = "<p class='fw-bold'>"+formatRupiah(total2_diskon)+"</p>";
      }
     else{
       $('#biaya_final').val(total2);
       $("#biaya_final").attr('data-id',total2);
       
       diskon.innerHTML ="<div class='col-9'>Diskon&nbsp;<i class='fa fa-info-circle' type='button' data-toggle='modal' data-target='#modal_promo_checkout' aria-hidden='true'></i></div><div class='col-3'>-"+formatRupiah(0)+"</div>"; 
       hasil_total.innerHTML = "<p class='fw-bold'>"+formatRupiah(total2)+"</p>";
     }
    }
  
    
  });

    </script>
    <script>
      $(document).ready(function(){
       $('input[name="metode_pembayaran"]').on('change', function(){
        const formatRupiah = (money) => {
      return new Intl.NumberFormat('id-ID',
        {style:'currency',currency:'IDR', minimumFractionDigits: 0 }
      ).format(money);
    }
          // let produk = $('input[name="produk_id"]').val();
      const bayar = document.querySelector('input[name=metode_pembayaran]:checked').value;
      const biaya_final = parseInt($('[name=biaya_final]').val());
      const biaya_final_awal = $("#biaya_final").attr('data-id');
      
      if (bayar == 'Alfamart') {
        // console.log(bayar);
        var biaya_tambahan = document.getElementById("biaya_tambahan_div");
        var hasil_total = document.getElementById("hasil_total");

        var nominal_tambahan = 4000;
        var total_tambahan = parseInt(nominal_tambahan+biaya_final);
      biaya_tambahan.innerHTML ="<div class='col-9'>Biaya tambahan</div><div class='col-3'>"+formatRupiah(nominal_tambahan)+"</div>"; 
      hasil_total.innerHTML= "<p class='fw-bold'>"+formatRupiah(total_tambahan)+"</p>";

      // [+4000]

      $('#biaya_final').val(total_tambahan);
      $('#biaya_tambahan').val(nominal_tambahan);

      }
      else {
      var hasil_total = document.getElementById("hasil_total");
      var biaya_tambahan = document.getElementById("biaya_tambahan_div");

      biaya_tambahan.innerHTML =""; 
      hasil_total.innerHTML= "<p class='fw-bold'>"+formatRupiah(biaya_final_awal)+"</p>";
      $('#biaya_final').val(biaya_final_awal);
      $('#biaya_tambahan').val(0);
      }
      
      });
    });
    </script>
     <script src="{{
      !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
      data-client-key="{{ config('services.midtrans.clientKey')
    }}"></script>
    <script>
      $("#tambah_checkout").submit(function(event) {
          event.preventDefault();
          var nama= $('input#nama').val()
          alert (nama)
          return false
          $.post("/bayar_midtrans", {
              _method: 'POST',
              _token: '{{ csrf_token() }}',
              // donor_name: $('input#donor_name').val(),
              // donor_email: $('input#donor_email').val(),
              // donation_type: $('select#donation_type').val(),
              // amount: $('input#amount').val(),
              // note: $('textarea#note').val(),
              nama: $('input#nama').val(),
              no_wa: $('no_wa').val(),
              alamat_tujuan: $('alamat_tujuan').val(),
              kota_tujuan: $('kota_tujuan').val(),
              provinsi_tujuan: $('provinsi_tujuan').val(),
              kode_pos: $('kode_pos').val(),
              data_kurir: $('data_kurir').val(),
              jumlah_pembelian: $('jumlah_pembelian').val(),
          },

          function (data, status) {
              alert(data)
              return false
              console.log(data);
              snap.pay(data.snap_token, {
                  // Optional
                  onSuccess: function (result) {
                      location.reload();
                  },
                  // Optional
                  onPending: function (result) {
                      location.reload();
                  },
                  // Optional
                  onError: function (result) {
                      location.reload();
                  }
              });
              return false;
          })
        })
  </script>
    
@endsection
@endsection
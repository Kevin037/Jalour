@extends('main')
@section('judul')
<title>JALOUR | Home</title>
@endsection
@section('isi')  
    <section class="banner">
          <div class="owl-carousel banner_hero owl-theme owl-non-dots" >
               <div class="item" id="banner-1" style="margin-top: -1%"><h4>
                </h4></div>
               <div class="item" id="banner-2">
                 <div class="container-fluid">
                   <div class="row">
                     <div class="col-sm-12 text-center">
                       <form action="/tshirt_produk" method="GET">
                      <button type="submit" class="button_banner"><span>Selengkapnya</span></button>
                    </form>
                     </div>
                   </div>
                 </div>
                </div>
    </div>
    </section>
     <section>
        <div id="edu-2">
          <center>
            <img id="bag21" src="img/testing/headal.jpg" width="350px" style="margin-bottom: 3%">
            <!--<center><h2>PENTINGNYA MERCHANT IT UNTUK KAMU?</h2></center><br>-->
        <div class="row container-fluid" style="margin-bottom:2%">
            <div class="col-md-4">
                <img id="bag21" src="img/testing/al1.jpg" width="35%">
                <img id="bag211" src="img/testing/capt1.jpg" width="70%">
            </div>
            <div class="col-md-4">
                <img id="bag22" src="img/testing/al2.jpg" width="35%">
                <img id="bag222" src="img/testing/capt2.jpg" width="70%">
            </div>
            <div class="col-md-4">
                <img id="bag23" src="img/testing/al3.jpg" width="35%">
                <img id="bag233" src="img/testing/capt3.jpg" width="70%">
            </div>
        </div>
            
       
    </center>
        </div>
    </section>
  <div class="col-12 mb-3">
    <div class="w-100 my-3 border-top border-grey"></div>
</div>
    <section class="produk_terlaris">
        <div class="container-fluid" style="padding: 0 5% 0 5%">
            <center><h2>PILIH OUTFIT FAVORITMU</h2></center><br>
            <div class="owl-carousel produk-terlaris owl-theme owl-non-dots row">
              @foreach ($produk_terlaris as $produk) 
              <div class="listproduk">
                
                <div class="item col-md-10 per-produk">
                  @if ($produk->diskon != null)
                  <p class="diskon-terlaris">-{{ $produk->diskon }}%</p>
                  @elseif ($produk->diskon == null)
                  <p class="no_diskon" style="color: white"></p>
                  @endif

                  <div class="part-terlaris">
                    <div class="item_produk">
                        @if ($produk->jenis_produk_id == '1')
                        <a href="/item_tshirt{{ $produk->id_produk }}">
                        <div class="overlay-produk">
                        <img src="{{ url('img/testing/katalog/T-shirt/'.$produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="100%">
                        <img class="gambar2" src="{{ url('img/testing/katalog/T-shirt/'.$produk->gambar_list2) }}" alt="" width="100%">
                        @elseif ($produk->jenis_produk_id == '2')
                        <a href="/item_hoodie{{ $produk->id_produk }}">
                        <div class="overlay-produk">
                        <img src="{{ url('img/testing/katalog/Hoodie/'.$produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="100%">
                        <img class="gambar2" src="{{ url('img/testing/katalog/Hoodie/'.$produk->gambar_list2) }}" alt="" width="100%">
                        @elseif ($produk->jenis_produk_id == '3')
                        <a href="/item_crewneck{{ $produk->id_produk }}">
                        <div class="overlay-produk">
                        <img src="{{ url('img/testing/katalog/Crewneck/'.$produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="100%">
                        <img class="gambar2" src="{{ url('img/testing/katalog/Crewneck/'.$produk->gambar_list2) }}" alt="" width="100%">
                        @elseif ($produk->jenis_produk_id == '4' || '5')
                        <a href="/item_case{{ $produk->id_produk }}">
                        <div class="overlay-produk">
                        <img src="{{ url('img/testing/katalog/Case/'.$produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="100%">
                        <img class="gambar2" src="{{ url('img/testing/katalog/Case/'.$produk->gambar_list2) }}" alt="" width="100%">
                        @endif
                      </div>
                      </a>
                    </div>
                    <p class="capt-jenis">{{ $produk->nama_jenis }}</p>
                    <a href="/item_tshirt{{ $produk->id_produk }}" class="card teks" ><h6>{{ $produk->nama_produk }}</h6></a>
                    <div style="margin-top: 5px;display:flex;flex-direction:row">
                      <div class="row">
                      @if ($produk->harga_produk1!=null)
                      {{-- <div class="col-md-5 col-12">
                        <p class="small" style="text-decoration: line-through rgb(173, 173, 173);color:rgb(173, 173, 173);font-style:italic;font-size:5px;"> @currency($produk->harga_produk1)</p>
                      </div>
                      <div class="col-md-7 col-12">
                        <b><p style="margin-left:10px;color:rgb(20, 20, 20)">@currency($produk->harga_produk2)</p></b>
                      </div> --}}
                      <div class="col-3">
                        <p class="small" style="text-decoration: line-through rgb(173, 173, 173);color:rgb(173, 173, 173);font-style:italic;font-size:5px;"> @currency_k($produk->harga_produk1)</p>
                      </div>
                      <div class="col-9">
                        <h5 class="" style="margin-left:10px;color:rgb(20, 20, 20)">@currency_k($produk->harga_produk2)</h5>
                      </div>
                      @else
                      {{-- <div class="col-md-5 col-12">
                        <b><p style="margin-left:10px;color:rgb(20, 20, 20)">@currency($produk->harga_produk2)</p></b>
                      </div> --}}
                      <div class="col-4">
                        <b><p style="margin-left:10px;color:rgb(20, 20, 20)">@currency_k($produk->harga_produk2)</p></b>
                      </div>
                      @endif
                    </div>  
                    </div>
                  </div>
               </div>
              </div>
                 @endforeach
            </div>
        </div>
    </section>
    <div class="col-12 mb-3">
    <div class="w-100 my-3 border-top border-grey"></div>
</div>
    <section>
      <div class="container-fluid" id="catatan">
          <div class="row">
              <div class="col-lg-7  text-center"><img id="itkiri" src="img/testing/itkiri.jpg" width="90%"></div>
            <div class="col-lg-5  text-center capt-edu-2"><img src="img/testing/itkanan.jpg" width="80%" style="margin-top:15%"></div>
      </div>
      </div>
  </section>
    <div class="col-12 mb-3">
        <div class="w-100 my-3 border-top border-grey"></div>
    </div>
    <section>
        
    <div class="container-fluid">
        
    <section class="pilihan_produk">
        <div class="row text-center">
            <div class="col-md-4" >
                <section id="pilihan_tshirt">
                    <h2 class="capt_pilihan"> T-SHIRT</h2>
                    <form action="/tshirt_produk" method="GET">
                        @csrf
                    <button class="button_jenis"><span>Klik disini</span></button>
                </form>
              </section>
            </div>
            <div class="col-md-4">
                <section id="pilihan_hoodie">
                    <h2 class="capt_pilihan">HOODIE</h2>
                    <form action="/hoodie_produk" method="GET">
                        @csrf
                    <button class="button_jenis">Klik disini</button></section>
                    </form>
            </div>
            <div class="col-md-4">
                <section id="pilihan_crewneck">
                    <h2 class="capt_pilihan">CREWNECK</h2>
                    <form action="/crewneck_produk" method="GET">
                        @csrf
                    <button class="button_jenis">Klik disini</button></section>
                </form>
            </div>
        </div>
    </section>
    <section class="pilihan_produk-m">
      <div class="container-fluid" style="padding: 0 0% 0 0%">
          <div class="owl-carousel produk owl-theme owl-dots-dots text-center">
               <div class="item">
                <section id="pilihan_tshirt-m">
                  <h2 class="capt_pilihan">T-SHIRT</h2>
                  <form action="/tshirt_produk" method="GET">
                      @csrf
                  <button class="button_jenis"><span>Klik disini</span></button>
              </form>
            </section>
               </div>
               <div class="item">
                <section id="pilihan_hoodie-m">
                  <h2 class="capt_pilihan">HOODIE</h2>
                  <form action="/tshirt_produk" method="GET">
                      @csrf
                  <button class="button_jenis"><span>Klik disini</span></button>
              </form>
            </section>
               </div>
               <div class="item">
                <section id="pilihan_crewneck-m">
                  <h2 class="capt_pilihan">CREWNECK</h2>
                  <form action="/tshirt_produk" method="GET">
                      @csrf
                  <button class="button_jenis"><span>Klik disini</span></button>
              </form>
            </section>
               </div>
          </div>
      </div>
  </section>
</div>
</section>
<section id="demos" class="section-testimoni" style="padding: 0 5% 0 5%">
  <center><H2>TESTIMONI</H2></center>
    <div class="row">
      <div class="large-12 columns">
        <div class="owl-carousel testi owl-theme owl-non-dots">
          @foreach ($testi as $testi)
          <div class="item card-testi item-testi">
            <div class="row">
              <div class="col-7 capt-testi">
               <h6>{{ $testi->customer }}&nbsp;({{ $testi->asal_cust }}).<br></h6>
                <h5>{{ $testi->testi }}<br></h5>
              </div>
              <div class="col-5 text-center gambar-testi" >
                @if ($testi->gambar == null)
                <i style="border-radius: 50%" class="fa fa-user" aria-hidden="true"></i>
                @else
                  <img style="border-radius: 50%" src="{{url('img/testing/testi/'.$testi->gambar) }}" alt="">
                
                    
                @endif
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endsection
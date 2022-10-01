@extends('main')
@section('judul')
@foreach ($data as $data)
    @if ($jenis_produk == '1')
      <title>JALOUR | Detail Produk T-shirt</title>
    @elseif ($jenis_produk == '2')
      <title>JALOUR | Detail Produk Hoodie</title>
    @elseif ($jenis_produk == '3')
      <title>JALOUR | Detail Produk Crewneck</title>
    @elseif ($jenis_produk == '4' || '5')
      <title>JALOUR | Detail Produk Case</title>
    @endif
    
@endsection
@section('isi')

<section style="margin-bottom: 5%">
  <center><div class="btn-promo text-center" type="button" data-toggle="modal" data-target="#modal_promo">
    <p class="teks-promo"><i class='fas fa-bullhorn'></i>&nbsp;Spesial cashback Hingga 20k, KLIK DISINI !!</p>
  </div></center>
  <div class="container-fluid" >
    <div class="row">
        <div class="col-lg-6 col-12 pokok-gambar">
          {{-- <div class="container-fluid"> --}}
            <div class="row">
              <div class="col-lg-4 col-md-4 col-12 gambar-atas">
                {{-- <div class="container-fluid"> --}}
                  <div class="row">
                    <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                        <!--Start Slides-->
                        <div class="carousel-inner product-links-wap" role="listbox">
                            <!--First slide-->

                            {{-- <div class="container-fluid"> --}}
                              {{-- PILIHAN GAMBAR DINAMIS --}}
                            @if ($jenis_produk == '1')
                            <div class="carousel-item active">
                              <div class="row pilihan_gambar">
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/T-shirt/'.$data->gambar_produk) }}" alt="Product Image 1">
                                      </a>
                                  </div>
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/T-shirt/'.$data->gambar_produk2) }}" alt="Product Image 2">
                                      </a>
                                  </div>
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/T-shirt/'.$data->gambar_produk3) }}" alt="Product Image 3">
                                      </a>
                                  </div>
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/T-shirt/'.$data->gambar_produk4) }}" alt="Product Image 3">
                                      </a>
                                  </div>
                              </div>
                          </div>
                          @elseif ($jenis_produk == '2')
                            <div class="carousel-item active">
                              <div class="row pilihan_gambar">
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Hoodie/'.$data->gambar_produk) }}" alt="Product Image 1">
                                      </a>
                                  </div>
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Hoodie/'.$data->gambar_produk2) }}" alt="Product Image 2">
                                      </a>
                                  </div>
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Hoodie/'.$data->gambar_produk3) }}" alt="Product Image 3">
                                      </a>
                                  </div>
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Hoodie/'.$data->gambar_produk4) }}" alt="Product Image 3">
                                      </a>
                                  </div>
                              </div>
                          </div>
                          @elseif ($jenis_produk == '3')
                            <div class="carousel-item active">
                              <div class="row pilihan_gambar">
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Crewneck/'.$data->gambar_produk) }}" alt="Product Image 1">
                                      </a>
                                  </div>
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Crewneck/'.$data->gambar_produk2) }}" alt="Product Image 2">
                                      </a>
                                  </div>
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Crewneck/'.$data->gambar_produk3) }}" alt="Product Image 3">
                                      </a>
                                  </div>
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Crewneck/'.$data->gambar_produk4) }}" alt="Product Image 3">
                                      </a>
                                  </div>
                              </div>
                          </div>
                          @elseif ($jenis_produk == '4' || '5')
                            <div class="carousel-item active">
                              <div class="row pilihan_gambar">
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Case/'.$data->gambar_produk) }}" alt="Product Image 1">
                                      </a>
                                  </div>
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Case/'.$data->gambar_produk2) }}" alt="Product Image 2">
                                      </a>
                                  </div>
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Case/'.$data->gambar_produk3) }}" alt="Product Image 3">
                                      </a>
                                  </div>
                                  <div class="col-3 pilih_gambar">
                                      <a href="#">
                                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Case/'.$data->gambar_produk4) }}" alt="Product Image 3">
                                      </a>
                                  </div>
                              </div>
                          </div>
                          @endif
                          {{-- PILIHAN GAMBAR DINAMIS --}}
                            {{-- </div> --}}

                            <!--/.Third slide-->
                        </div>
                        <!--End Slides-->
                    </div>
                </div>
                {{-- </div> --}}
                  
              </div>
              <div class="col-lg-8 col-md-8 col-12 gambar-bawah" style="margin-top: 7%">
                  <div class="card mb-3 gambar-gedi">
                      {{-- <figure class="card mb-3 zoom" style="background-image: url(img/testing/1.jpg);" onmousemove="zoom(event)"> --}}
                        @if ($jenis_produk == '1')
                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/T-shirt/'.$data->gambar_produk) }}" alt="Card image cap" id="product-detail" width="140%" height="100px">
                        @elseif ($jenis_produk == '2')
                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Hoodie/'.$data->gambar_produk) }}" alt="Card image cap" id="product-detail" width="140%" height="100px">
                        @elseif ($jenis_produk == '3')
                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Crewneck/'.$data->gambar_produk) }}" alt="Card image cap" id="product-detail" width="140%" height="100px">
                        @elseif ($jenis_produk == '4' || '5')
                          <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Case/'.$data->gambar_produk) }}" alt="Card image cap" id="product-detail" width="140%" height="100px">
                        @endif
                      {{-- </figure> --}}
                      
                  </div>
                  <img src="img/testing/garansi.png" alt="" class="garansi">
              </div>
          </div>
          {{-- </div> --}}
            
        </div>


        
        <div class="col-lg-6 col-12 keterangan">
            <div class="head-cap-produk">
            <h3>{{ $data->nama_jenis }}&nbsp;{{ $data->nama_produk }}</h3>
              <div class="row">
                <div class="col-3">
                  @if ($data->harga_produk1 == null || '0')
                    <h2 class="fw-bold" style="margin-top: 2%">@currency_k($data->harga_produk2)</h2>
                    {{-- <h4 class="fw-bold">@currency($data->harga_produk2)</h4> --}}
                  @else
                    <h6 style="text-decoration: line-through rgb(117, 117, 117);color:rgb(117, 117, 117);font-style:italic;">@currency_k($data->harga_produk1)</h6>
                    {{-- <h6 style="text-decoration: line-through rgb(117, 117, 117);color:rgb(117, 117, 117);font-style:italic;">@currency($data->harga_produk1)</h6> --}}
                      <h2 class="fw-bold" style="margin-left:5%">@currency_k($data->harga_produk2)</h2>
                    {{-- <h3>@currency($data->harga_produk2)</h3> --}}
                  @endif
                </div>
                <div class="col-9">
                  @if ($data->diskon != null)
                  <p class="diskon-detail">-{{ $data->diskon }}%</p>
                  @elseif ($data->diskon == null)
                  <p class="no_diskon" style="color: white"></p>
                  @endif
                </div>
              </div>

            </div>
            <div class="btn-produk">
                <div id="ukuran">
                  <form action="/tambah_keranjang" method="POST" name="form_keranjang" class="form cf" enctype="multipart/form-data">
                     @csrf
                        @if($jenis_produk == '4')
                          <div class="row">
                            <div class="col-md-5">
                              <input type="hidden" name="ukuran_id" id="s" value="1">
                            </div>
                          </div>
                        @elseif($jenis_produk == '5')
                              <input type="hidden" name="ukuran_id" id="s" value="1">
                        @elseif($jenis_produk == '1')
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Sizechart
                         </button>
                         
                        <section class="plan cf">
                          <input type="radio" name="ukuran_id" id="s" value="1"><label class="free-label four col" for="s">S</label>
                          <input type="radio" name="ukuran_id" id="m" value="2"><label class="basic-label four col kiri" for="m">M</label>
                          <input type="radio" name="ukuran_id" id="l" value="3"><label class="premium-label four col kiri" for="l">L</label>
                          <input type="radio" name="ukuran_id" id="xl" value="4"><label class="free-label four col kiri" for="xl">XL</label>
                          <input type="radio" name="ukuran_id" id="xxl" value="5"><label class="basic-label four col kiri" for="xxl">XXL</label>
                          <input type="radio" name="ukuran_id" id="xxxl" value="6"><label class="premium-label four col kiri" for="xxxl">XXXL</label>
                          <input type="radio" name="ukuran_id" id="xxxxl" value="7"><label class="premium-label four col kiri" for="xxxxl">XXXXL</label>
                        </section> 
                        @elseif($jenis_produk == '2' ||'3')
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Sizechart
                         </button>
                         
                        <section class="plan cf">
                          <input type="radio" name="ukuran_id" id="s" value="1"><label class="free-label four col" for="s">S</label>
                          <input type="radio" name="ukuran_id" id="m" value="2"><label class="basic-label four col kiri" for="m">M</label>
                          <input type="radio" name="ukuran_id" id="l" value="3"><label class="premium-label four col kiri" for="l">L</label>
                          <input type="radio" name="ukuran_id" id="xl" value="4"><label class="free-label four col kiri" for="xl">XL</label>
                          <input type="radio" name="ukuran_id" id="xxl" value="5"><label class="basic-label four col kiri" for="xxl">XXL</label>
                        </section> 
                        @endif
                        
                        {{-- <div class="container-fluid"> --}}
                            <div class="container-fluid">
                              <div class="row jumlah">
                                <div class="col-3">
                                      <input type="hidden" value="{{ $data->id_produk }}" id="kode_produk_request" name="produk_id" class="quantity-field" readonly>
                                      <input type="hidden" value="{{ $data->nama_produk }}" id="nama_produk_request">
                                      <input type="hidden" value="{{ $data->harga_produk2 }}" name="harga_produk" class="quantity-field" readonly>
                                      <input type="hidden" value="{{ $data->hpp }}" name="hpp" class="quantity-field" readonly>
                                      <input type="hidden" value="{{ $data->berat_produk }}" name="berat_produk" class="quantity-field" readonly>
                                      <input type="hidden" value="{{ $data->jenis_produk_id }}" name="jenis_produk" class="quantity-field" readonly>

                                      <div class="quantity buttons_added">
                                        <input type="button" value="-" class="minus" />
                                            <input type="number" step="1" min="1" max="30" name="jumlah_produk_keranjang" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="" readonly/>
                                        <input type="button" value="+" class="plus" />
                                    </div>
                                </div>  
                                        @if ($jenis_produk == '4')
                                        <div class="col-9 container-fluid" >
                                          <div class="container-fluid">
                                            <div class="row">
                                          <div class="col-md-6"><input type="text" class="form-control" name="tipe_hp" placeholder="(Masukkan tipe hp..)"></div>
                                        @elseif($jenis_produk == '5')
                                        <div class="col-9 container-fluid" >
                                          <div class="container-fluid">
                                            <div class="row">
                                          <div class="col-md-6"><input type="text" class="form-control" name="tipe_hp" placeholder="(Masukkan tipe hp..)"></div>
                                        @elseif($jenis_produk != '4' || '5')
                                        <div class="col-9 stok container-fluid" >
                                          <div class="container-fluid">
                                            <div class="row">
                                            <div class="col-7">Stok bahan:
                                            </div>
                                        <div class="col-5"><p id="tampilan_stok">0</p></div>
                                        @endif
                                    </div>         
                                  </div>                           
                                </div>
                            </div>
                            </div>
                        {{-- </div> --}}
                        {{-- <input type="text" id="tampilan_stok" name="tampil_stok"> --}}
                        
                        <div class="">
                          <div class="col-md-12" style="margin-bottom: 5%">
                              @if ($jenis_produk == '4')
                              <button for="check" class="submit tkk" type="submit"><i class="fa fa-shopping-cart" style="padding-left: -5%">&nbsp;</i>TAMBAH KE KERANJANG</button>
                            </form>
                                <button type="button" class="info" data-toggle="modal" data-target="#stok_case"><i class="fab fa-whatsapp" style="padding-left: -5%">&nbsp;</i>TANYAKAN STOK</button>
                                
                              @elseif ($jenis_produk == '5')
                              <button  class="submit tkk" type="submit"><i class="fa fa-shopping-cart" style="padding-left: -5%">&nbsp;</i>TAMBAH KE KERANJANG</button>
                            </form>
                                <button type="button" class="info" data-toggle="modal" data-target="#stok_case"><i class="fab fa-whatsapp" style="padding-left: -5%">&nbsp;</i>TANYAKAN STOK</button>
                                
                              @elseif ($jenis_produk != '4' || '5')
                                <center><button for="check" class="submit  col-12 text-center tkk" type="submit" onclick="return validasi_ukuran();"><i class="fa fa-shopping-cart">&nbsp;</i>TAMBAH KE KERANJANG</button></center>
                              </form>
                              <form action="#">
                                <button class="info tkk request col-12 text-center"><i class="fab fa-whatsapp">&nbsp;</i>REQUEST CUSTOM</button>
                              </form>
                                
                           @endif
                          </div>
                      </div>
                </div>
            </div>
           </div>
        </div>

    </div>

    <div class="tab info_produk">
      <button class="tablinks" onclick="openCity(event, 'London')"><i class="fa-solid fa-down-to-line"></i>&nbsp;Informasi Produk</button>
      <button class="tablinks" onclick="openCity(event, 'Paris')"><i class="fa-solid fa-circle-arrow-right"></i>&nbsp;Spesifikasi Khusus</button>
    </div> 
    
    <div id="London" class="tabcontent">
      <table style="width:100%">
        <tr>
          <th>Jenis Produk</th>
          <td>{{ $data->nama_jenis }}</td>
        </tr>
        <tr>
          <th>Kategori Produk</th>
          <td>{{ $data->nama_kategori }}</td>
        </tr>
        <tr>
          <th>Berat</th>
          <td>{{ $data->berat_produk }}gr</td>
        </tr>
        <tr>
          <th>Bahan</th>
          <td>{{ $data->bahan_jenis }}</td>
        </tr>
        
        @if($jenis_produk == '4')

        @elseif($jenis_produk == '5')
        
        @elseif($jenis_produk != '4' || '5')
          <tr>
            <th>Sablon</th>
            <td>{{ $data->nama_sablon }}</td>
          </tr>
          @endif
          
        
      </table>
    </div>
    
    <div id="Paris" class="tabcontent">
      @if($jenis_produk == '4')
        <h5>Spesifikasi Bahan Case</h5>
        <div class="col-12 mb-3">
          <div class="w-100 my-3 border-top border-dark-grey"></div>
      </div>
        <p>{{ $data->spek_bahan }}</p><br>
      @elseif($jenis_produk == '5')
        <h5>Spesifikasi Bahan Case</h5>              
        <div class="col-12 mb-3">
          <div class="w-100 my-3 border-top border-dark-grey"></div>
      </div>
        <p>{{ $data->spek_bahan }}</p><br>
      @elseif($jenis_produk != '4' || '5')
        <h5>Spesifikasi Bahan kain</h5>
      <div class="col-12 mb-3">
        <div class="w-100 my-3 border-top border-dark-grey"></div>
    </div>
      <p>{{ $data->spek_bahan }}</p><br>
      @endif

      @if($jenis_produk == '4')

      @elseif($jenis_produk == '5')
                        
      @elseif($jenis_produk != '4' || '5')
    <h5>Spesifikasi Sablon</h5>
    <div class="col-12 mb-3">
      <div class="w-100 my-3 border-top border-grey"></div>
  </div>
  <p>{{ $data->keterangan_sablon }}</p>
    @endif
      
    </div>
    
    <section id="demos" class="section-testi" style="padding: 0 10% 0 10%">
    @if (isset($testi))
        <div class="nav nav-tabs">
          <div class="nav-item">
            <a class="nav-link active fw-bold" role="tab" data-bs-toggle="tab" href="#ulasan">Ulasan ({{ $jumlah_testi }})</a>
          </div>
        </div>
        <div class="tab-content">
            <ul  class="tab-pane active" id="ulasan" style="margin:2%">
              @foreach ($testi as $testi)
              <li class="item-testi" style="border-bottom:1px solid rgb(197, 197, 197)">
                <div style="margin-bottom: 1%">
                  <h6 class="fw-bold">{{ $testi->customer }}&nbsp;({{ $testi->asal_cust }}).<br></h6>
                  <div class="row">
                    <div class="col-md-7">
                      <p>{{ $testi->testi }}</p>
                    </div>
                    <div class="col-md-5">
                      @if ($testi->gambar == null)
                        
                      @else
                        <img style="border-radius: 5%" src="{{url('img/testing/testi/'.$testi->gambar) }}" width="15%" alt="">
                      @endif</div>
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
        </div>
    {{-- @else
          <div class="row">
            <div class="large-12 columns">
              <div class="owl-carousel testi owl-theme owl-non-dots">
                @foreach ($testi_all as $testi_all)
                <div class="item card-testi item-testi">
                    <div class="row">
                      <div class="col-7 capt-testi">
                       <h6>{{ $testi_all->customer }}&nbsp;({{ $testi_all->asal_cust }}).<br></h6>
                        <h5>{{ $testi_all->testi }}<br></h5>
                      </div>
                      <div class="col-5 text-center gambar-testi" >
                        @if ($testi_all->gambar == null)
                        <i style="border-radius: 50%" class="fa fa-user" aria-hidden="true"></i>
                        @else
                          <img style="border-radius: 50%" src="{{url('img/testing/testi/'.$testi_all->gambar) }}" alt="">
                          @endif
                      </div>
                    </div>
                </div>
                @endforeach
              </div>
            </div>
          </div> --}}
    @endif
    </section>

    {{-- POPUP SIZECHART --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
                <center>	
                  @if ($jenis_produk == '1')
                  <img src="img/testing/sizekaos.jpg" alt="" class="img-responsive" width="100%">
                  @elseif ($jenis_produk == '2')
                  <img src="img/testing/sizehoodie.jpg" alt="" class="img-responsive" width="100%">
                  @elseif ($jenis_produk == '3')
                  <img src="img/testing/sizecrewneck.jpg" alt="" class="img-responsive" width="100%">
                  @endif
                  
              </center>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
            </div>
          </div>
        </div>
      </div>
      {{-- POPUP SIZECHART --}}

{{-- MODAL PROMO --}}
      <div class="modal fade" id="modal_promo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <center><h4 class="modal-title">SPESIAL PROMO!!</h4></center>
            </div>
            <div class="modal-body">
              <img src="img/testing/promo.jpg" alt="" class="img-responsive" width="100%">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
            </div>
          </div>
        </div>
      </div>
      {{-- MODAL PROMO --}}

      {{-- MODAL FORM WA --}}
      <div class="modal fade" id="stok_case" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                      <input type="text" class="form-control" name="nama_produk_tanya" value="{{ $data->nama_produk }}" id="nama_produk_tanya" readonly>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Tipe HP</label>
                      <input type="text" class="form-control" name="tipe_case_tanya" id="tipe_case_tanya" placeholder="Masukkan tipe hp anda..">
                    </div>
                    <button class="btn btn-success tanyastok"><i class="fab fa-whatsapp">&nbsp;</i>Tanyakan Stok</button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
            </div>
          </div>
        </div>
      </div>
      {{-- MODAL FORM WA --}}
</section>
    
    <script>
      

    </script>
    @endforeach
    
@endsection

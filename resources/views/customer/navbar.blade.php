
<input type="checkbox" id="check">
    
<div class="sidebar-keranjang">
    <header>
    <label for="check"><i class="fas fa-times" id="cancel"></i></label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keranjang 
    </header>
    @if ($id_user == '0')
     <div style="margin-left: 10px;" class="belum-login">
      <h5>Anda belum <b><a style="text-decoration:none" href="/login">Masuk</a></b>, silakan <a style="text-decoration:none" href="/login">Masuk</a>&nbsp;untuk melihat daftar keranjang anda.</h5> 
     </div>
    @elseif($id_user > '0')
    <ul>
      @foreach ($data_keranjang as $data_keranjang)
      <li>
        <div class="row">
          <div class="col-3"><a href="/item_tshirt{{ $data_keranjang->produk_id }}">
            @if ($data_keranjang->jenis_produk_id == '1')
            <img class="card-img img-fluid" src="{{ url('img/testing/katalog/T-shirt/'.$data_keranjang->gambar_list1) }}" alt="Card image cap" width="140%" height="100px">
            @elseif ($data_keranjang->jenis_produk_id == '2')
            <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Hoodie/'.$data_keranjang->gambar_list1) }}" alt="Card image cap" width="140%" height="100px">
            @elseif ($data_keranjang->jenis_produk_id == '3')
            <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Crewneck/'.$data_keranjang->gambar_list1) }}" alt="Card image cap" width="140%" height="100px">
            @elseif ($data_keranjang->jenis_produk_id == '4' || '5')
            <img class="card-img img-fluid" src="{{ url('img/testing/katalog/Case/'.$data_keranjang->gambar_list1) }}" alt="Card image cap"  width="140%" height="100px">
            @endif
          </a>
          </div>
          <div class="col-6">
            <p>{{ $data_keranjang->nama_jenis }}
            {{ Str::limit($data_keranjang->nama_produk, 15) }}
            ({{ $data_keranjang->nama_ukuran }})
            &nbsp;&nbsp;&nbsp;x{{ $data_keranjang->jumlah_produk_keranjang }}</p>
            <h6>@currency_k($data_keranjang->harga_produk2)</h6>
            
          </div>
          <div class="col-3">
            <a href="#" for="check" data-id="{{ $data_keranjang->id_keranjang }}" data-jenis="{{ $data_keranjang->nama_jenis }}" data-gambar="{{ $data_keranjang->gambar_list1 }}" class="hapus_keranjang"><i class="fa fa-trash" aria-hidden="true"></i></a>
          </div>  
        </div>
      </li>
      @endforeach
      @if ($total_biaya == null)
      <p>Keranjang anda masih kosong, silakan pilih produk favoritmu..</p>
      @elseif($total_biaya != null)
      <div class="row">
        <div class="col-md-3">TOTAL&nbsp;:</div>
        <div class="col-md-9">@currency_k($total_biaya)</div>
      </div>
      <form action="/checkout" name="form-checkout" method="GET">
        @csrf
        <input type="hidden" name="biaya_total" value="{{ $total_biaya}}">
      <button class="submit tkk" width=100% style="margin-bottom: 25%" >Checkout</button>
    </form>
      @endif
    </ul>
    @endif
</div>

 {{-- SIDEBAR-FILTER-MOB --}}
 <input type="checkbox" id="check-filter">

 <div class="sidebar-filter-mob">
  <header>FILTER
  <label for="check-filter" style="float: right">
    <label for="check-filter"><i class="fas fa-times" id="cancel-filter"></i></label>
  </label>
  <hr class="solid">
  </header>
  <a class="dropdown-btn model-btn" id="model-btn-mob">KATEGORI MODEL
    <span class="fa fa-caret-down model-rotate"></span>
  </a>


  {{-- SIDEBAR PRODUK DINAMIS --}}
  @if ($jenis_produk=='1')
    <div class="dropdown-container model-container" id="model-show-mob">
      <a href="/tshirt_code">Script Code Programming</a>
      <a href="/tshirt_tipografi">Tipografi</a>
      <a href="/tshirt_streetwear">Streetwear</a>
    </div>
  @elseif($jenis_produk=='2')
  <div class="dropdown-container model-container" id="model-show-mob">
    <a href="/hoodie_code">Script Code Programming</a>
    <a href="/hoodie_tipografi">Tipografi</a>
    <a href="/hoodie_ikonik">Ikonik</a>
  </div>
  @elseif($jenis_produk=='3')
  <div class="dropdown-container model-container" id="model-show-mob">
    <a href="/crewneck_code">Script Code Programming</a>
    <a href="/crewneck_tipografi">Tipografi</a>
    <a href="/crewneck_ikonik">Ikonik</a>
  </div>
  @elseif($jenis_produk=='4'||'5')
  <div class="dropdown-container model-container" id="model-show-mob">
    <a href="/case_hard">Hardcase</a>
    <a href="/case_soft">Softcase</a>
  </div>
  @else
  <div class="dropdown-container model-container" id="model-show-mob">
    <a href="/case_hard">Hardcase</a>
    <a href="/case_soft">Softcase</a>
  </div>
  @endif
{{-- SIDEBAR PRODUK DINAMIS --}}


  <hr class="solid">
  <br><p>HARGA</p>
  <div class="slider">
    <div class="wrapperm">
      <div class="valuesm">
        Rp<span id="range1m">
          0
        </span>
        <span> &dash;</span>
        Rp<span id="range2m">100</span>
      </div>
      <div class="containerm">
        <div class="slider-trackm"></div>
         @if ($jenis_produk=='1')
              @if ($kategori=='1')
                <form method="get" action="/tshirt_code">
              @elseif ($kategori=='2')
                <form method="get" action="/tshirt_tipografi">
              @elseif ($kategori=='3')
                <form method="get" action="/tshirt_streetwear">
              @else
              <form method="get" action="/tshirt_produk">
              @endif
        @elseif($jenis_produk=='2')
              @if ($kategori=='1')
                <form method="get" action="/hoodie_code">
              @elseif ($kategori=='2')
                <form method="get" action="/hoodie_tipografi">
              @elseif ($kategori=='3')
                <form method="get" action="/hoodie_ikonik">
              @endif
              <form method="get" action="/hoodie_produk">
        @elseif($jenis_produk=='3')
              @if ($kategori=='1')
                <form method="get" action="/crewneck_code">
              @elseif ($kategori=='2')
                <form method="get" action="/crewneck_tipografi">
              @elseif ($kategori=='3')
                <form method="get" action="/crewneck_ikonik">
              @endif
              <form method="get" action="/crewneck_produk">
        @elseif($jenis_produk=='4'||'5')
              @if ($jenis_produk=='4')
                <form method="get" action="/case_hard">
              @elseif ($jenis_produk=='5')
                <form method="get" action="/case_soft">
              @elseif ($jenis_produk=='case')
              <form method="get" action="/case_produk"> 
                @endif
        @endif
        <input type="range" min="0" max="250000" name="harga_min" value="0" id="slider-1m" oninput="slideOnem()">
        <input type="range" min="0" max="250000" name="harga_max" value="250000" id="slider-2m" oninput="slideTwom()">
        
      </div>
      <button type="submit" class="filter-hargam" name="button_filter">Filter</button>
          </form>
    </div>
    
  </div>
</div>
 {{-- SIDEBAR-FILTER-MOB --}}
 {{-- <div id="aktiv_label_check"><label for="check">HAHAHA</label></div> --}}
  <nav class="navbar sticky-top navbar-expand-lg navbar-light shadow" style="background: white;">
    <div class="container-fluid">

    <!-- accordion1 -->
    
      <button class="navbar-toggler singkatnavbar" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand h1 align-self-center logo" href="/home-user" style="font-family:'Ferro'; margin-left: 5%;">
        JALOUR
    </a>
      <div class="align-self-center collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item dropdown navbarbaris dropdown_navbar">
            <a class="nav-link cool-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              APPAREL <span class="fas fa-caret-down" ></span>
            </a></strong>
            <div class="dropdown-menu dropdown_menu_navbar" aria-labelledby="navbarDropdown">
              <a class="dropdown-item navbar-light" href="/tshirt_produk">T-shirt</a>
              <a class="dropdown-item navbar-light" href="/hoodie_produk">Hoodie</a>
              <a class="dropdown-item navbar-light" href="/crewneck_produk">Crewneck</a>
            </div>
          </li>
          <li class="nav-item dropdown dropdown_navbar">
              <a class="nav-link cool-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                AKSESORIS<span class="fas fa-caret-down"></span>
              </a>
            <div class="dropdown-menu dropdown_menu_navbar" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#case_coming_soon">Phone Case</a>
              </div>
            </li>
        <li class="nav-item">
            <a class="nav-link cool-link" href="/tentang">TENTANG</a>
        </li>
        <li class="nav-item">
            <a class="nav-link cool-link" href="#kaki">KONTAK</a>
        </li>
        </ul>
        <div class="dropdown-divider"></div>
        
      </div>
      <!-- accordion1 -->
      
      <div>  
        <div class="dropdown" style="float:right">
          <i class="fas fa-user fa-lg"></i>
          
          <div class="dropdown-content">
            @if ($id_user == "0")
            <a href="/login">Login</a>
            @elseif ($id_user != "0")
            <a href="#">Hi, {{ auth()->user()->name }}</a>
            @endif
            <a class="" href="/histori_pesanan">Histori Pesanan</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="hidden" name="" id="input">

            @if($id_user == "0")
              
            @elseif($id_user != "0")
            <a href="#" onclick="document.getElementById('logout-form').submit();">Keluar</a>
            @endif
        </form>
          </div>
        </div>
        <label for="check" class="nav-icon" >
          <!-- <div class="tooltip"> -->
            <div id="btn-keranjang">
          <i class="fa fa-fw fa-shopping-cart fa-lg" data-toggle="tooltip" title="Keranjang" ></i>
          <!-- <span class="tooltiptext">Keranjang</span> -->
          <!-- </div> -->
          <span class=" top-0 left-100 translate-middle badge rounded-pill bg-light text-dark" style="font-size:10px">{{ $jumlah_keranjang }}</span>
          </div>
      </label>
      
      </div>
    </div>
  </nav>
  <div id="off-keranjang">


    <div class="modal fade" id="case_coming_soon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Coming Soon!</h4>
          </div>
          <div class="modal-body">
              <center>	
                <img src="img/testing/katalog/case/2c3d1.jpg" alt="" class="img-responsive" width="100%">
            </center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
          </div>
        </div>
      </div>
    </div>  


   
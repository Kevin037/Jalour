@extends('main')
@section('judul')
<title>JALOUR | Produk Hoodie</title>
@endsection
@section('isi')
{{-- <section class="banner" ></section> --}}
<section>

  <center><label for="check-filter" class="nav-icon btn btn-secondary btn-md btn-block" id="label_kotak_filter">
    <div id="btn-filter" class="">
      <i class="fas fa-filter" style="color:white"></i>Filter
    </div>
  </label></center>
<div class="container-fluid">
 <div class="row">

   {{-- SIDEBAR --}}
<div class="col-lg-4">
  <div class="sidebar-filter">
   FILTER
    <hr class="solid">
      <a class="dropdown-btn model-btn" id="model-btn">KATEGORI MODEL
        <span class="fa fa-caret-down model-rotate"></span>
        {{-- <hr class="solid"> --}}
      </a>
      <div class="dropdown-container model-container" id="model-show">
        <a href="/hoodie_code">Script Code Programming</a>
        <a href="/hoodie_tipografi">Tipografi</a>
        <a href="/hoodie_ikonik">Ikonik</a>
      </div>
      <br><hr class="solid"><p>HARGA</p>
      <div class="slider">
        <div class="wrapper">
          {{-- <div class="filter-harga">Filter</div> --}}
          <div class="values">
            Rp<span id="range1">
              
            </span>
            <span> &dash;</span>
            Rp<span id="range2">100</span>
          </div>
          <div class="container">
            <div class="slider-track"></div>
            @if($jenis_produk=='2')
              @if ($kategori=='1')
                <form method="get" action="/hoodie_code">
              @elseif ($kategori=='2')
                <form method="get" action="/hoodie_tipografi">
              @elseif ($kategori=='3')
                <form method="get" action="/hoodie_ikonik">
              @endif
              <form method="get" action="/hoodie_produk">
            @endif
            <input type="range" min="0" max="250000" name="harga_min" value="8" id="slider-1" oninput="slideOne()">
            <input type="range" min="0" max="250000" name="harga_max" value="250000" id="slider-2" oninput="slideTwo()">
            <button type="submit" class="filter-harga" name="button_filter">Filter</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    </div>
 {{-- SIDEBAR --}}

 {{-- LIST PRODUK --}}
    <div class="col-lg-8" style="margin-bottom: 6%">
      <div class="listproduk">
      <div class="row">
        @foreach ($data as $produk)
        <div class="col-6 col-md-4">
          @if ($produk->diskon != null)
          <p class="diskon">-{{ $produk->diskon }}%</p>
          @elseif ($produk->diskon == null)
          <p class="no_diskon" style="color: white"></p>
          @endif
          <div class="part">
            <div class="item_produk">
              <a href="/item_hoodie{{ $produk->id_produk }}">
              <div class="overlay-produk">
                <img src="{{ url('img/testing/katalog/Hoodie/'.$produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="100%">
                <img class="gambar2" src="{{ url('img/testing/katalog/Hoodie/'.$produk->gambar_list2) }}" alt="" width="100%">
              </div>
              </a>
            </div>
            <p class="capt-jenis">{{ $produk->nama_jenis }}</p>
            <a href="/item_hoodie{{ $produk->id_produk }}" class="card teks" >{{ $produk->nama_produk }}</a>
            <div style="margin-top: 5px;display:flex;flex-direction:row">
              <div class="row">
                @if ($produk->harga_produk1!=null)
                {{-- <div class="col-md-5 col-12">
                  <p class="small" style="text-decoration: line-through rgb(173, 173, 173);color:rgb(173, 173, 173);font-style:italic;font-size:5px;"> @currency($produk->harga_produk1)</p>
                </div>
                <div class="col-md-7 col-12">
                  <b><p style="margin-left:5px;color:rgb(20, 20, 20)">@currency($produk->harga_produk2)</p></b>
                </div> --}}
                <div class="col-3">
                  <p class="small" style="text-decoration: line-through rgb(173, 173, 173);color:rgb(173, 173, 173);font-style:italic;font-size:5px;"> @currency_k($produk->harga_produk1)</p>
                </div>
                <div class="col-9">
                  <h5 class="" style="margin-left:10px;color:rgb(20, 20, 20)">@currency_k($produk->harga_produk2)</h5>
                </div>
                @else
                {{-- <div class="col-md-5 col-12">
                  <b><p style="margin-left:5px;color:rgb(20, 20, 20)">@currency($produk->harga_produk2)</p></b>
                </div> --}}
                <div class="col-4">
                  <h5 style="margin-left:10px;color:rgb(20, 20, 20)">@currency_k($produk->harga_produk2)</h5>
                </div>
                @endif
              </div>  
            </div>
          </div>
        </div> 
        @endforeach
        </div>
    </div>
    <div class="container-fluid paginasi" style="margin-top: 6%;margin-bottom:6%">
      @if ($paginasi == 'ya')
    <div class="container-fluid paginasi" style="margin-bottom:6%">
      <center>{{ $data->links() }}</center>
    </div>
    @elseif($paginasi == 'ga')

    @endif
    </div>
    </div>
     {{-- LIST PRODUK --}}
</div>  
</div>
<section>

@endsection

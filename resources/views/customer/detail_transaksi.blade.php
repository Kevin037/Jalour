@extends('main')
@section('judul')
<title>JALOUR | Detail Transaksi</title>
@endsection
@section('isi')

    

        <div class="hasil_detail">
          <div style="float: right" class="button-judul"><a href="/histori_pesanan">Histori pesanan</a>&nbsp;/&nbsp;<a href="#" style="">Detail transaksi</a></div>
          <!-- /.card-header -->
          {{-- @foreach ($data_atc as $data_atc) --}}
          @foreach ($data as $data)
          <h3 class="card-title">Data Transaksi {{ $data->kode_transaksi }}</h3>
          @endforeach
          {{-- @endforeach --}}
          <div class="container-fluid">
            <div class="card-body table-responsive p-0">
              <table class="table  text-nowrap">
                <thead>
                  <tr>
                    <th>Gambar</th>
                    <th>Jenis Produk</th>
                    <th>Nama</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_atc as $data_atc)
                  <tr>
                    <td>
                      @if ($data_atc->jenis_produk_id == '1')
                      <img src="{{ url('img/testing/katalog/T-shirt/'.$data_atc->gambar_list1) }}" alt="Avatar" class="gambar1" width="20%">
                      @elseif ($data_atc->jenis_produk_id == '2')
                      <img src="{{ url('img/testing/katalog/Hoodie/'.$data_atc->gambar_list1) }}" alt="Avatar" class="gambar1" width="20%">
                      @elseif ($data_atc->jenis_produk_id == '3')
                      <img src="{{ url('img/testing/katalog/Crewneck/'.$data_atc->gambar_list1) }}" alt="Avatar" class="gambar1" width="20%">
                      @elseif ($data_atc->jenis_produk_id == '4' || '5')
                      <img src="{{ url('img/testing/katalog/Case/'.$data_atc->gambar_list1) }}" alt="Avatar" class="gambar1" width="20%">
                      @endif
                    </td>
                    <td>{{ $data_atc->nama_jenis }}</td>
                    <td>{{ $data_atc->nama_produk }}</td>
                    <td>{{ $data_atc->nama_ukuran }}</td>
                    <td><span class="tag tag-success">{{ $data_atc->jumlah_produk_keranjang }}</span></td>
                    <td>@currency_k($data_atc->harga_produk2)</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="container-fluid" style="margin-top: 8%">
              <div class="row">
                <div class="col-md-12">
                  <section class="produk_rekom">
                    <div class="container-fluid" style="padding: 0 5% 0 5%">
                        <h5>Mungkin anda suka</h5><br>
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
                                  <a href="/item_tshirt{{ $produk->id_produk }}">
                                  <div class="overlay-produk">
                                    @if ($produk->jenis_produk_id == '1')
                                    <img src="{{ url('img/testing/katalog/T-shirt/'.$produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="100%">
                                    <img class="gambar2" src="{{ url('img/testing/katalog/T-shirt/'.$produk->gambar_list2) }}" alt="" width="100%">
                                    @elseif ($produk->jenis_produk_id == '2')
                                    <img src="{{ url('img/testing/katalog/Hoodie/'.$produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="100%">
                                    <img class="gambar2" src="{{ url('img/testing/katalog/Hoodie/'.$produk->gambar_list2) }}" alt="" width="100%">
                                    @elseif ($produk->jenis_produk_id == '3')
                                    <img src="{{ url('img/testing/katalog/Crewneck/'.$produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="100%">
                                    <img class="gambar2" src="{{ url('img/testing/katalog/Crewneck/'.$produk->gambar_list2) }}" alt="" width="100%">
                                    @elseif ($produk->jenis_produk_id == '4' || '5')
                                    <img src="{{ url('img/testing/katalog/Case/'.$produk->gambar_list1) }}" alt="Avatar" class="gambar1" width="100%">
                                    <img class="gambar2" src="{{ url('img/testing/katalog/Case/'.$produk->gambar_list2) }}" alt="" width="100%">
                                    @endif
                                  </div>
                                  </a>
                                </div>
                                <p class="capt-jenis">{{ $produk->nama_jenis }}</p>
                                <a href="/item_tshirt{{ $produk->id_produk }}" class="card teks" ><p>{{ Str::limit($produk->nama_produk, 30) }}</p></a>
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
                          </div>
                             @endforeach
                        </div>
                    </div>
                </section>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        
@endsection
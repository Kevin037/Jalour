@extends('main')
@section('judul')
<title>JALOUR | Histori Transaksi</title>
@endsection
@section('isi')

   <div class="hasil_detail">
     <div style="float: right" class="button-judul"><a href="/home-user">Home</a>&nbsp;/&nbsp;<a href="#" style="">Histori pesanan</a></div>
   
        <div class="">
          
          <!-- /.card-header -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-4 col-2">
                <h3 class="card-title judul_histori_pesanan">Data Pemesanan</h3><br>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID Pesanan</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Biaya</th>
                        <th>No Resi</th>
                        <th>Tindakan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $datas)
                      @if ($datas->id <1)
                     
                      {{-- <tr>
                       <td> --}}
                         <p> Histori Pesanan anda masih kosong, silakan lakukan transaksi untuk produk favorit anda</p>
                        {{-- </td>
                      </tr> --}}
                      @elseif($datas->id >0)
                      <tr>
                        <td>{{ $datas->kode_transaksi }}</td>
                        <td>{{ $datas->tgl_transaksi }}</td>
                        <td><span class="tag tag-success">
                          @if ($datas->status_transaksi == 'pesanan selesai')
                              <p style="color: rgb(44, 177, 44)">selesai</p>
                          @elseif($datas->status_transaksi != 'pesanan selesai')
                          {{ $datas->status_transaksi }}
                          @endif
                        </span></td>
                        <td>@currency_k($datas->biaya_transaksi)</td>
                        <td>{{ $datas->no_resi_transaksi }}</td>
                      <td>
                        @if ($datas->status_transaksi == 'menunggu pembayaran')
                        <a class="btn btn-success" href="/form_konfirmasi_pembayaran{{ $datas->id }}">Konfirmasi Pembayaran</a>
                        &nbsp;<a class="btn btn-secondary klik_detail" id="detail" href="/detail_transaksi{{ $datas->id }}" data-user="{{ $id_user }}" data-transaksi="{{ $datas->id }}"><i class="fa fa-search" aria-hidden="true"></i></a></td>
                        @elseif ($datas->status_transaksi == 'pesanan dikirim')
                        <a class="btn btn-warning" href="/pesanan_diterima{{ $datas->id }}">Diterima</a>
                        &nbsp;<a class="btn btn-secondary klik_detail" id="detail" href="/detail_transaksi{{ $datas->id }}" data-user="{{ $id_user }}" data-transaksi="{{ $datas->id }}"><i class="fa fa-search" aria-hidden="true"></i></a></td>
                        @elseif($datas->status_transaksi != 'menunggu pembayaran' || 'pesanan dikirim')
                        <center><a class="btn btn-secondary klik_detail" id="detail" href="/detail_transaksi{{ $datas->id }}" data-user="{{ $id_user }}" data-transaksi="{{ $datas->id }}"><i class="fa fa-search" aria-hidden="true"></i></a></td></center>
                        @endif
                       
                      
                      </tr>
                      @endif
                      
                      @endforeach
                      {{-- <tr><td><div class="hasil_detail"></div></td></tr> --}}
                    </tbody>
                    
                  </table>
                 
                </div>
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12 text-center">
                      {{ $data->links() }}
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="container-fluid" style="margin-top: 5%">
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
  </div>
  
@endsection
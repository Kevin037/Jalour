<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // public function adminHome(){
    //     return view('admin.home');
    // }

    public function home_user(Request $request){
      $produk_terlaris= Produk::produkterlaris();

      $testi = DB::table('testi')
      ->select('testi.*')
      ->get();
      if(isset(auth()->user()->id)){
        $id_user = auth()->user()->id;
          $data_keranjang= Keranjang::getdatakeranjang();
          $total_biaya = Keranjang::gettotalbiaya();
          $jumlah_keranjang = Keranjang::getjumlah_keranjang();
          $jenis_produk=1;
          $kategori=1;
              return view('customer.home', compact('produk_terlaris','data_keranjang','jenis_produk','kategori','jumlah_keranjang','id_user','testi','total_biaya')); 
         
      }
      else{
        $id_user=0;
          $jumlah_keranjang =0;
          $jenis_produk=1;
          $kategori=1;
              return view('customer.home', compact('produk_terlaris','jenis_produk','kategori','jumlah_keranjang','id_user','testi'));  
      }
        
    }

    public function tampil_stok($id,$ukuran){
      $stok=
      DB::table('stok_ukuran')
      ->where('produk_id','like',$id)
      ->where('ukuran_id','like',$ukuran)
      ->pluck('jumlah_stok','id_stok');
      return json_encode($stok);
    }

    public function alur_pemesanan(){
      if(isset(auth()->user()->id)){
        $id_user = auth()->user()->id;
        $data_keranjang= Keranjang::getdatakeranjang();
        $total_biaya = Keranjang::gettotalbiaya();
        $jumlah_keranjang = Keranjang::getjumlah_keranjang();
      
          $jenis_produk=1;
          $kategori=1;
              return view('customer.alur_pemesanan', compact('data_keranjang','jenis_produk','kategori','jumlah_keranjang','id_user','total_biaya')); 
          
      }
      else{
        $id_user=0;
          $jumlah_keranjang =0;
          $jenis_produk=1;
          $kategori=1;
              return view('customer.alur_pemesanan', compact('jenis_produk','kategori','jumlah_keranjang','id_user'));  
      }
    }

    public function garansi_retur(){
      if(isset(auth()->user()->id)){
        $id_user = auth()->user()->id;
        $data_keranjang= Keranjang::getdatakeranjang();
        $total_biaya = Keranjang::gettotalbiaya();
        $jumlah_keranjang = Keranjang::getjumlah_keranjang();
      
          $jenis_produk=1;
          $kategori=1;
              return view('customer.garansi_retur', compact('data_keranjang','jenis_produk','kategori','jumlah_keranjang','id_user','total_biaya')); 
          
      }
      else{
        $id_user=0;
          $jumlah_keranjang =0;
          $jenis_produk=1;
          $kategori=1;
              return view('customer.garansi_retur', compact('jenis_produk','kategori','jumlah_keranjang','id_user'));  
      }
    }

    public function info_konfirmasi(){
      if(isset(auth()->user()->id)){
        $id_user = auth()->user()->id;
        $data_keranjang= Keranjang::getdatakeranjang();
        $total_biaya = Keranjang::gettotalbiaya();
        $jumlah_keranjang = Keranjang::getjumlah_keranjang();
      
          $jenis_produk=1;
          $kategori=1;
              return view('customer.info_konfirmasi', compact('data_keranjang','jenis_produk','kategori','jumlah_keranjang','id_user','total_biaya')); 
          
      }
      else{
        $id_user=0;
          $jumlah_keranjang =0;
          $jenis_produk=1;
          $kategori=1;
              return view('customer.info_konfirmasi', compact('jenis_produk','kategori','jumlah_keranjang','id_user'));  
      }
    }

    public function kurir(){
      if(isset(auth()->user()->id)){
        $id_user = auth()->user()->id;
        $data_keranjang= Keranjang::getdatakeranjang();
        $total_biaya = Keranjang::gettotalbiaya();
        $jumlah_keranjang = Keranjang::getjumlah_keranjang();
      
          $jenis_produk=1;
          $kategori=1;
              return view('customer.kurir_pengiriman', compact('data_keranjang','jenis_produk','kategori','jumlah_keranjang','id_user','total_biaya')); 
          
      }
      else{
        $id_user=0;
          $jumlah_keranjang =0;
          $jenis_produk=1;
          $kategori=1;
              return view('customer.kurir_pengiriman', compact('jenis_produk','kategori','jumlah_keranjang','id_user'));  
      }
    }
    
    public function tentang(){
      if(isset(auth()->user()->id)){
        $id_user = auth()->user()->id;
        $data_keranjang= Keranjang::getdatakeranjang();
              $total_biaya = Keranjang::gettotalbiaya();
              $jumlah_keranjang = Keranjang::getjumlah_keranjang();
      
          $jenis_produk=1;
          $kategori=1;
              return view('customer.tentang', compact('data_keranjang','jenis_produk','kategori','jumlah_keranjang','id_user','total_biaya')); 
        
      }
      else{
        $id_user=0;
          $jumlah_keranjang =0;
          $jenis_produk=1;
          $kategori=1;
              return view('customer.tentang', compact('jenis_produk','kategori','jumlah_keranjang','id_user'));  
      }
    }
}
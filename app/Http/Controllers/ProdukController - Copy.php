<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\JenisProduk;
use App\Models\JenisSablon;
use App\Models\KategoriProduk;
use App\Models\Keranjang;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{

   // T-SHIRT
   public function detail_tshirt(Request $request, $id){
      $testi = DB::table('testi')
      ->where('produk_id','like',$id)
      ->select('testi.*')
      ->get();

      $testi_all = DB::table('testi')
      ->select('testi.*')
      ->get();

      $jumlah_testi = DB::table('testi')
      ->where('produk_id','like',$id)
      ->select('testi.*')
      ->count();

               $jenis_produk=1;
               $kategori=1;
               $data= 
         DB::table('produk')
         ->where('id_produk','like',$id)
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.*','jenis_produk.*')
         ->get();
      if(isset(auth()->user()->id)){
         $id_user = auth()->user()->id;
            $data_keranjang=
            DB::table('keranjang')
               ->where('user_id','like',$id_user)
               ->where('status_keranjang','=','atc')
               ->join('produk','produk.id_produk','=','produk_id')
               ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
               ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
               ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
               ->get();
               
               $total_biaya = DB::table('keranjang')
               ->where('status_keranjang','=','atc')
               ->where('user_id','like',$id_user)
               ->select('keranjang.*')
               ->sum('biaya_keranjang');

               $jumlah_keranjang = DB::table('keranjang')
               ->where('user_id','like',$id_user)->where('status_keranjang','=','atc')->count();
               return view('customer.detail_produk', compact('testi_all','jumlah_testi','testi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user')); 
       }
       else{
         
         $id_user=0;
           $jumlah_keranjang = 0;
               return view('customer.detail_produk', compact('testi_all','jumlah_testi','testi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
         }
   }


   public function tampil_tshirt(Request $request){
         if ($request->has('button_filter')){
            $harga_min = $request->harga_min;
            $harga_max = $request->harga_max;
            $data= 
            DB::table('produk')
            ->where('jenis_produk_id','like','1')
            ->whereBetween('harga_produk2', array($harga_min, $harga_max))
            ->join('kategori_produk','produk.kategori_id','=','id_kategori')
            ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
            ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
            ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
            ->get();

            $paginasi='ga';
         }
         else{
            $data= 
            DB::table('produk')
            ->where('jenis_produk_id','like','1')
            ->join('kategori_produk','produk.kategori_id','=','id_kategori')
            ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
            ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
            ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
            ->paginate(9);
            
            $paginasi='ya';
         }
         $jenis_produk=1;
         $kategori='';

      if(isset(auth()->user()->id)){
         $id_user = auth()->user()->id;
            $data_keranjang=
            DB::table('keranjang')
            ->where('user_id','like',$id_user)
            ->where('status_keranjang','=','atc')
            ->join('produk','produk.id_produk','=','produk_id')
            ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
            ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
            ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
            ->get();

            $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

             $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
             return view('customer.list_produk_tshirt', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
       }
       else{
         $id_user=0;
         $jumlah_keranjang = 0;
         return view('customer.list_produk_tshirt', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
         }
   }

   public function tshirt_code(Request $request){

         if ($request->has('button_filter')){
            $harga_min = $request->harga_min;
            $harga_max = $request->harga_max;
            $data= 
            DB::table('produk')
            ->where('jenis_produk_id','like','1')
            ->where('kategori_id','like','1')
            ->whereBetween('harga_produk2', array($harga_min, $harga_max))
            ->join('kategori_produk','produk.kategori_id','=','id_kategori')
            ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
            ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
            ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
            ->get();
            $paginasi='ga';
            }
            else{
               $data= 
            DB::table('produk')
            ->where('jenis_produk_id','like','1')
            ->where('kategori_id','like','1')
            ->join('kategori_produk','produk.kategori_id','=','id_kategori')
            ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
            ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
            ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
            ->paginate(9);
            $paginasi='ya';
            }
            $jenis_produk=1;
            $kategori=1;

      if(isset(auth()->user()->id)){

         $id_user = auth()->user()->id;
            $data_keranjang=
            DB::table('keranjang')
            ->where('user_id','like',$id_user)
            ->where('status_keranjang','=','atc')
            ->join('produk','produk.id_produk','=','produk_id')
            ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
            ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
            ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
            ->get();

            $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

             $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
             return view('customer.list_produk_tshirt', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
       }
       else{
         $id_user=0;
         $jumlah_keranjang = 0;
         return view('customer.list_produk_tshirt', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
         }
         
     }

     public function tshirt_tipografi(Request $request){
        
         if ($request->has('button_filter')){
            $harga_min = $request->harga_min;
            $harga_max = $request->harga_max;
            $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','1')
         ->where('kategori_id','like','2')
         ->whereBetween('harga_produk2', array($harga_min, $harga_max))
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->get();
         $paginasi='ga';
      }
         else{
            $data= 
            DB::table('produk')
            ->where('jenis_produk_id','like','1')
            ->where('kategori_id','like','2')
            ->join('kategori_produk','produk.kategori_id','=','id_kategori')
            ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
            ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
            ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
            ->paginate(9);
            $paginasi='ya';
         }

         $jenis_produk=1;
            $kategori=2;
      if(isset(auth()->user()->id)){
            $id_user = auth()->user()->id;
            $data_keranjang=
         DB::table('keranjang')
         ->where('user_id','like',$id_user)
         ->where('status_keranjang','=','atc')
         ->join('produk','produk.id_produk','=','produk_id')
         ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
         ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
         ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
         ->get();

         $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

      $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
      return view('customer.list_produk_tshirt', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
          }
      else{
         $id_user=0;
         $jumlah_keranjang = 0;
         return view('customer.list_produk_tshirt', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user','id_user'));
         }
      }

     public function tshirt_streetwear(Request $request){
         if ($request->has('button_filter')){
            $harga_min = $request->harga_min;
            $harga_max = $request->harga_max;
            $data= 
            DB::table('produk')
            ->where('jenis_produk_id','like','1')
            ->where('kategori_id','like','3')
            ->whereBetween('harga_produk2', array($harga_min, $harga_max))
            ->join('kategori_produk','produk.kategori_id','=','id_kategori')
            ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
            ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
            ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
            ->get();
            $paginasi='ga';
         }
         else{
            $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','1')
         ->where('kategori_id','like','3')
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->paginate(9);
         $paginasi='ya';
         }
         $jenis_produk=1;
      $kategori=3;
      if(isset(auth()->user()->id)){
         $id_user = auth()->user()->id;
         $data_keranjang=
         DB::table('keranjang')
         ->where('user_id','like',$id_user)
         ->where('status_keranjang','=','atc')
         ->join('produk','produk.id_produk','=','produk_id')
         ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
         ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
         ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
         ->get();

         $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');
         
         $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
         return view('customer.list_produk_tshirt', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
          }
      else{
         $id_user=0;
         $jumlah_keranjang = 0;
         return view('customer.list_produk_tshirt', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
         }
     }
   // T-SHIRT



   // HOODIE
   public function detail_hoodie($id){
      // $jumlah_keranjang = DB::table('keranjang')->count();
      // $data_keranjang=
      // DB::table('keranjang')
      //   ->join('produk','produk.id_produk','=','produk_id')
      //   ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
      //   ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
      //   ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
      //   ->get();
      // $jenis_produk=2;
      // $kategori=1;
      // $data= 
      // DB::table('produk')
      // ->where('id_produk','like',$id)
      // ->join('kategori_produk','produk.kategori_id','=','id_kategori')
      // ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
      // ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
      // ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
      // ->get();
      // return view('customer.detail_produk', compact('data','jenis_produk','kategori','data_keranjang','jumlah_keranjang'));
      $testi = DB::table('testi')
      ->where('produk_id','like',$id)
      ->select('testi.*')
      ->get();

      $testi_all = DB::table('testi')
      ->select('testi.*')
      ->get();

      $jumlah_testi = DB::table('testi')
      ->where('produk_id','like',$id)
      ->select('testi.*')
      ->count();

      $jenis_produk=2;
               $kategori=1;
               $data= 
         DB::table('produk')
         ->where('id_produk','like',$id)
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.*','jenis_produk.*')
         ->get();
      if(isset(auth()->user()->id)){
         $id_user = auth()->user()->id;
            $data_keranjang=
            DB::table('keranjang')
               ->where('user_id','like',$id_user)
               ->where('status_keranjang','=','atc')
               ->join('produk','produk.id_produk','=','produk_id')
               ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
               ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
               ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
               ->get();

               $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');
               
               $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')
               ->where('user_id','like',$id_user)->count();
               return view('customer.detail_produk', compact('testi_all','jumlah_testi','testi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user')); 
       }
       else{
         
         $id_user=0;
           $jumlah_keranjang = 0;
               return view('customer.detail_produk', compact('testi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
         }
   }

   public function tampil_hoodie(Request $request){
      if ($request->has('button_filter')){
         $harga_min = $request->harga_min;
         $harga_max = $request->harga_max;
         $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','2')
         ->whereBetween('harga_produk2', array($harga_min, $harga_max))
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->get();
         $paginasi='ga';
      }
      else{
         $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','2')
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->paginate(9);
         $paginasi='ya';
      }
      $jenis_produk=2;
      $kategori='';

   if(isset(auth()->user()->id)){
      $id_user = auth()->user()->id;
         $data_keranjang=
         DB::table('keranjang')
         ->where('user_id','like',$id_user)
         ->where('status_keranjang','=','atc')
         ->join('produk','produk.id_produk','=','produk_id')
         ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
         ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
         ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
         ->get();

         $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

          $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
          return view('customer.list_produk_hoodie', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
    }
    else{
      $id_user=0;
      $jumlah_keranjang = 0;
      return view('customer.list_produk_hoodie', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
      }
   }

     public function hoodie_code(Request $request){
      if ($request->has('button_filter')){
         $harga_min = $request->harga_min;
         $harga_max = $request->harga_max;
         $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','2')
         ->where('kategori_id','like','1')
         ->whereBetween('harga_produk2', array($harga_min, $harga_max))
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->get();
         $paginasi='ga';
         }
         else{
            $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','2')
         ->where('kategori_id','like','1')
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->paginate(9);
         $paginasi='ya';
         }
         $jenis_produk=2;
         $kategori=1;

   if(isset(auth()->user()->id)){

      $id_user = auth()->user()->id;
         $data_keranjang=
         DB::table('keranjang')
         ->where('user_id','like',$id_user)
         ->where('status_keranjang','=','atc')
         ->join('produk','produk.id_produk','=','produk_id')
         ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
         ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
         ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
         ->get();

         $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

          $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
          return view('customer.list_produk_hoodie', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
    }
   else{
      $id_user=0;
      $jumlah_keranjang = 0;
      return view('customer.list_produk_hoodie', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
      }   
   }

     public function hoodie_tipografi(Request $request){
      if ($request->has('button_filter')){
         $harga_min = $request->harga_min;
         $harga_max = $request->harga_max;
         $data= 
      DB::table('produk')
      ->where('jenis_produk_id','like','2')
      ->where('kategori_id','like','2')
      ->whereBetween('harga_produk2', array($harga_min, $harga_max))
      ->join('kategori_produk','produk.kategori_id','=','id_kategori')
      ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
      ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
      ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
      ->get();
      $paginasi='ga';
   }
      else{
         $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','2')
         ->where('kategori_id','like','2')
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->paginate(9);
         $paginasi='ya';
      }

      $jenis_produk=2;
         $kategori=2;
   if(isset(auth()->user()->id)){
         $id_user = auth()->user()->id;
         $data_keranjang=
      DB::table('keranjang')
      ->where('user_id','like',$id_user)
      ->where('status_keranjang','=','atc')
      ->join('produk','produk.id_produk','=','produk_id')
      ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
      ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
      ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
      ->get();

      $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

   $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
   return view('customer.list_produk_hoodie', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
       }
   else{
      $id_user=0;
      $jumlah_keranjang = 0;
      return view('customer.list_produk_hoodie', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user','id_user'));
      }   
   }

     public function hoodie_ikonik(Request $request){
      if ($request->has('button_filter')){
         $harga_min = $request->harga_min;
         $harga_max = $request->harga_max;
         $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','2')
         ->where('kategori_id','like','4')
         ->whereBetween('harga_produk2', array($harga_min, $harga_max))
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->get();
         $paginasi='ga';
      }
      else{
         $data= 
      DB::table('produk')
      ->where('jenis_produk_id','like','2')
      ->where('kategori_id','like','4')
      ->join('kategori_produk','produk.kategori_id','=','id_kategori')
      ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
      ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
      ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
      ->paginate(9);
      $paginasi='ya';
      }
      $jenis_produk=2;
   $kategori=4;
   if(isset(auth()->user()->id)){
      $id_user = auth()->user()->id;
      $data_keranjang=
      DB::table('keranjang')
      ->where('user_id','like',$id_user)
      ->where('status_keranjang','=','atc')
      ->join('produk','produk.id_produk','=','produk_id')
      ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
      ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
      ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
      ->get();

      $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');
      
      $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
      return view('customer.list_produk_hoodie', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
       }
   else{
      $id_user=0;
      $jumlah_keranjang = 0;
      return view('customer.list_produk_hoodie', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
      }   
   }
   //   HOODIE



   // CREWNECK
   public function detail_crewneck($id){
      $testi = DB::table('testi')
      ->where('produk_id','like',$id)
      ->select('testi.*')
      ->get();

      $testi_all = DB::table('testi')
      ->select('testi.*')
      ->get();

      $jumlah_testi = DB::table('testi')
      ->where('produk_id','like',$id)
      ->select('testi.*')
      ->count();

            $jenis_produk=3;
            $kategori=1;
            $data= 
      DB::table('produk')
      ->where('id_produk','like',$id)
      ->join('kategori_produk','produk.kategori_id','=','id_kategori')
      ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
      ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
      ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.*','jenis_produk.*')
      ->paginate(9);

      if(isset(auth()->user()->id)){
      $id_user = auth()->user()->id;
         $data_keranjang=
         DB::table('keranjang')
            ->where('user_id','like',$id_user)
            ->where('status_keranjang','=','atc')
            ->join('produk','produk.id_produk','=','produk_id')
            ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
            ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
            ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
            ->get();

            $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');
            
            $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')
            ->where('user_id','like',$id_user)->count();
            return view('customer.detail_produk', compact('testi_all','jumlah_testi','testi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user')); 
      }
      else{

      $id_user=0;
      $jumlah_keranjang = 0;
            return view('customer.detail_produk', compact('testi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
      }
   }
     public function tampil_crewneck(Request $request){
      if ($request->has('button_filter')){
         $harga_min = $request->harga_min;
         $harga_max = $request->harga_max;
         $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','3')
         ->whereBetween('harga_produk2', array($harga_min, $harga_max))
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->get();
         $paginasi='ga';
      }
      else{
         $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','3')
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->paginate(9);
         $paginasi='ya';
      }
      $jenis_produk=3;
      $kategori='';

   if(isset(auth()->user()->id)){
      $id_user = auth()->user()->id;
         $data_keranjang=
         DB::table('keranjang')
         ->where('user_id','like',$id_user)
         ->where('status_keranjang','=','atc')
         ->join('produk','produk.id_produk','=','produk_id')
         ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
         ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
         ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
         ->get();

         $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

          $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
          return view('customer.list_produk_crewneck', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
    }
    else{
      $id_user=0;
      $jumlah_keranjang = 0;
      return view('customer.list_produk_crewneck', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
      }
     }

     public function crewneck_code(Request $request){
      if ($request->has('button_filter')){
         $harga_min = $request->harga_min;
         $harga_max = $request->harga_max;
         $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','3')
         ->where('kategori_id','like','1')
         ->whereBetween('harga_produk2', array($harga_min, $harga_max))
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->get();
         $paginasi='ga';
         
         }
         else{
            $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','3')
         ->where('kategori_id','like','1')
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->paginate(9);
         $paginasi='ya';
         }
         $jenis_produk=3;
         $kategori=1;

   if(isset(auth()->user()->id)){

      $id_user = auth()->user()->id;
         $data_keranjang=
         DB::table('keranjang')
         ->where('user_id','like',$id_user)
         ->where('status_keranjang','=','atc')
         ->join('produk','produk.id_produk','=','produk_id')
         ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
         ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
         ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
         ->get();

         $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

          $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
          return view('customer.list_produk_crewneck', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
    }
    else{
      $id_user=0;
      $jumlah_keranjang = 0;
      return view('customer.list_produk_crewneck', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
      }
   }

     public function crewneck_tipografi(Request $request){
      if ($request->has('button_filter')){
         $harga_min = $request->harga_min;
         $harga_max = $request->harga_max;
         $data= 
      DB::table('produk')
      ->where('jenis_produk_id','like','3')
      ->where('kategori_id','like','2')
      ->whereBetween('harga_produk2', array($harga_min, $harga_max))
      ->join('kategori_produk','produk.kategori_id','=','id_kategori')
      ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
      ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
      ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
      ->get();
      $paginasi='ga';
   }
      else{
         $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','3')
         ->where('kategori_id','like','2')
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->paginate(9);
         $paginasi='ya';
      }

      $jenis_produk=3;
         $kategori=2;
   if(isset(auth()->user()->id)){
         $id_user = auth()->user()->id;
         $data_keranjang=
      DB::table('keranjang')
      ->where('user_id','like',$id_user)
      ->where('status_keranjang','=','atc')
      ->join('produk','produk.id_produk','=','produk_id')
      ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
      ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
      ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
      ->get();

      $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

   $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
   return view('customer.list_produk_crewneck', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
       }
   else{
      $id_user=0;
      $jumlah_keranjang = 0;
      return view('customer.list_produk_crewneck', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user','id_user'));
      }   
   }

     public function crewneck_ikonik(Request $request){
      if ($request->has('button_filter')){
         $harga_min = $request->harga_min;
         $harga_max = $request->harga_max;
         $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','3')
         ->where('kategori_id','like','4')
         ->whereBetween('harga_produk2', array($harga_min, $harga_max))
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
         ->get();
         $paginasi='ga';
      }
      else{
         $data= 
      DB::table('produk')
      ->where('jenis_produk_id','like','3')
      ->where('kategori_id','like','4')
      ->join('kategori_produk','produk.kategori_id','=','id_kategori')
      ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
      ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
      ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
      ->paginate(9);
      $paginasi='ya';
      }
      $jenis_produk=3;
   $kategori=4;
   if(isset(auth()->user()->id)){
      $id_user = auth()->user()->id;
      $data_keranjang=
      DB::table('keranjang')
      ->where('user_id','like',$id_user)
      ->where('status_keranjang','=','atc')
      ->join('produk','produk.id_produk','=','produk_id')
      ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
      ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
      ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
      ->get();
      
      $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

      $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
      return view('customer.list_produk_crewneck', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
       }
   else{
      $id_user=0;
      $jumlah_keranjang = 0;
      return view('customer.list_produk_crewneck', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
      }   
   }
     
   // CREWNECK


   // CASE
   public function detail_case($id){
      $testi = DB::table('testi')
      ->select('testi.*')
      ->get();
      $jenis_produk=4;
               $kategori=1;
               $data= 
         DB::table('produk')
         ->where('id_produk','like',$id)
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_produk.*')
         ->get();
      if(isset(auth()->user()->id)){
         
         $id_user = auth()->user()->id;
            $data_keranjang=
            DB::table('keranjang')
               ->where('user_id','like',$id_user)
               ->where('status_keranjang','=','atc')
               ->join('produk','produk.id_produk','=','produk_id')
               ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
               ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
               ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
               ->get();

               $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');
               
               $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')
               ->where('user_id','like',$id_user)->count();
               return view('customer.detail_produk', compact('testi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user')); 
       }
       else{
         
         $id_user=0;
           $jumlah_keranjang = 0;
               return view('customer.detail_produk', compact('testi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
         }
   }
     public function tampil_case(Request $request){
   
   if ($request->has('button_filter')){
      $harga_min = $request->harga_min;
            $harga_max = $request->harga_max;
            $data= 
            DB::table('produk')
            ->where('jenis_produk_id','like','4')
            ->orwhere('jenis_produk_id','like','5')
            ->whereBetween('harga_produk2', array($harga_min, $harga_max))
            ->join('kategori_produk','produk.kategori_id','=','id_kategori')
            ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
            ->select('produk.*','kategori_produk.nama_kategori','jenis_produk.nama_jenis')
            ->get();
            $paginasi='ga';
   }
   else{
      $data= 
      DB::table('produk')
      ->where('jenis_produk_id','like','4')
      ->orwhere('jenis_produk_id','like','5')
      ->join('kategori_produk','produk.kategori_id','=','id_kategori')
      ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
      ->select('produk.*','kategori_produk.nama_kategori','jenis_produk.nama_jenis')
      ->paginate(9);
      $paginasi='ya';
   }
   $jenis_produk='case';
   $kategori=1;
if(isset(auth()->user()->id)){
   $id_user = auth()->user()->id;
      $data_keranjang=
      DB::table('keranjang')
      ->where('user_id','like',$id_user)
      ->where('status_keranjang','=','atc')
      ->join('produk','produk.id_produk','=','produk_id')
      ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
      ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
      ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
      ->get();

      $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

       $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
       return view('customer.list_produk_case', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
 }
 else{
   $id_user=0;
   $jumlah_keranjang = 0;
   return view('customer.list_produk_case', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
   }
}

     public function case_hard(Request $request){
      if ($request->has('button_filter')){
         $harga_min = $request->harga_min;
               $harga_max = $request->harga_max;
               $data= 
               DB::table('produk')
               ->where('jenis_produk_id','like','4')
               ->whereBetween('harga_produk2', array($harga_min, $harga_max))
               ->join('kategori_produk','produk.kategori_id','=','id_kategori')
               ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
               ->select('produk.*','kategori_produk.nama_kategori','jenis_produk.nama_jenis')
               ->get();
               $paginasi='ga';
      }
      else{
         $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','4')
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_produk.nama_jenis')
         ->paginate(9);
         $paginasi='ya';
      }
      $jenis_produk='case';
      $kategori=1;
   if(isset(auth()->user()->id)){
      $id_user = auth()->user()->id;
         $data_keranjang=
         DB::table('keranjang')
         ->where('user_id','like',$id_user)
         ->where('status_keranjang','=','atc')
         ->join('produk','produk.id_produk','=','produk_id')
         ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
         ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
         ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
         ->get();

         $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

          $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
          return view('customer.list_produk_case', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
    }
    else{
      $id_user=0;
      $jumlah_keranjang = 0;
      return view('customer.list_produk_case', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
      } }

     public function case_soft(Request $request){
      if ($request->has('button_filter')){
         $harga_min = $request->harga_min;
               $harga_max = $request->harga_max;
               $data= 
               DB::table('produk')
               ->where('jenis_produk_id','like','5')
               ->whereBetween('harga_produk2', array($harga_min, $harga_max))
               ->join('kategori_produk','produk.kategori_id','=','id_kategori')
               ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
               ->select('produk.*','kategori_produk.nama_kategori','jenis_produk.nama_jenis')
               ->get();
               $paginasi='ga';
      }
      else{
         $data= 
         DB::table('produk')
         ->where('jenis_produk_id','like','5')
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_produk.nama_jenis')
         ->paginate(9);
         $paginasi='ya';
      }
      $jenis_produk='5';
      $kategori=1;
   if(isset(auth()->user()->id)){
      $id_user = auth()->user()->id;
         $data_keranjang=
         DB::table('keranjang')
         ->where('user_id','like',$id_user)
         ->where('status_keranjang','=','atc')
         ->join('produk','produk.id_produk','=','produk_id')
         ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
         ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
         ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
         ->get();

         $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');

          $jumlah_keranjang = DB::table('keranjang')->where('status_keranjang','=','atc')->where('user_id','like',$id_user)->count();
          return view('customer.list_produk_case', compact('paginasi','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user'));
    }
    else{
      $id_user=0;
      $jumlah_keranjang = 0;
      return view('customer.list_produk_case', compact('paginasi','data','jenis_produk','kategori','jumlah_keranjang','id_user'));
      }   
   }
   // CASE
}

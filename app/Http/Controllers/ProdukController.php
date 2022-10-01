<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{

   public static $id_produk, $harga_min, $harga_max, $jenis_produk, $kategori_id;
   // T-SHIRT
   public function detail_tshirt(Request $request, $id){
      self::$id_produk = $id;
      $testi = Produk::get_testi_detail();
      $testi_all = Produk::get_testi_all();
      $jumlah_testi = Produk::get_jumlah_testi();

      $jenis_produk=1;
      $kategori=1;
      $data= Produk::get_data_detail();
      if(isset(auth()->user()->id)){
         $id_user = auth()->user()->id;
         $data_keranjang= Keranjang::getdatakeranjang();
         $total_biaya = Keranjang::gettotalbiaya();
         $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
            self::$harga_min = $request->harga_min;
            self::$harga_max = $request->harga_max;
            self::$jenis_produk = 1;
            $data = Produk::get_list();
            $paginasi='ga';
         }
         else{
            self::$jenis_produk = 1;
            $data = Produk::get_list();
            $paginasi='ya';
         }
         $jenis_produk=1;
         $kategori='';
   
      if(isset(auth()->user()->id)){
         $id_user = auth()->user()->id;
         $data_keranjang= Keranjang::getdatakeranjang();
         $total_biaya = Keranjang::gettotalbiaya();
         $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
            self::$harga_min = $request->harga_min;
            self::$harga_max = $request->harga_max;
            self::$kategori_id = 1;
            self::$jenis_produk = 1;
            $data = Produk::get_list();
            $paginasi='ga';
         }
         else{
            self::$kategori_id = 1;
            self::$jenis_produk = 1;
            $data = Produk::get_list();
            $paginasi='ya';
         }
            $jenis_produk=1;
            $kategori=1;

      if(isset(auth()->user()->id)){

         $id_user = auth()->user()->id;
         $data_keranjang= Keranjang::getdatakeranjang();
         $total_biaya = Keranjang::gettotalbiaya();
         $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
            self::$harga_min = $request->harga_min;
            self::$harga_max = $request->harga_max;
            self::$kategori_id = 2;
            self::$jenis_produk = 1;
            $data = Produk::get_list();
         $paginasi='ga';
      }
         else{
            self::$kategori_id = 2;
            self::$jenis_produk = 1;
            $data = Produk::get_list();
            $paginasi='ya';
         }

         $jenis_produk=1;
            $kategori=2;
      if(isset(auth()->user()->id)){
            $id_user = auth()->user()->id;
            $data_keranjang= Keranjang::getdatakeranjang();
            $total_biaya = Keranjang::gettotalbiaya();
            $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
            self::$harga_min = $request->harga_min;
            self::$harga_max = $request->harga_max;
            self::$kategori_id = 3;
            self::$jenis_produk = 1;
            $data = Produk::get_list();
            $paginasi='ga';
         }
         else{
            self::$kategori_id = 3;
            self::$jenis_produk = 1;
            $data = Produk::get_list();
            $paginasi='ya';
         }
         $jenis_produk=1;
      $kategori=3;
      if(isset(auth()->user()->id)){
         $id_user = auth()->user()->id;
         $data_keranjang= Keranjang::getdatakeranjang();
         $total_biaya = Keranjang::gettotalbiaya();
         $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
      self::$id_produk = $id;
      $testi = Produk::get_testi_detail();
      $testi_all = Produk::get_testi_all();
      $jumlah_testi = Produk::get_jumlah_testi();

      $jenis_produk=2;
      $kategori=1;
      $data= Produk::get_data_detail();
      if(isset(auth()->user()->id)){
         $id_user = auth()->user()->id;
         $data_keranjang= Keranjang::getdatakeranjang();
         $total_biaya = Keranjang::gettotalbiaya();
         $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
         self::$harga_min = $request->harga_min;
         self::$harga_max = $request->harga_max;
         self::$jenis_produk = 2;
         $data = Produk::get_list();
         $paginasi='ga';
      }
      else{
         self::$jenis_produk = 2;
         $data = Produk::get_list();
         $paginasi='ya';
      }
      $jenis_produk=2;
      $kategori='';

   if(isset(auth()->user()->id)){
      $id_user = auth()->user()->id;
      $data_keranjang= Keranjang::getdatakeranjang();
      $total_biaya = Keranjang::gettotalbiaya();
      $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
            self::$harga_min = $request->harga_min;
            self::$harga_max = $request->harga_max;
            self::$kategori_id = 1;
            self::$jenis_produk = 2;
            $data = Produk::get_list();
            $paginasi='ga';
         }
         else{
            self::$kategori_id = 1;
            self::$jenis_produk = 2;
            $data = Produk::get_list();
            $paginasi='ya';
         }
         $jenis_produk=2;
         $kategori=1;

   if(isset(auth()->user()->id)){

      $id_user = auth()->user()->id;
      $data_keranjang= Keranjang::getdatakeranjang();
      $total_biaya = Keranjang::gettotalbiaya();
      $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
            self::$harga_min = $request->harga_min;
            self::$harga_max = $request->harga_max;
            self::$kategori_id = 2;
            self::$jenis_produk = 2;
            $data = Produk::get_list();
            $paginasi='ga';
      }
      else{
         self::$kategori_id = 2;
         self::$jenis_produk = 2;
         $data = Produk::get_list();
         $paginasi='ya';
      }

      $jenis_produk=2;
         $kategori=2;
   if(isset(auth()->user()->id)){
         $id_user = auth()->user()->id;
         $data_keranjang= Keranjang::getdatakeranjang();
         $total_biaya = Keranjang::gettotalbiaya();
         $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
         self::$harga_min = $request->harga_min;
         self::$harga_max = $request->harga_max;
         self::$kategori_id = 4;
         self::$jenis_produk = 2;
         $data = Produk::get_list();
         $paginasi='ga';
      }
      else{
         self::$kategori_id = 4;
         self::$jenis_produk = 2;
         $data = Produk::get_list();
         $paginasi='ya';
      }
      $jenis_produk=2;
   $kategori=4;
   if(isset(auth()->user()->id)){
      $id_user = auth()->user()->id;
      $data_keranjang= Keranjang::getdatakeranjang();
      $total_biaya = Keranjang::gettotalbiaya();
      $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
      self::$id_produk = $id;
      $testi = Produk::get_testi_detail();
      $testi_all = Produk::get_testi_all();
      $jumlah_testi = Produk::get_jumlah_testi();

      $jenis_produk=3;
      $kategori=1;
      $data= Produk::get_data_detail();

      if(isset(auth()->user()->id)){
      $id_user = auth()->user()->id;
      $data_keranjang= Keranjang::getdatakeranjang();
         $total_biaya = Keranjang::gettotalbiaya();
         $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
         self::$harga_min = $request->harga_min;
         self::$harga_max = $request->harga_max;
         self::$jenis_produk = 3;
         $data = Produk::get_list();
         $paginasi='ga';
      }
      else{
         self::$jenis_produk = 3;
         $data = Produk::get_list();
         $paginasi='ya';
      }
      $jenis_produk=3;
      $kategori='';

   if(isset(auth()->user()->id)){
      $id_user = auth()->user()->id;
      $data_keranjang= Keranjang::getdatakeranjang();
      $total_biaya = Keranjang::gettotalbiaya();
      $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
      self::$harga_min = $request->harga_min;
         self::$harga_max = $request->harga_max;
         self::$kategori_id = 1;
         self::$jenis_produk = 3;
         $data = Produk::get_list();
         $paginasi='ga';
         
         }
         else{
            self::$kategori_id = 1;
            self::$jenis_produk = 3;
            $data = Produk::get_list();
            $paginasi='ya';
         }
         $jenis_produk=3;
         $kategori=1;

   if(isset(auth()->user()->id)){

      $id_user = auth()->user()->id;
      $data_keranjang= Keranjang::getdatakeranjang();
      $total_biaya = Keranjang::gettotalbiaya();
      $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
         self::$harga_min = $request->harga_min;
         self::$harga_max = $request->harga_max;
         self::$kategori_id = 2;
         self::$jenis_produk = 3;
         $data = Produk::get_list();
         $paginasi='ga';
      }
      else{
         self::$kategori_id = 2;
         self::$jenis_produk = 3;
         $data = Produk::get_list();
         $paginasi='ya';
      }

      $jenis_produk=3;
         $kategori=2;
   if(isset(auth()->user()->id)){
         $id_user = auth()->user()->id;
         $data_keranjang= Keranjang::getdatakeranjang();
         $total_biaya = Keranjang::gettotalbiaya();
         $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
         self::$harga_min = $request->harga_min;
         self::$harga_max = $request->harga_max;
         self::$kategori_id = 4;
         self::$jenis_produk = 3;
         $data = Produk::get_list();
         $paginasi='ga';
      }
      else{
         self::$kategori_id = 4;
         self::$jenis_produk = 3;
         $data = Produk::get_list();
         $paginasi='ya';
      }
      $jenis_produk=3;
   $kategori=4;
   if(isset(auth()->user()->id)){
      $id_user = auth()->user()->id;
      $data_keranjang= Keranjang::getdatakeranjang();
         $total_biaya = Keranjang::gettotalbiaya();
         $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
      $data= Produk::get_data_detail();
      if(isset(auth()->user()->id)){
         
         $id_user = auth()->user()->id;
         $data_keranjang= Keranjang::getdatakeranjang();
         $total_biaya = Keranjang::gettotalbiaya();
         $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
   $data_keranjang= Keranjang::getdatakeranjang();
   $total_biaya = Keranjang::gettotalbiaya();
   $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
      $data_keranjang= Keranjang::getdatakeranjang();
      $total_biaya = Keranjang::gettotalbiaya();
      $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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
      $data_keranjang= Keranjang::getdatakeranjang();
      $total_biaya = Keranjang::gettotalbiaya();
      $jumlah_keranjang = Keranjang::getjumlah_keranjang();
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

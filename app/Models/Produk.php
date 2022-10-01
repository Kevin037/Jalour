<?php

namespace App\Models;

use App\Http\Controllers\ProdukController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    protected $table = 'produk';

    public static function get_testi_all(){
        $testi_all = DB::table('testi')
        ->select('testi.*')
        ->get();
        return $testi_all;
    }

    public static function get_testi_detail(){
        $testi = DB::table('testi')
        ->where('produk_id','like',ProdukController::$id_produk)
        ->select('testi.*')
        ->get();

        return $testi;
    }

    public static function get_jumlah_testi(){
    $jumlah_testi = DB::table('testi')
      ->where('produk_id','like',ProdukController::$id_produk)
      ->select('testi.*')
      ->count();

      return $jumlah_testi;
    }

    public static function get_data_detail(){
    $data_detail= 
         DB::table('produk')
         ->where('id_produk','like',ProdukController::$id_produk)
         ->join('kategori_produk','produk.kategori_id','=','id_kategori')
         ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
         ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
         ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.*','jenis_produk.*')
         ->get();
        return $data_detail;
    }

    public static function get_list(){
        // $list_produk= 
        //     DB::table('produk')
        //     ->where('jenis_produk_id','like','1')
        //     if(empty(ProdukController::$id_produk)){
        //     ->whereBetween('harga_produk2', array($harga_min, $harga_max))
        //     }
        //     ->join('kategori_produk','produk.kategori_id','=','id_kategori')
        //     ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
        //     ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
        //     ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
        //     ->paginate(9);

        $harga_min = ProdukController::$harga_min;
        $harga_max = ProdukController::$harga_max;
        $kategori_id = ProdukController::$kategori_id;
        $jenis_produk = ProdukController::$jenis_produk;
        $list_produk = Produk::query();
        $list_produk= Produk::when((!empty($harga_min) && !empty($harga_max)),function ($query)use($harga_min, $harga_max){
                $query->whereBetween('harga_produk2', array($harga_min, $harga_max));
            })->when((!empty($kategori_id)),function ($query)use($kategori_id){
                $query->where('kategori_id','like',$kategori_id);
            })
            ->where('jenis_produk_id','like',$jenis_produk)
            ->join('kategori_produk','produk.kategori_id','=','id_kategori')
            ->join('jenis_sablon','produk.sablon_produk_id','=','id_jenis_sablon')
            ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
            ->select('produk.*','kategori_produk.nama_kategori','jenis_sablon.nama_sablon','jenis_produk.nama_jenis')
            ->paginate(9);

        return $list_produk;
    }

    public static function produkterlaris(){
        $produk_terlaris= 
        DB::table('produk')
        ->where('terlaris','=','y')
        ->join('kategori_produk','produk.kategori_id','=','id_kategori')
        ->join('jenis_produk','produk.jenis_produk_id','=','id_jenis')
        ->select('produk.*','kategori_produk.nama_kategori','jenis_produk.nama_jenis')
        ->get();

        return $produk_terlaris;
    }
}

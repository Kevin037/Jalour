<?php

namespace App\Models;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $fillable = ['produk_id','ukuran_id','tambahan_request','jumlah_produk_keranjang','berat_keranjang','status_keranjang','transaksi_id','user_id','biaya_keranjang','net_margin'];

    public static function getdatakeranjang(){
        $id_user = auth()->user()->id;
        $data_keranjang=
          DB::table('keranjang')
            ->where('user_id','like',$id_user)
            ->where('status_keranjang','=','atc')
            ->join('produk','produk.id_produk','=','produk_id')
            ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
            ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
            ->select('keranjang.*','produk.*','nama_ukuran', 'nama_jenis')
            ->get();
        return $data_keranjang;
    }

    public static function detail_keranjang(){
        $data_produk=
        DB::table('keranjang')
        ->where('transaksi_id','like',DashboardController::$id_transaksi)
        ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
        ->join('produk','produk.id_produk','=','produk_id')
        ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
        ->select('keranjang.*','ukuran.*','produk.*','jenis_produk.*')
        ->get();

        return $data_produk;
    }
    
    public static function keranjang_chekcout(){
        $data_keranjang=
          DB::table('keranjang')
          ->where('user_id','like', TransaksiController::$id_user)
          ->where('status_keranjang','=','atc')
          ->join('produk','produk.id_produk','=','produk_id')
          ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
          ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
          ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
          ->get();

          return $data_keranjang;
    }

    public static function gettotalbiaya(){
        $id_user = auth()->user()->id;
        $total_biaya = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->select('keranjang.*')
          ->sum('biaya_keranjang');
        return $total_biaya;
    }

    public static function getjumlah_keranjang(){
        $id_user = auth()->user()->id;
        $jumlah_keranjang = DB::table('keranjang')
          ->where('status_keranjang','=','atc')
          ->where('user_id','like',$id_user)
          ->count();

        return $jumlah_keranjang;
    }

    public static function get_stok_ukuran(){

        $stok = 
        DB::table('stok_ukuran')
        ->where('produk_id','like',KeranjangController::$produk_id)
        ->where('ukuran_id','like',KeranjangController::$ukuran_id)
        ->select('stok_ukuran.*')
        ->get();

        return $stok;
    }

    public static function update_stok(){
        $jumlah_produk = KeranjangController::$stoka-KeranjangController::$request->jumlah_produk_keranjang;

        $stok_baru=
        DB::table('stok_ukuran')
        ->where('produk_id','like',KeranjangController::$produk_id)
        ->where('ukuran_id','like',KeranjangController::$ukuran_id)
        ->update(['jumlah_stok' => $jumlah_produk]);

        return $stok_baru;
    }

    public static function data_berat(){
        $data_berat=
        DB::table('keranjang')
        ->where('user_id','like',TransaksiController::$id_user)
        ->where('status_keranjang','=','atc')
        ->select('keranjang.*') 
        ->sum('berat_keranjang');

        return $data_berat;
    }

    public static function jumlah_pembelian(){
        $jumlah_pembelian = DB::table('keranjang')
        ->where('status_keranjang','=','atc')
        ->where('user_id','like',TransaksiController::$id_user)
        ->select('keranjang.*')
        ->sum('jumlah_produk_keranjang');

        return $jumlah_pembelian;
    }

    public static function hapus(){
        $hapus = DB::table('keranjang')
        ->where('id_keranjang','like',KeranjangController::$id_keranjang)
        ->delete();

        return $hapus;
    }

    public static function detail_transaksi_di_dari_keranjang(){
        $data_atc=
        DB::table('keranjang')
        ->where('user_id','like',TransaksiController::$id_user)
        ->where('transaksi_id','like',TransaksiController::$id_transaksi)
        ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
        ->join('produk','produk.id_produk','=','produk_id')
        ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
        ->select('keranjang.*','ukuran.*','produk.*','jenis_produk.*')
        ->get(); 

        return $data_atc;
    }

    public static function get_data_produk_konfirmasi(){
    $data_produk_konfirmasi=
        DB::table('keranjang')
        ->where('transaksi_id','like',TransaksiController::$id_transaksi)
        ->where('status_keranjang','=','checkout')
        ->join('produk','produk.id_produk','=','produk_id')
        ->join('ukuran','ukuran.id_ukuran','=','ukuran_id')
        ->join('jenis_produk','produk.jenis_produk_id','=','jenis_produk.id_jenis')
        ->select('keranjang.*','produk.nama_produk','produk.gambar_list1','produk.jenis_produk_id','produk.harga_produk2','nama_ukuran', 'nama_jenis')
        ->get();

    return $data_produk_konfirmasi;
    }
}

class TambahKeranjang extends Keranjang{
    public static function tambah(){

        $jumlah_produk= KeranjangController::$request->jumlah_produk_keranjang;
        $berat_produk = KeranjangController::$request->berat_produk;
        $berat_keranjang = $berat_produk*$jumlah_produk;
        $harga = KeranjangController::$request->harga_produk;
        $margin =$harga-KeranjangController::$request->hpp;

        $produk = new Keranjang;
        $produk->produk_id = KeranjangController::$produk_id;
        $produk->ukuran_id = KeranjangController::$ukuran_id;
        $produk->tambahan_request = KeranjangController::$request->tambahan_request;
        $produk->jumlah_produk_keranjang = $jumlah_produk;
        $produk->berat_keranjang = $berat_keranjang;
        $produk->status_keranjang = "atc";
        $produk->user_id = auth()->user()->id;
        $produk->biaya_keranjang = $jumlah_produk * $harga ;
        $produk->net_margin = $margin*$jumlah_produk;
        $produk->save(); 

        return $produk;
    }
}

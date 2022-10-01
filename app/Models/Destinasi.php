<?php

namespace App\Models;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Destinasi extends Model
{
    protected $table = 'destinasi';
    protected $fillable = [
       'id_destinasi',
       'nama',
       'no_wa',
       'alamat_tujuan',
       'kota_id',
       'provinsi_id',
       'kodepos'
    ];

    public static function hapus(){
        $hapus = DB::table('destinasi')
                ->where('id_destinasi','like',DashboardController::$id_destinasi)
                ->delete();

      return $hapus;
    }

    public static function tambah(){
        $destinasi = new Destinasi;
        $destinasi->nama=TransaksiController::$request->nama;
        $destinasi->no_wa=TransaksiController::$request->no_wa;
        $destinasi->alamat_tujuan=TransaksiController::$request->alamat_tujuan;
        $destinasi->kota_id=TransaksiController::$request->kota_tujuan;
        $destinasi->provinsi_id=TransaksiController::$request->provinsi_tujuan;
        $destinasi->kode_pos=TransaksiController::$request->kode_pos;
        $destinasi->save(); 

      return $destinasi;
    }
}

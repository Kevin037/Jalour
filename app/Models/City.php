<?php

namespace App\Models;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded =[];

    public static function get_provinsi_kota(){

    $checkout = TransaksiController::$checkout;
    $t_kota_idv = TransaksiController::$kota_id;
    $d_kota_id = DashboardController::$kota_id;
    $provinsi_kota=City::query();
    $provinsi_kota=
    City::when((!empty($checkout)),function ($query)use($t_kota_idv){
    $query->where('city_id','like',$t_kota_idv);})
    ->when((empty($checkout)),function ($query)use($d_kota_id){
    $query->where('city_id','like',$d_kota_id);})
    ->join('provinces','provinces.province_id','=','cities.province_id')
    ->select('cities.*','provinces.*')
    ->get();

    return $provinsi_kota;
    }
}

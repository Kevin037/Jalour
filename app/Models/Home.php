<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    public static $id_user;
    public $data_keranjang;
    public $total_biaya;
    public $jumlah_keranjang;
    public $produk_terlaris;
    public static $list = array();

    // public static function get_3(){
    //     self::$list = self::getdatakeranjang();
    //     self::$list = self::gettotalbiaya();
    //     self::$list = self::getjumlah_keranjang();

    //     return self::$list;
    // }

}

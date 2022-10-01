<?php

namespace App\Models;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'destinasi_id',
        'bukti_pembayaran',
        'nama_rek_pengirim',
        'email_user',
        'status_transaksi',
        'no_resi_transaksi',
        'kurir_id',
        'paket_kurir',
        'biaya_ongkir',
        'biaya_tambahan',
        'biaya_transaksi',
        'net_profit',
        'catatan_tambahan',
        'metode_pembayaran',
        'user_id',
        'snap_token',
        'tgl_transaksi',
        'tgl_jatuh_tempo',
        'tgl_kirim',
        'tgl_selesai'
    ];

    // ADMIN ===============================================
    public static function get_jumlah_pesanan_belum_bayar(){
        $jumlah_pesanan_belum_bayar = 
        DB::table('transaksi')
        ->where('status_transaksi','like','menunggu pembayaran')
        ->count();

        return $jumlah_pesanan_belum_bayar;
    }

    public static function get_jumlah_pesanan_verifikasi(){
        $jumlah_pesanan_verifikasi = 
        DB::table('transaksi')
        ->where('status_transaksi','like','Menunggu verifikasi admin')
        ->count();

        return $jumlah_pesanan_verifikasi;
    }

    public static function get_jumlah_pesanan_belum_dikirim(){
        $jumlah_pesanan_belum_dikirim = 
        DB::table('transaksi')
        ->where('status_transaksi','like','pesanan diproses')
        ->count();

        return $jumlah_pesanan_belum_dikirim;
    }

    public static function get_jumlah_pesanan_belum_diterima(){
        $jumlah_pesanan_belum_diterima = 
        DB::table('transaksi')
        ->where('status_transaksi','like','pesanan dikirim')
        ->count();

        return $jumlah_pesanan_belum_diterima;
    }
        
    public static function get_jumlah_pesanan_selesai(){
        $jumlah_pesanan_selesai = 
        DB::table('transaksi')
        ->where('status_transaksi','like','pesanan selesai')
        ->count();

        return $jumlah_pesanan_selesai;
    }     
    
    public static function get_jumlah_omset(){
        $jumlah_omset = 
        DB::table('transaksi')
        ->where('status_transaksi','like','pesanan selesai')
        ->select('transaksi.*')
        ->sum('net_profit');

        return $jumlah_omset;
    }    

    public static function get_data_pesanan_masuk(){
        $data_pesanan_masuk=
        DB::table('transaksi')
        ->where('status_transaksi','like','menunggu pembayaran')
        ->orwhere('status_transaksi','like','Menunggu verifikasi admin')
        ->join('destinasi','transaksi.destinasi_id','=','id_destinasi')
        // ->orderBy('created_at', 'DESC')
        ->select('transaksi.*','destinasi.*')
        ->get();

        return $data_pesanan_masuk;
    }    

    public static function get_data_pesanan_diproses(){
        $data_pesanan_diproses=
        DB::table('transaksi')
        ->where('status_transaksi','like','pesanan diproses')
        ->orwhere('status_transaksi','like','pesanan dikirim')
        ->join('destinasi','transaksi.destinasi_id','=','id_destinasi')
        ->select('transaksi.*','destinasi.*')
        ->orderBy('tgl_transaksi', 'asc')
        ->get();

        return $data_pesanan_diproses;
    }    

    public static function get_histori_pesanan(){
        $histori_pesanan=
        DB::table('transaksi')
        ->where('status_transaksi','like','pesanan selesai')
        ->join('destinasi','transaksi.destinasi_id','=','id_destinasi')
        ->select('transaksi.*','destinasi.*')
        ->orderBy('tgl_selesai', 'asc')
        ->get();

        return $histori_pesanan;
    }

    public static function get_pesanan_belum_bayar(){
        $data_pesanan_masuk=
        DB::table('transaksi')
        ->where('status_transaksi','like','menunggu pembayaran')
        ->join('destinasi','transaksi.destinasi_id','=','id_destinasi')
        ->orderBy('tgl_transaksi', 'desc')
        ->select('transaksi.*','destinasi.*')
        ->get();

        return $data_pesanan_masuk;
    }

    public static function get_pesanan_tunggu_verifikasi_admin(){
        $tunggu_verifikasi_admin=
        DB::table('transaksi')
        ->orwhere('status_transaksi','like','Menunggu verifikasi admin')
        ->join('destinasi','transaksi.destinasi_id','=','id_destinasi')
        ->orderBy('tgl_transaksi', 'desc')
        ->select('transaksi.*','destinasi.*')
        ->get();

        return $tunggu_verifikasi_admin;
    }

    public static function get_pesanan_belum_dikirim(){
        $pesanan_belum_dikirim=
        DB::table('transaksi')
        ->where('status_transaksi','like','pesanan diproses')
        ->join('destinasi','transaksi.destinasi_id','=','id_destinasi')
        ->select('transaksi.*','destinasi.*')
        ->orderBy('tgl_transaksi', 'asc')
        ->get();

        return $pesanan_belum_dikirim;
    }

    public static function get_pesanan_belum_diterima(){
        $pesanan_belum_diterima=
        DB::table('transaksi')
        ->orwhere('status_transaksi','like','pesanan dikirim')
        ->join('destinasi','transaksi.destinasi_id','=','id_destinasi')
        ->select('transaksi.*','destinasi.*')
        ->orderBy('tgl_transaksi', 'asc')
        ->get();

        return $pesanan_belum_diterima;
    }
    public static function do_verifikasi_admin(){
        $verifikasi_admin = 
        $verifikasi_admin=Transaksi::find(DashboardController::$id_transaksi);
        $verifikasi_admin->status_transaksi = 'pesanan diproses';
        $verifikasi_admin->save();

        return $verifikasi_admin;
    }

    public static function transaksi_form_resi(){
    $data_transaksi=
        DB::table('transaksi')
        ->where('id','like',DashboardController::$id_transaksi)
        ->join('destinasi','transaksi.destinasi_id','=','id_destinasi')
        ->select('transaksi.*','destinasi.*')
        ->get();

        return $data_transaksi;    
    }

    public static function simpan_resi(){

        $transaksi=Transaksi::find(DashboardController::$id_transaksi);
        $transaksi->status_transaksi = 'pesanan dikirim';
        $transaksi->no_resi_transaksi = DashboardController::$request->no_resi;
        $transaksi->tgl_kirim = DashboardController::$tgl;
        $transaksi->save();

        return $transaksi;
    }
    
    public static function pesanan_selesai(){

        $transaksi=Transaksi::find(DashboardController::$id_transaksi);
        $transaksi->status_transaksi = 'pesanan selesai';
        $transaksi->tgl_selesai = DashboardController::$tgl;
        $transaksi->save();

        return $transaksi;
    }

    public static function hapus(){
        $hapus = DB::table('transaksi')
                ->where('id','like',DashboardController::$id_transaksi)
                ->delete();

      return $hapus;
    }
    
    // ADMIN ===============================================

    // USER ===============================================
    public static function update_transaksi_id(){
        $transaksi_id=DB::table('keranjang')
        ->where('user_id','like',TransaksiController::$id_user)
        ->where('status_keranjang','=','atc')
        ->update(['transaksi_id' => TransaksiController::$id_transaksi_baru]);

        return $transaksi_id;
    }

    public static function update_status_keranjang(){
        $statu_keranjang=DB::table('keranjang')
        ->where('user_id','like',TransaksiController::$id_user)
        ->where('status_keranjang','=','atc')
        ->update(['status_keranjang' => 'checkout']);
    
        return $statu_keranjang;
    }

    public static function net_profit(){
        $net_profit = DB::table('keranjang')
        ->where('status_keranjang','=','checkout')
        ->where('user_id','like',TransaksiController::$id_user)
        ->where('transaksi_id','like',TransaksiController::$id_transaksi_baru)
        ->select('keranjang.*')
        ->sum('net_margin');
    
        return $net_profit;
    }

    public static function tambah_transaksi(){
        $transaksi = new Transaksi;
        $transaksi->kode_transaksi=TransaksiController::$kode_transaksi;
        $transaksi->destinasi_id=TransaksiController::$id_destinasi_baru;
        $transaksi->status_transaksi='menunggu pembayaran';
        $transaksi->kurir_id=TransaksiController::$request->data_kurir;
        // $transaksi->paket_kurir=$request->paket;
        $transaksi->biaya_ongkir=TransaksiController::$request->input_ongkir;
        $transaksi->biaya_tambahan=TransaksiController::$request->biaya_tambahan;
        $transaksi->biaya_transaksi=TransaksiController::$request->biaya_final;
        $transaksi->net_profit=TransaksiController::$net_profit-TransaksiController::$request->input_diskon;
        $transaksi->catatan_tambahan=TransaksiController::$request->catatan_tambahan;
        $transaksi->metode_pembayaran=TransaksiController::$request->metode_pembayaran;
        $transaksi->user_id=TransaksiController::$id_user;
        $transaksi->tgl_transaksi=TransaksiController::$tgl_transaksi;
        $transaksi->tgl_jatuh_tempo=TransaksiController::$tgl_jatuh_tempo;
        $transaksi->save(); 
    
        return $transaksi;
    }

    public static function get_id_transaksi_baru(){
    $id_transaksi_baru= DB::table('transaksi')
      ->where('user_id','like',TransaksiController::$id_user)
      ->max('id');

    return $id_transaksi_baru;
    }

    public static function get_transaksi_baru(){
    $transaksi_baru= DB::table('transaksi')
      ->where('id','like',self::get_id_transaksi_baru())
      ->join('destinasi','transaksi.destinasi_id','=','id_destinasi')
      ->select('transaksi.*','destinasi.*')
      ->get();
      return $transaksi_baru;
    }

    public static function list_transaksi(){
        $data=
        DB::table('transaksi')
        ->where('user_id','like',TransaksiController::$id_user)
        ->orderBy('created_at','desc')
        ->select('transaksi.*')
        ->paginate(4);

        return $data;
    }

    public static function detail_transaksi(){
        $data=
        DB::table('transaksi')
        ->where('user_id','like',TransaksiController::$id_user)
        ->where('id','like',TransaksiController::$id_transaksi)
        ->select('transaksi.*')
        ->get();

    return $data;
    }

    public static function update_pesanan_diterima(){
        $transaksi=Transaksi::find(TransaksiController::$id_transaksi);
        $transaksi->status_transaksi = 'pesanan selesai';
        $transaksi->tgl_selesai = TransaksiController::$tgl_transaksi;
        $transaksi->save();

        return $transaksi;
    }
    // USER ===============================================

    // PEMBAYARAN MIDTRANS ================================

    public function setStatusPending()
    {
        $this->attributes['status'] = 'pending';
        self::save();
    }

    /**
     * Set status to Success
     *
     * @return void
     */
    public function setStatusSuccess()
    {
        $this->attributes['status'] = 'success';
        self::save();
    }

    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setStatusFailed()
    {
        $this->attributes['status'] = 'failed';
        self::save();
    }

    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setStatusExpired()
    {
        $this->attributes['status'] = 'expired';
        self::save();
    }

    // PEMBAYARAN MIDTRANS ================================
}
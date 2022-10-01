<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Transaksi;
use App\Models\City;
use App\Models\Courier;
use App\Models\Destinasi;
use App\Models\Dotransaksi;
use App\Models\Keranjang;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public static $id_transaksi, $tgl, $request, $id_destinasi, $kota_id;

    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index(){
        $jumlah_pesanan_belum_bayar = Transaksi::get_jumlah_pesanan_belum_bayar();
        $jumlah_pesanan_verifikasi = Transaksi::get_jumlah_pesanan_verifikasi();
        $jumlah_pesanan_belum_dikirim = Transaksi::get_jumlah_pesanan_belum_dikirim();
        $jumlah_pesanan_belum_diterima = Transaksi::get_jumlah_pesanan_belum_diterima();
        $jumlah_pesanan_selesai = Transaksi::get_jumlah_pesanan_selesai();
        $jumlah_omset = Transaksi::get_jumlah_omset();

        return view('admin.home',compact('jumlah_pesanan_belum_bayar','jumlah_pesanan_verifikasi',
        'jumlah_pesanan_belum_dikirim','jumlah_pesanan_belum_diterima','jumlah_pesanan_selesai','jumlah_omset'));
    }
    public function Kota($id){
        $city = City::where('province_id',$id)->pluck('title','city_id');
        return json_encode($city);
        // dd($city);
    }   
    public function submit(Request $request){
        $biaya = Rajaongkir::ongkosKirim([
            'origin' => $request->kota_asal,
            'destination' => $request->kota_tujuan,
            'weight' => $request->berat,
            'courier' => $request->kurir,
        ])->get();
        $biaya = Rajaongkir::all();
        $status='sudahkurir';
        $hasil=$biaya[0]['costs'];
        // return $hasil['service'];
        // dd($hasil);
        $couriers = Courier::pluck('title','code');
        $provinces = Province::pluck('title','province_id');
        return view('admin.home',compact('hasil','status','provinces','couriers'));
    }

    public function pesanan_masuk(){
        $data_pesanan_masuk= Transaksi::get_data_pesanan_masuk();
        return view('admin.pesanan_masuk',compact('data_pesanan_masuk'));
    }

    public function verifikasi_admin($id){
        self::$id_transaksi = $id;
        Transaksi::do_verifikasi_admin();
        toast('Verifikasi pembayaran berhasil','success');
        return redirect('/pesanan-diproses');
    }

    public function pesanan_diproses(){
        $data_pesanan_diproses= Transaksi::get_data_pesanan_diproses();
        return view('admin.pesanan_diproses',compact('data_pesanan_diproses'));
    }
    public function form_resi($id){
        self::$id_transaksi = $id;
        $data_transaksi = Transaksi::transaksi_form_resi();
        return view('admin.form_resi',compact('data_transaksi'));
    }

    public function simpan_resi(Request $request, $id){
        self::$request = $request;
        self::$tgl=Date('Y-m-d H:i');
        self::$id_transaksi = $id;
        Transaksi::simpan_resi();

        toast('No.resi berhasil diperbarui','success');
        return redirect('pesanan-diproses');
    }
    public function pesanan_selesai($id){
        self::$id_transaksi = $id;
        self::$tgl=Date('Y-m-d H:i');
        Transaksi::pesanan_selesai();

        toast('Pesanan selesai','success');
        return redirect('/pesanan-admin');
    }
    
    public function admin_pemesanan(){
        $histori_pesanan = Transaksi::get_histori_pesanan();
        return view('admin.histori_pesanan',compact('histori_pesanan'));
    }


    // DASHBOARD

    public function pesanan_belum_bayar(){
        $data_pesanan_masuk = Transaksi::get_pesanan_belum_bayar();
        return view('admin.pesanan_masuk',compact('data_pesanan_masuk'));
    }

    public function verifikasi_pembayaran(){
        $data_pesanan_masuk = Transaksi::get_pesanan_tunggu_verifikasi_admin();
        return view('admin.pesanan_masuk',compact('data_pesanan_masuk'));
    }

    public function pesanan_belum_dikirim(){
        $data_pesanan_diproses = Transaksi::get_pesanan_belum_dikirim();
        return view('admin.pesanan_diproses',compact('data_pesanan_diproses'));
    }

    public function pesanan_belum_diterima(){
        $data_pesanan_diproses = Transaksi::get_pesanan_belum_diterima();
        return view('admin.pesanan_diproses',compact('data_pesanan_diproses'));
    }

    public function detail_pesanan($id){
        self::$id_transaksi = $id;
        
        $data_transaksi = Transaksi::transaksi_form_resi();

        // $kota=
        // DB::table('transaksi')
        // ->where('id','like',$id)
        // ->join('destinasi','id_destinasi','=','transaksi.destinasi_id')
        // ->select('destinasi.kota_id')
        // ->get();

        foreach ($data_transaksi as $data) {
            self::$kota_id=$data->kota_id;
        }
        
        $provinsi_kota= City::get_provinsi_kota();
        $data_produk = Keranjang::detail_keranjang();

        return view('admin.detail_pesanan',compact('data_transaksi','data_produk','provinsi_kota'));
    }

    public function destroy ($id)
    {
        self::$id_transaksi = $id;
        $destin = Transaksi::transaksi_form_resi();

        foreach ($destin as $destin) {
            self::$id_destinasi=$destin->destinasi_id;
        }
        Transaksi::hapus();
        Destinasi::hapus();
        return back();
    }
    // DASHBOARD
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Keranjang;
use App\Models\Destinasi;
use Illuminate\Support\Facades\DB;
use File;
use App\Models\Province;
use App\Models\User;
use App\Models\City;
use App\Models\Courier;
use App\Models\Produk;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;

class TransaksiController extends Controller
{
  public static $id_user, $request, $kota_id, $checkout, $id_transaksi_baru, $id_destinasi_baru, $tgl_jatuh_tempo, $kode_transaksi,
  $tgl_transaksi, $net_profit, $id_transaksi;
  public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function checkout(Request $request){
      self::$id_user = auth()->user()->id;
      $id_user = auth()->user()->id;
      $data_keranjang = Keranjang::keranjang_chekcout();
      $data_berat=Keranjang::data_berat();
      $jumlah_pembelian = Keranjang::jumlah_pembelian();

      $couriers = Courier::pluck('title','code');
      $provinces = Province::pluck('nama_provinsi','province_id');
      self::$request=$request;
        if ($request->kurir) {
            $biaya_total=$request->biaya_total;
            $nama=$request->nama_customer;
            $no_wa=$request->no_wa_customer;
            $provinsi_asal='6';
            $kota_asal='153';
            $provinsi_tujuan=$request->provinsi_tujuan;
            $kota_tujuan=$request->kota_tujuan;
            self::$kota_id=$kota_tujuan;
            self::$checkout="1";
            $kode_pos=$request->kode_pos;
            $alamat_tujuan=$request->alamat_tujuan;
            $berat=$request->berat;
            $kurir=$request->kurir;

            $provinsi_kota = City::get_provinsi_kota();

            $biaya = Rajaongkir::ongkosKirim([
                'origin' => $kota_asal,
                'destination' => $kota_tujuan,
                'weight' => $berat,
                'courier' => $kurir,
            ])->get();
            $hasil=$biaya[0]['costs'];
            $status='cekongkir';
            // echo $status;
            // die;
            return view('customer.checkout', compact('data_berat','biaya_total','couriers','provinces','hasil', 
            'provinsi_asal', 'kota_asal','provinsi_tujuan','kota_tujuan','berat','kurir','status',
            'provinsi_kota','nama','no_wa','kode_pos','alamat_tujuan','id_user','data_keranjang',
            'jumlah_pembelian'));
        }
        else{
          // $biaya_total=$request->biaya_total;
            $biaya_total = Keranjang::gettotalbiaya();
            $status='belum_cekongkir';
            return view('customer.checkout', compact('data_berat','biaya_total','couriers','provinces','status','id_user','data_keranjang'));
        } 
    }

    public function Kota($id){
      $city = City::where('province_id',$id)->pluck('nama_kota','city_id');
      return json_encode($city);
    }   

    public function tambah(Request $request){
      
      $id_transaksi_cek = Transaksi::max('id');
      $id_destinasi_cek = Destinasi::max('id_destinasi');

      self::$id_user = auth()->user()->id;
      self::$id_transaksi_baru = $id_transaksi_cek+1;
      self::$id_destinasi_baru = $id_destinasi_cek+1;
      self::$kode_transaksi='#TR21'.self::$id_transaksi_baru;
      
      Transaksi::update_transaksi_id();
      Transaksi::update_status_keranjang();
      self::$net_profit = Transaksi::net_profit();
      self::$tgl_transaksi=Date('Y-m-d H:i');
      self::$tgl_jatuh_tempo=date('Y-m-d H:i', strtotime('+1 days', strtotime(self::$tgl_transaksi)));
      self::$request=$request;
      
      Transaksi::tambah_transaksi();
      Destinasi::tambah();

      $nama=$request->nama;
      $total_biaya=$request->biaya_final;
      $metode_pembayaran=$request->metode_pembayaran;

      $status='selesai_checkout';
      // toast('Pesanan berhasil dibuat','success');
      return redirect('/checkout_selesai');
    }

    public function checkout_selesai(){

      self::$id_user = auth()->user()->id;
      // $id_transaksi_baru= Transaksi::get_id_transaksi_baru();
      $transaksi_baru= Transaksi::get_transaksi_baru();
      $kode=4;
      return view('customer.checkout_selesai',compact('transaksi_baru'));
    }

    public function index(){
      // $this->middleware('verified');
        $jenis_produk=1;
               $kategori=1;
               
        if(isset(auth()->user()->id)){
            self::$id_user = auth()->user()->id;
            $id_user = auth()->user()->id;
            $produk_terlaris= Produk::produkterlaris();
            $data_keranjang= Keranjang::keranjang_chekcout();
            $data = Transaksi::list_transaksi();

            $status_atc=0;
            $total_biaya = Keranjang::gettotalbiaya();
            $jumlah_keranjang = Keranjang::getjumlah_keranjang();
            return view('customer.histori_pesanan', compact('produk_terlaris','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user','status_atc'));   
          }
          else{
            
            $id_user=0;
            $jumlah_keranjang = 0;
            return view('customer.histori_pesanan', compact('data','jenis_produk','kategori','jumlah_keranjang','id_user'));
          }
    }

public function detail_transaksi($id){
    $jenis_produk=1;
    $kategori=1;
    self::$id_transaksi = $id;
    if(isset(auth()->user()->id)){
    self::$id_user = auth()->user()->id;
    $id_user = auth()->user()->id;
    
    $produk_terlaris= Produk::produkterlaris();
    $data_keranjang= Keranjang::keranjang_chekcout();
    $data= Transaksi::detail_transaksi();
    $data_atc= Keranjang::detail_transaksi_di_dari_keranjang();
    $total_biaya = Keranjang::gettotalbiaya();
    $jumlah_keranjang = Keranjang::getjumlah_keranjang();

    $status_atc=1;
    return view('customer.detail_transaksi', compact('produk_terlaris','total_biaya','data','jenis_produk','kategori','data_keranjang','jumlah_keranjang','id_user','data_atc','status_atc','id')); 
}
else{
  
  $id_user=0;
    $jumlah_keranjang = 0;
        return view('customer.detail_transaksi', compact('data','jenis_produk','kategori','jumlah_keranjang','id_user'));
  }
}

public function form_konfirmasi($id){
        self::$id_transaksi = $id;
        self::$id_user=auth()->user()->id;
        $id_user=auth()->user()->id;
        $jenis_produk=1;
        $kategori=1;

        $data= Transaksi::detail_transaksi();
        $data_keranjang= Keranjang::keranjang_chekcout();
        $data_produk_konfirmasi= Keranjang::get_data_produk_konfirmasi();
        $jumlah_keranjang = Keranjang::getjumlah_keranjang();
        $total_biaya = Keranjang::gettotalbiaya();

        return view('customer.konfirmasi_pembayaran',compact('data_produk_konfirmasi','total_biaya','data','jenis_produk','kategori','id_user','data_keranjang','jumlah_keranjang'));
}

    public function update_pembayaran(Request $request,$id){
        $transaksi=Transaksi::find($id);
        $input = $request->all();
        if($request->hasFile('bill'))
        {
          // dd( $request->file('gambar_bukti'));
          $request->validate([
            'bill' => 'image|mimes:jpg,jpeg,png|max:900'
          ]);

            $image = $request->file('bill');
            File::delete('img/testing/Pembayaran/'.$transaksi->bukti_pembayaran);
            $nama_gambar = $image->getClientOriginalName();
            $image->move('img/testing/Pembayaran/',$nama_gambar);
            $input['bill'] = $image->getClientOriginalName();
            $transaksi->bukti_pembayaran = $nama_gambar;
            $transaksi->nama_rek_pengirim=$request->nama_rek_pengirim;
            $transaksi->status_transaksi = 'Menunggu verifikasi admin';
            $transaksi->save();
        }
        toast('Konfirmasi pembayaran berhasil','success');
        return redirect('/histori_pesanan');
    }

    public function pesanan_diterima($id){
      self::$id_transaksi = $id;
      self::$tgl_transaksi=Date('Y-m-d H:i');

      Transaksi::update_pesanan_diterima();

      toast('Pesanan telah diterima','success');
      return redirect('/histori_pesanan');
  }

    // MIDTRANS =======================================
    public function store(Request $request)
    {
      // echo"test";
      // die;
        //   DB::transaction(function() use($request) {

        //   $id_transaksi_cek = Transaksi::max('id');
        //   $id_destinasi_cek = Destinasi::max('id_destinasi');

        //   self::$id_user = auth()->user()->id;
        //   self::$id_transaksi_baru = $id_transaksi_cek+1;
        //   self::$id_destinasi_baru = $id_destinasi_cek+1;
        //   self::$kode_transaksi='#TR21'.self::$id_transaksi_baru;

        //   Transaksi::update_transaksi_id();
        //   Transaksi::update_status_keranjang();
        //   self::$net_profit = Transaksi::net_profit();
        //   self::$tgl_transaksi=Date('Y-m-d H:i');
        //   self::$tgl_jatuh_tempo=date('Y-m-d H:i', strtotime('+1 days', strtotime(self::$tgl_transaksi)));
        //   self::$request=$request;
          
        //   $transaksi = Transaksi::tambah_transaksi();
        //   $destinasi = Destinasi::tambah();

        //     // $donation = Donation::create([
        //     //     'donor_name' => $request->donor_name,
        //     //     'donor_email' => $request->donor_email,
        //     //     'donation_type' => $request->donation_type,
        //     //     'amount' => floatval($request->amount),
        //     //     'note' => $request->note,
        //     // ]);

        //     $payload = [
        //         'transaction_details' => [
        //             // 'order_id'      => $transaksi->kode_transaksi,
        //             // 'gross_amount'  => $transaksi->biaya_transaksi,
        //             'order_id'      => "test123",
        //             'gross_amount'  => 80000,
        //         ],
        //         'customer_details' => [
        //             'first_name'    => $request->nama,
        //             'email'         => "ksatria708@gmail.com",
        //             // 'phone'         => '08888888888',
        //             // 'address'       => '',
        //         ],
        //         'item_details' => [
        //             [
        //                 'id'       => "99",
        //                 'price'    => 90000,
        //                 'quantity' => 1,
        //                 'name'     => "Beli kaos"
        //             ]
        //         ]
        //     ];
        //     // $snapToken = Veritrans_Snap::getSnapToken($payload);
        //     // $transaksi->snap_token = $snapToken;
        //     // $transaksi->save();

        //     $this->response['snap_token'] = $snapToken;
        // });
        $this->response['snap_token'] = $request->nama;
        return response()->json($this->response);
    }
    // MIDTRANS =======================================
}

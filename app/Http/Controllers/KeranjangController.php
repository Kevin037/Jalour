<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\TambahKeranjang;
use Illuminate\Support\Facades\Mail;

class KeranjangController extends Controller
{
    public static $produk_id, $ukuran_id, $request, $stoka, $id_keranjang;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tambah(Request $request){
        self::$request = $request;
        self::$produk_id = $request->produk_id;
        self::$ukuran_id = $request->ukuran_id;
        $id_user = auth()->user()->id;
        $stok = Keranjang::get_stok_ukuran();
        foreach ($stok as $stok ) {
            $stoka =  $stok->jumlah_stok ;
            self::$stoka = $stoka;
        }
        
        if($request->jenis_produk != '4'||'5'){
            if($request->jumlah_produk_keranjang>$stoka){
                toast('Stok tidak tersedia 
                (Pilih ukuran/produk lain)','error');
                return back();
            }
        }
        TambahKeranjang::tambah();
        
            if($request->jenis_produk != '4'||'5'){
                Keranjang::update_stok();
            }

            Mail::raw('Tambah Keranjang Berhasil', function ($message) {
                $message->to('ksatria708@gmail.com', 'Kevin Satria');
                $message->subject('Selamat, Item ini telah ditambahkan ke Keranjang');
            });

            // Mail::send('customer.kirim_email', $data, function ($message) {
            //     $message->to('john@johndoe.com', 'John Doe');
            //     $message->subject('Subject');
            // });

            toast('Berhasil ditambahkan ke keranjang','success');
            return back();
    }

    public function destroy ($id)
    {
        self::$id_keranjang = $id;
        Keranjang::hapus();
        return back();
    }

}

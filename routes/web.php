<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
// use App\Http\Controllers\GoogleController;

// EMAIL
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
// EMAIL


// RESET PASSWORD
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
// RESET PASSWORD


    Route::group(['middleware' => 'guest' ],function(){
        Route::get('/coba',function(){return view('dicoba');});
    });

    Route::get('/',[HomeController::class,'home_user']);
    Route::get('/home-user',[HomeController::class,'home_user']);
    Route::get('/tentang',[HomeController::class,'tentang']);
    Route::get('/alur_pemesanan',[HomeController::class,'alur_pemesanan']);
    Route::get('/garansi_retur',[HomeController::class,'garansi_retur']);
    Route::get('/info_konfirmasi',[HomeController::class,'info_konfirmasi']);
    Route::get('/kurir',[HomeController::class,'kurir']);
    Route::get('/page',function(){
        return view('vendor.pagination.default');
    });

    // LIST PRODUK
    Route::get('/tshirt_produk',[ProdukController::class,'tampil_tshirt']);
    Route::get('/tshirt_code',[ProdukController::class,'tshirt_code']);
    Route::get('/tshirt_tipografi',[ProdukController::class,'tshirt_tipografi']);
    Route::get('/tshirt_streetwear',[ProdukController::class,'tshirt_streetwear']);
    
    Route::get('/hoodie_produk',[ProdukController::class,'tampil_hoodie']);
    Route::get('/hoodie_code',[ProdukController::class,'hoodie_code']);
    Route::get('/hoodie_tipografi',[ProdukController::class,'hoodie_tipografi']);
    Route::get('/hoodie_ikonik',[ProdukController::class,'hoodie_ikonik']);
    
    Route::get('/crewneck_produk',[ProdukController::class,'tampil_crewneck']);
    Route::get('/crewneck_code',[ProdukController::class,'crewneck_code']);
    Route::get('/crewneck_tipografi',[ProdukController::class,'crewneck_tipografi']);
    Route::get('/crewneck_ikonik',[ProdukController::class,'crewneck_ikonik']);
    
    Route::get('/case_produk',[ProdukController::class,'tampil_case']);
    Route::get('/case_hard',[ProdukController::class,'case_hard']);
    Route::get('/case_soft',[ProdukController::class,'case_soft']);
    // LIST PRODUK
    
    // DETAIL PRODUK
    Route::get('/item_tshirt{id}',[ProdukController::class,'detail_tshirt']);
    Route::get('/item_hoodie{id}',[ProdukController::class,'detail_hoodie']);
    Route::get('/item_crewneck{id}',[ProdukController::class,'detail_crewneck']);
    Route::get('/item_case{id}',[ProdukController::class,'detail_case']);
    Route::get('/produk/{id}/ukuran/{ukuran}',[HomeController::class,'tampil_stok']);
    // DETAIL PRODUK

    Auth::routes(['verify' => true]);

    // Route::group(['middleware' => 'guest' ],function(){
    // LOGIN SOCIALITE
    Route::get('auth/google',[App\Http\Controllers\GoogleController::class,'redirectToGoogle'])->name('google.login')->middleware('guest');
    Route::get('auth/google/callback',[App\Http\Controllers\GoogleController::class,'handleGoogleCallback'])->name('google.callback')->middleware('guest');

    Route::get('auth/facebook',[App\Http\Controllers\GoogleController::class,'redirectToFacebook'])->name('facebook.login')->middleware('guest');
    Route::get('auth/facebook/callback',[App\Http\Controllers\GoogleController::class,'handleFacebookCallback'])->name('facebook.callback')->middleware('guest');
    // LOGIN SOCIALITE
    // });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/redirects', function(){
        return redirect(Redirect::intended()->getTargetUrl());
        // You can replace above line with the following to return to previous page
        return back();	// or return redirect()->back();
    });
    
Route::group(['middleware' => 'verified','customer'],function(){
    // KERANJANG
    Route::post('/tambah_keranjang',[KeranjangController::class,'tambah']);
    Route::get('/hapus_keranjang{id}',[KeranjangController::class,'destroy']);
    Route::get('/histori_pesanan',[TransaksiController::class,'index']);
    // Route::post('/tampil_atc{id}',[TransaksiController::class,'index']);
    Route::get('/detail_transaksi{id}',[TransaksiController::class,'detail_transaksi']);
    // Route::post('/checkout',[TransaksiController::class,'checkout']);
    Route::get('/checkout',[TransaksiController::class,'checkout']);
    Route::get('/coba_detail{id}/{id_user}',[TransaksiController::class,'coba_detail']);
    Route::get('/form_konfirmasi_pembayaran{id}',[TransaksiController::class,'form_konfirmasi']);
    Route::post('/update_pembayaran{id}',[TransaksiController::class,'update_pembayaran']);
    Route::get('/provinsi/{id}/kota',[TransaksiController::class,'Kota']);
    Route::post('/pengiriman_pembayaran',[TransaksiController::class,'checkout']);
    Route::post('/bayar_midtrans',[TransaksiController::class,'store']);
    Route::post('/tambah_checkout',[TransaksiController::class,'tambah']);
    Route::get('/checkout_selesai',[TransaksiController::class,'checkout_selesai']);
    Route::get('/pesanan_diterima{id}',[TransaksiController::class,'pesanan_diterima']);

    Route::post('/bayar_midtrans',[TransaksiController::class,'bayar_midtrans']);
    Route::post('/test',[TransaksiController::class,'test']);

    // KERANJANG
});

Route::group(['middleware' => 'admin'],function(){
    Route::get('/home-admin',[DashboardController::class,'index']);
    Route::get('/pesanan-masuk',[DashboardController::class,'pesanan_masuk']);
    Route::get('/pesanan-diproses',[DashboardController::class,'pesanan_diproses']);
    Route::get('/pesanan-admin',[DashboardController::class,'admin_pemesanan']);
    Route::get('/verifikasi_admin{id}',[DashboardController::class,'verifikasi_admin']);
    Route::get('/form_resi{id}',[DashboardController::class,'form_resi']);
    Route::post('/simpan_resi{id}',[DashboardController::class,'simpan_resi']);
    Route::get('/pesanan_selesai{id}',[DashboardController::class,'pesanan_selesai']);
    Route::get('/detail_pesanan{id}',[DashboardController::class,'detail_pesanan']);
    Route::get('/hapus_pesanan{id}',[DashboardController::class,'destroy']);

    Route::get('/pesanan_belum_bayar',[DashboardController::class,'pesanan_belum_bayar']);
    Route::get('/verifikasi_pembayaran',[DashboardController::class,'verifikasi_pembayaran']);
    Route::get('/pesanan_belum_dikirim',[DashboardController::class,'pesanan_belum_dikirim']);
    Route::get('/pesanan_belum_diterima',[DashboardController::class,'pesanan_belum_diterima']);
    
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'home_user'])->name('home');
// Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('role');

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//produk
Route::get('administrator/produk', 'ProdukController@index');
Route::get('administrator/produk/tambah', 'ProdukController@tambah');
Route::post('administrator/produk/simpan', 'ProdukController@simpan');
Route::get('administrator/produk/edit/{id}', 'ProdukController@edit');
Route::post('administrator/produk/ubah/{id}', 'ProdukController@ubah');
Route::get('administrator/produk/hapus/{id}', 'ProdukController@hapus');
Route::post('administrator/produk/upload_foto', 'ProdukController@upload_foto');
Route::post('administrator/produk/unlink', 'ProdukController@unlink');

//rekening
Route::get('administrator/rekening', 'RekeningPelapakController@index');
Route::get('administrator/rekening/tambah', 'RekeningPelapakController@tambah');
Route::post('administrator/rekening/simpan', 'RekeningPelapakController@simpan');
Route::get('administrator/rekening/edit/{id}', 'RekeningPelapakController@edit');
Route::post('administrator/rekening/ubah/{id}', 'RekeningPelapakController@ubah');
Route::get('administrator/rekening/hapus/{id}', 'RekeningPelapakController@hapus');

//transaksi
Route::get('administrator/transaksi', 'Pelapak\PelapakTransaksiController@index');
Route::get('administrator/transaksi/detail/{id}', 'Pelapak\PelapakTransaksiController@detail');
Route::get('adminstrator/transaksi/status/edit/{id}/{status}/{id_trx}', 'Pelapak\PelapakTransaksiController@update_status');

//web produk
Route::get('/', 'Web\ProdukWebController@index');
Route::get('produk', 'Web\ProdukWebController@produk');
Route::get('produk/popular', 'Web\ProdukWebController@popular');
Route::get('produk/{id}', 'Web\ProdukWebController@produkId');

//daftar
// Route::get('daftar', 'Web\KonsumenWebController@index');
Route::post('daftar/simpan', 'Web\KonsumenWebController@simpan')->name('daftarSimpan');
Route::get('kotaByProvinsiId/{id}', 'Web\KonsumenWebController@kotaByProvinsiId');

Auth::routes();
//reset password
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@upadate_password');
Route::post('password/update', 'Auth\ResetPasswordController@upadate_password');
Route::get('keluar', 'Auth\LoginController@keluar')->name('keluar');

//keranjang
Route::get('keranjang', 'Web\KeranjangWebController@index')->middleware('checkUserLogin');
Route::post('keranjang', 'Web\KeranjangWebController@simpan')->middleware('checkUserLogin');
Route::get('keranjang/hapus/{id}', 'Web\KeranjangWebController@hapus');
Route::post('keranjang/hitungTotal', 'Web\KeranjangWebController@hitungTotal');
Route::post('keranjang/ambilHarga', 'Web\KeranjangWebController@ambilHarga');
Route::post('keranjang/updateJumlah', 'Web\KeranjangWebController@updateJumlah');
Route::post('keranjang/go_checkout', 'Web\KeranjangWebController@go_checkout');

//checkout
Route::get('checkout', 'Web\CheckoutWebController@index');
Route::post('/simpanTransaksi', 'Web\CheckoutWebController@simpanTransaksi');
Route::get('sukses/{kodeTrx}', 'Web\CheckoutWebController@sukses')->middleware('checkUserLogin');

//konfirmasi
Route::get('konfirmasi', 'Web\KonfirmasiWebController@index')->middleware('checkUserLogin');
Route::get('konfirmasi/data', 'Web\KonfirmasiWebController@data')->middleware('checkUserLogin');
Route::post('konfirmasi/data', 'Web\KonfirmasiWebController@data');
Route::post('konfirmasi/simpan', 'Web\KonfirmasiWebController@simpan');
Route::get('konfirmasi/akun/{id}', 'Web\KonfirmasiWebController@akun');
Route::get('verified', 'Web\KonfirmasiWebController@verified');

//pesanan
Route::get('pesanan', 'Web\PesananWebController@index')->middleware('checkUserLogin');
Route::get('pesanan/detail/{id}', 'Web\PesananWebController@detail')->middleware('checkUserLogin');

//konsumen profile
Route::get('profile', 'Web\ProfileWebController@index')->name('profile')->middleware('checkUserLogin');
Route::post('profile/ubah/{role}/{id}', 'Web\ProfileWebController@ubah');
Route::get('profile/rekening', 'Web\ProfileWebController@rekening')->name('rekening');
Route::get('profile/alamat', 'Web\ProfileWebController@alamat')->name('alamat')->middleware('checkUserLogin');
Route::post('profile/alamat/simpan', 'Web\ProfileWebController@simpan_alamat');
Route::post('profile/alamat/ubah/{id}', 'Web\ProfileWebController@ubah_alamat');
Route::get('profile/alamat/hapus/{id}', 'Web\ProfileWebController@hapus_alamat');
Route::get('profile/alamat/ubah/utama/{id}', 'Web\ProfileWebController@ubah_alamat_utama');

Route::get('/home', 'HomeController@index')->name('home');

//web pelapak
Route::get('pelapak/{username}', 'Web\PelapakWebController@index')->name('halaman_pelapak');
Route::get('pelapak/{username}/produk', 'Web\PelapakWebController@produk')->name('halaman_produk_pelapak');

//pelapak
Route::get('jual', 'Pelapak\PelapakController@index');

//review
Route::post('review/produk', 'Web\ReviewWebController@postReview');
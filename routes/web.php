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



Auth::routes();
Route::get('/dashboard','homeController@index');
Route::get('/pemesananvendor','homeController@getPesanVendor');
Route::post('/pemesananvendor/{id}','homeController@tambahSuratKerja');
Route::get('/pembukuan','homeController@pembukuan');
Route::get('/pembukuan/filter','homeController@filterPembukuan');
Route::get('/pembukuan/filterPembukuanStarBuyerM','homeController@filterPembukuanStarBuyerM');
Route::get('/pembukuan/filterPembukuanStarBuyerY','homeController@filterPembukuanStarBuyerY');
Route::get('/','homeController@notifItem');
Route::get('/notifikasi','homeController@showNotif');
Route::get('/auth-customer','homeController@index');
Route::get('/auth-vendor','homeController@index');
Route::get('/ambilpesanan','homeController@ambilPesanan');

Route::get('/pengguna/aktivasi/{id}','UserController@userAkt');
Route::post('/pengguna/aktivasi/aktif/{id}','UserController@Aktivasi');
Route::post('/pengguna/aktivasi/tolak/{id}','UserController@Tolak');
Route::get('/pengguna','UserController@index');
Route::resource('users', 'UserController');
Route::post('/auth-login/register-customer','UserController@store');
Route::post('/auth-login/register-vendor','UserController@storeVendor');

Route::get('/detailitem/{id}','ItemController@edit');
Route::post('/detailitem/updateitem/{id}','ItemController@update');
Route::get('/tambahstokbarang','ItemController@create');
Route::post('/tambahstokbarang','ItemController@store');
Route::get('/gudang','ItemController@index');

Route::get('/detailvendor/{id}','VendorController@edit');
Route::post('/detailvendor/updateVendor/{id}','VendorController@update');
Route::get('/catatanvendor','VendorController@catatanVendor');
Route::get('/daftarvendor','VendorController@index');
Route::get('/tambahvendor','VendorController@create');
Route::post('/tambahvendor','VendorController@store');
Route::get('/barang-vendor','VendorController@getBarang');
Route::post('/barang-vendor','VendorController@barang');

Route::get('/daftarpemesanan','OrderVendorController@rekap');
Route::get('/daftarpemesanan/cari','OrderVendorController@filter');
Route::get('/detailpemesanan/{id}','OrderVendorController@detailPemesanan');
Route::post('/detailpemesanan/update/{id}','OrderVendorController@updatePemesanan');
Route::get('/detailpemesanan/ambilorder/{id}','OrderVendorController@getOrder');
Route::post('/detailpemesanan/ambilorder/prosesorder/{id}','OrderVendorController@prosesorder');
Route::get('/updateselesai/{id}','OrderVendorController@detaillunas');
Route::post('/updateselesai/{id}','OrderVendorController@updateselesai');
Route::get('/uploadvendor/{id}','OrderVendorController@detaillunas');
Route::post('/uploadvendor/{id}','OrderVendorController@cekBayar');
Route::get('/uploadvendorCek/{id}','OrderVendorController@cekdetaillunas');
Route::post('/uploadvendorCek/{id}','OrderVendorController@konfirmasi');
Route::get('/pesananvendor/{id}','OrderVendorController@pesananVendor');
Route::POST('/detailpemesanan/update/prosesnego/{id}','OrderVendorController@prosesnego');

Route::get('/pesananbaru','ItemCustomerController@create');
Route::post('/pesananbaru','ItemCustomerController@store');
Route::get('/daftarpesanan','ItemCustomerController@listPO');
Route::get('/daftarpesanan/cari','ItemCustomerController@filtering');
Route::get('/pelunasan','ItemCustomerController@Pelunasan');
Route::get('/ulasanrating','ItemCustomerController@rating');
Route::get('/detailpesanan/{id}','ItemCustomerController@edit');
Route::post('/detailpesanan/update/{id}','ItemCustomerController@update');
Route::post('/detailpesanan/update/prosespesanan/{id}','ItemCustomerController@prosesPesanan');
Route::post('/detailpesanan/update/tolakpesanan/{id}','ItemCustomerController@tolakPesanan');
Route::get('/detailpesanancust/{id}','ItemCustomerController@detailpescust');
Route::get('/upload/{id}', 'ItemCustomerController@detailpelunasan');
Route::get('/uploadCek/{id}', 'ItemCustomerController@cekdetailpelunasan');
Route::get('/updatelunas/{id}','ItemCustomerController@detailpelunasan');
Route::post('/updatelunas/{id}','ItemCustomerController@updateLunas');
Route::get('/pesananpelanggan/{id}','ItemCustomerController@pesananPelanggan');
Route::get('/pesananbarucust','ItemCustomerController@getPesananCust');
Route::post('/pesananbarucust','ItemCustomerController@tambahPesananCust');

Route::get('/detailpelanggan/{id}','CustomerController@edit');
Route::post('/detailpelanggan/update/{id}','CustomerController@update');
Route::get('/datapelanggan','CustomerController@index');
Route::get('/tambahcust','CustomerController@create');
Route::post('/tambahcust','CustomerController@store');
Route::get('/datapelanggan/historypelanggan/{id}','CustomerController@show');

Route::get('/gudang/export_excel','UploadController@import_excel');
Route::post('/gudang/import_excel','UploadController@import_excel');
Route::post('/upload/proses/{id}', 'UploadController@proses_upload');
Route::post('/uploadCek/proses/{id}', 'UploadController@cekproses_upload');
Route::post('/gudang/import_excel','UploadController@import_excel');
Route::post('/uploadvendor/proses_vendor/{id}','UploadController@proses_vendor');
Route::post('/uploadvendorCek/proses_vendor/{id}','UploadController@cekproses_vendor');


Route::get('/', function () {
    return redirect('/dashboard');
});
Route::get('/home', function () {
    return redirect('/dashboard');
});



Route::get('auth-login', function () {
    return view('/auth-login');
});
Route::get('auth-register', function () {
    return view('/auth-register');
});


Route::get('auth-invoice', function () {
    return view('/auth-invoice');
});


//19-9-2020






Auth::routes();


<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth.adminsiswa'])->group(function() {
    Route::get('/', 'Admin\HomeController@index');

    // Siswa
    Route::get('/siswa/kelas/{id_kelas}', 'Admin\SiswaController@index');
    Route::get('/siswa/kelas/{id_kelas}/create', 'Admin\SiswaController@create');
    Route::get('/siswa/{nisn}/lihat-spp', 'Admin\SiswaController@lihatSpp');
    Route::get('/siswa/{nisn}/bayar/{id_spp}/{month}/create', 'Admin\SiswaController@createPembayaranSpp');
    Route::post('/siswa/{nisn}/bayar/{id_spp}/{month}', 'Admin\SiswaController@storePembayaranSpp');
    Route::get('/siswa/{nisn}/bayar/{id_spp}/{month}/{id_pembayaran}', 'Admin\SiswaController@editPembayaranSpp');
    Route::put('/siswa/{nisn}/bayar/{id_spp}/{month}/{id_pembayaran}', 'Admin\SiswaController@UpdatePembayaranSpp');
    Route::get('/histori-pembayaran', 'Admin\HistoriPembayaranController@index');
    Route::get('/histori-pembayaran/cetak/index', 'Admin\HistoriPembayaranController@cetakIndex');
    Route::get('/histori-pembayaran/{id_log_pembayaran}', 'Admin\HistoriPembayaranController@show');
    Route::get('/histori-pembayaran/{id_log_pembayaran}/kuitansi', 'Admin\HistoriPembayaranController@showKuitansi');
    Route::get('/histori-pembayaran/siswa/{nisn}', 'Admin\HistoriPembayaranController@showByNisn');
    Route::get('/histori-pembayaran/siswa/{id_pembayaran}/pembayaran', 'Admin\HistoriPembayaranController@showByPembayaranId');
    Route::get('/siswa/{id_kelas}/create', 'Admin\SiswaController@create');
    Route::resource('/siswa', 'Admin\SiswaController');
    Route::resource('/tahun-ajaran', 'Admin\TahunAjaranController');
    Route::resource('/kompetensi-keahlian', 'Admin\KompetensiKeahlianController');
    Route::resource('/kelas', 'Admin\KelasController');
    Route::resource('/spp', 'Admin\SppController');
    Route::resource('/petugas', 'Admin\PetugasController');
    Route::post('/logout', 'Auth\Admin\LoginController@logout');
});

// Login 
Route::middleware(['siswa.petugas.guest'])->group(function() {
    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm');
    Route::post('/login', 'Auth\Admin\LoginController@login');
});
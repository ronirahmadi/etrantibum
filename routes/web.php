<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//karyawan wajib melakukan login
Route::middleware('auth:users')->group(function(){
    Route::get('/user/index', 'User\MainController@index')->name('user.index');
});

//admin wajib melakukan login
Route::middleware('auth:admin')->group(function(){
    Route::get('/cms-admin/index', 'Admin\MainController@index')->name('cms-admin.index');
    //profil admin
    Route::get('/cms-admin/profil', 'Admin\ProfilController@profil')->name('cms-admin.profil.index');
    //perbarui profil admin
    Route::patch('/cms-admin/profil/updateprofil', 'Admin\ProfilController@updateprofil')->name('cms-admin.profil.updateprofil');
    //upload foto profil
    Route::post('/cms-admin/profil/upfoto/', 'Admin\ProfilController@upfoto')->name('cms-admin.profil.upfoto');
    Route::patch('/cms-admin/profil/fotoprofil/{nip}', 'Admin\ProfilController@hapusfp')->name('cms-admin.profil.hapusfp');
    //update password
    Route::get('/cms-admin/profil/password', 'Admin\ProfilController@perbaruipassword')->name('cms-admin.profil.password');
    Route::patch('/cms-admin/profil/change-password', 'Admin\ProfilController@updatepassword')->name('cms-admin.change.password');
    //daftar laporan pegawai untuk admin
    Route::get('/cms-admin/data/daftarlaporan', 'Admin\MainController@daftarlaporan')->name('cms-admin.data.daftarlaporan');
    Route::get('/cms-admin/data/searchlaporan', 'Admin\MainController@daftarlaporanfilter')->name('cms-admin.data.searchlaporan');
    Route::post('/cms-admin/data/searchlaporan', 'Admin\MainController@daftarlaporan')->name('cms-admin.data.searchlaporan.get');
    //lihat laporan pegawai untuk admin
    Route::get('/cms-admin/detail/laporan/{kodeunik_laporan}', 'Admin\MainController@detaildatalaporan')->name('cms-admin.data.detail.laporan');
    //proses menghapus laporan harian
    Route::delete('/cms-admin/data/{kodeunik_laporan}', 'Admin\MainController@hapuslaporan')->name('cms-admin.data.hapuslaporan');
    //proses menghapus laporan harian di detail
    Route::delete('/cms-admin/data/detail/laporan/{kodeunik_laporan}', 'Admin\MainController@hapuslaporandidetail')->name('cms-admin.data.detail.laporan.hapuslaporan');
    
    //daftar pegawai
    Route::get('/cms-admin/data/pegawai', 'Admin\UserController@daftarpegawai')->name('cms-admin.data.daftarpegawai');
    Route::get('/cms-admin/data/detail/pegawai/{nip}', 'Admin\UserController@datadetailpegawai')->name('cms-admin.data.detail.pegawai');
    //form tambah pegawai oleh admin
    Route::get('/cms-admin/form/tambahpegawai', 'Admin\UserController@formtambahpegawai')->name('cms-admin.form.tambahpegawai');
    Route::post('/cms-admin/form/kirimdatapegawai/', 'Admin\UserController@kirimdatapegawai')->name('cms-admin.form.kirimdatapegawai');
    //proses update nama pegawai
    Route::patch('/cms-admin/data/detail/pegawai/{nip}', 'Admin\UserController@perbaruidatapegawai')->name('cms-admin.data.detail.pegawai.perbaruidatapegawai');
    //proses update password pegawai
    Route::patch('/cms-admin/data/pegawai/{nip}', 'Admin\UserController@perbaruipasswordpegawai')->name('cms-admin.data.pegawai.perbaruipasswordpegawai');
    //proses menghapus pegawai dari tabel user
    Route::delete('/cms-admin/data/pegawai/{nip}', 'Admin\UserController@hapuspegawai')->name('cms-admin.data.daftarpegawai.hapuspegawai');
    
    //daftar verifikator
    Route::get('/cms-admin/data/verifikator', 'Admin\UserController@daftarverifikator')->name('cms-admin.data.daftarverifikator');
    Route::get('/cms-admin/data/detail/verifikator/{nip}', 'Admin\UserController@datadetailverifikator')->name('cms-admin.data.detail.verifikator');
    //form tambah verifikator oleh admin
    Route::get('/cms-admin/form/tambahverifikator', 'Admin\UserController@formtambahverifikator')->name('cms-admin.form.tambahverifikator');
    Route::post('/cms-admin/form/kirimdataverifikator/', 'Admin\UserController@kirimdataverifikator')->name('cms-admin.form.kirimdataverifikator');
    //proses update nama verifikator
    Route::patch('/cms-admin/data/detail/verifikator/{nip}', 'Admin\UserController@perbaruinamaverifikator')->name('cms-admin.data.detail.verifikator.perbaruinamaverifikator');
    //proses update password verifikator
    Route::patch('/cms-admin/data/verifikator/{nip}', 'Admin\UserController@perbaruipasswordverifikator')->name('cms-admin.data.verifikator.perbaruipasswordverifikator');
    //proses menghapus verifikator
    Route::delete('/cms-admin/data/verifikator/{nip}', 'Admin\UserController@hapusverifikator')->name('cms-admin.data.daftarverifikator.hapusverifikator');

    //daftar grup
    Route::get('/cms-admin/data/grup', 'Admin\MainController@daftargrup')->name('cms-admin.data.daftargrup');
    //form tambah grup oleh admin
    Route::get('/cms-admin/form/tambahgrup', 'Admin\MainController@formtambahgrup')->name('cms-admin.form.tambahgrup');
    Route::post('/cms-admin/form/kirimdatagrup/', 'Admin\MainController@kirimdatagrup')->name('cms-admin.form.kirimdatagrup');
    //form Edit grup oleh Admin
    Route::get('/cms-admin/form/editgrup/{id}', 'Admin\MainController@editgrup')->name('cms-admin.form.editgrup');
    //proses update grup
    Route::patch('/cms-admin/form/editgrup/{id}', 'Admin\MainController@updategrup')->name('cms-admin.form.updategrup');
    //proses menghapus grup
    Route::delete('/cms-admin/data/grup/{id}', 'Admin\MainController@hapusgrup')->name('cms-admin.data.daftargrup.hapusgrup');
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\User\WebViewController;
use App\Http\Controllers\Web\Admin\AdminViewController;

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

Route::view('/gg', 'welcome');
Route::get('/', [WebViewController::class, 'login'])->name('login.page');
// Route::post('/', [WebViewController::class, 'login'])->name('login');
Route::get('/dashboard', [WebViewController::class, 'dashboard'])->name('user.dashboard');
Route::get('/pilih-tahun-anggaran', [WebViewController::class, 'pilihTahunAnggaran'])->name('pilih.tahun.anggaran');
Route::get('/kegiatan', [WebViewController::class, 'kegiatan'])->name('user.kegiatan');
Route::get('/pelaksaan', [WebViewController::class, 'pelaksanaan'])->name('user.pelaksanaan');

Route::get('/kegiatan/{id}/pelaksanaan/kelola', [WebViewController::class, 'pelaksanaanKelola'])->name('pelaksanaan.kelola');
Route::get('/kegiatan/{id}/rencana/{id2}/pencairan', [WebViewController::class, 'pencairan'])->name('pencairan');



//HALAMAN ADMIN
Route::get('admin/tahun-anggaran', [AdminViewController::class, 'tahunAnggaran'])->name('admin.tahun.anggaran');
Route::get('admin/RPD', [AdminViewController::class, 'rpd'])->name('admin.rpd');

Route::get('sesi/{id}/cetak/{kategori}', [WebViewController::class, 'cetak'])->name('cetak');

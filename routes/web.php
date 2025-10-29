<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\User\WebViewController;
use App\Http\Controllers\Web\Admin\AdminViewController;
use App\Http\Controllers\Web\SPI\SpiWebViewController;

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
Route::get('/pelaksanaan', [WebViewController::class, 'pelaksanaan'])->name('user.pelaksanaan');

Route::get('/pencairan', [WebViewController::class, 'dokumenPencairan'])->name('dokumen-pencairan');
Route::get('/pencairan/{id}/detail', [WebViewController::class, 'detail'])->name('dokumen-pencairan.detail');

Route::get('/kegiatan/{id}/pelaksanaan/kelola', [WebViewController::class, 'pelaksanaanKelola'])->name('pelaksanaan.kelola');
Route::get('/kegiatan/{id}/rencana/{id2}/pencairan', [WebViewController::class, 'pencairan'])->name('pencairan');
Route::get('/dokumen/tracking', [WebViewController::class, 'tracking'])->name('tracking');

Route::get('/anggota/{id}/kategori/{kategori}/cetak', [WebViewController::class, 'cetakPerjadin'])->name('cetak.perjadin');



//HALAMAN ADMIN
Route::get('admin/dahsboard', [AdminViewController::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/tahun-anggaran', [AdminViewController::class, 'tahunAnggaran'])->name('admin.tahun.anggaran');
Route::get('admin/RPD', [AdminViewController::class, 'rpd'])->name('admin.rpd');

Route::get('sesi/{id}/cetak/{kategori}/jenis/{jenis}', [WebViewController::class, 'cetak'])->name('cetak');

// HALAMAN SPI
Route::get('/spi/dashboard', [SpiWebViewController::class, 'dashboard'])->name('spi.dashboard');
Route::get('/spi/usulan', [SpiWebViewController::class, 'usulan'])->name('spi.usulan');
Route::get('/spi/periksa-dokumen', [SpiWebViewController::class, 'periksaDokumen'])->name('spi.periksa-dokumen');
Route::get('/spi/sesi/{sesiId}/kategori/{kategori}', [SpiWebViewController::class, 'cetak'])->name('spi.cetak');

Route::get('/spi/daftar-barang-jasa', [SpiWebViewController::class, 'barjas'])->name('spi.barjas');
Route::get('/spi/periksa-barang-jasa', [SpiWebViewController::class, 'barjasPeriksa'])->name('spi.barjas.periksa');
Route::get('/spi/barjas/{id}/cetak', [SpiWebViewController::class, 'barjasCetak'])->name('spi.barjas.cetak');

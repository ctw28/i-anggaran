<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\DaftarNominalController;
use App\Http\Controllers\PelaksanaanController;
use App\Http\Controllers\PelaksanaanDasarController;
use App\Http\Controllers\PencairanSesiController;
use App\Http\Controllers\RencanaSesiController;
use App\Http\Controllers\TahunAnggaranSesiController;
use App\Http\Controllers\TahunAnggaranDipaController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\NominalPengaturanController;
use App\Http\Controllers\BelanjaBahanController;
use App\Http\Controllers\SPI\PeriksaUsulController;
use App\Http\Controllers\SPI\PeriksaSesiController;
use App\Http\Controllers\SPI\PeriksaDaftarController;
use App\Http\Controllers\SPI\PeriksaDokumenController;
use App\Http\Controllers\SPI\PeriksaPimpinanController;
use App\Http\Controllers\PerjadinController;
use App\Http\Controllers\Perjadin\AnggotaController;
use App\Http\Controllers\Perjadin\RincianController;
use App\Http\Controllers\Perjadin\RealCostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => ['api', 'checkToken'],
], function ($router) {
    //GENERAL
    Route::get('/tahun-anggaran', [APIController::class, 'tahunAnggaran'])->name('tahun.anggaran.data');
    Route::post('/organisasi/sesi/', [APIController::class, 'setOrganisasiSesi'])->name('set.organisasi.sesi');
    Route::get('/kode-akun', [APIController::class, 'kodeAkun'])->name('kode.akun');
    Route::get('/organisasi/kategori/{kategori}', [APIController::class, 'organisasi'])->name('organisasi.data');
    Route::get('/jabatan/flag/{flag}', [APIController::class, 'jabatan'])->name('jabatan.data');
    Route::get('/organisasi/{id}/jabatan/flag/{flag}', [APIController::class, 'pejabat'])->name('pejabat.data');

    //AUTENTIKASI
    Route::post('auth', [AuthController::class, 'login'])->name('login');
    Route::post('cek-token', [AuthController::class, 'check'])->name('token.check');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('ganti-peran', [AuthController::class, 'switcRole'])->name('switch.role');

    //KEGIATAN
    Route::post('kegiatan/', [KegiatanController::class, 'index'])->name('kegiatan.data');
    Route::post('kegiatan/simpan', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::get('kegiatan/{id}', [KegiatanController::class, 'show'])->name('kegiatan.show');
    Route::get('kegiatan/{id}/hapus', [KegiatanController::class, 'delete'])->name('kegiatan.delete');

    //RPD
    Route::post('rpd/simpan', [KegiatanController::class, 'rpdstore'])->name('rpd.store');
    Route::get('rpd/{id}/data', [KegiatanController::class, 'rpdShow'])->name('rpd.show');
    Route::get('rpd/{id}/hapus', [KegiatanController::class, 'rpdDelete'])->name('rpd.delete');
    Route::post('rpd/sesi/simpan', [RencanaSesiController::class, 'store'])->name('rpd.sesi.store');

    //PELAKSANAAN
    Route::post('/pelaksanaan/simpan', [PelaksanaanController::class, 'store'])->name('pelaksanaan.store');
    Route::post('/pelaksanaan/{id}/data', [PelaksanaanController::class, 'show'])->name('pelaksanaan.show');

    //PELAKSANAAN DASAR
    Route::get('/kegiatan/{id}/pelaksanaan-dasar', [PelaksanaanDasarController::class, 'index'])->name('pelaksanaan.dasar');
    Route::post('/pelaksanaan-dasar/simpan', [PelaksanaanDasarController::class, 'store'])->name('pelaksanaan-dasar.store');
    Route::get('/pelaksanaan-dasar/{id}/hapus', [PelaksanaanDasarController::class, 'delete'])->name('pelaksanaan-dasar.delete');

    //PENCAIRAN SESI
    Route::get('/rencana/{id}/pencairan-sesi/data', [PencairanSesiController::class, 'index'])->name('pencairan-sesi.index');
    Route::post('/pencairan-sesi/simpan', [PencairanSesiController::class, 'store'])->name('pencairan-sesi.store');
    Route::get('/pencairan-sesi/{id}', [PencairanSesiController::class, 'show'])->name('pencairan-sesi.show');
    Route::get('/pencairan-sesi/{id}/delete', [PencairanSesiController::class, 'delete'])->name('pencairan-sesi.delete');

    //NOMINAL PENGATURAN
    Route::get('/pencairan-sesi/{id}/nominal-pengaturan', [NominalPengaturanController::class, 'index'])->name('pencairan-sesi.nominal-pengaturan');
    Route::post('/pencairan-sesi/{id}/nominal-pengaturan/update', [NominalPengaturanController::class, 'update'])->name('pencairan-sesi.nominal-pengaturan.update');

    //DAFTAR NOMINAL
    Route::get('/pencairan-sesi/{id}/daftar-nominal', [DaftarNominalController::class, 'index'])->name('daftar.nominal.index');
    Route::post('daftar-nominal/simpan', [DaftarNominalController::class, 'store'])->name('daftar.nominal.store');

    //BELANJA BAHAN
    Route::get('/pencairan-sesi/{id}/belanja-bahan', [BelanjaBahanController::class, 'index'])->name('belanja.bahan.index');
    Route::post('belanja-bahan/simpan', [BelanjaBahanController::class, 'store'])->name('belanja.bahan.store');

    //BELANJA BAHAN NPWP
    Route::post('belanja-bahan/npwp/update', [BelanjaBahanController::class, 'npwpUpdate'])->name('npwp.update');

    //ADMIN
    Route::get('admin/organisasi-rpd', [KegiatanController::class, 'organisasiRpd'])->name('admin.organisasi.rpd');
    Route::post('admin/kegiatan/', [KegiatanController::class, 'adminKegiatan'])->name('admin.kegiatan.data');
    Route::get('admin/tahun-anggaran-sesi/data', [TahunAnggaranSesiController::class, 'index'])->name('admin.tahun-anggaran-sesi.index');
    Route::post('admin/tahun-anggaran-sesi/simpan', [TahunAnggaranSesiController::class, 'store'])->name('admin.tahun-anggaran-sesi.store');

    Route::get('admin/tahun-anggaran-dipa/data', [TahunAnggaranDipaController::class, 'index'])->name('admin.tahun-anggaran-dipa.index');
    Route::post('admin/tahun-anggaran-dipa/simpan', [TahunAnggaranDipaController::class, 'store'])->name('admin.tahun-anggaran-dipa.store');

    // SPI
    //PERIKSA USUL
    Route::post('spi/daftar-usulan', [PeriksaUsulController::class, 'index'])->name('spi.daftar-usulan');
    Route::post('spi/daftar-usulan/simpan', [PeriksaUsulController::class, 'store'])->name('spi.daftar-usulan.store');

    //PERIKSA SESI
    Route::post('periksa-sesi/', [PeriksaSesiController::class, 'index'])->name('periksa.sesi.index');
    Route::post('periksa-sesi/simpan', [PeriksaSesiController::class, 'store'])->name('periksa.sesi.store');
    Route::post('periksa-sesi/{id}/update', [PeriksaSesiController::class, 'update'])->name('periksa.sesi.update');

    //PERIKSA DAFTAR
    Route::get('periksa-daftar/{id}/daftar/', [PeriksaDaftarController::class, 'index'])->name('periksa.daftar.index');
    // Route::post('periksa-daftar/simpan', [PeriksaDaftarController::class, 'store'])->name('periksa.daftar.store');

    //PERIKSA DOKUMEN
    Route::post('periksa-daftar/simpan', [PeriksaDokumenController::class, 'store'])->name('periksa-dokumen.store');
    Route::post('periksa-daftar/{id}/delete', [PeriksaDokumenController::class, 'delete'])->name('periksa-dokumen.delete');
    Route::post('periksa-daftar/history', [PeriksaDokumenController::class, 'history'])->name('periksa-dokumen.story');

    //PERIKSA PIMPINAN
    Route::get('periksa-pimpinan', [PeriksaPimpinanController::class, 'index'])->name('periksa-pimpinan.index');
    Route::post('periksa-pimpinan/simpan', [PeriksaPimpinanController::class, 'store'])->name('periksa-pimpinan.store');

    //PERJADIN
    Route::get('pencairan-sesi/{id}/perjadin', [PerjadinController::class, 'index'])->name('perjadin.index');
    Route::post('perjadin/simpan', [PerjadinController::class, 'store'])->name('perjadin.store');
    Route::get('perjadin/{id}', [PerjadinController::class, 'show'])->name('perjadin.show');
    Route::get('perjadin/{id}/hapus', [PerjadinController::class, 'delete'])->name('perjadin.delete');

    //PERJADIN ANGGOTA
    Route::get('perjadin-anggota/{id}/data', [AnggotaController::class, 'index'])->name('perjadin.anggota.index');
    Route::post('perjadin-anggota/simpan', [AnggotaController::class, 'store'])->name('perjadin.anggota.store');

    //PERJADIN RINCIAN
    Route::get('perjadin/{id}/perjadin-rincian/{anggotaId}/data', [RincianController::class, 'index'])->name('perjadin.rincian.index');
    Route::post('perjadin-rincian/simpan', [RincianController::class, 'store'])->name('perjadin.rincian.store');

    //PERJADIN REAL COST
    Route::get('perjadin-real-cost/{anggotaId}/data', [RealCostController::class, 'index'])->name('perjadin.real-cost.index');
    Route::post('perjadin-real-cost/simpan', [RealCostController::class, 'store'])->name('perjadin.real-cost.store');
    Route::post('perjadin-real-cost/delete', [RealCostController::class, 'delete'])->name('perjadin.real-cost.delete');
});

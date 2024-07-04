<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Authentication\PanitiaRegisterController;
use App\Http\Controllers\Authentication\PengujiRegisterController;
use App\Http\Controllers\Authentication\SantriRegisterController;
use App\Http\Controllers\PanitiaDashboardController;
use App\Http\Controllers\PengujiDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\Setoran\SantriVerifiedSetoranController;
use App\Http\Controllers\Setoran\SetoranController;
use App\Http\Controllers\Ujian\SantriVerifiedUjianController;
use App\Http\Controllers\Ujian\UjianController;
use App\Models\SantriVerifiedSetoran;
use App\Models\SantriVerifiedUjian;
use App\Models\Setoran;
use App\Models\Ujian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing.index');
})->name('home');

Route::get('/santri/register', [SantriRegisterController::class, 'create'])->name('santri.create');
Route::post('/santri/register', [SantriRegisterController::class, 'store'])->name('santri.store');
Route::get('/penguji/register', [PengujiRegisterController::class, 'create'])->name('penguji.create');
Route::post('/penguji/register', [PengujiRegisterController::class, 'store'])->name('penguji.store');
Route::get('/panitia/register', [PanitiaRegisterController::class, 'create'])->name('panitia.create');
Route::post('/panitia/register', [PanitiaRegisterController::class, 'store'])->name('panitia.store');

Route::resource('/setoran', SetoranController::class);

Route::resource('/ujian', UjianController::class);

Route::get('/santri/verified/setoran', [SantriVerifiedSetoranController::class, 'index'])->name('santri-verified-setoran.index');
Route::post('/santri/verified/setoran', [SantriVerifiedSetoranController::class, 'store'])->name('santri-verified-setoran.store');
Route::put('/santri/verified/setoran/{santriVerifiedSetoran}', [SantriVerifiedSetoranController::class, 'update'])->name('santri-verified-setoran.update');

Route::get('/santri/verified/ujian', [SantriVerifiedUjianController::class, 'index'])->name('santri-verified-ujian.index');
Route::post('/santri/verified/ujian', [SantriVerifiedUjianController::class, 'store'])->name('santri-verified-ujian.store');
Route::put('/santri/verified/ujian/{santriVerifiedUjian}', [SantriVerifiedUjianController::class, 'update'])->name('santri-verified-ujian.update');
Route::put('/santri/done/ujian/{santriVerifiedUjian}', [SantriVerifiedUjianController::class, 'updateDone'])->name('santri-verified-ujian.update.done');


Route::get('/santri/setoran', [SetoranController::class, 'indexSantriSetoran'])->name('dashboard.santri');

Route::get('/santri/ujian', [SetoranController::class, 'indexSantriUjian'])->name('dashboard.santri.ujian.index');

Route::get('/santri/detail-ujian/{ujian}', [SantriController::class, 'detailUjian'])->name('dashboard.santri.detail');

Route::get('/santri/setoran/{id}', [SantriController::class, 'indexNilaiSetoran'])->name('dashboard.santri.setoran');

Route::get('/santri/ujian/{id}', [SantriController::class, 'indexNilaiUjian'])->name('dashboard.santri.ujian');

Route::get('/santri/ujian/pengumuman/{ujianVerified}', [SantriController::class, 'indexPengumuman'])->name('dashboard.santri.pengumuman');

Route::get('/penguji', function () {
    $setoran = Setoran::where('penguji_id', Auth::user()->penguji->id)->get();

    $ujian = Ujian::where('penguji_id', Auth::user()->penguji->id)->get();

    $ujianSubQuery = SantriVerifiedUjian::select(DB::raw('MAX(id) as id'))
        ->groupBy('santri_id');

    $setoranSubQuery = SantriVerifiedSetoran::select(DB::raw('MAX(id) as id'))
        ->groupBy('santri_id');

    $pendaftaranSetoran = SantriVerifiedSetoran::whereIn('id', $setoranSubQuery)->get();

    $pendaftaranUjian = SantriVerifiedUjian::whereIn('id', $ujianSubQuery)->where('panitia_done', null)->orWhere('penguji_done', null)->get();

    $ujianDiterima = SantriVerifiedUjian::whereIn('id', $ujianSubQuery)
        ->where('panitia_verified', true)
        ->where('penguji_verified', true)
        ->get();


    $setoran->load('penguji.user', 'santri.user', 'nilais');
    $ujian->load('penguji.user', 'santri.user', 'nilais');

    return view('dashboard.penguji', compact('setoran', 'pendaftaranSetoran', 'ujian', 'pendaftaranUjian', 'ujianDiterima'));
})->name('dashboard.penguji');

Route::get('/peguji/setoran/{id}', [PengujiDashboardController::class, 'indexDetailSantri'])->name('dashboard.penguji.detail-santri');

Route::get('/peguji/ujian/{id}', [PengujiDashboardController::class, 'indexDetailUjian'])->name('dashboard.penguji.detail-ujian');

Route::get('/penguji/setoran', [SetoranController::class, 'create'])->name('dashboard.penguji.setoran.create');

Route::get('/penguji/setoran/{setoran}', [SetoranController::class, 'edit'])->name('dashboard.penguji.setoran.update');

Route::put('/ujian/panitia/{ujian}', [UjianController::class, 'updatePanitia'])->name('ujian.update.panitia');

Route::get('/penguji/ujian', [UjianController::class, 'create'])->name('dashboard.penguji.ujian.create');

Route::get('/penguji/ujian/{ujian}', [UjianController::class, 'edit'])->name('dashboard.penguji.ujian.update');

Route::get('/panitia/ujian', [PanitiaDashboardController::class, 'indexUjianSantri'])->name('dashboard.panitia.ujian');

Route::get('/panitia/pendaftaran-ujian', [PanitiaDashboardController::class, 'indexPendaftaranUjian'])->name('dashboard.panitia.pendaftaran-ujian');

Route::get('/panitia/pendaftaran-setoran', [PanitiaDashboardController::class, 'indexPendaftaranSetoran'])->name('dashboard.panitia');

Route::get('/panitia/create-ujian', [PanitiaDashboardController::class, 'createUjian'])->name('dashboard.panitia.ujian.create');

Route::get('/panitia/edit-ujian/{ujian}', [PanitiaDashboardController::class, 'editUjian'])->name('dashboard.panitia.ujian.edit');

Route::get('/panitia/pendaftaran-setoran/{id}', [PanitiaDashboardController::class, 'indexSetoran'])->name('dashboard.panitia.pendaftaranSetoran');

Route::get('/panitia/pendaftaran-ujian/{id}', [PanitiaDashboardController::class, 'indexUjian'])->name('dashboard.panitia.pendaftaranUjian');

Route::get('/departemen-mudarosah', function () {
    return view('landing.departemen_mudarosah');
})->name('departemen.mudarosah');

Route::get('/departemen-munaqosyah', function () {
    return view('landing.departemen_munaqosyah');
})->name('departemen.munaqosyah');

Route::get('/departemen-syiar', function () {
    return view('landing.departemen_syiar');
})->name('departemen.syiar');

Route::get('/departemen-tahfidz', function () {
    return view('landing.departemen_tahfidz');
})->name('departemen.tahfidz');

Route::get('/departemen-ukhuwah', function () {
    return view('landing.departemen_ukhuwah');
})->name('departemen.ukhuwah');

Route::get('/publikasi', function () {
    return view('landing.publikasi');
})->name('publikasi');

Route::get('/program-tahfidz', function () {
    return view('landing.tahfidz');
})->name('program.tahfidz');


Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
    Route::get('/admin/setoran', [AdminDashboardController::class, 'index_setoran'])->name('dashboard.admin.setoran');
    Route::get('/admin/ujian', [AdminDashboardController::class, 'indexUjian'])->name('dashboard.admin.ujian');

    Route::get('/admin/setoran-penguji/{id}', [AdminDashboardController::class, 'editSetoranPenguji'])->name('dashboard.admin.setoran-penguji');
    Route::get('/admin/setoran-panitia/{id}', [AdminDashboardController::class, 'editSetoranPanitia'])->name('dashboard.admin.setoran-panitia');

    Route::get('/admin/ujian-penguji/{id}', [AdminDashboardController::class, 'editUjianPenguji'])->name('dashboard.admin.ujian-penguji');
    Route::get('/admin/ujian-panitia/{id}', [AdminDashboardController::class, 'editUjianPanitia'])->name('dashboard.admin.ujian-panitia');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require_once __DIR__ . '/auth.php';

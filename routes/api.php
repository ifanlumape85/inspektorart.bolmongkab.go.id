<?php

use App\Http\Controllers\Api\DisposisiLayananController;
use App\Http\Controllers\Api\DisposisiPengaduanController;
use App\Http\Controllers\Api\JenisController;
use App\Http\Controllers\Api\JenisLayananController;
use App\Http\Controllers\Api\LayananController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\PihakTerkaitController;
use App\Http\Controllers\Api\TanggapanLayananController;
use App\Http\Controllers\Api\TanggapanPengaduanController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('news', [NewsController::class, 'index']);

Route::post('users', [UserController::class, 'index']);
Route::post('login', [UserController::class, 'login']);
Route::post('change_profile', [UserController::class, 'update']);
Route::post('logout', [UserController::class, 'logout']);
Route::post('register', [UserController::class, 'store']);

Route::post('pengaduans', [PengaduanController::class, 'index']);
Route::post('layanans', [LayananController::class, 'index']);

Route::post('store_disposisi_layanan', [DisposisiLayananController::class, 'store']);
Route::post('store_disposisi_pengaduan', [DisposisiPengaduanController::class, 'store']);

Route::post('store_tanggapan_layanan', [TanggapanLayananController::class, 'store']);
Route::post('store_tanggapan_pengaduan', [TanggapanPengaduanController::class, 'store']);

Route::post('store_layanan', [LayananController::class, 'store']);
Route::post('update_layanan', [LayananController::class, 'update']);
Route::post('destroy_layanan', [LayananController::class, 'destroy']);

Route::post('store_pengaduan', [PengaduanController::class, 'store']);
Route::post('update_pengaduan', [PengaduanController::class, 'update']);
Route::post('destroy_pengaduan', [PengaduanController::class, 'destroy']);

Route::post('store_pihak_terkait', [PihakTerkaitController::class, 'store']);
Route::post('update_pihak_terkait', [PihakTerkaitController::class, 'update']);
Route::post('destroy_pihak_terkait', [PihakTerkaitController::class, 'destroy']);

Route::post('jenis', [JenisController::class, 'index']);
Route::post('jenis_layanans', [JenisLayananController::class, 'index']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

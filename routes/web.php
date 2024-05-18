<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\KMeansController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MapController;

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
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('actionlogin', [AuthController::class, 'actionlogin'])->name('actionlogin');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register/action', [AuthController::class, 'actionregister'])->name('actionregister');

Route::get('actionlogout', [AuthController::class, 'actionlogout'])
    ->name('actionlogout')
    ->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
});

//Route Map
Route::get('/maps', [MapController::class, 'Map']);

// Route::get('/maps', function () {
//     return view('maps');
// });

// Route::get('/geojson', function () {
//     return response()->file(resource_path('maps/geojson.geojson'));
// });

//Route Kabupaten
Route::get('/kabupaten', [KabupatenController::class, 'index']);
Route::get('/kabupaten/kabupaten_tambah', [KabupatenController::class, 'kabupaten_tambah']);
Route::post('/kabupaten/kabupaten_store', [KabupatenController::class, 'kabupaten_store']);
Route::get('/kabupaten/kabupaten_edit/{nama_kabupaten}', [KabupatenController::class, 'kabupaten_edit']);
Route::post('/kabupaten/kabupaten_update', [KabupatenController::class, 'kabupaten_update']);
Route::get('/kabupaten/kabupaten_hapus/{nama_kabupaten}', [KabupatenController::class, 'kabupaten_hapus']);

//Route Produksi
Route::get('/produksi', [ProduksiController::class, 'index']);
Route::get('/produksi/produksi_tambah', [ProduksiController::class, 'produksi_tambah']);
Route::post('/produksi/produksi_store', [ProduksiController::class, 'produksi_store']);
Route::get('/produksi/produksi_edit/{produksi}', [ProduksiController::class, 'produksi_edit']);
Route::post('/produksi/produksi_update', [ProduksiController::class, 'produksi_update']);
Route::get('/produksi/produksi_hapus/{produksi}', [ProduksiController::class, 'produksi_hapus']);
Route::post('/produksi/filter', [ProduksiController::class, 'filterProses'])->name('produksi.filter');

// Route::get('/kmeans', [KMeansController::class, 'kMeansClustering']);
// Route::get('/kmeans', [KMeansController::class, 'kMeansClustering']);

Route::get('/tampil_clustering', [KMeansController::class, 'index']);
Route::post('/clustering', [KMeansController::class, 'kMeansClustering'])->name('clustering');
Route::post('/clustering/filter', [KMeansController::class, 'filterClusteringByYear']);


<?php

use App\Http\Controllers\OutputController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PPKController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PPKController::class, 'index']);
Route::get('/ppk', [PPKController::class, 'getAllPPK'])->name('PPK');
Route::post('/ppk/insert', [PPKController::class, 'insertPPK']);
Route::post('/ppk/update/{id_ppk}', [PPKController::class, 'updatePPK']);
Route::get('/ppk/delete/{id_ppk}', [PPKController::class, 'deletePPK']);

Route::get('/paket', [PaketController::class, 'getAllPaket'])->name('Paket');
Route::post('/paket/insert', [PaketController::class, 'insertPaket']);
Route::get('/paket/detail/{id_paket_pekerjaan}', [PaketController::class, 'displayDetailPaket']);
Route::get('/paket/detail/{id_paket_pekerjaan}/search', [PaketController::class, 'searchOutput']);
Route::post('/paket/update/{id_paket_pekerjaan}', [PaketController::class, 'updatePaket']);
Route::get('/paket/delete/{id_paket_pekerjaan}', [PaketController::class, 'deletePaket']);
Route::get('/paket/search', [PaketController::class, 'searchPaket']);

Route::post('/output/insert/{id_paket_pekerjaan}', [OutputController::class, 'insertOutput']);
Route::post('/output/update/{id_paket_pekerjaan}/{id_rincian_output}', [OutputController::class, 'updateOutput']);
Route::get('/output/delete/{id_paket_pekerjaan}/{id_rincian_output}', [OutputController::class, 'deleteOutput']);

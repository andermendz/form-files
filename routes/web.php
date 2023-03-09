<?php

use App\Http\Controllers\saveFilesController;
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
// obtener
route::get('/', [saveFilesController::class,'index']);
// guardar
route::post('/saveFile', [saveFilesController::class,'saveFile'])->name('saveFile');
// eliminar
route::post('/delete/{id}', [saveFilesController::class,'delete'])->name('delete');


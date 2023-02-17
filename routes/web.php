<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImporterController;
use App\Http\Controllers\ProductsController;
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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [\App\Http\Controllers\LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'doLogin'])->name('login');
Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'doLogout'])->name('logout');

Route::resources([
    'categories' => CategoryController::class,
]);

Route::resource('importer', \App\Http\Controllers\ImporterController::class);
Route::get('importer/{id}/settings', [ImporterController::class, 'settings'])->name('importer.settings');
Route::post('importer/{id}/settings', [ImporterController::class, 'settingStore'])->name('importer.settings.store');
Route::get('importer/{id}/run-import', [ImporterController::class, 'runImport'])->name('importer.run.import');
Route::get('importer/{id}/view-products', [ImporterController::class, 'viewProducts'])->name('importer.view.products');
Route::get('importer/{id}/delete-products', [ImporterController::class, 'deleteProducts'])->name('importer.delete.products');


<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProfileController;
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
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get("/dashboard",[HomeController::class,"index"])->middleware(["auth"])->name("dashboard");
/*------------------------------------------------------- */
Route::middleware(['auth','user-role:admin'])->group(function()
{
    Route::resource("/dashboard/admin",AdminController::class);
    Route::match(['get', 'post'], '/admin-utilisateurs', [AdminController::class, 'getUtilistauer'])->name("admin-utilisateurs");
    Route::resource("/admin-reclamation",ReclamationController::class);
    Route::resource("/admin-catalogue",CatalogueController::class);
    Route::resource("/admin-commande",CommandeController::class);
    Route::resource("/admin-livraison",LivraisonController::class);
    Route::resource("/admin-paiement",PaiementController::class);


});
/*------------------------------------------------------- */
Route::middleware(['auth','user-role:client'])->group(function()
{
    Route::resource("/dashboard/client",ClientController::class);
    Route::resource("/client/reclamation",ReclamationController::class);
    Route::resource("/client/commande",CommandeController::class);
});
/*------------------------------------------------------- */
Route::middleware(['auth','user-role:fournisseur'])->group(function()
{
    Route::resource("/dashboard/fournisseur",FournisseurController::class);
    Route::resource("/fournisseur/catalogue",CatalogueController::class);
});
/*------------------------------------------------------- */
Route::middleware(['auth','user-role:livreur'])->group(function()
{
    Route::resource("/dashboard/livreur",LivreurController::class);
    Route::resource("/livreur-livraison",LivraisonController::class);
});
/*------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

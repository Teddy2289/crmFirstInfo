<?php
use App\Http\Controllers\CategoriedepenseController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'parametrages', 'middleware' => 'auth'], function(){
    Route::get('categorie_depense', [CategoriedepenseController::class, 'page'])->name('parametrages.categorie_depenses');
});


Route::group(['prefix' => 'security', 'middleware' => 'auth'], function(){
    Route::get('users', [PagesController::class, 'userPage'])->name('security.users');
    Route::get('role', [PagesController::class, 'rolePage'])->name('security.role');
    Route::get('permission', [PagesController::class, 'permissionPage'])->name('security.permission');
});


Route::group(['prefix' => 'esn', 'middleware' => 'auth'], function(){
    Route::get('company', [PagesController::class, 'companyPage'])->name('esn.company');
    Route::get('client', [PagesController::class, 'clientPage'])->name('esn.client');
    Route::get('techno', [PagesController::class,'technologyPage'])->name('esn.technology');
});

Route::group(['prefix' => 'gestionEmploye', 'middleware' => 'auth'], function(){
    Route::get('employe', [PagesController::class, 'employePage'])->name('gestionEmploye.employe');
});

Route::group(['prefix' => 'facturation', 'middleware' => 'auth'], function(){
    Route::get('contract', [PagesController::class, 'contractPage'])->name('facturation.contract');
});




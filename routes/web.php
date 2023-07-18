<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
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
Route::get('/', function () {
    return view('welcome');
});
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');;

// Admin Routes
Route::middleware(['auth','user-role:admin'])->group(function()
{
    Route::get('/publisher', [App\Http\Controllers\pagesController::class, 'publisher'])->name('publisher');
    Route::get('/subscriber', [App\Http\Controllers\pagesController::class, 'subscriber'])->name('subscriber');
    Route::get('/pendingAd', [App\Http\Controllers\pagesController::class, 'PendingAd'])->name('pendingAd');
    Route::get('/approvedAd', [App\Http\Controllers\pagesController::class, 'ApprovedAd'])->name('approvedAd');
    Route::get('/History', [App\Http\Controllers\pagesController::class, 'HistoryAd'])->name('History');
    Route::get('/deletePublisher/{id}', [App\Http\Controllers\adminController::class, 'deletePublisher'])->name('deletePublisher');
    Route::post('/Createpublisher', [App\Http\Controllers\adminController::class,'createUser'])->name('admin.users.create');
    Route::get("/CHECK", [App\Http\Controllers\adminController::class, 'VerifierExistance']);
    Route::post('/createSubscriber', [App\Http\Controllers\adminController::class,'createSubscriber'])->name('admin.subscribers.create');
    Route::get('/deleteSubscriber/{id}', [App\Http\Controllers\adminController::class, 'deleteSubscriber'])->name('deleteSubscriber');
    Route::post('admin/ads/{id}/validate', 'App\Http\Controllers\pagesController@validateAd')->name('admin.ads.validate');
    Route::post('admin/ads/{id}/reject', 'App\Http\Controllers\pagesController@rejectAd')->name('admin.ads.reject');
    Route::get('/dashboard', [App\Http\Controllers\pagesController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/advertisements/{id}', 'App\Http\Controllers\adminController@show')->name('admin.advertisements.show');

// Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
 // Permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');
});
// Publisher Routes
Route::middleware(['auth','user-role:publisher'])->group(function()
{
    Route::get('/publisher/cafe', [App\Http\Controllers\pagesController::class, 'PublisherCafe'])->name('PublisherCafe');
    Route::get('/adsList', [App\Http\Controllers\pagesController::class, 'PublisherAds'])->name('PublisherAds');
    Route::get('/NewAd', [App\Http\Controllers\pagesController::class, 'NewAd'])->name('NewAd');
    Route::post("/createAd", [App\Http\Controllers\adminController::class, 'createAd'])->name('createAd');
    Route::get('/get-category', [App\Http\Controllers\adminController::class,'getCategory']);
});

// Publisher Routes
Route::middleware(['auth','user-role:subscriber'])->group(function()
{

    Route::get('/ashtrays', [App\Http\Controllers\pagesController::class, 'showAshtrays'])->name('ashtrays.show');
    Route::post("/CreateReport", [App\Http\Controllers\ReportController::class, 'CreateReport'])->name('CreateReport');
    Route::post("/BreakdownAlert", [App\Http\Controllers\BreakdownController::class, 'BreakdownAlert'])->name('BreakdownAlert');


});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


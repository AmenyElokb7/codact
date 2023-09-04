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
Route::get('/cafe', function () {
    return view('design');
});

// Define the API endpoint to send the picture URL to ESP32
Route::post('/send-picture-url', 'ESP32Controller@sendPictureURL');
Route::post( '/deleteUser' , [App\Http\Controllers\pagesController:: class , 'deleteUser' ])->middleware( 'web' ); 

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::get('/resetmethod', function () {
        return view('auth/resetmethod');
    });
    Route::get('/forgetpasswordsms', function () {
        $phone="";
        return view('auth/forgetpasswordsms',compact('phone'));
    });
    Route::get('/setnewpassword/{link}',  [App\Http\Controllers\pagesController::class, 'showsetnewpassword'])->name('showsetnewpassword');

    Route::post('/newpassword', [App\Http\Controllers\pagesController::class, 'Setnewpassword'])->name('newpassword');

    Route::post('/sendsms', [App\Http\Controllers\pagesController::class, 'sendsms'])->name('sendsms');
    Route::post('/methodreset', [App\Http\Controllers\pagesController::class, 'methodreset'])->name('methodreset');

    Route::get('/forgetpassword', function () {
        $email="";
        return view('auth/forgetpassword',compact('email'));
    });
    Route::post('/sendemail', [App\Http\Controllers\pagesController::class, 'sendEmail'])->name('sendemail');
    Route::get('/checkkey', [App\Http\Controllers\pagesController::class, 'showcheckkey'])->name('checkkey');
    Route::post('/postcheckkey', [App\Http\Controllers\pagesController::class, 'checkKey'])->name('postcheckkey');
// Admin Routes
Route::middleware(['auth', 'user-role:publisher,admin'])->group(function() {
    Route::get('/EditProfile', [App\Http\Controllers\pagesController::class,'EditProfile'])->name('EditProfile');
    Route::post('/user/{user}', [App\Http\Controllers\pagesController::class,'updateprofile'])->name('updateprofile');
    });
Route::middleware(['auth','user-role:admin'])->group(function()
{

// transaction
Route::get('/Historic', [App\Http\Controllers\pagesController::class,'hisorictransaction'])->name('hisorictransaction');
Route::get('/sendmoney', [App\Http\Controllers\pagesController::class, 'sendmoney'])->name('sendmoney');
Route::post('/sendtouser', [App\Http\Controllers\pagesController::class, 'sendtouser'])->name('sendtouser');
Route::get('/approvedtransaction', [App\Http\Controllers\pagesController::class, 'approvedtransaction'])->name('approvedtransaction');
Route::get('/acceptedtransaction', [App\Http\Controllers\pagesController::class, 'acceptedtransaction'])->name('acceptedtransaction');
Route::get('/pendingtransaction', [App\Http\Controllers\pagesController::class, 'pendingtransaction'])->name('pendingtransaction');
Route::post('/rejectofflinetransaction', [App\Http\Controllers\pagesController::class, 'rejectofflinetransaction'])->name('rejectofflinetransaction');
Route::post('/sendtouserfromoffline', [App\Http\Controllers\pagesController::class, 'sendtouserfromoffline'])->name('sendtouserfromoffline');
Route::get('/offlinetransaction', [App\Http\Controllers\pagesController::class, 'offlinet_transaction'])->name('offlinet_transaction');
Route::get('/Transaction', [App\Http\Controllers\pagesController::class,'adminTransactions'])->name('adminTransactions');
// *****************



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
    Route::get('/advertisements/{id}/pause', 'App\Http\Controllers\adminController@pause')->name('pause-ad');
    Route::get('/advertisements/{id}/resume', 'App\Http\Controllers\adminController@resume')->name('resume-ad');
    Route::get('/categories', 'App\Http\Controllers\pagesController@adminCategories')->name('admin.categories');
    Route::post('/categoryCreate', 'App\Http\Controllers\adminController@createCategory')->name('admin.category.create');
    Route::get('/categories/{category}/edit', 'App\Http\Controllers\adminController@editCategory')->name('categories.edit');
    Route::delete('/categories/{category}', 'App\Http\Controllers\adminController@destroyCategory')->name('categories.destroy');
    
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
Route::get('admin/Notifications', 'App\Http\Controllers\pagesController@NotificationsAdmin')->name('notifications');

// Publisher Routes
Route::middleware(['auth','user-role:publisher'])->group(function()
{
    Route::get('/publisher/cafe', [App\Http\Controllers\pagesController::class, 'PublisherCafe'])->name('PublisherCafe');
    Route::get('/adsList', [App\Http\Controllers\pagesController::class, 'PublisherAds'])->name('PublisherAds');
    Route::get('/NewAd', [App\Http\Controllers\pagesController::class, 'NewAd'])->name('NewAd');
    Route::post("/createAd", [App\Http\Controllers\adminController::class, 'createAd'])->name('createAd');
    Route::get('/get-category', [App\Http\Controllers\adminController::class,'getCategory']);
    Route::get('/filtered-ads', 'App\Http\Controllers\adminController@filteredAds')->name('filteredAds');
    Route::get('/coffe', [App\Http\Controllers\pagesController::class, 'showpreview'])->name('showpreview');

    Route::get('/Financalsummary', [App\Http\Controllers\pagesController::class, 'Financalsummary'])->name('Financalsummary');
    Route::get('/payads', [App\Http\Controllers\pagesController::class, 'payads'])->name('payads');
    Route::get('/Transactions', [App\Http\Controllers\pagesController::class,'Transactions'])->name('Transactions');
    Route::post('/transactionoffline', [App\Http\Controllers\pagesController::class, 'transaction_offline'])->name('transaction_offline');
    Route::post('/sendpayment', [App\Http\Controllers\pagesController::class, 'sendpayment'])->name('sendpayment');
    Route::get('/Transactions', [App\Http\Controllers\pagesController::class,'Transactions'])->name('Transactions');
    Route :: post( '/deleteofflinetransaction' , [App\Http\Controllers\pagesController :: class , 'deleteofflinetransaction' ])->name( 'deleteofflinetransaction' );
    Route ::get( '/editofflinetransaction/{id}' , [App\Http\Controllers\pagesController:: class , 'editofflinetransaction' ])->name( 'editofflinetransaction' );
    Route::post('/editing_transaction_offline/{id}', [App\Http\Controllers\PagesController::class, 'editing_transaction_offline'])->name('editing_transaction_offline');
    Route::get('/publisher/payads', [App\Http\Controllers\pagesController::class, 'publisherpayads'])->name('publisherpayads');
    Route::post('/publisher/checkout', [App\Http\Controllers\pagesController::class,'processCheckout'])->name('processCheckout');
    Route::delete('/ads/{id}', [App\Http\Controllers\pagesController::class, 'destroy'])->name('ads.destroy');

});

// Subscriber Routes
Route::middleware(['auth','user-role:subscriber'])->group(function()
{

    Route::get('/ashtrays', [App\Http\Controllers\pagesController::class, 'showAshtrays'])->name('ashtrays.show');
    Route::get('/subscriber/ads', 'App\Http\Controllers\pagesController@subscriberAds')->name('subscriber.ads');
    Route::post('/send-ashtray-breakdown-notification', [App\Http\Controllers\adminController::class, 'sendAshtrayBreakdownNotification'])
    ->name('sendAshtrayBreakdownNotification');

Route::post('/send-new-claim-notification', [App\Http\Controllers\adminController::class, 'sendNewClaimNotification'])
    ->name('sendNewClaimNotification');

});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


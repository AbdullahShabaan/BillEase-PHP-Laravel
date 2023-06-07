<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController ;
use App\Http\Controllers\BillController ;
use App\Http\Controllers\CategoryController ;
use App\Http\Controllers\testController ;
use App\Http\Controllers\DetailController ;
use App\Http\Controllers\ProductController ;
use App\Http\Controllers\BillAttachementController ;
use App\Http\Controllers\UserController ;
use App\Http\Controllers\RoleController ;
use App\Http\Controllers\BillReportsController ;
use App\Http\Controllers\CustomerReportsController ;
use App\Http\Controllers\HomeController ;
use App\Http\Controllers\EditProfileController ;


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

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('/', function () {
    return view('auth.login');
});

Route::get('test' , [testController::class , 'index']);

Route::get('/dashboard', [HomeController::class , 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [EditProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('bills' , BillController::class) ;
Route::get('changeStatus/{id}' , [BillController::class , 'changeStatus']) ;
Route::post('updateStatus/{id}' , [BillController::class , 'updateStatus']) ;
Route::get('billsArchive' , [BillController::class , 'archive']) ;
Route::post('billRestore' , [BillController::class , 'restore']) ;
Route::post('forceBill' , [BillController::class , 'forceBill']) ;

Route::get('printBill/{id}' , [BillController::class , 'printBill']) ;

Route::get('Paid' , [BillController::class , 'Paid']) ;
Route::get('PartialyPaid' , [BillController::class , 'PartialyPaid']) ;
Route::get('UnPaid' , [BillController::class , 'UnPaid']) ;

Route::resource('Attachement' , BillAttachementController::class) ;

Route::get('details/{id}' , [DetailController::class , 'edit']) ;

Route::get('downloadFile/{fileName}' , [DetailController::class , 'downloadFile']) ;

Route::get('DeleteFile/{fileName}' , [DetailController::class , 'DeleteFile']) ;

Route::get('openFile/{fileName}' , [DetailController::class , 'openFile']) ;

Route::resource('categories' , CategoryController::class) ;

Route::get('/cat/{id}' ,[ CategoryController::class , 'getproducts']) ;

route::resource('products' , ProductController::class) ;


// routes for bill reports
Route::get('billReports' , [BillReportsController::class , 'index']);
Route::post('SearchBill' , [BillReportsController::class , 'SearchBill']);

// routes for customer reports
Route::get('CustomerReports' , [CustomerReportsController::class , 'index']);
Route::post('CustomerSearch' , [CustomerReportsController::class , 'CustomerSearch']);

// Notification mark as read 
Route::get('/markAsRead', function(){

    auth()->user()->unreadNotifications->markAsRead();

    return redirect()->back();

})->name('mark');

require __DIR__.'/auth.php';

<?php

use App\Models\Invoice;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Admin\ArchiveInvoiceController;
use App\Http\Controllers\Admin\InvoiceDetailsController;

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

define('COUNTER', 12);

Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/', 'index_login')->name('auth.index.login');
        Route::post('/login', 'login')->name('auth.login');
        Route::get('/register', 'index_register')->name('auth.index.register');
        Route::post('/register', 'register')->name('auth.register');
    });
    Route::middleware(['auth', 'guest_verify'])->group(function () {
        Route::get('/verify', 'get_verify')->name('auth.get_verify');
        Route::post('/verify', 'post_verify')->name('auth.post_verify');
        Route::get('/resend/code', 'resend_code')->name('auth.resend');
    });
});
Route::group(['middleware' => ['auth', 'verify']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    ///////////////////////////////////////////////Resources/////////////////////////////////////////////////////
    Route::resources([
        'panal' => HomeController::class,
        'sections' => SectionController::class,
        'products' => ProductController::class,
        'invoice' => InvoiceController::class,
        'archive/invoices' => ArchiveInvoiceController::class,
    ]);
    ///////////////////////////////////////////////Actions-of-Invoice/////////////////////////////////////////////////////
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice/status/edit/{invoice}', 'show_status')->name('show.status');
        Route::patch('/invoice/status/apply/{invoice}', 'apply_status')->name('apply.status');
        Route::get('/archive/{invoice}', 'archive')->name('invoice.archive');
        Route::get('/restore/{id}', 'restore')->name('invoice.restore');
    });
    ///////////////////////////////////////////////Details-of-Invoice/////////////////////////////////////////////////////
    Route::controller(InvoiceDetailsController::class)->group(function () {
        Route::get('invoice/details/{invoice}', 'get_invoice_details')->name('invoice.details');
        Route::get('attachment/show/{invoice}', 'show_file')->name('file.show');
        Route::get('attachment/download/{invoice}', 'download_file')->name('file.download');
        Route::get('attachment/delete/{invoice}', 'delete_file')->name('file.delete');
    });
    ///////////////////////////////////////////////Ajax-Products////////////////////////////////////////////////////
    Route::get('/get_products_by_bank/{id}', [InvoiceController::class, 'GetAllProductsByOneSection'])->name('get_products_by_bank');
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\APi\InvoiceController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\FilterBankController;
use App\Http\Controllers\Api\PrintInvoiceController;
use App\Http\Controllers\Api\FilterInvoiceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArchiveInvoiceController;
use App\Http\Controllers\Api\InvoiceDetailsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest:sanctum')->group(function () {
        Route::post('/login', 'login')->name('auth.login');
    });
    Route::middleware(['auth:sanctum', 'guest_verify'])->group(function () {
        Route::post('/verify', 'post_verify')->name('auth.post_verify');
        Route::get('/resend/code', 'resend_code')->name('auth.resend');
    });
});
Route::group(['middleware' => ['auth:sanctum', 'verify'], 'perfix' => LaravelLocalization::setLocale()], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    ///////////////////////////////////////////////Resources/////////////////////////////////////////////////////
    Route::get('invoice/{status?}', [InvoiceController::class, 'index'])->name('invoice.index')
        ->whereIn('status', ['Paid', 'Unpaid', 'Partially paid']);
    Route::Apiresources([
        'panal' => HomeController::class,
        'sections' => SectionController::class,
        'products' => ProductController::class,
        'invoice' => InvoiceController::class,
        'archive/invoices' => ArchiveInvoiceController::class,
        'user' => UserController::class,
        'role' => RoleController::class,
    ]);
    ///////////////////////////////////////////////Actions-of-Invoice/////////////////////////////////////////////////////
    Route::controller(InvoiceController::class)->group(function () {
        Route::patch('/invoice/status/apply/{invoice}', 'apply_status')->name('apply.status');
        Route::get('/archive/{invoice}', 'archive')->name('invoice.archive');
        Route::get('/restore/{id}', 'restore')->name('invoice.restore');
    });
    Route::controller(PrintInvoiceController::class)->group(function () {
        Route::get('/print/invoice', 'print_invoice')->name('show.print');
        // Route::post('/print/invoice/{invoice}', 'apply_print')->name('apply.print');
    });
    ///////////////////////////////////////////////Details-of-Invoice/////////////////////////////////////////////////////
    Route::controller(InvoiceDetailsController::class)->group(function () {
        Route::get('invoice/details/{invoice}', 'get_invoice_details')->name('invoice.details');
        Route::get('attachment/show/{invoice}', 'show_file')->name('file.show');
        Route::get('attachment/download/{invoice}', 'download_file')->name('file.download');
        Route::get('attachment/delete/{invoice}', 'delete_file')->name('file.delete');
    });
    ///////////////////////////////////////////////Ajax-Products///////////////////////////////////////////////////////////
    Route::get('/get_products_by_bank/{id}', [InvoiceController::class, 'GetAllProductsByOneSection'])->name('get_products_by_bank');
    ///////////////////////////////////////////////Invoice-Search////////////////////////////////////////////////////
    Route::controller(FilterInvoiceController::class)->group(function () {
        Route::post('invoices/search', 'search')->name('invoice.search.result');
    });
    ///////////////////////////////////////////////Bank-Search////////////////////////////////////////////////////
    Route::controller(FilterBankController::class)->group(function () {
        Route::post('banks/search', 'search')->name('banks.search.result');
    });
});

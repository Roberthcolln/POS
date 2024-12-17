<?php


use App\Http\Controllers\BarController;
use App\Http\Controllers\BarOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeWebController;
use App\Http\Controllers\KasirController;


use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\KitchenOrderController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;

use App\Http\Controllers\SettingController;

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


Route::get('/', [HomeWebController::class, 'index']);

Route::get('/cart', [HomeWebController::class, 'cart'])->name('cart');

Route::get('/add-to-cart/{productId}', [HomeWebController::class, 'addToCart'])->name('add_to_cart');

Route::get('/remove-from-cart/{productId}', [HomeWebController::class, 'removeFromCart'])->name('remove_from_cart');

Route::get('/remove-all-from-cart', [HomeWebController::class, 'removeAllFromCart'])->name('remove_all_from_cart');

Route::get('/update-cart/{id}/{quantity}', [HomeWebController::class, 'updateCart'])->name('update_cart');

Route::get('checkout', [PemesananController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [PemesananController::class, 'checkout'])->name('checkout');



Route::prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/', [KasirController::class, 'index'])->name('index');
    Route::post('/pay/{id}', [KasirController::class, 'processPayment'])->name('processPayment');
    Route::post('/combine-transactions', [KasirController::class, 'combineTransactions'])->name('combineTransactions'); // Tambahkan ini
    Route::get('receipt/{id}', [KasirController::class, 'printReceipt'])->name('printReceipt');
    
    
});





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');
    Route::resource('dashboard', DashboardController::class);
    Route::resource('setting', SettingController::class);
    Route::post('image-upload', [SettingController::class, 'storeImage'])->name('image.upload');

    Route::resource('pemesanan', PemesananController::class);
    Route::resource('kategori_produk', KategoriProdukController::class);

    Route::resource('produk', ProdukController::class);
    // Routes untuk Kitchen
    Route::get('kitchen', [KitchenOrderController::class, 'index'])->name('kitchen.index');

    // Routes untuk Bar
    Route::get('bar', [BarOrderController::class, 'index'])->name('bar.index');

    Route::post('kitchen/approve/{id}', [KitchenOrderController::class, 'approve'])->name('kitchen.approve');
    Route::post('bar/approve/{id}', [BarOrderController::class, 'approve'])->name('bar.approve');

    // Route untuk approve pemesanan
    Route::post('pemesanan/{id}/approve', [PemesananController::class, 'approve'])->name('pemesanan.approve');

    Route::post('/kitchen/done/{id}', [KitchenOrderController::class, 'done'])->name('kitchen.done');
    Route::post('/bar/done/{id}', [BarOrderController::class, 'done'])->name('bar.done');

    Route::get('pemesanan/{id}/bayar', [PemesananController::class, 'bayar'])->name('pemesanan.bayar');
});

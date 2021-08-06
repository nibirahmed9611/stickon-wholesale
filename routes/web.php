<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\UserController;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get( '/', function () {
    return view( 'welcome' );
} );

Auth::routes();

Route::middleware( ['auth'] )->group( function () {
    Route::get( '/home', [App\Http\Controllers\HomeController::class, 'index'] )->name( 'home' );
    Route::resource( 'product', ProductController::class );
    Route::resource( 'orders', OrderController::class );

    Route::get( 'order', [OrderController::class, 'makeOrder'] )->name( 'order' );
    Route::get( 'user/{user}/orders', [OrderController::class, 'individual'] )->name( 'user.order' );

    Route::resource( 'account', AccountController::class );
    Route::resource( 'user', UserController::class );
    Route::resource( 'refund', RefundController::class );

    Route::patch( 'update-order-products/{order_product}', function ( Request $request, OrderProduct $order_product ) {
        $order_product->update( [
            'status' => $request->status,
        ] );
            // dd($request->status);
        return redirect()->back()->with('updated','Status updated successfully');

    } )->name( 'update.order.products' );
} );

Route::get( 'test', function () {
    return view( "test" );
} );
<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Attribute;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware( 'auth' );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        if ( Auth::user()->role == "Admin" ) {
            $due                = Order::sum( "due" );
            $outOfStock         = Attribute::where( "quantity", 0 )->count();
            $clients            = User::where( "role", "Customer" )->count();
            $montlyOrderRevenue = Order::whereMonth( "created_at", Carbon::today() )->sum( "paid" );
            $montlyExpense      = Account::whereMonth( "created_at", Carbon::today() )->where( "pm", "Minus" )->sum( "value" );

            $products = [];
        } else {
            $due                = 0;
            $outOfStock         = 0;
            $clients            = 0;
            $montlyOrderRevenue = 0;
            $montlyExpense      = 0;
            $products           = Product::with( "attributes" )->get();
        }

        return view( 'home', [
            "due"                => $due,
            "outOfStock"         => $outOfStock,
            "clients"            => $clients,
            "montlyOrderRevenue" => $montlyOrderRevenue,
            "montlyExpense"      => $montlyExpense,
            "products"           => $products,
        ] );
    }

}

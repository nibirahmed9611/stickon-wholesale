<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Account;
use App\Models\Product;
use Livewire\Component;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $due;
    public $outOfStock;
    public $clients;
    public $montlyOrderRevenue;
    public $montlyExpense;
    public $products;

    public $search;

    public function render()
    {
        if ( Auth::user()->role == "Admin" ) {
            $this->due                = Order::sum( "due" );
            $this->outOfStock         = Attribute::where( "quantity", 0 )->count();
            $this->clients            = User::where( "role", "Customer" )->count();
            $this->montlyOrderRevenue = Order::whereMonth( "created_at", Carbon::today() )->sum( "paid" );
            $this->montlyExpense      = Account::whereMonth( "created_at", Carbon::today() )->where( "pm", "Minus" )->sum( "value" );

            $this->products = [];
        } else {
            $this->due                = 0;
            $this->outOfStock         = 0;
            $this->clients            = 0;
            $this->montlyOrderRevenue = 0;
            $this->montlyExpense      = 0;

            if(!$this->search){
                $this->products = Product::with( "attributes" )->get();
            }else{
                $this->products = Product::whereHas( 'attributes', function($query){
                    $query->where('value', 'LIKE' , "%$this->search%");
                } )->get();
            }
        }
        return view('livewire.dashboard');
    }
}

<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class AllOrders extends Component {

    use WithPagination;

    public $deleteConfirm;

    public $from;

    public $to;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'from' => ["except" => ""],
        'to'   => ["except" => ""],
    ];

    public function delete( $id ) {
        $this->deleteConfirm = $id;
    }

    public function modalDelete() {

        $order = Order::find( $this->deleteConfirm );

        foreach ( $order->order_products as $order_product ) {

            if ( $order_product->image ) {

                if ( file_exists( $order_product->image->path ) ) {
                    Storage::disk( 'public' )->delete( $order_product->image->path );
                }

            }

            $order_product->delete();
        }

        $order->delete();

        $this->mount();
    }

    public function reset_filter() {
        return redirect()->route("orders.index");
    }

    public function render() {

        if ( Auth::user()->role == "Admin" || Auth::user()->role == "Employee" ) {

            if ( $this->from && $this->to ) {
                $from = Carbon::createFromFormat( "Y-m-d", $this->from );
                $to   = Carbon::createFromFormat( "Y-m-d", $this->to );

                $allOrders = Order::whereBetween( "created_at", [$from, $to] )
                    ->orderByDesc( 'id' )
                    ->paginate( 15 );
            } else {
                $allOrders = Order::whereMonth( "created_at", Carbon::today() )
                    ->orderByDesc( 'id' )
                    ->paginate( 15 );
            }

        } else {
            $allOrders = Auth::user()->order()->orderByDesc( 'id' )->paginate( 15 );
        }

        return view( 'livewire.order.all-orders', [
            'allOrders' => $allOrders,
        ] );
    }

}

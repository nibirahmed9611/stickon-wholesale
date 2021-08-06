<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AllOrders extends Component {

    use WithPagination;

    public $deleteConfirm;

    protected $paginationTheme = 'bootstrap';

    public function delete( $id ) {
        $this->deleteConfirm = $id;
    }

    public function modalDelete() {

        $order = Order::find( $this->deleteConfirm );

        foreach ($order->order_products as $order_product) {
            if($order_product->image){
                if(file_exists($order_product->image->path)){
                    Storage::disk('public')->delete($order_product->image->path);
                }
            }
            $order_product->delete();
        }

        $order->delete();

        $this->mount();
    }

    public function render() {
        if( Auth::user()->role == "Admin" || Auth::user()->role == "Viewer"  ){
            $allOrders = Order::orderByDesc( 'id' )->paginate( 15 );
        }else{
            $allOrders = Auth::user()->order()->orderByDesc( 'id' )->paginate( 15 );
        }
        return view( 'livewire.order.all-orders', [
            'allOrders' =>$allOrders,
        ] );
    }
}

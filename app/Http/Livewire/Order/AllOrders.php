<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AllOrders extends Component {

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render() {
        return view( 'livewire.order.all-orders', [
            'allOrders' => Order::orderByDesc('id')->paginate( 15 ),
        ] );
    }
}

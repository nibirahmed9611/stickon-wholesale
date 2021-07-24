<?php

namespace App\Http\Livewire\OrderProducts;

use App\Models\Order;
use Livewire\Component;

class OrderProducts extends Component {

    public $orderID;

    public $order;

    public $discount;

    public $paid;

    public $status;

    protected $rules = [
        'discount' => 'required|numeric|min:0',
        'paid'     => 'required|numeric|min:0',
        'status'   => 'required',
    ];

    public function mount() {
        $this->order    = Order::findOrFail( $this->orderID )->toArray();
        $this->discount = $this->order['discount'];
        $this->paid     = $this->order['paid'];
        $this->status     = $this->order['status'];
    }

    public function updateOrder() {

        $this->validate();

        $total = $this->order['subtotal'] - $this->discount;

        Order::findOrFail( $this->orderID )->update( [
            'discount' => $this->discount,
            'total'    => $total,
            'paid'     => $this->paid,
            'due'      => $total - $this->paid,
            'status'      => $this->status,
        ] );

        $this->mount();

        session()->flash('saved','Saved Successfully');
    }

    public function paid() {
        dd( $this->paid );
    }

    public function render() {
        return view( 'livewire.order-products.order-products', [
            'orderProducts' => Order::findOrFail( $this->orderID )->order_products,
        ] );
    }

}

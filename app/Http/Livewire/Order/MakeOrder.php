<?php

namespace App\Http\Livewire\Order;

use App\Models\Account;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class MakeOrder extends Component {

    use WithFileUploads;

    public $productErrors = array();

    public $allProducts;

    public $orderProducts;

    /**
     *
     * Initializes the component
     *
     */
    public function mount() {
        $this->orderProducts = [
            [
                "photo"     => null,
                "product"   => Product::first()->id ?? "",
                "attribute" => "",
                "quantity"  => 1,
            ],
        ];
        $this->allProducts = Product::all();

    }

    /**
     *
     * Add another order box
     *
     */
    public function addMore() {

        $this->orderProducts[] = [
            "photo"     => null,
            "product"   => Product::first()->id ?? "",
            "attribute" => "",
            "quantity"  => 1,
        ];

    }

    /**
     *
     * Placing an order
     *
     * @return order_id
     *
     */
    public function order() {

        // dd($this->orderProducts);

        // Check the stock
        $productAndQuantity = array();

        foreach ( $this->orderProducts as $orderProduct ) {

            if ( array_key_exists( $orderProduct['product'], $productAndQuantity ) ) {
                $productAndQuantity[$orderProduct['product']] += (int) $orderProduct['quantity'];
            } else {
                $productAndQuantity[$orderProduct['product']] = (int) $orderProduct['quantity'];
            }

        }

        // Showing error message of the stock and showing the error message

        $totalPrice = 0;

        $this->productErrors = [];

        foreach ( $this->orderProducts as $orderProduct ) {

            if ( $orderProduct['attribute'] == null || $orderProduct['attribute'] == "null" ) {
                $this->productErrors[] = "Please choose size/model for all products";
                return;
            } 
        }

        foreach ( $productAndQuantity as $key => $orderQuantity ) {
            $product = Product::find( $key );
            $totalPrice += (int) $product->price * $orderQuantity;

            if ( $orderQuantity > $product->quantity ) {
                $this->productErrors[] = $product->name . " has " . $product->quantity . " in stock, you've ordered " . $orderQuantity . " items ";
            }

        }

        if ( $this->productErrors ) {
            return;
        }

        DB::transaction(function () use ( $totalPrice, $productAndQuantity ) {
            // Make an order
            $order = Order::create( [
                'user_id'  => 1, // Auth::user()->id
                'subtotal' => $totalPrice,
                'discount' => 0,
                'total'    => $totalPrice,
                'paid'     => 0,
                'due'      => $totalPrice,
                'status'   => "Pending Payment",
            ] );

            // Assign all the products to the order and transfer the images
            foreach ( $this->orderProducts as $orderedProduct ) {
                OrderProduct::create( [
                    'order_id'     => $order->id,
                    'product_id'   => $orderedProduct['product'],
                    'attribute_id' => $orderedProduct['attribute'],
                    'quantity'     => $orderedProduct['quantity'],
                    'staus'        => "Incomplete",
                ] );
            }

            // Remove from stock
            foreach ( $productAndQuantity as $key => $orderQuantity ) {
                $product = Product::find( $key );

                if ( $orderQuantity < $product->quantity ) {
                    $product->decrement( 'quantity', $orderQuantity );
                }

            }

            // Create a new account(p/m)
            Account::create( [
                'order_id'  => $order->id,
                'name'      => "Order ", // Auth::user()->name
                'value'     => $totalPrice,
                'pm'        => "Plus",
            ] );
        });
        

        session()->flash( 'success', "Your order has been places successfully" );

        $this->mount();
    }

    public function render() {
        return view( 'livewire.order.make-order' );
    }

}

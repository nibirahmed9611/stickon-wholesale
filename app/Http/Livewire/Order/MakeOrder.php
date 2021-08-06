<?php

namespace App\Http\Livewire\Order;

use App\Models\Account;
use App\Models\Attribute;
use App\Models\Media;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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

    public function updatedOrderProducts() {

        foreach ($this->orderProducts as $key => $orderedProduct) {
            $product = Product::findOrFail($orderedProduct['product']);

            $attributes = $product->attributes()->pluck('id')->toArray();

            if( !in_array($orderedProduct['attribute'],$attributes) ){
                $this->orderProducts[$key]['attribute'] = "null";
            }
        }
        
    }

    /**
     *
     * Placing an order
     *
     * @return order_id
     *
     */
    public function order() {

        // Showing error message of the stock and showing the error message of all attributes checked

        $this->productErrors = [];

        foreach ( $this->orderProducts as $orderProduct ) {

            if ( $orderProduct['attribute'] == null || $orderProduct['attribute'] == "null" || $orderProduct['attribute'] == "" ) {
                $this->productErrors[] = "Please choose size/model for all products";
                return;
            }

        }

        // Check the stock

        foreach ( $this->orderProducts as $orderProduct ) {
            $attribute = Attribute::findOrFail( $orderProduct['attribute'] );

            if ( $orderProduct['quantity'] > $attribute->quantity ) {
                $this->productErrors[] = $attribute->value . " of " . $attribute->product->name . " has " . $attribute->quantity . " in stock, you've ordered " . $orderProduct['quantity'] . " items ";
            }

        }

        if ( $this->productErrors ) {
            return;
        }

        //Calculate the price

        $totalPrice = 0;

        foreach ( $this->orderProducts as $orderedProducts ) {

            $product = Product::findOrFail( $orderedProducts['product'] );

            $totalPrice += (int) $product->price * $orderedProducts['quantity'];

        }


        DB::transaction( function () use ( $totalPrice ) {

            // Make an order
            $order = Order::create( [
                'user_id'  => Auth::user()->id, // Auth::user()->id
                'subtotal' => $totalPrice,
                'discount' => 0,
                'total'    => $totalPrice,
                'paid'     => 0,
                'due'      => $totalPrice,
                'status'   => "Pending Payment",
            ] );

            // Assign all the products to the order and transfer the images

            foreach ( $this->orderProducts as $orderedProduct ) {

                $orderProduct = OrderProduct::create( [
                    'order_id'     => $order->id,
                    'product_id'   => $orderedProduct['product'],
                    'attribute_id' => $orderedProduct['attribute'],
                    'quantity'     => $orderedProduct['quantity'],
                    'staus'        => "Processing",
                ] );

                if ( $orderedProduct['photo'] ) {
                    $uploadedPhoto = $orderedProduct['photo']->store( 'photos', 'public' );

                    Media::create( [
                        'order_product_id' => $orderProduct->id,
                        'path'             => $uploadedPhoto,
                    ] );
                }

            }

            // Remove from stock

            foreach ( $this->orderProducts as $p ) {

                // dd("Ashche");
                $attribute = Attribute::findOrFail( $p['attribute'] );

                if ( $p['quantity'] < $attribute->quantity ) {
                    $attribute->decrement( 'quantity', $p['quantity'] );
                }

            }

            // Create a new account(p/m)
            Account::create( [
                'order_id' => $order->id,
                'name'     => "Order from " . Auth::user()->name, // Auth::user()->name
                'value' => $totalPrice,
                'pm'       => "Plus",
            ] );
        } );

        session()->flash( 'success', "Your order has been places successfully" );

        $this->mount();
    }

    public function render() {
        return view( 'livewire.order.make-order' );
    }

}

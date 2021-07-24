<?php

namespace App\Http\Livewire\Product;

use App\Models\Attribute;
use App\Models\Product;
use Livewire\Component;

class CreateProduct extends Component {

    public Product $product;

    public $attributes = [];

    public function mount() {
        $this->product = new Product();
    }

    protected $rules = [
        'product.name'     => 'required|string',
        'product.price'    => 'required|integer',
        'product.quantity' => 'required|integer|numeric|min:0',
    ];

    public function addMore() {
        $this->attributes[] = "";
    }

    public function save() {
        $this->validate();

        $this->product->save();

        $product = $this->product->id;

        foreach ( $this->attributes as $attribute ) {
            Attribute::create( [
                'value'      => $attribute,
                'product_id' => $product,
            ] );
        }

        session()->flash( 'success', 'Product added successfully' );

        $this->mount();
        $this->attributes = [];
    }

    public function render() {
        return view( 'livewire.product.create-product' );
    }

}

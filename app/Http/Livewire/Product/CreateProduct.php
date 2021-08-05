<?php

namespace App\Http\Livewire\Product;

use App\Models\Attribute;
use App\Models\Product;
use Livewire\Component;

class CreateProduct extends Component {

    public $product;

    public $attributes = [];

    public function mount() {
        $this->product = new Product();
    }

    protected $rules = [
        'product.name'  => 'required|string',
        'product.price' => 'required|integer',
        // 'product.quantity' => 'required|integer|numeric|min:0',
        'attributes'    => 'required',
    ];

    public function addMore() {
        $this->attributes[] = [
            'value'    => "",
            'quantity' => "",
        ];
    }

    public function save() {
        $this->validate();

        // dd($this->attributes);
        $this->product->save();

        $product = $this->product->id;

        foreach ( $this->attributes as $attribute ) {
            Attribute::create( [
                'value'      => $attribute['value'],
                'product_id' => $product,
                'quantity'   => $attribute['quantity'],
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

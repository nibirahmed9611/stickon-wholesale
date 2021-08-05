<?php

namespace App\Http\Livewire\Product;

use App\Models\Attribute;
use App\Models\Product;
use Livewire\Component;

class EditAttribute extends Component {

    public $productID;

    public $attributes = [];

    public function mount() {
        $this->attributes = Product::findOrFail( $this->productID )->attributes()->select('id','value','quantity')->get()->toArray();
    }

    public function addMore() {
        $this->attributes[] = [
            'value'    => "",
            'quantity' => "",
        ];
    }

    public function edit($id) {

        $primaryKey = $this->attributes[$id]['id'];
        
        Attribute::findOrFail($primaryKey)->update([
            'value' => $this->attributes[$id]['value'],
            'quantity' => $this->attributes[$id]['quantity'],
        ]);

        session()->flash('updated','Updated Successfully');
    }

    public function delete($id) {
        // dd($id);
        Attribute::findOrFail($id)->delete();
        $this->mount();

        session()->flash('delete','Deleted Successfully');
    }

    public function update() {
        // dd($this->attributes);
        foreach ( $this->attributes as $attribute ) {

            Attribute::firstOrCreate(
                [
                    'value' => $attribute['value'],
                    'quantity' => (int) $attribute['quantity'],
                    'product_id' => $this->productID,
                ],
            );
            
        }

        session()->flash('updated','Updated Successfully');

        $this->mount();

    }

    public function render() {
        // dd($this->attributes);
        return view( 'livewire.product.edit-attribute' );
    }

}

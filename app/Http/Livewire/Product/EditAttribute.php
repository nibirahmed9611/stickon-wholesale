<?php

namespace App\Http\Livewire\Product;

use App\Models\Attribute;
use App\Models\Product;
use Livewire\Component;

class EditAttribute extends Component {

    public $productID;

    public $attributes = [];

    public function mount() {
        $this->attributes = Product::findOrFail( $this->productID )->attributes->pluck( 'value','id','created_at' )->toArray();
    }

    public function addMore() {
        $this->attributes[] = "";
    }

    public function edit($id) {
        Attribute::findOrFail($id)->update([
            'value' => $this->attributes[$id]
        ]);

        session()->flash('updated','Updated Successfully');
    }

    public function delete($id) {
        Attribute::findOrFail($id)->delete();
        $this->mount();

        session()->flash('delete','Deleted Successfully');
    }

    public function update() {

        foreach ( $this->attributes as $attribute ) {
            Attribute::firstOrCreate(
                ['value' => $attribute],
                ['product_id' => $this->productID],
            );
        }

        session()->flash('updated','Updated Successfully');

    }

    public function render() {
        // dd($this->attributes);
        return view( 'livewire.product.edit-attribute' );
    }

}

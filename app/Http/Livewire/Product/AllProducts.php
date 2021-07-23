<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AllProducts extends Component {
    
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render() {

        return view( 'livewire.product.all-products', [
            'allProducts' => Product::paginate(15),
        ] );
    }
}

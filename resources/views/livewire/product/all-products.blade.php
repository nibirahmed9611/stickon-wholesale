
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('delete'))
                <div class="alert alert-danger">
                    {{ session('delete') }}
                </div>
            @endif
            <a href="{{ route("product.create") }}" class="btn btn-primary mb-2">Add Product</a>
            <div class="card">
                <div class="card-header"><b>{{ __('All Products') }}</b></div>

                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Remaining Stock</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @forelse ($allProducts as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td><a class="btn btn-primary" href="{{ route('product.edit',['product'=>$product->id]) }}">Edit</a></td>
                                    <td>
                                        <form action="{{ route('product.destroy',['product'=>$product->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">{{ __('No Products Found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $allProducts->links() }}

                </div>
            </div>
        </div>
    </div>
</div>




<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
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
                            </tr>
                        </thead>
                        
                        <tbody>
                            @forelse ($allProducts as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                </tr>
                            @empty
                                {{ __('No Products Found') }}
                            @endforelse
                        </tbody>
                    </table>

                    {{ $allProducts->links() }}

                </div>
            </div>
        </div>
    </div>
</div>



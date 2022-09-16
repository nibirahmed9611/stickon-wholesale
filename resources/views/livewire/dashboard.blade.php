<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ( auth()->user()->role == "Customer" )
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="card border-success">
                                        <div class="card-body">
                                        <h5 class="card-title">Order</h5>
                                        <p class="card-text">Place an order</p>
                                        <a href="{{ route('order') }}" class="btn btn-success">Make Order</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card border-info">
                                        <div class="card-body">
                                        <h5 class="card-title">All Orders</h5>
                                        <p class="card-text">Track all of your existing orders</p>
                                        <a href="{{ route('orders.index') }}" class="btn btn-primary">Orders</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card border-danger">
                                        <div class="card-body">
                                        <h5 class="card-title">Replacement</h5>
                                        <p class="card-text">Apply for a Replacement</p>
                                        <a href="{{ route('refund.create') }}" class="btn btn-danger">Apply for replacement</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row px-3">
                                <div class="col-md">
                                    <h4 class="my-4">Available Products</h4>
                                </div>
                                <div class="col-md text-right pt-3">
                                    <input wire:model.debounce.500ms="search" class="form-control" placeholder="Search">
                                </div>

                                <div class="accordion w-100" id="accordionExample">

                                    @forelse ($products as $product)

                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-{{ $product->id }}" aria-expanded="true" aria-controls="collapseOne">
                                                    <b class="text-dark">{{ $product->name }}</b>
                                                </button>
                                                </h2>
                                            </div>

                                            <div id="collapse-{{ $product->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Model Name</th>
                                                                <th>Stock</th>
                                                            </tr>
                                                        </thead>
                                                        @forelse ($product->attributes as $attribute)
                                                            @if ( $search )
                                                                @if (Str::contains($attribute->value,$search))
                                                                <tr>
                                                                    <td>{{ $attribute->value }}</td>
                                                                    <td>{{ $attribute->quantity }}</td>
                                                                </tr>
                                                                @endif
                                                            @else
                                                            <tr>
                                                                <td>{{ $attribute->value }}</td>
                                                                <td>{{ $attribute->quantity }}</td>
                                                            </tr>
                                                            @endif
                                                        @empty
                                                            No Attributes Found
                                                        @endforelse

                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        No Products Found
                                    @endforelse


                                  </div>
                            </div>
                        @else

                            @if ( auth()->user()->role == "Admin" )

                                <div class="row mt-2">
                                    <div class="col">
                                        <h3>Overview</h3>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-sm mt-3">
                                        <div class="card border-success">
                                            <div class="card-body">
                                            <h5 class="card-title">Total Clients</h5>
                                            <p class="card-text"><b>{{ $clients }}</b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm mt-3">
                                        <div class="card border-success">
                                            <div class="card-body">
                                            <h5 class="card-title">Order Revenue</h5>
                                            <p class="card-text">{{ $montlyOrderRevenue }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm mt-3">
                                        <div class="card border-info">
                                            <div class="card-body">
                                            <h5 class="card-title">Monthly Expense</h5>
                                            <p class="card-text">{{ $montlyExpense }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm mt-3">
                                        <div class="card border-danger">
                                            <div class="card-body">
                                            <h5 class="card-title">Due</h5>
                                            <p class="card-text">{{ $due }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm mt-3">
                                        <div class="card border-danger">
                                            <div class="card-body">
                                            <h5 class="card-title">Stock Out</h5>
                                            <p class="card-text">{{ $outOfStock }}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif



                            <div class="row mt-4">
                                <div class="col">
                                    <h3>Pages</h3>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-4 mt-3">
                                    <div class="card border-success">
                                        <div class="card-body">
                                        <h5 class="card-title">All Orders</h5>
                                        <p class="card-text">See the list of orders</p>
                                        <a href="{{ route('orders.index') }}" class="btn btn-success">Orders</a>
                                        </div>
                                    </div>
                                </div>

                                @if ( auth()->user()->role == "Admin" )
                                    <div class="col-sm-4 mt-3">
                                        <div class="card border-secondary">
                                            <div class="card-body">
                                            <h5 class="card-title">Accounts</h5>
                                            <p class="card-text">Manage your account</p>
                                            <a href="{{ route('account.index') }}" class="btn btn-secondary">Accounts</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-sm-4 mt-3">
                                    <div class="card border-primary">
                                        <div class="card-body">
                                        <h5 class="card-title">Products</h5>
                                        <p class="card-text">List of all the products and stock available</p>
                                        <a href="{{ route('product.index') }}" class="btn btn-primary">Products</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4 mt-3">
                                    <div class="card border-danger">
                                        <div class="card-body">
                                        <h5 class="card-title">Replacement</h5>
                                        <p class="card-text">List of all the replacemnet requests</p>
                                        <a href="{{ route('refund.index') }}" class="btn btn-danger">Replacements</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4 mt-3">
                                    <div class="card border-dark">
                                        <div class="card-body">
                                        <h5 class="card-title">Users</h5>
                                        <p class="card-text">List of all users</p>
                                        <a href="{{ route('user.index') }}" class="btn btn-dark">Users</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

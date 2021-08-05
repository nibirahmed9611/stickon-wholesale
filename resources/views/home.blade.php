@extends('layouts.app')

@section('content')
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
                    @else
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

                            <div class="col-sm-4 mt-3">
                                <div class="card border-secondary">
                                    <div class="card-body">
                                    <h5 class="card-title">Accounts</h5>
                                    <p class="card-text">Manage your account</p>
                                    <a href="{{ route('account.index') }}" class="btn btn-secondary">Accounts</a>
                                    </div>
                                </div>
                            </div>

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
@endsection

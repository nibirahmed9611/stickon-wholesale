
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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

                    
                    <table class="table table-striped table-bordered table-hover table-responsive-md">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Subtotal</th>
                                <th>Discount</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Status</th>
                                <th>Placed at</th>
                                <th>Products</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @forelse ($allOrders as $order)
                                <tr>
                                    <td>{{ "Nibir" }}</td>
                                    <td>{{ $order->subtotal }}</td>
                                    <td>{{ $order->discount }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->paid }}</td>
                                    <td>{{ $order->due }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->created_at->format("d-M-Y | h:i a") }}</td>
                                    <td><a href="{{ route('orders.show',['order'=>$order->id]) }}">Show</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">{{ __('No Orders Found') }}</td>
                                </tr> 
                            @endforelse
                        </tbody>
                    </table>

                    {{ $allOrders->links() }}

                </div>
            </div>
        </div>
    </div>
</div>



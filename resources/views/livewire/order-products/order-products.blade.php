
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

                    
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Attribute</th>
                                <th>Status</th>
                                <th>Quantity</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @forelse ($orderProducts as $orderProduct)
                                <tr>
                                    <td>{{ $orderProduct->product ? $orderProduct->product->name : "Not Found" }}</td>
                                    <td>{{ $orderProduct->attribute ? $orderProduct->attribute->value : "Not Found" }}</td>
                                    <td>{{ $orderProduct->status ?? "Not Found" }}</td>
                                    <td>{{ $orderProduct->quantity ?? "Not Found" }}</td>
                                    <td>{{ $orderProduct->updated_at->format("d-M-Y | h:i a") }}</td>
                                </tr>
                            @empty
                                {{ __('No Orders Products Found') }}
                            @endforelse
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col"></div>
                        <div class="col">
                            <h4 class="mt-4">Overview</h4>
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <td>Status</td>
                                    <td>{{ $order['status'] }}</td>
                                </tr>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>{{ $order['subtotal'] }}</td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td><input type="number" class="form-control" wire:model.defer="discount"></td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>{{ $order['total'] }}</td>
                                </tr>
                                <tr>
                                    <td>Paid</td>
                                    <td><input type="number" class="form-control" wire:model.defer="paid"></td>
                                </tr>
                                <tr>
                                    <td>Due</td>
                                    <td>{{ $order['due'] }}</td>
                                </tr>
                            </table>
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route("orders.index") }}" class="btn btn-info text-light">Back</a>
                                    @error('discount') <span class="text-danger">{{ $message }}</span> @enderror
                                    @error('paid') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col text-right">
                                    <button class="btn btn-success" wire:click="updateOrder">Save</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



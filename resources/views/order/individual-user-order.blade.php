@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header"><b>{{ __('All Orders') }}</b></div>

                <div class="card-body">
                    
                    @if (session('deleted'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('deleted') }}
                        </div>
                    @endif

                    
                    <table class="table table-striped table-bordered table-hover table-responsive-md">
                        <thead>
                            <tr>
                                <th>Done By</th>
                                <th>Subtotal</th>
                                <th>Discount</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Status</th>
                                <th>Placed at</th>
                                <th>Products</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @forelse ($allOrders as $order)
                                <tr>
                                    <td>{!! $order->user ? "<a href=". route("user.edit",['user'=> $order->user->id]) . ">" . $order->user->name . "</a>"  : 'Not found' !!}</td>
                                    <td>{{ $order->subtotal ?? '' }}</td>
                                    <td>{{ $order->discount  ?? '' }}</td>
                                    <td>{{ $order->total ?? '' }}</td>
                                    <td>{{ $order->paid ?? '' }}</td>
                                    <td>{{ $order->due ?? '' }}</td>
                                    <td>{{ $order->status ?? '' }}</td>
                                    <td>{{ $order->created_at->format("d-M-Y | h:i a") }}</td>
                                    <td><a class="btn btn-primary" href="{{ route('orders.show',['order'=>$order->id]) }}">Show</a></td>
                                    <td>
                                        @if ( auth()->user()->role == "Admin" )
                                            <form action="{{ route('orders.destroy', ['order'=>$order->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input value="Delete" type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">
                                            </form>
                                        @else
                                            <p>Only for admin</p>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">{{ __('No Orders Found') }}</td>
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






@endsection
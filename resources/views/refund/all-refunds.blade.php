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
            @if (session()->has('delete'))
                <div class="alert alert-danger">
                    {{ session('delete') }}
                </div>
            @endif

            @if ( auth()->user()->role == "Customer" )
                <a href="{{ route("refund.create") }}" class="btn btn-primary mb-2">Apply for Refund</a>
            @endif
            <div class="card">
                <div class="card-header"><b>{{ __('All replacement requests') }}</b></div>

                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <table class="table table-responsive-md table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Applied at</th>
                                <th>Action</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @forelse ($allRefunds as $refund)
                                <tr>
                                    <td>{{ $refund->title ?? "" }}</td>
                                    <td>{{ $refund->description ? substr($refund->description, 0, 30) : "" }}</td>
                                    <td>{!! $refund->image ? "<a target='_blank' href=". asset( 'storage/' . $refund->image ) ."><img width='100px' src=". asset( 'storage/' . $refund->image ) ."></a>" : "Not Found" !!}</td>
                                    <td>{{ $refund->created_at ? $refund->created_at->format("d-M-Y") : "Not Found" }}</td>
                                    <td><a class="btn btn-primary" href="{{ route("refund.show",['refund'=>$refund->id]) }}">Show</a></td>
                                    <td>
                                        <form action="{{ route("refund.destroy",['refund'=>$refund->id]) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <input onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" type="submit" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">{{ __('No Replacement Found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $allRefunds->links() }}

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
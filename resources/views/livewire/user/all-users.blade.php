
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

            @if ( auth()->user()->role == "Admin" )
                <a href="{{ route("user.create") }}" class="btn btn-primary mb-2">Add User</a>
            @endif
            <div class="card">
                <div class="card-header"><b>{{ __('All Users') }}</b></div>

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
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Joined</th>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Orders</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Joined</th>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Orders</th>
                            </tr>
                        </tfoot>
                        
                        <tbody>
                            @forelse ($allUsers as $user)
                                <tr>
                                    <td>{{ $user->name ?? "" }}</td>
                                    <td>{{ $user->email ?? "" }}</td>
                                    <td>{{ $user->phone ?? "" }}</td>
                                    <td>{{ $user->address ?? "" }}</td>
                                    <td>{{ $user->role ?? "" }}</td>
                                    <td>{{ $user->created_at ? $user->created_at->format("d-M-Y") : "Not Found" }}</td>
                                    <td>
                                        @if ( auth()->user()->role == "Admin" )
                                            <form action="{{ route("user.destroy",['user'=>$user->id]) }}" method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <input onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" type="submit" value="Delete">
                                            </form>
                                        @else
                                            <p>Only for admin</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ( auth()->user()->role == "Admin" )
                                            <a class="btn btn-primary" href="{{ route("user.edit",['user'=>$user->id]) }}">Edit</a>
                                        @else
                                            <p>Only for admin</p>
                                        @endif
                                    </td>
                                    <td><a class="btn btn-primary" href="{{ route("user.order",['user'=>$user->id]) }}">Orders</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">{{ __('No Users Found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $allUsers->links() }}

                </div>
            </div>
        </div>
    </div>
</div>



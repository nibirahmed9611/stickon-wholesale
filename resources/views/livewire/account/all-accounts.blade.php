
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <a href="{{ route("account.create") }}" class="btn btn-primary mb-2">Add Account Data</a>
                </div>
                <div class="col text-right">
                    <button wire:click="resetFilter" class="btn btn-info text-light mb-2">Reset</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 pt-4">
                            <b class="h4">{{ __('All Accounts') }}</b>
                        </div>
                        <div class="col-md-4">
                            <label>From</label>
                            <input wire:model.debounce.2000="from" type="date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>To</label>
                            <input wire:model.debounce.2000="to" type="date" class="form-control">
                        </div>
                        {{-- <div class="col-md-2 pt-1 text-center">
                            <button wire:click="resetFilter" class="btn btn-primary mt-4">Reset</button>
                        </div> --}}
                    </div>
                    
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                {{ $plus ? "Revenue : " . $plus . " Tk" : "" }}
                            </div>
                            <div class="col-6">
                                {{ $minus ? "Expenditure : " . $minus . " Tk" : "" }}
                            </div>
                        </div>
                        
                    </div>

                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <table class="table table-striped table-bordered table-hover mt-3 table-responsive-md">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Value</th>
                                <th>Plus/Minus</th>
                                <th>Date</th>
                                <th>Order</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @forelse ($allAccounts as $account)
                                <tr>
                                    <td>{{ $account->name ?? "" }}</td>
                                    <td>{{ $account->value ?? "" }}</td>
                                    <td>{{ $account->pm ?? "" }}</td>
                                    <td>{{ $account->created_at ? $account->created_at->format("d-M-Y | h:i a") : "" }}</td>
                                    <td>
                                        {!! $account->order ? "<a href=' " . route("orders.show",['order'=> $account->order->id]) . " '>Show</a>" : "Not From Order" !!}
                                    </td>
                                    <td><button class="btn btn-danger" wire:click="delete({{ $account->id }})" data-toggle="modal" data-target="#exampleModal">Delete</button></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">{{ __('No Orders Found') }}</td>
                                </tr>
                                
                            @endforelse
                        </tbody>
                    </table>

                    {{ $allAccounts->links() }}

                </div>
            </div>

            <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                       <div class="modal-body">
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                            <button type="button" wire:click.prevent="modalDelete()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has('updated'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('updated') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('delete') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Edit Attribute') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="update">

                        <table class="table table-striped table-bordered table-hover table-responsive-sm">
                            
                        
                        @foreach ($attributes as $i => $attribute)
                            <tr>
                                <td>
                                    <input type="text" placeholder="Name" class="form-control mt-1" wire:model.defer="attributes.{{$i}}.value">
                                </td>
                                <td>
                                    <input type="number" placeholder="Quantity" class="form-control mt-1" wire:model.defer="attributes.{{$i}}.quantity">
                                </td>

                                @if ( isset($attribute['id']) )
                                    <td class="text-center">
                                        <button wire:click.prevent="edit({{ $i }})" class="btn btn-primary">Update</button>
                                    </td>
                                    @if ( auth()->user()->role == "Admin" )
                                        <td class="text-center">
                                            <button wire:click.prevent="delete({{ $attribute['id'] }})" class="btn btn-danger">Delete</button>
                                        </td>
                                    @endif
                                @else
                                    <td colspan="2">Not Updated Yet</td>
                                @endif
                                
                            </tr>
                        @endforeach

                        </table>    

                        <div class="row">
                            <div class="col">
                                <button wire:click.prevent="addMore" class="btn btn-primary mt-3">Add a Attribute</button>
                            </div>
                            <div class="col text-right">
                                <input type="submit" value="Update" class="btn btn-success mt-3">
                            </div>
                        </div>
                    
                    </form>
                </div>
            </div>
            <a href="{{ route('product.edit',['product'=>$productID]) }}" class="btn btn-info mt-2">Back</a>
        </div>
    </div>
</div>

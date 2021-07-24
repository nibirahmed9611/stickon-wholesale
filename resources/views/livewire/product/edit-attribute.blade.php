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
                <div class="card-header">{{ __('Create Product') }}</div>

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
                            <td class="w-100">
                                <input type="text" class="form-control mt-1" wire:model.defer="attributes.{{$i}}">
                            </td>
                            <td class="text-center">
                                <button wire:click.prevent="edit({{ $i }})" class="btn btn-primary">Update</button>
                            </td>
                            <td class="text-center">
                                <button wire:click.prevent="delete({{ $i }})" class="btn btn-danger">Delete</button>
                            </td>
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
        </div>
    </div>
</div>

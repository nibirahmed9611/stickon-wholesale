<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
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

                    <form wire:submit.prevent="save">
                        <label for="">Name</label>   
                        <input wire:model.defer="product.name" type="text" class="form-control">
                        @error('product.name') <span class="text-danger">{{ $message }}</span><br> @enderror

                        <label class="mt-1" for="">Price</label>   
                        <input wire:model.defer="product.price" type="number" class="form-control">
                        @error('product.price') <span class="text-danger">{{ $message }}</span><br> @enderror

                        <label class="mt-1" for="">Stock</label>   
                        <input wire:model.defer="product.quantity" type="number" class="form-control">
                        @error('product.quantity') <span class="text-danger">{{ $message }}</span><br> @enderror

                        @if ( count($attributes) > 0 )
                            <label class="mt-2" for="">Attributes</label>   
                        @endif

                        @foreach ($attributes as $i => $attribute)
                            <input type="text" class="form-control mt-1" wire:model.defer="attributes.{{$i}}">
                        @endforeach

                        <div class="row">
                            <div class="col">
                                <button wire:click.prevent="addMore" class="btn btn-primary mt-3">Add a Attribute</button>
                            </div>
                            <div class="col text-right">
                                <input type="submit" value="Create" class="btn btn-success mt-3">
                            </div>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col mt-2">
                                <h4>
                                    {{ __('Order') }}
                                </h4>
                            </div>
                            <div class="col text-right" wire:loading>
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden"></span>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="card-body">
                        
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="order">
                            @foreach ($orderProducts as $index => $orderProduct)
                                <div class="row mt-3 border p-3">

                                    <div class="col">
                                        <label class="">Image of your product</label>
                                        <div class="custom-file">
                                            <input type="file" wire:model.lazy="orderProducts.{{$index}}.photo" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Upload design</label>
                                        </div>

                                        <img src="{{ $orderProducts[$index]['photo'] != null ? $orderProducts[$index]['photo']->temporaryUrl(): 'https://via.placeholder.com/300x230'}}" width="300px" class="mt-2" style="border-radius: 5px;"> <br>

                                    </div>

                                    <div class="col">
                                        <label for="">Product</label>
                                        <select wire:model="orderProducts.{{$index}}.product" class="form-control">
                                            @foreach ($allProducts as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>

                                        <label class="mt-5">Model/Size</label>                                            
                                        <select class="form-control" wire:model.lazy="orderProducts.{{$index}}.attribute">
                                            <option value="null">Select Model/Size</option>
                                            @php
                                                if( $orderProducts[$index]['product'] != "" ){
                                                    $singleProduct = \App\Models\Product::findOrFail($orderProducts[$index]['product']);
                                                    $attributes = $singleProduct->attributes;

                                                    foreach ($attributes as $attribute) {
                                                        echo "<option value='$attribute->id'>$attribute->value</option>";
                                                    }
                                                }
                                            @endphp
                                        </select>

                                        <label class="mt-5" for="">Quantity</label>
                                        <input type="number" wire:model.lazy="orderProducts.{{$index}}.quantity" class="form-control">
                                    </div>

                                </div>

                            @endforeach
                        
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-primary mt-3" wire:loading.attr="disabled" wire:click.prevent="addMore">Add More</button>
                                </div>
                                <div class="col text-right">
                                    <input type="submit" value="Order Now" class="btn btn-success mt-3">
                                </div>
                            </div>
                        </form>
                        
                    </div>
                        @forelse ( $productErrors as $productErrors )
                                <p class="text-danger ml-4">{!! $productErrors !!}</p>
                        @empty
                            
                        @endforelse
                </div>
            </div>
        </div>
    </div>
    



<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
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

                <div class="card-body" wire:loading.class="ce-dis">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form wire:submit.prevent="order">
                    <div class="row">
                        @foreach ($orderProducts as $index => $orderProduct)
                        
                        <div class="col-md-6">
                            <div class="row mt-3 border p-3">
                                <div class="col">
                                    <b>{{ $loop->iteration }}:</b>
                                    <label class="">Image of your product</label>
                                    <div class="custom-file">
                                        <input type="file" wire:model.lazy="orderProducts.{{$index}}.photo" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Upload design</label>
                                    </div>
                                    <img src="{{ $orderProducts[$index]['photo'] != null ? $orderProducts[$index]['photo']->temporaryUrl(): 'https://via.placeholder.com/420x230'}}" width="420px" height="230px" class="my-2" style="border-radius: 5px;"> <br>
                                    <a href="#" class="mt-5" wire:click.prevent="remove({{ $index }})"
                                    onclick="return confirm('Are you sure you want to delete?')">
                                        Delete
                                    </a>
                                </div>

                                <div class="col">
                                    <label for="">Product</label>
                                    <select wire:loading.attr="disabled" wire:model="orderProducts.{{$index}}.product" class="form-control">
                                        @foreach ($allProducts as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>

                                    <label class="mt-5">Model/Size</label>                                            
                                    <select wire:loading.attr="disabled" class="form-control" wire:model.lazy="orderProducts.{{$index}}.attribute">
                                        <option value="null">Select Model/Size</option>
                                        @php
                                            if( $orderProducts[$index]['product'] != "" ){
                                                $singleProduct = \App\Models\Product::findOrFail( $orderProducts[$index]['product'] );
                                                $attributes = $singleProduct->attributes->sortBy("value");

                                                foreach ($attributes as $attribute) {
                                                    if($attribute->quantity != 0){
                                                        echo "<option value='$attribute->id'>$attribute->value - ( $attribute->quantity in stock )</option>";
                                                    }else{
                                                        echo "<option class='text-danger' disabled value='$attribute->id'>$attribute->value - (Out of stock)</option>";
                                                    }
                                                }
                                            }
                                        @endphp
                                    </select>

                                    <label class="mt-5" for="">Quantity</label>
                                    <input wire:loading.attr="disabled" type="number" wire:model.lazy="orderProducts.{{$index}}.quantity" class="form-control">
                                </div>
                            </div>
                        </div>
                        @endforeach 
                    </div>
                        
                    
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary mt-3" wire:loading.attr="disabled" wire:click.prevent="addMore">Add More</button>
                                <p wire:loading class="text-danger">
                                    <b>Please wait until your image is shown here. If you face any problem then please reload the page</b> 
                                </p>
                            </div>
                            
                        </div>
                        <div class="row mt-5">
                            <div class="col text-right">
                                <textarea class="form-control" placeholder="Order Message" rows="3" wire:model.debounce.laxy="comment"></textarea>
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



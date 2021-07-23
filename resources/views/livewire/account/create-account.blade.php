
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Add Account') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="save">
                        <label for="">Name</label>   
                        <input wire:model.defer="account.name" type="text" class="form-control">
                        @error('account.name') <span class="text-danger">{{ $message }}</span><br> @enderror

                        <label class="mt-3" for="">Value</label>   
                        <input wire:model.defer="account.value" type="number" class="form-control">
                        @error('account.value') <span class="text-danger">{{ $message }}</span><br> @enderror

                        <label class="mt-3" for="">Revenue/Expenditure</label>  

                        <select wire:model="account.pm" class="form-control">
                            <option value="Plus">Revenue</option>
                            <option value="Minus">Expenditure</option>
                        </select>
                            
                        @error('account.pm') <span class="text-danger">{{ $message }}</span><br> @enderror

                        <div class="row">
                            <div class="col">
                                <a href="{{ route("account.index") }}" class="btn btn-primary mt-3">Go Back</a>
                            </div>
                            <div class="col text-right">
                                <input type="submit" value="Add" class="btn btn-success mt-3">
                            </div>
                        </div>
                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

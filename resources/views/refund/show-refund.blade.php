@extends('layouts.app')

@section('content')

    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has('applied'))
                <div class="alert alert-success">
                    {{ session('applied') }}
                </div>
            @endif
            @if (session()->has('update'))
                <div class="alert alert-success">
                    {{ session('update') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Replacement') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route("refund.update",['refund'=>$refund->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" value="{{ $refund->title }}" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description"  class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea disabled class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" id="" cols="30" rows="10">
                                    {{ $refund->description }}
                                </textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">

                                {{-- <input type="file" name="image" class="mt-1" id="customFile"> --}}
                                <a href="{{ asset( 'storage/' . $refund->image ) }}"><img width="330" src="{{ asset( 'storage/' . $refund->image ) }}" alt=""></a>
                                <div class="lead">Click the image to see larger</div>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">

                                <select @if ( auth()->user()->role != "Admin" ) disabled @endif class="form-control" name="status">
                                    <option @if ( $refund->status == "Processing" ) selected @endif value="Processing">Processing</option>
                                    <option @if ( $refund->status == "Accepted" ) selected @endif value="Accepted">Accepted</option>
                                    <option @if ( $refund->status == "Declined" ) selected @endif value="Declined">Declined</option>
                                </select>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-6 text-right pr-4 mt-2">
                                @if ( auth()->user()->role == "Admin" )
                                    <input type="submit" class="btn btn-primary mr-1" value="Update">
                                @endif
                            </div>
                    </form>
                            <div class="col-6 text-right pr-4">
                                @if ( auth()->user()->role == "Admin" )
                                    <form action="{{ route("refund.destroy",['refund',$refund->id]) }}" method="POST">
                                        @csrf
                                        @method("DELETE")

                                        <input type="submit" value="Delete" class="btn btn-danger mt-2" onclick="return confirm('Are you sure you want to delete')">
                                    </form>
                                @endif
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
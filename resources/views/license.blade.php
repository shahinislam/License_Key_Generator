@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: #9BC06C">
                <div class="pt-2 pb-4 text-center text-white text-uppercase font-weight-bold">Enter License Key</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success text-center">
                            <strong>Congratulations!! </strong>
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    <form action="/license" method="post" id="form">
                        @csrf

                        <div class="form-group row">
                            <label for="license_key" class="text-white col-md-4 col-form-label text-md-right">{{ __('License Key') }}</label>

                            <div class="col-md-6">
                                <input id="license_key" type="text" class="form-control @error('license_key') is-invalid @enderror" name="license_key" value="{{ old('license_key') }}" autocomplete="license_key" autofocus>

                                @error('license_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-block font-weight-bold" style="background-color: #00FFAA">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6 offset-md-4 text-right text-white">Return to <a href="/login" class="text-warning">Login</a> Page.</div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

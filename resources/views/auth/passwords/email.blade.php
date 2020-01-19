@extends('master')

@section('content')
<main id="main">
    <div class="dashboard">
        <div class="container">
            <h2>{{ __('Reset Password') }}</h2>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row">
                    <div class="col-xs-6">
                        <div class="login-success-message">
                            @if (session('status'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>	
                                        <strong>{{ session('status') }}</strong>
                                </div>
                            @endif
                        </div>
                        <!-- <div class="login-error-message">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>  -->
                        <div class="field-group">
                            <label for="email" class="input-label">{{ __('E-Mail Address') }}</label>
                            <input 
                                type="text" 
                                name="email" 
                                id="email" 
                                class="field-input required email @error('email') input-error @enderror" 
                                placeholder="{{ __('Type E-Mail address') }}" value="{{ old('email') }}" 
                                autocomplete="email" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="field-group clearfix">
                    <input type="submit" class="field-submit" value="{{ __('Send Password Reset Link') }}" />
                </div>
            </form>
            <div class="login-links clearfix">
                <p>{{ __('Already registered') }}? <a href="{{ route('login') }}">{{ __('Login Here') }}</a></p>
            </div>
        </div>
    </div>
</main>
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection

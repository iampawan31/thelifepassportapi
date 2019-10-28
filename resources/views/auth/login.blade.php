@extends('master')

@section('content')
<main id="main">
    <div class="dashboard">
        <div class="container">
            <h2>{{ __('Login') }}</h2>
            <form action="{{ route('login') }}" method="post" class="custom-form">
                @csrf
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
                </div> -->
                <div class="login-success-message">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                @endif
                </div>
                <div class="signup-step signup-step-1 active">
                    <div class="row">
                        <div class="col-xs-6">
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
                    
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="field-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    class="field-input input-password required  @error('password') input-error @enderror" 
                                    placeholder="{{ __('Enter your password') }}" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="field-instructions">{{ __('Forgot your password?') }} <a href="{{ route('password.request') }}">{{ __('Click here') }}</a></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="field-group">
                                <input class="field-input form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="field-group clearfix">
                        <input type="submit" class="field-submit" value="{{ __('Login') }}" />
                    </div>
                </div>
            </form>

            <div class="login-links clearfix">
                <p>{{ __("Don't have an account?") }} <a href="{{ route('register') }}">{{ __('Register Now') }}</a></p>
            </div>
        </div>
    </div>
</main>
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
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

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection

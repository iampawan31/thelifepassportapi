@extends('master')

@section('content')
<main id="main">
    <div class="dashboard">
        <div class="container">
            <h2>{{ __('Register') }}</h2>
            <form action="{{ route('register') }}" method="post" class="custom-form">
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
                                <label for="first_name" class="input-label">{{ __('Name') }}</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    data-id="name" 
                                    class="field-input required @error('name') input-error @enderror " 
                                    placeholder="{{ __('Your name') }}" 
                                    value="{{ old('name') }}" 
                                    autocomplete="name" 
                                    autofocus/>
                                @error('name')
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
                                <p class="field-instructions">{{ __('Already registered') }}? <a href="{{ route('login') }}">{{ __('Login Here') }}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="field-group">
                                <label for="phone_number" class="input-label">{{ __('Mobile Number') }}</label>
                                <input 
                                    type="text" 
                                    name="phone_number" 
                                    id="phone_number" 
                                    class="field-input required input-mobile @error('phone_number') input-error @enderror" 
                                    placeholder="{{ __('Type mobile number') }}" 
                                    value="{{ old('phone_number') }}" 
                                    autocomplete="phone_number" />
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <p class="field-instructions">{{ __('This will only be used for urgent matters and two-factor authentications.') }}</p>
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
                                    placeholder="{{ __('Enter a strong password') }}" />
                                @error('password')
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
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    id="password_confirm" 
                                    class="field-input required" 
                                    placeholder="{{ __('Re-enter the password') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="field-group">
                                <small>By clicking "Register", you agree to <a href="#">terms and conditions</a> and allows The Life Passport to utilize the information shared and send messages related to offerings and updates.</small>
                            </div>
                        </div>
                    </div>
                    <div class="field-group clearfix">
                        <input type="submit" class="field-submit" value="{{ __('Register') }}" />
                    </div>
                </div>
            </form>

            <div class="login-links clearfix">
                <p>{{ __('Already registered') }}? <a href="{{ route('register') }}">{{ __('Login Here') }}</a></p>
            </div>
        </div>
    </div>
</main>
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
@extends('master')

@section('page_title', 'Reset Password')

@section('content')
<main id="main" class="no-padding">
    <div class="dashboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h1 class="site-title">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ __('images/logo.png') }}" alt="{{ __('The Life Passport - Logo') }}" class="img-fluid" />
                        </a>
                    </h1>
                    <div class="login-block">
                        <h2>{{ __('Reset Password') }}</h2>
                        <div class="login-success-message">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>	
                                        <strong>{{ $message }}</strong>
                                </div>
                            @endif
                        
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="row" style="display:none;">
                                    <div class="col-xs-6">
                                        <div class="field-group">
                                            <label for="email" class="input-label">{{ __('E-Mail Address') }}</label>
                                            <input 
                                                type="text" 
                                                name="email" 
                                                id="email" 
                                                class="field-input required email @error('email') input-error @enderror" 
                                                placeholder="{{ __('Type E-Mail address') }}" 
                                                autocomplete="email"
                                                value="{{ $email ?? old('email') }}"
                                                autofocus />
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
                                                id="password-confirm" 
                                                class="field-input input-password required  @error('password') input-error @enderror" 
                                                placeholder="{{ __('Re-enter the password') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="field-group clearfix">
                                    <input type="submit" class="field-submit" value="{{ __('Reset Password') }}" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

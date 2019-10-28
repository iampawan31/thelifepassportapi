@extends('master')

@section('content')
<main id="main">
    <div class="dashboard">
        <div class="container">
            <h2>{{ __('Reset Password') }}</h2>
            <div class="login-success-message">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                @endif
            </div>
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
</main>

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
                                    {{ __('Reset Password') }}
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

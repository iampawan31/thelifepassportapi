@extends('master')

@section('content')
<main id="main">
    <div class="dashboard">
        <div class="container">
            <h2>{{ __('Verify Your Email Address') }}</h2>
            <div class="welcome-text">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
            </div>

            <!-- <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>. 
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</main>
@endsection

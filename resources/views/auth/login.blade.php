@extends('master')

@section('page_title', 'Login')

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
                        <h2>{{ __('Login to your account.') }}</h2>
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
                            <form action="{{ route('login') }}" method="post" class="custom-form ajax-form">
                                @csrf
                                <div class="field-group">
                                    <label for="email" class="input-label">{{ __('E-Mail Address') }}</label>
                                    <input type="text" name="email" id="email" class="field-input required email @error('email') input-error @enderror" placeholder="{{ __('Type E-Mail address') }}" value="{{ old('email') }}" autocomplete="email" />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="field-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input type="password" name="password" id="password" class="field-input input-password required  @error('password') input-error @enderror" placeholder="{{ __('Enter your password') }}" />
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="field-instructions">{{ __('Forgot your password?') }} <a href="{{ route('password.request') }}">{{ __('Click here') }}</a></div>
                                </div>
                                <div class="field-group form-group-checkbox clearfix">
                                  <label for="remember">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /><i></i> <span>{{ __('Remember Me') }}</span>
                                  </label>
                                </div>
                                {{-- <div class="field-group">
                                    <input class="field-input form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div> --}}
                                <div class="field-group field-group-submit">
                                    <input type="submit" class="field-submit" value="{{ __('Login') }}" />
                                </div>
                            </form>
                            <div class="login-links clearfix">
                                <p>{{ __("Don't have an account?") }} <a href="{{ route('register') }}">{{ __('Register Now') }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="dashboard__menus">
                        <ul class="clearfix">
                          <li>
                            <div class="item personal-information current">
                              <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-feather">
                                  <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                                  <line x1="16" y1="8" x2="2" y2="22"></line>
                                  <line x1="17.5" y1="15" x2="9" y2="15"></line>
                                </svg>
                                {{ __('Personal Information') }}
                              </span>
                              <div class="locked">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-lock">
                                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="item financial-information">
                              <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-briefcase">
                                  <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                  <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                {{ __('Financial Information') }}
                              </span>
                              <div class="locked">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-lock">
                                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="item professional-providers">
                              <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-users">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                  <circle cx="9" cy="7" r="4"></circle>
                                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                {{ __('Professional Service Providers') }}</span>
                              <div class="locked">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-lock">
                                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="item real-estate">
                              <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-home">
                                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                  <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                {{ __('Real Estate & Other Assets') }}</span>
                              <div class="locked">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-lock">
                                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="item insurance-information">
                              <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-shield">
                                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                                {{ __('Insurance Information') }}</span>
                              <div class="locked">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-lock">
                                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="item physical-locations">
                              <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-navigation">
                                  <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                                </svg>
                                {{ __('Physical Locations of Documents') }}</span>
                                <div class="locked">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-lock">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                  </svg>
                                </div>
                            </div>
                          </li>
                          <li>
                            <div class="item eol-planning">
                              <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-watch">
                                  <circle cx="12" cy="12" r="7"></circle>
                                  <polyline points="12 9 12 12 13.5 13.5"></polyline>
                                  <path
                                    d="M16.51 17.35l-.35 3.83a2 2 0 0 1-2 1.82H9.83a2 2 0 0 1-2-1.82l-.35-3.83m.01-10.7l.35-3.83A2 2 0 0 1 9.83 1h4.35a2 2 0 0 1 2 1.82l.35 3.83">
                                  </path>
                                </svg>
                                {{ __('End of Life Planning') }}
                              </span>
                              <div class="locked">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-lock">
                                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="item my-account has-children">
                              <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-user">
                                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                  <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                {{ __('My Account') }}
                              </span>
                              <div class="locked">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-lock">
                                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
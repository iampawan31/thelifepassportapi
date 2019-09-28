@extends('master')

@section('content')
<div id="main">
    <div class="dashboard">
        <div class="container">
            <div class="welcome-text">
                <p>Welcome to The Life Passport, one stop-shop to securely store all of your personal and financial information. It is the peace of mind, in knowing, those that you love will be well equipped to conveniently manage and access all of what you have built over a lifetime, when you may not be easily accessible.</p>
                <p><a href="{{ route('personal-details') }}" class="btn btn__get-started">Get Started</a></p>
            </div>

            <div class="dashboard__menus">
                <ul class="clearfix">
                    <li><a href="#"><span><i data-feather="feather"></i>Personal Information</span></a></li>
                    <li><a href="#"><span><i data-feather="briefcase"></i>Financial Information</span></a></li>
                    <li><a href="#"><span><i data-feather="users"></i>Professional Service Providers</span></a></li>
                    <li><a href="#"><span><i data-feather="home"></i>Real Estate & Other Assets</span></a></li>
                    <li><a href="#"><span><i data-feather="shield"></i>Insurance Information</span></a></li>
                    <li><a href="#"><span><i data-feather="navigation"></i>Physical Locations of Documents</span></a></li>
                    <li><a href="#"><span><i data-feather="watch"></i>End of Life Planning</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
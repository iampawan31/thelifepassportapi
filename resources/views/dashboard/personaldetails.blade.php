@extends('master')

@section('content')
<main id="main" class="personal-information">
    <div class="questions-nav">
        <h4>Navigate</h4>
        <ul>
            <li><a href="#" class="questions-nav__prev"><i data-feather="arrow-left"></i></a></li>
            <li><a href="personal-information.php" class="questions-nav__list"><i data-feather="list"></i></a></li>
            <li><a href="#" class="questions-nav__next"><i data-feather="arrow-right"></i></a></li>
        </ul>
    </div>
    <personal-details></personal-details>
    </div>
    @endsection
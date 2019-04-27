<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}" type="text/css">
    <script async="false" defer
            src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API')}}&language=fa&region=IR&libraries=places">
        //            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlcVddNcJrrifavMfBBHkGhmh8ajmskbU&callback=initMap">
    </script>
</head>
<body>

{{--static navbar--}}
<nav class="navbar navbar-expand-md navbar-dark fixed-top   bg-primary">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="{{Request::is('/') ? 'active ':''}}nav-item text-center">
                <a class="nav-link" href="/">خانه <span class="sr-only">(current)</span></a>
            </li>
            <li class="{{Request::is('banners/create') ? 'active ':''}} nav-item text-center">
                <a class="nav-link" href="/banners/create">ساخت</a>
            </li>
            <li class="{{Request::is('madrese.view') ? 'active ':''}}nav-item text-center">
                <a class="nav-link" href="{{route('madrese.view')}}">مدارس</a>
            </li>
            {{--<li class="{{Request::is('map') ? 'active ':''}}nav-item text-center">--}}
            {{--<a class="nav-link" href="{{route('map')}}">نقشه</a>--}}
            {{--</li>--}}

            {{--enter and register or logout--}}

            @if(auth()->guest())
                <li class="nav-item"><a class="nav-link text-center" href="{{url('login')}}">ورود</a></li>
                <li class="nav-item"><a class="nav-link text-center" href="{{url('register')}}">ثبت نام</a></li>
            @else
                <li class="nav-item dropdown ">
                    <a href="#" class=" nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">
                        {{auth()->user()->username}} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">

                        <li class="nav-item text-center">
                            <form id="user-panel-form" method="POST" style="display: none;"
                                  action="{{ route('user.panel',['username' =>auth()->user()->username]) }}"
                            >
                                {{ csrf_field() }}
                            </form>

                            <a class="nav-link"
                               onclick="event.preventDefault(); document.getElementById('user-panel-form').submit();"
                               href="{{ route('user.panel',['username' =>auth()->user()->username]) }}">
                                پنل کاربری <i class="fa fa-btn fa fa-user-circle"></i>
                            </a>
                        </li>

                        <li class="nav-item text-center">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                            <a class="nav-link"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               href="{{route('logout')}}">
                                <i class="fa fa-btn fa fa-sign-out"></i>خروج
                            </a>
                        </li>


                    </ul>
                </li>
            @endif


        </ul>

        <form class="form-inline mt-2 mt-md-0">
            {{csrf_field()}}
            <input class="form-control mr-sm-2" type="text" placeholder="جستجو" aria-label="Search">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">جستجو</button>
        </form>

    </div> <!-- nav collapse -->
    <a class="navbar-brand" href="/">سه کنج</a>
</nav>
{{--end static navbar--}}

<section class="container-fluid my-content" id="app">
    @yield('content')
</section>

<footer class="section footer-classic context-dark bg-secondary mt-5 mb-1   " style="">
    <div class="container">
        <div class="row ">
            <div class="col-md-4 col-xl-5">
                <div class="pr-xl-4"><a class="brand" href="index.html"><img class="brand-logo-light"
                                                                             src="images/agency/logo-inverse-140x37.png"
                                                                             alt="" width="140" height="37"
                                                                             srcset="images/agency/logo-retina-inverse-280x74.png 2x"></a>
                    <p>We are an award-winning creative agency, dedicated to the best result in web design, promotion,
                        business consulting, and marketing.</p>
                    <!-- Rights-->
                    <p class="rights"><span>©  </span><span
                                class="copyright-year">2018</span><span> </span><span>Waves</span><span>. </span><span>All Rights Reserved.</span>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Contacts</h5>
                <dl class="contact-list">
                    <dt>Address:</dt>
                    <dd>798 South Park Avenue, Jaipur, Raj</dd>
                </dl>
                <dl class="contact-list">
                    <dt>email:</dt>
                    <dd><a href="mailto:#">dkstudioin@gmail.com</a></dd>
                </dl>
                <dl class="contact-list">
                    <dt>phones:</dt>
                    <dd><a href="tel:#">+91 7568543012</a> <span>or</span> <a href="tel:#">+91 9571195353</a>
                    </dd>
                </dl>
            </div>
            <div class="col-md-4 col-xl-3">
                <h5>Links</h5>
                <ul class="nav-list">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Projects</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contacts</a></li>
                    <li><a href="#">Pricing</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row no-gutters social-container">
        <div class="col"><a class="social-inner" href="#"><span
                        class="icon mdi mdi-facebook"></span><span>Facebook</span></a></div>
        <div class="col"><a class="social-inner" href="#"><span
                        class="icon mdi mdi-instagram"></span><span>instagram</span></a></div>
        <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-twitter"></span><span>twitter</span></a>
        </div>
        <div class="col"><a class="social-inner" href="#"><span
                        class="icon mdi mdi-youtube-play"></span><span>google</span></a></div>
    </div>
</footer>

<script src="/js/dropzone.js"></script>

<script src="/js/app.js"></script>
{{--@include('flash')--}}
{{--@yield('script')--}}


</body>
</html>
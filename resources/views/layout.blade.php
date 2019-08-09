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

    <!-- Include a polyfill for ES6 Promises (optional) for IE11 -->

    {{--<link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css"--}}
    {{--type="text/css">--}}

</head>
<body>

{{--static navbar--}}
<nav class="navbar navbar-expand-md navbar-dark fixed-top  bg-gradient-blue" id="navbar">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="{{request()->is('/') ? 'active ':''}}nav-item text-center">
                <a class="nav-link" href="/">خانه <span class="sr-only">(current)</span></a>
            </li>

            @if(auth()->user())
                <li class="{{request()->is('schools') ? 'active ':''}}nav-item text-center">
                    <a class="nav-link"
                       href="{{route('school.view',['username' =>auth()->user()->username])}}">مدارس</a>
                </li>
            @endif
            {{--<li class="{{Request::is('map') ? 'active ':''}}nav-item text-center">--}}
            {{--<a class="nav-link" href="{{route('map')}}">نقشه</a>--}}
            {{--</li>--}}

            {{--enter and register or logout--}}

            @if(auth()->guest())
                <li class="{{request()->is('login') ? 'active ':''}}nav-item">
                    <a class="nav-link text-center" href="{{url('login')}}">ورود</a></li>
                <li class="{{request()->is('register') ? 'active ':''}}nav-item">
                    <a class="nav-link text-center" href="{{url('register')}}">ثبت نام</a></li>
            @else
                @can('create','App\User')
                    <li class="{{request()->is('register') ? 'active ':''}}nav-item">
                        <a class="nav-link text-center"
                           href="{{route('user.view',['username' =>auth()->user()->username])}}">ثبت کاربر</a></li>
                @endcan
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

        {{--<form class="form-inline mt-2 mt-md-0">--}}
        {{--{{csrf_field()}}--}}
        {{--<input class="form-control mr-sm-2" type="text" placeholder="جستجو" aria-label="Search">--}}
        {{--<button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">جستجو</button>--}}
        {{--</form>--}}

    </div> <!-- nav collapse -->
    <div
            class=" bg-gradient-purple small position-absolute left-0 bottom-0 px-2 mx-2 ">{{ \Morilog\Jalali\Jalalian::forge('today')->format('%A, %d %B %y')}}</div>
    <a class="navbar-brand" href="/">عشایر</a>
</nav>
{{--end static navbar--}}

<section class=" container-full parallax-front " id="app">
    @yield('content')
</section>

@include('layouts.footer')

<script src='https://google.com/recaptcha/api.js?hl=fa'></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
<script src="{{mix('js/app.js')}}"></script>
<script
        src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList"></script>
@yield('scripts')
{{--@include('flash')--}}
{{--@yield('script')--}}
@include('flash')
<script>
    let prevScrollpos = window.pageYOffset;
    window.onscroll = function () {
        let currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "-4.5rem";
        }
        prevScrollpos = currentScrollPos;
    };

    //    $(window).scroll(function () {
    //        let bottom_of_screen = $(window).scrollTop() + window.innerHeight;
    //        let top_of_screen = $(window).scrollTop();
    //        let features = $("#features");
    //        let numbers = $("#numbers");
    //
    //        let top_of_features = features.offset().top;
    //        let bottom_of_features = top_of_features + features.outerHeight();
    //
    //        if ((bottom_of_screen > top_of_features) && (top_of_screen < bottom_of_features)) {
    //            $(features).fadeIn();
    //        }
    //        else {
    //            $(features).fadeOut();
    //        }
    //
    //        let top_of_numbers = numbers.offset().top;
    //        let bottom_of_numbers = top_of_numbers + numbers.outerHeight();
    //
    //        if ((bottom_of_screen > top_of_numbers) && (top_of_screen < bottom_of_numbers)) {
    //            $(numbers).fadeIn();
    //        }
    //        else {
    //            $(numbers).fadeOut();
    //        }
    //    });

</script>
</body>
</html>
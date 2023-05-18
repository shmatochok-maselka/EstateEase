<!DOCTYPE html>
<html lang="en">
<head>
    <title>EstateEase</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500">
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mediaelementplayer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fl-bigmug-line.css') }}">


    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>

<div class="site-loader"></div>

<div class="site-wrap">

    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>
</div>
<div class="site-navbar">
    <div class="container py-1">
        <div class="row align-items-center">
            <div class="col-8 col-md-8 col-lg-4">
                <h1 class=""><a href="/" class="h5 text-black" style="font-size: 35px"><strong>EstateEase<span
                                class="text-black">.</span></strong></a></h1>
            </div>
            <div class="col-4 col-md-4 col-lg-8">
                <nav class="site-navigation text-right text-md-right" role="navigation">

                    <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#"
                                                                                  class="site-menu-toggle js-menu-toggle text-black"><span
                                class="icon-menu h3"></span></a></div>

                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                        <li class="has-children">
                            <a href="/">Місцезнаходження</a>
                            <ul class="dropdown">
                                @foreach ($globalLocations as $location)
                                    <li><a href="{{ route('location', $location->slug) }}">{{ $location->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="/">Тип нерухомості</a>
                            <ul class="dropdown">
                                @foreach ($globalEventTypes as $eventType)
                                    <li><a href="{{ route('event_type', $eventType->slug) }}">{{ $eventType->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('about') }}">Про нас</a></li>
                        <li><a href="{{ route('contact') }}">Контакти</a></li>
                        <li>
                            @guest
                                @if (Route::has('login'))
                                    <a class="no-underline hover:underline" href="{{ route('login') }}">Увійти</a>
                                @endif
                            @else
                                <a href="{{ route('logout') }}"
                                   class="no-underline hover:underline"
                                   onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">Вихід</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            @endguest
                            <i class="fa fa-user" style="color: #fff;"></i>
                        </li>
                    </ul>
                </nav>
            </div>


        </div>
    </div>
</div>
@yield('content')

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="mb-5">
                    <a href="{{ route('about') }}"><h3 class="footer-heading mb-4">Про проект</h3></a>
                    <p>Проект EstateEase має на меті допомогти людям знайти своє ідеальне житло на Закарпатті. Цей
                        проект створений для того, щоб спростити процес пошуку нерухомості та зробити його більш
                        ефективним і зручним для користувачів.</p>
                    <p>Завдяки використанню сучасних технологій та інноваційних
                        рішень, EstateEase надає можливість знайти житло з врахуванням всіх потрібних параметрів, таких
                        як ціна, тип нерухомості, кількість кімнат, місцезнаходження та інші. Ми прагнемо зробити пошук
                        нерухомості на Закарпатті більш доступним та зручним для кожного, хто прагне знайти своє
                        ідеальне житло в цьому чудовому куточку України.</p>
                </div>
            </div>
            <div class="col-lg-3 mb-5 mb-lg-0">
                <div class="row mb-5">
                    <div class="col-md-6 col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="{{ route('about') }}"><h3 class="footer-heading mb-4">Про нас</h3></a></li>
                            <li><a href="{{ route('contact') }}"><h3 class="footer-heading mb-4">Контакти</h3></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 mb-5 mb-lg-0">
                <h3 class="footer-heading mb-4">Слідкуйте за нами у соціальних мережах</h3>
                <div>
                    <a href="https://uk-ua.facebook.com/" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                    <a href="https://twitter.com/?lang=uk" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                    <a href="https://www.instagram.com/" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                    <a href="https://www.linkedin.com/feed/" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                </div>
            </div>

        </div>
    </div>
</footer>

</div>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/mediaelement-and-player.min.js') }}"></script>
<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>

<script src="{{ asset('js/main-front.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>


@yield('javascript')

</body>
</html>

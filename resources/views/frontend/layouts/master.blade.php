
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Moniruzzaman</title>
        @include('frontend.layouts.partials.style')
    </head>
    <body class="cv has-additional-menu-content">
        <header id="identity">
            <!-- Logo -->
            <div class="logo">
                <a href="index.html" class="logo-link" rel="home"> <img src="{{ asset('frontend_assets/images/logo.png') }}" class="logo" alt=""> </a>
            </div>
        </header>
        @include('frontend.layouts.partials.menu')
        @include('frontend.layouts.partials.socialmenu')
        @include('frontend.layouts.partials.banner')
        <!-- Content -->
        <div class="content-wrap clearfix">
            @yield('content')
            @include('frontend.layouts.partials.copyright')
        </div>
        @include('frontend.layouts.partials.hiddenmenu')
        @include('frontend.layouts.partials.footerinfo')
        @include('frontend.layouts.partials.scripts')
    </body>
</html>

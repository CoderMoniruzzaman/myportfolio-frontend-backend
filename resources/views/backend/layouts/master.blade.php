<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title','EmployerSixteen')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.layouts.partial.style')
</head>
<body>
    <div id="app">
        <!-- page container area start -->
        <div class="page-container">
            @include('backend.layouts.partial.sidebar')
            <!-- main content area start -->
            <div class="main-content">
                @include('backend.layouts.partial.header')
                @yield('breadcum')
                <div class="main-content-inner mt-30">
                    @yield('content')
                </div>
            </div>
            <!-- main content area end -->
            @include('backend.layouts.partial.footer')
        </div>
        <!-- page container area end -->
        @include('backend.layouts.partial.offset')
    </div>
    @include('sweetalert::alert')
    @include('backend.layouts.partial.scripts')
</body>
</html>

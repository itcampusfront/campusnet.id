<!DOCTYPE html>
<html lang="en">
<head>
    @include('template/member/_head')
    @yield('css-extra')
</head>
<body style="background-color: #f8f9fa" id="home">
    <div class="" id="body-row">
        <div class="d-flex">
            <div class="left">
                @include('template/member/_sidebar')
            </div>
            <div class="right">
                @include('template/member/_header')
                <div class="right-container">
                    @yield('content')
                </div>
                @include('template/member/_footer')
            </div>
        </div>
    </div>
    @include('template/member/_js')
    @yield('js-extra')
</body>
</html>
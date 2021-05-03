<!DOCTYPE html>
<html lang="en">
<head>
    @include('template/admin/_head')
    @yield('css-extra')
</head>
<body style="background-color: #f8f9fa" id="home">
    <div class="" id="body-row">
        <div class="d-flex">
            <div class="left">
                @include('template/admin/_sidebar')
            </div>
            <div class="right">
                @include('template/admin/_header')
                <div class="right-container">
                    @yield('content')
                </div>
                @include('template/admin/_footer')
            </div>
        </div>
    </div>
    @include('template/admin/_js')
    @yield('js-extra')
</body>
</html>
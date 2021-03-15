<!DOCTYPE html>
<html lang="en">
<head>
    @include('template/admin/_head')
    @yield('css-extra')
</head>
<body style="background-color: #f8f9fa" id="home">
    @include('template/admin/_header')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 py-4 d-none d-lg-block">
                @include('template/admin/_sidebar')
            </div>
            <div class="col-lg-9 py-4">
                @yield('content')
            </div>
        </div>
    </div>
    @include('template/admin/_footer')
    @include('template/admin/_js')
    @yield('js-extra')
</body>
</html>
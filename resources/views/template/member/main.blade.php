<!DOCTYPE html>
<html lang="en">
<head>
    @include('template/member/_head')
    @yield('css-extra')
</head>
<body style="background-color: #f8f9fa" id="home">
    @include('template/member/_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 vh-100 py-4">
                @include('template/member/_sidebar')
            </div>
            <div class="col-9 py-4">
                @yield('content')
            </div>
        </div>
    </div>
    @include('template/member/_js')
    @yield('js-extra')
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('template/front/_head')
    @include('template/front/_css')
    @yield('css-extra')
</head>
<body style="background-color: #f8f9fa">
    @include('template/front/_navbar')
    <div class="wrap" style="margin-top: 4em;" id="wrapper">
        @yield('content')
    </div>
    @include('template/front/_footer')
    @include('template/front/_js')
    @yield('js-extra')
</body>
</html>
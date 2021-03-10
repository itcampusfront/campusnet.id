<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('template/front/_head')
    @yield('css-extra')
</head>
<body style="background-color: #f8f9fa" id="home">
    <!-- fab -->
    <div class="fixed-bottom d-flex align-items-center justify-content-end text-right">
        <div class="bg-white shadow-sm px-3 py-2 mr-2 rounded-3" style="width: fit-content; animation: fab 2s infinite ease">
            <span class="font-weight-bold">Contact Us</span>
        </div>
        <a href="https://wa.me/62816343741" target="blank" class="opacity-0">
        <div class="rounded-circle shadow-sm float-right text-center d-flex align-items-center justify-content-center mr-2 mb-2" style="width: 60px; height: 60px; background-color: #00E676;">
            <i class="fab fa-whatsapp h1 text-white m-0"></i>
        </div>
        </a>
    </div>
    @include('template/front/_navbar')
    <div class="wrap">
        @yield('content')
    </div>
    @include('template/front/_footer')
    @include('template/front/_js')
    @yield('js-extra')
</body>
</html>
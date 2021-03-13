<!DOCTYPE html>
<html lang="en">
<head>
    @include('template/member/_head')
    @yield('css-extra')
</head>
<body style="background-color: #f8f9fa" id="home">
    @include('template/member/_header')
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
    <div class="container">
        <div class="row">
            <div class="col-lg-3 py-4 d-none d-lg-block">
                @include('template/member/_sidebar')
            </div>
            <div class="col-lg-9 py-4">
                @yield('content')
            </div>
        </div>
    </div>
    @include('template/member/_js')
    @yield('js-extra')
</body>
</html>
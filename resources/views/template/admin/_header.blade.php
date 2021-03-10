<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container justify-content-start justify-content-lg-center text-lg-center">
        <button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand p-0 w-100 w-md-0" href="/">
            <!-- <h1 style="font-family: 'Dancing Script', cursive;">
                <span class="color-theme-1">Campus</span><span class="color-theme-2">net</span>
            </h1> -->
            <img width="160" src="{{asset('assets/images/logo/campusnet.webp')}}">
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="d-block d-lg-none">
                @include('template/admin/_sidebar')
            </div>
        </div>
    </div>
</nav>
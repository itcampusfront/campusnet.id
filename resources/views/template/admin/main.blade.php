<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('template/front/_head')
</head>
<body style="background-color: #f8f9fa" id="home">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <!-- sadsad -->
        <div class="container justify-content-center">
            <button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand p-0" href="#home">
                <h1 style="font-family: 'Dancing Script', cursive;">
                    <span class="color-theme-1">Campus</span><span class="color-theme-2">net</span>
                </h1>
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-3 vh-100 py-4">
                <div class="sidebar">
                    <div class="profile-info text-center bg-white shadow-sm rounded-3 py-4 mb-4">
                        <img width="100" class="mb-3" src="https://ingeniolms.com/img/avatar.svg">
                        <h5>Username</h5>
                        <p>username@gmail.com</p>
                    </div>
                    <div class="list-group list-group-flush bg-white shadow-sm rounded-3 p-3">
                        <a class="list-group-item mb-3 border-0" href="#"><i class="fas fa-tachometer-alt mr-3"></i> Dashboard</a>
                        <a class="list-group-item mb-3 border-0" href="#"><i class="fas fa-globe-asia mr-3"></i> Website</a>
                        <a class="list-group-item mb-3 border-0" href="#"><i class="fas fa-exchange-alt mr-3"></i> Transaksi</a>
                        <a class="list-group-item border-0" href="#"><i class="fas fa-power-off mr-3"></i> Keluar</a>
                    </div>
                </div>
            </div>
            <div class="col-9 py-4">
                <div class="content">
                    <div class="bg-white rounded-3 shadow-sm py-3 px-4 mb-4">
                        <div class="media">
                            <img width="150" class="mr-4" src="{{asset('assets/images/ilustrasi/undraw_social_friends_nsbv.svg')}}">
                            <div class="media-body">
                                <h5 class="m-0">Selamat datang Username</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli<br>sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                                <button class="btn btn-theme-2 rounded-3 px-3">Order Sekarang</button>
                            </div>
                        </div>
                    </div>
                    <div class="detail mb-4">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center">
                                    <div class="card-header rounded-3 border-0 shadow" style="background-color: #f95738; color: #fff">
                                        <p class="m-0">Pengguna Baru</p>
                                    </div>
                                     <div class="card-body">
                                         <h1>2</h1>
                                     </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center">
                                    <div class="card-header rounded-3 border-0 shadow" style="background-color: #0d3b66; color: #fff">
                                        <p class="m-0">Website Baru</p>
                                    </div>
                                     <div class="card-body">
                                         <h1>2</h1>
                                     </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center">
                                    <div class="card-header rounded-3 border-0 shadow" style="background-color: #ffd100; color: #fff">
                                        <p class="m-0">Menunggu Pembayaran</p>
                                    </div>
                                     <div class="card-body">
                                         <h1>2</h1>
                                     </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="card border-0 shadow-sm rounded-3 text-center">
                                    <div class="card-header rounded-3 border-0 shadow" style="background-color: #735d78; color: #fff">
                                        <p class="m-0">Transaksi Berhasil</p>
                                    </div>
                                     <div class="card-body">
                                         <h1>2</h1>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-3 shadow-sm py-3 px-4 mb-4">
                        <h5>Website Kamu</h5>
                        <div class="list-group list-group-flush">
                            <a class="list-group-item" href="#"><i class="fas fa-globe-asia mr-3"></i> www.something.com</a>
                            <a class="list-group-item" href="#"><i class="fas fa-globe-asia mr-3"></i> www.something.com</a>
                            <a class="list-group-item" href="#"><i class="fas fa-globe-asia mr-3"></i> www.something.com</a>
                            <a class="list-group-item" href="#"><i class="fas fa-globe-asia mr-3"></i> www.something.com</a>
                            <a class="list-group-item" href="#"><i class="fas fa-globe-asia mr-3"></i> www.something.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('template/front/_js')
</body>
</html>
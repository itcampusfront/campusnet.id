<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="{{ get_website_name() }}">
        <!-- Open Graph Meta-->
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ get_website_name() }}">
        <meta property="og:title" content="{{ get_website_name() }}">
        <meta property="og:url" content="{{ URL::to('/') }}">
        <meta property="og:image" content="{{ asset('assets/images/logo/'.get_icon()) }}">
        <meta property="og:description" content="{{ get_website_name() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('assets/images/logo/'.get_icon()) }}">
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('templates/vali-admin/css/main.css') }}">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />

        <style type="text/css">
            /* Change Primary */
            ::selection {background-color: {{ get_warna_primer() }}!important;}
            ::-moz-selection {background-color: {{ get_warna_primer() }}!important;}
            a {color: {{ get_warna_primer() }};}
            a:hover {color: {{ get_warna_sekunder() }};}
            .page-link {color: {{ get_warna_primer() }};}
            .page-link:hover {color: {{ get_warna_sekunder() }};}
            .nav-pills .nav-link.active, .nav-pills .show > .nav-link {background-color: {{ get_warna_primer() }}!important;}
            .material-half-bg .cover {background-color: {{ get_warna_primer() }}!important;}
            .app-sidebar {background-color: {{ get_warna_primer() }}!important;}
            .app-sidebar__toggle:focus, .app-sidebar__toggle:hover {background-color: {{ get_warna_sekunder() }}!important;}
            .text-primary {color: {{ get_warna_primer() }}!important;}
            .btn-primary {background-color: {{ get_warna_primer() }}!important; border-color: {{ get_warna_primer() }}!important;}
            .btn-primary:hover {background-color: {{ get_warna_sekunder() }}!important; border-color: {{ get_warna_sekunder() }}!important;}
            .page-item.active .page-link {background-color: {{ get_warna_primer() }}!important; border-color: {{ get_warna_primer() }}!important;}
            .form-control:focus {border-color: {{ get_warna_primer() }}!important;}
            .animated-checkbox input[type="checkbox"]:checked + .label-text:before {color: {{ get_warna_primer() }}!important;}
            .widget-small.primary.coloured-icon .icon {background-color: {{ get_warna_primer() }}!important;}
            .dropdown-item.active, .dropdown-item:active {background-color: {{ get_warna_primer() }}!important;}
            .treeview-menu {background-color: {{ get_warna_sekunder() }}!important;}
            .progress-bar {background-color: {{ get_warna_primer() }}!important;}
            .btn-outline-primary {color: {{ get_warna_primer() }}; background-color: transparent; background-image: none; border-color: {{ get_warna_primer() }};}
            .btn-outline-primary:hover {color: #FFF; background-color: {{ get_warna_primer() }}; border-color: {{ get_warna_primer() }};}
            .btn-outline-primary:not(:disabled):not(.disabled):active, .btn-outline-primary:not(:disabled):not(.disabled).active, .show > .btn-outline-primary.dropdown-toggle {color: #FFF; background-color: {{ get_warna_primer() }}; border-color: {{ get_warna_primer() }};}

            .login-content .login-box {min-height: 430px;}
            .app-menu__item.active, .app-menu__item:hover, .app-menu__item:focus {border-left-color: #fdd100!important;}
            .treeview.is-expanded [data-toggle='treeview'] {border-left-color: #fdd100!important;}
            .btn .icon, .btn .fa {margin-right: 0; width: 14px;}
            .app-header {background-color: #555!important;}
            .app-sidebar__user-avatar {border-radius: 0!important;}
            .app-menu {border-top: 1px solid #bbb;}
            .app-menu__submenu {margin-top: 2rem; padding: 8px 15px;}
            .app-menu__submenu .app-menu__label {color: #fff; font-size: 1rem; font-weight: bold; text-transform: uppercase;}
            .tab-content {border-top: 1px solid {{ get_warna_primer() }};}
            .separator {width: 100%; margin: 1rem; border-top: 1px solid #ddd;}

            @media(max-width: 767px){
                .app-header__logo {display: none;}
            }

            @media(min-width: 768px){
                .app-header__logo {background-color: {{ get_warna_primer() }}80!important; font-family: 'Lato'; text-transform: uppercase;}
            }

            /* Custom this page */
            body {background-color: #e5e5e5;}
            main {margin-top: 90px!important;}
            .navbar {border-bottom: 2px solid {{ get_warna_primer() }};}
            .navbar .navbar-nav .nav-item {margin-left: .5rem!important;}
            .tile .tile-body .form-group:last-child {margin-bottom: 0px!important;}
            .tile#tile-title {border-top: 5px solid {{ get_warna_primer() }};}
            .tile .tile-body .form-row {margin-bottom: 1rem!important;}
            .tile .tile-body .form-row:last-child {margin-bottom: 0px!important;}
            .radio-disabled {height: 30px; width: 30px;}
        </style>

        <title>Quiz Generator | {{ get_website_name() }}</title>
    </head>
    <body>

        <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Quiz Generator</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto d-none d-sm-flex">
                        <li class="nav-item">
                            <a href="#" class="btn btn-outline-primary btn-submit my-2 my-sm-0">Submit</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto d-sm-none">
                        <li class="nav-item">
                            <a href="#" class="nav-link btn-submit">Submit</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container mb-5 main-quiz">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form id="form-quiz" method="post" action="#">
                        {{ csrf_field() }}
                        <input type="hidden" name="id">
                        <!-- Judul dan Deskripsi Soal -->
                        <div class="tile" id="tile-title">
                            <div class="tile-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="mb-3">{{ $kuis->judul_kuis }}</h3>
                                        <p class="text-justify">{{ $kuis->deskripsi_kuis }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Judul dan Deskripsi Soal -->
                        <!-- Pertanyaan dan Pilihan -->
                        <div class="tile-questions">
                            @for($i = 0; $i < $count; $i++)
                            <div class="tile tile-question" data-question="{{ $i }}">
                                <div class="tile-body">
                                    <div class="row">
                                        <div class="form-row col-md-12 form-question">
                                            <div class="col">
                                                <p class="h6 mb-0">{{ $kuis->pertanyaan[$i] }}</p>
                                                <img class="img-thumbnail mt-2 {{ $kuis->gambar_pertanyaan[$i] != '' ? '' : 'd-none' }}" src="{{ $kuis->gambar_pertanyaan[$i] }}" style="width: {{ $kuis->dimensi_pertanyaan[$i][1] }}px">
                                            </div>
                                        </div>
                                        @for($j = 0; $j < count($kuis->pilihan[$i]); $j++)
                                        <div class="form-row col-md-12 form-choice" data-choice="{{ $j }}">
                                            <div class="col-auto">
                                                <input type="radio" name="kunci[{{ $i }}]" class="radio-disabled" data-toggle="tooltip" data-placement="top" title="Pilih salah satu sebagai jawaban Anda">
                                            </div>
                                            <div class="col">
                                                <p class="mb-0">{{ $kuis->pilihan[$i][$j] }}</p>
                                                <img class="img-thumbnail mt-2 {{ $kuis->gambar_pilihan[$i][$j] != '' ? '' : 'd-none' }}" src="{{ $kuis->gambar_pilihan[$i][$j] }}" style="width: {{ $kuis->dimensi_pilihan[$i][$j][1] }}px">
                                            </div>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <!-- /Pertanyaan dan Pilihan -->
                    </form>
                </div>
            </div>
        </main>

        <main class="container mb-5 main-score d-none">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <p class="h5 quiz-message"></p>
                        <p class="mb-2">Skor Anda:</p>
                        <p><span class="h2 quiz-score"></span> / 100</p>
                        <button class="btn btn-primary btn-repeat">Ulangi Kuis</button>
                    </div>
                </div>
            </div>
        </main>

        <!-- Essential javascripts for application to work-->
        <script src="{{ asset('templates/vali-admin/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('templates/vali-admin/js/popper.min.js') }}"></script>
        <script src="{{ asset('templates/vali-admin/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('templates/vali-admin/js/main.js') }}"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="{{ asset('templates/vali-admin/js/plugins/pace.min.js') }}"></script>
        <script>
            // Klik Radio Disabled
            $(document).on("click", ".radio-disabled", function(e){
                $(this).tooltip("hide");
            });
        </script>
    </body>
</html>
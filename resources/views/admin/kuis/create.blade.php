<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="{{ get_website_name() }}">
        <!-- Open Graph Meta-->
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ get_website_name() }}">
        <meta property="og:title" content="{{ get_website_name() }}">
        <meta property="og:url" content="https://{{ get_website_name() }}.id">
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
            main {margin-top: 90px;}
            .navbar .navbar-nav .nav-item {margin-left: .5rem!important;}
            .tile .tile-body .form-group:last-child {margin-bottom: 0px!important;}
            .tile#tile-title {border-top: 5px solid {{ get_warna_primer() }};}
            .tile.tile-question {cursor: move!important;}
            .tile .tile-body .form-row {margin-bottom: 1rem!important;}
            .tile .tile-body .form-row:last-child {margin-bottom: 0px!important;}
            .tile .tile-footer .form-row {margin-left: 5px; margin-right: 5px;}
            .radio-disabled {height: 37px; width: 37px;}
            .btn-add-choice, .btn-answer-key {line-height: 37px; font-weight: bold;}
            .btn-remove-image-question, .btn-remove-image-choice {font-weight: bold;}
            textarea {overflow: hidden; min-height: 37px; resize: none;}
            input[name="judul_soal"] {font-size: 1.5rem; font-weight: bold;}
            #modal-image .modal-body {height: 80vh; overflow-y: auto;}
            .dropzone-wrapper {height: 150px; border: 2px dashed {{ get_warna_primer() }};}
            .dropzone-wrapper:hover {background-color: {{ get_warna_primer() }}66; transition: .3s ease-in;}
            .dropzone-desc {text-align: center; font-weight: bold;}
            .dropzone, .dropzone:focus {position: absolute; width: 100%; height: 150px; outline: none!important; cursor: pointer; opacity: 0;}
            .btn-choose-image {cursor: pointer; opacity: .7;}
            .btn-choose-image:hover {opacity: 1; transition: .3s ease-in;}
            .ui-state-highlight {height: 2rem; margin-bottom: 1rem;}
        </style>

        <title>Quiz Generator | {{ get_website_name() }}</title>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Quiz Generator</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto d-none d-lg-flex">
                        <li class="nav-item">
                            <a href="#" class="btn btn-outline-primary btn-submit my-2 my-sm-0">Simpan & Embed</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto d-lg-none">
                        <li class="nav-item">
                            <a href="#" class="nav-link btn-submit">Simpan & Embed</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form id="form-quiz" method="post" action="#">
                        {{ csrf_field() }}
                        <input type="hidden" name="id">
                        <!-- Judul dan Deskripsi Soal -->
                        <div class="tile" id="tile-title">
                            <div class="tile-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <input type="text" name="judul_soal" class="form-control form-field" value="Tanpa Judul" placeholder="Judul Soal">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea name="deskripsi_soal" class="form-control form-field" placeholder="Deskripsi Soal" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Judul dan Deskripsi Soal -->
                        <!-- Pertanyaan dan Pilihan -->
                        <div class="tile-questions"></div>
                        <!-- /Pertanyaan dan Pilihan -->
                    </form>
                </div>
            </div>
        </main>

        <div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambahkan Gambar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id-question">
                        <input type="hidden" id="id-choice">
                        <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-upload-tab" data-toggle="pill" href="#pills-upload" role="tab" aria-controls="pills-upload" aria-selected="true">Upload</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-galeri-tab" data-toggle="pill" href="#pills-galeri" role="tab" aria-controls="pills-galeri" aria-selected="false">Galeri</a>
                            </li>
                        </ul>
                        <div class="tab-content py-2" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-upload" role="tabpanel" aria-labelledby="pills-upload-tab">
                                <form id="form-upload" method="post" action="#" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex dropzone-wrapper align-items-center justify-content-center">
                                                <div class="dropzone-desc">
                                                    <i class="fa fa-2x fa-download"></i>
                                                    <p>Pilih file gambar atau drag ke sini.</p>
                                                </div>
                                                <input type="file" name="file" id="file" class="dropzone" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="progress d-none">
                                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-galeri" role="tabpanel" aria-labelledby="pills-galeri-tab"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-embed" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Embed Kuis</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success text-center"><i class="fa fa-check mr-2"></i>Berhasil menyimpan kuis.</div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Silahkan salin kode embed di bawah ini:</label>
                                    <div class="input-group">
                                        <input type="text" id="embed-url" class="form-control" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary btn-copy-url" type="button" data-toggle="tooltip" data-placement="top" title="Copy to Clipboard"><i class="fa fa-copy"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Essential javascripts for application to work-->
        <script src="{{ asset('templates/vali-admin/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('templates/vali-admin/js/popper.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"></script>
        <script src="{{ asset('templates/vali-admin/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('templates/vali-admin/js/main.js') }}"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="{{ asset('templates/vali-admin/js/plugins/pace.min.js') }}"></script>

        <script type="text/javascript">
            $(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });

            $(window).on("load", function(){
                $(".tile-questions").html(html_question());
                update_question();
            });

            // Sortable
            $(".tile-questions").sortable({
                placeholder: "ui-state-highlight",
                start: function(event, ui){
                    $(".ui-state-highlight").css("height", $(ui.item).outerHeight());
                },
                update: function(event, ui){
                    update_question();
                }
            });
            $(".tile-questions").disableSelection();

            // Cegah Press Enter pada Input Text
            $(document).on("keydown", "input[type=text]", function(e){
                if(e.keyCode == 13) e.preventDefault();
            });

            // Auto Resize Textarea
            $(document).on("keydown", "textarea", function(){
                var el = this;
                setTimeout(function(){
                    el.style.cssText = "height:auto; padding:0";
                    el.style.cssText = el.scrollHeight > 37 ? "height:" + (el.scrollHeight + 17) + "px" : "height:" + el.scrollHeight + "px";
                }, 0);
            });

            // Button Tambah Pertanyaan
            $(document).on("click", ".btn-add-question", function(e){
                e.preventDefault();
                $(this).tooltip("hide");
                var question = $(this).parents(".tile-question").data("question");
                add_question(question);
                update_question();
            });

            // Button Salin Pertanyaan
            $(document).on("click", ".btn-copy-question", function(e){
                e.preventDefault();
                $(this).tooltip("hide");
                var question = $(this).parents(".tile-question").data("question");
                copy_question(question);
                update_question();
                update_resizable_image(question);
            });

            // Button Hapus Pertanyaan
            $(document).on("click", ".btn-remove-question", function(e){
                e.preventDefault();
                $(this).tooltip("hide");
                var question = $(this).parents(".tile-question").data("question");
                delete_question(question);
                update_question();
            });

            // Button Tambah Gambar pada Pertanyaan
            $(document).on("click", ".btn-add-image-question", function(e){
                e.preventDefault();
                $(this).tooltip("hide");
                var question = $(this).data("question");
                var choice = $(this).data("choice");
                $("#id-question").val(question);
                $("#id-choice").val(choice);
                $("#modal-image").modal("show");
            });

            // Button Tambah Pilihan
            $(document).on("click", ".btn-add-choice", function(e){
                e.preventDefault();
                $(this).tooltip("hide");
                var question = $(this).data("question");
                add_choice(question);
                update_choice(question);
            });

            // Button Hapus Pilihan
            $(document).on("click", ".btn-remove-choice", function(e){
                e.preventDefault();
                $(this).tooltip("hide");
                var choice = $(this).data("choice");
                var question = $(this).parents(".tile-question").data("question");
                delete_choice(question, choice);
                update_choice(question);
            });

            // Button Tambah Gambar pada Pilihan
            $(document).on("click", ".btn-add-image-choice", function(e){
                e.preventDefault();
                $(this).tooltip("hide");
                var question = $(this).parents(".tile-question").data("question");
                var choice = $(this).data("choice");
                $("#id-question").val(question);
                $("#id-choice").val(choice);
                $("#modal-image").modal("show");
            });

            // Klik Radio Disabled
            $(document).on("click", ".radio-disabled", function(e){
                $(this).tooltip("hide");
            });

            // Upload Gambar
            $(document).on("change", "#file", function(){
                var question = $("#id-question").val();
                var choice = $("#id-choice").val();
                var image_selector = choice == 0 ? $(".tile-question[data-question="+question+"]").find(".form-question img") : $(".tile-question[data-question="+question+"]").find(".form-choice[data-choice="+choice+"]").find("img");
                var button_selector = choice == 0 ? $(".tile-question[data-question="+question+"]").find(".form-question .btn-remove-image-question") : $(".tile-question[data-question="+question+"]").find(".form-choice[data-choice="+choice+"]").find(".btn-remove-image-choice");
                $(".progress").removeClass("d-none");
                $(".progress-bar").text('0%').css({
                    'width' : '0%',
                    'color' : '#333',
                    'margin-left' : '5px',
                    'margin-right' : '5px',
                }).attr('aria-valuenow', 0);
                upload_image(image_selector, button_selector);
            });

            // Load Galeri Gambar
            $(document).on("click", "#pills-galeri-tab", function(){
                $.ajax({
                    type: "get",
                    url: "/admin/ajax/show-images",
                    success: function(response){
                        var result = JSON.parse(response);
                        var html = '';
                        html += '<div class="row">';
                        if(result.length > 0){
                            for(var i = 0; i < result.length; i++){
                                html += '<div class="col-lg-3 col-md-3 col-sm-6 mb-3">';
                                html += '<img class="img-fluid img-thumbnail btn-choose-image" src="{{ asset('assets/images/konten-kuis') }}/'+result[i]+'">';
                                html += '</div>';
                            }
                        }
                        else{
                            html += '<div class="col-12">';
                            html += '<div class="alert alert-danger text-center">Belum ada gambar tersedia.</div>';
                            html += '</div>';
                        }
                        html += '</div>';
                        $("#pills-galeri").html(html);
                    }
                });
            });

            // Button Pilih Gambar
            $(document).on("click", ".btn-choose-image", function(e){
                e.preventDefault();
                var question = $("#id-question").val();
                var choice = $("#id-choice").val();
                var image_selector = choice == 0 ? $(".tile-question[data-question="+question+"]").find(".form-question img") : $(".tile-question[data-question="+question+"]").find(".form-choice[data-choice="+choice+"]").find("img");
                var button_selector = choice == 0 ? $(".tile-question[data-question="+question+"]").find(".form-question .btn-remove-image-question") : $(".tile-question[data-question="+question+"]").find(".form-choice[data-choice="+choice+"]").find(".btn-remove-image-choice");
                var url = $(this).attr("src");
                $(image_selector).attr("src", url).removeClass("d-none");
                $(button_selector).removeClass("d-none");
                $(image_selector).resizable({
                    minWidth: 200,
                    minHeight: 100,
                    maxWidth: 350,
                    aspectRatio: $(image_selector).outerWidth() / $(image_selector).outerHeight(),
                });
                $("#modal-image").modal("toggle");
            });

            // Button Hapus Gambar
            $(document).on("click", ".btn-remove-image-question, .btn-remove-image-choice", function(e){
                e.preventDefault();
                var question = $(this).data("question");
                var choice = $(this).data("choice");
                var image_selector = choice == 0 ? $(".tile-question[data-question="+question+"]").find(".form-question .ui-wrapper") : $(".tile-question[data-question="+question+"]").find(".form-choice[data-choice="+choice+"]").find(".ui-wrapper");
                var button_selector = choice == 0 ? $(".tile-question[data-question="+question+"]").find(".form-question .btn-remove-image-question") : $(".tile-question[data-question="+question+"]").find(".form-choice[data-choice="+choice+"]").find(".btn-remove-image-choice");
                $(image_selector).before('<img src="" class="img-thumbnail mt-2 d-none" style="width: 200px;">');
                $(image_selector).find("img").remove();
                $(image_selector).remove();
                $(button_selector).addClass("d-none");
            });

            // Close Modal
            $("#modal-image").on("hidden.bs.modal", function(e){
                $("#id-question").val(null);
                $("#id-choice").val(null);

                // Hilangkan class active di nav-link
                $("#pills-tab .nav-item .nav-link").each(function(key,elem){
                    $(elem).removeClass("active");
                    key == 0 ? $(elem).addClass("active") : '';
                });

                // Hilangkan class active dan show di tab-pane
                $("#pills-tabContent .tab-pane").each(function(key,elem){
                    $(elem).removeClass("active show");
                    key == 0 ? $(elem).addClass("active show") : '';
                });
            });

            // Button Submit Quiz
            $(document).on("click", ".btn-submit", function(e){
                e.preventDefault();

                // Mencari element
                var pertanyaan = [];
                var pilihan = [];
                var gambar_pertanyaan = [];
                var gambar_pilihan = [];
                var kunci = [];
                $(".tile-question").each(function(key,elem){
                    pertanyaan.push($(elem).find(".form-question .pertanyaan"));
                    pilihan.push($(elem).find(".form-choice .pilihan"));
                    gambar_pertanyaan.push($(elem).find(".form-question img"));
                    gambar_pilihan.push($(elem).find(".form-choice img"));
                    kunci.push($(elem).find(".form-choice .radio-disabled"));
                });

                // Pertanyaan
                var array_pertanyaan = [];
                for(i = 0; i < pertanyaan.length; i++){
                    array_pertanyaan.push($(pertanyaan[i]).val());
                }

                // Pilihan
                var array_pilihan = [];
                for(i = 0; i < pilihan.length; i++){
                    array_pilihan.push([]);
                    for(j = 0; j < pilihan[i].length; j++){
                        array_pilihan[i].push($(pilihan[i][j]).val());
                    }
                }

                // Gambar pertanyaan
                var array_gambar_pertanyaan = [];
                var array_dimensi_gambar_pertanyaan = [];
                for(i = 0; i < gambar_pertanyaan.length; i++){
                    array_gambar_pertanyaan.push($(gambar_pertanyaan[i]).attr("src"));
                    array_dimensi_gambar_pertanyaan.push([]);
                    array_dimensi_gambar_pertanyaan[i][0] = $(gambar_pertanyaan[i]).outerHeight();
                    array_dimensi_gambar_pertanyaan[i][1] = $(gambar_pertanyaan[i]).outerWidth();
                }

                // Gambar pilihan
                var array_gambar_pilihan = [];
                var array_dimensi_gambar_pilihan = [];
                for(i = 0; i < gambar_pilihan.length; i++){
                    array_gambar_pilihan.push([]);
                    array_dimensi_gambar_pilihan.push([]);
                    for(j = 0; j < gambar_pilihan[i].length; j++){
                        array_gambar_pilihan[i].push($(gambar_pilihan[i][j]).attr("src"));
                        array_dimensi_gambar_pilihan[i].push([]);
                        array_dimensi_gambar_pilihan[i][j][0] = $(gambar_pilihan[i][j]).outerHeight();
                        array_dimensi_gambar_pilihan[i][j][1] = $(gambar_pilihan[i][j]).outerWidth();
                    }
                }

                // Kunci
                var array_kunci = [];
                for(i = 0; i < kunci.length; i++){
                    array_kunci[i] = '';
                    for(j = 0; j < kunci[i].length; j++){
                        if($(kunci[i][j]).is(":checked")) array_kunci[i] = j;
                    }
                }

                // AJAX
                $.ajax({
                    type: "post",
                    url: "/quiz/save",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $("input[name=id]").val(),
                        judul: $("input[name=judul_soal]").val(),
                        deskripsi: $("textarea[name=deskripsi_soal]").val(),
                        pertanyaan: JSON.stringify(array_pertanyaan),
                        pilihan: JSON.stringify(array_pilihan),
                        gambar_pertanyaan: JSON.stringify(array_gambar_pertanyaan),
                        gambar_pilihan: JSON.stringify(array_gambar_pilihan),
                        dimensi_pertanyaan: JSON.stringify(array_dimensi_gambar_pertanyaan),
                        dimensi_pilihan: JSON.stringify(array_dimensi_gambar_pilihan),
                        kunci_jawaban: JSON.stringify(array_kunci),
                    },
                    success: function(response){
                        var result = JSON.parse(response);
                        window.location.href = '/quiz/edit/' + result.kode + '?saved';
                        // $("input[name=id]").val(result.id);
                        // $("#embed-url").val(result.url);
                        // $("#modal-embed").modal("show");
                    }
                });
            });

            
            // Copy to Clipboard
            $(document).on("click", ".btn-copy-url", function(e){
                e.preventDefault();
                document.getElementById("embed-url").select();
                document.getElementById("embed-url").setSelectionRange(0, 99999);
                document.execCommand("copy");
                $(this).attr('data-original-title','Copied!');
                $(this).tooltip("show");
                $(this).attr('data-original-title','Copy to Clipboard');
            });
        </script>

        <script type="text/javascript">
            function html_question(){
                var html = '';
                html += '<div class="tile tile-question">';
                html += '<div class="tile-body">';
                html += '<div class="row">';
                html += '<div class="form-row col-md-12 form-question">';
                html += '<div class="col">';
                html += '<textarea name="pertanyaan[1]" class="form-control form-field pertanyaan" placeholder="Pertanyaan" rows="1"></textarea>';
                html += '<img class="img-thumbnail mt-2 d-none" src="" style="width: 200px;">';
                html += '<div><a href="#" class="btn-remove-image-question d-none" data-question="1" data-choice="0">Hapus Gambar</a></div>';
                html += '</div>';
                html += '<div class="col-auto"><button class="btn btn-primary btn-add-image-question" data-question="1" data-choice="0" data-toggle="tooltip" data-placement="top" title="Tambahkan Gambar"><i class="fa fa-image"></i></button></div>';
                html += '</div>';
                html += '<div class="form-row col-md-12 form-choice" data-choice="1">';
                html += '<div class="col-auto"><input type="radio" name="kunci[1]" class="radio-disabled" data-toggle="tooltip" data-placement="top" title="Pilih salah satu sebagai kunci jawaban"></div>';
                html += '<div class="col"><input type="text" name="pilihan[1][]" class="form-control form-field pilihan" placeholder="Pilihan"><img class="img-thumbnail mt-2 d-none" src="" style="width: 200px;"><div><a href="#" class="btn-remove-image-choice d-none" data-question="1" data-choice="1">Hapus Gambar</a></div></div>';
                html += '<div class="col-auto"><button class="btn btn-primary btn-add-image-choice" data-choice="1" data-toggle="tooltip" data-placement="top" title="Tambahkan Gambar"><i class="fa fa-image"></i></button></div>';
                html += '<div class="col-auto"><button class="btn btn-primary btn-remove-choice" data-choice="1" data-toggle="tooltip" data-placement="top" title="Hapus Pilihan" disabled><i class="fa fa-times"></i></button></div>';
                html += '</div>';
                html += '<div class="form-row col-md-12 form-add-choice">';
                html += '<div class="col-auto"><input type="radio" class="radio-disabled" disabled></div>';
                html += '<div class="col"><a href="#" class="btn-add-choice">Tambahkan Pilihan Lainnya</a></div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '<div class="tile-footer">';
                html += '<div class="form-row">';
                // html += '<div class="col"><a href="#" class="btn-answer-key"><i class="fa fa-check-circle-o mr-2"></i>Kunci Jawaban</a></div>';
                html += '<div class="col"></div>';
                html += '<div class="col-auto"><button class="btn btn-primary btn-add-question" data-toggle="tooltip" data-placement="top" title="Tambah Pertanyan"><i class="fa fa-plus"></i></button></div>';
                html += '<div class="col-auto"><button class="btn btn-primary btn-copy-question" data-toggle="tooltip" data-placement="top" title="Salin Pertanyan"><i class="fa fa-copy"></i></button></div>';
                html += '<div class="col-auto"><button class="btn btn-primary btn-remove-question" data-toggle="tooltip" data-placement="top" title="Hapus Pertanyan"><i class="fa fa-trash"></i></button></div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                return html;
            }

            function add_question(question_id){
                var tile = $(".tile-question[data-question="+question_id+"]");
                var html = html_question();
                $(tile).after(html);
            }

            function copy_question(question_id){
                var tile = $(".tile-question[data-question="+question_id+"]");
                var html = $(tile).clone();
                var radio = $(tile).find("input[type=radio]");
                var checked;
                $(radio).each(function(key,elem){
                    if($(elem).prop("checked")) checked = key;
                });
                $(tile).after(html);
                $(tile).find("input[type=radio]").each(function(key,elem){
                    if(key == checked) $(elem).prop("checked",true);
                });
            }

            function update_question(){
                // Selector
                var tile = $(".tile-question");

                // Get Pilihan
                $(tile).each(function(key,elem){
                    // Mengaktifkan atau menonaktifkan btn-remove-question
                    $(tile).length > 1 ? $(elem).find(".btn-remove-question").removeAttr("disabled") : $(elem).find(".btn-remove-question").attr("disabled","disabled");

                    // Mengupdate atribut data-question
                    $(elem).attr("data-question",(key+1));
                    $(elem).find(".btn-add-choice").attr("data-question",(key+1));
                    $(elem).find(".btn-answer-key").attr("data-question",(key+1));
                    $(elem).find(".btn-add-question").attr("data-question",(key+1));
                    $(elem).find(".btn-copy-question").attr("data-question",(key+1));
                    $(elem).find(".btn-remove-question").attr("data-question",(key+1));
                    $(elem).find(".btn-add-image-question").attr("data-question",(key+1));
                    $(elem).find(".btn-remove-image-question").attr("data-question",(key+1));
                    $(elem).find(".btn-remove-image-choice").attr("data-question",(key+1));

                    // Mengupdate atribut lainnya
                    $(elem).find(".radio-disabled").attr("name","kunci["+(key+1)+"]");
                    $(elem).find(".pertanyaan").attr("name","pertanyaan["+(key+1)+"]");
                    $(elem).find(".pilihan").attr("name","pilihan["+(key+1)+"][]");
                });

                // Tooltip
                $('[data-toggle="tooltip"]').tooltip();
            }

            function delete_question(question_id){
                $(".tile-question[data-question="+question_id+"]").remove();
            }

            function add_choice(question_id){
                // Selector
                var tile = $(".tile-question[data-question="+question_id+"]");

                // Tambah Pilihan Lainnya
                var html = '';
                html += '<div class="form-row col-md-12 form-choice">';
                html += '<div class="col-auto"><input type="radio" name="kunci['+question_id+']" class="radio-disabled" data-toggle="tooltip" data-placement="top" title="Pilih salah satu sebagai kunci jawaban"></div>';
                html += '<div class="col"><input type="text" name="pilihan['+question_id+'][]" class="form-control form-field pilihan" placeholder="Pilihan"><img class="img-thumbnail mt-2 d-none" src="" style="width: 200px;"><div><a href="#" class="btn-remove-image-choice d-none">Hapus Gambar</a></div></div>';
                html += '<div class="col-auto"><button class="btn btn-primary btn-add-image-choice" data-toggle="tooltip" data-placement="top" title="Tambahkan Gambar"><i class="fa fa-image"></i></button></div>';
                html += '<div class="col-auto"><button class="btn btn-primary btn-remove-choice" data-toggle="tooltip" data-placement="top" title="Hapus Pilihan"><i class="fa fa-times"></i></button></div>';
                html += '</div>';
                $(tile).find(".form-add-choice").before(html);
            }

            function update_choice(question_id){
                // Selector
                var tile = $(".tile-question[data-question="+question_id+"]");

                // Get Pilihan
                $(tile).find(".form-choice").each(function(key,elem){
                    // Mengaktifkan atau menonaktifkan btn-remove-choice
                    $(tile).find(".form-choice").length > 1 ? $(elem).find(".btn-remove-choice").removeAttr("disabled") : $(elem).find(".btn-remove-choice").attr("disabled","disabled");

                    // Mengupdate atribut data-choice
                    $(elem).attr("data-choice",(key+1));
                    $(elem).find(".btn-add-image-choice").attr("data-choice",(key+1));
                    $(elem).find(".btn-remove-image-choice").attr("data-question",question_id).attr("data-choice",(key+1));
                    $(elem).find(".btn-remove-choice").attr("data-choice",(key+1));
                });

                // Tooltip
                $('[data-toggle="tooltip"]').tooltip();
            }

            function delete_choice(question_id, choice_id){
                $(".tile-question[data-question="+question_id+"]").find(".form-choice[data-choice="+choice_id+"]").remove();
            }

            function upload_image(image_selector, button_selector){
                // Mengambil input file gambar
                var file = document.getElementById("file").files[0];
                var formdata = new FormData();
                formdata.append("file", file);
                formdata.append("_token", "{{ csrf_token() }}");
                
                // Mengirim form
                var ajax = new XMLHttpRequest();
                ajax.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200){
                        var image = new Image();
                        var imageHeight = 0;
                        image.src = this.responseText;
                        image.onload = function(){
                            imageHeight = this.height / this.width * 200;
                            $(image_selector).attr("src", this.src).css("height", imageHeight).removeClass("d-none");
                            $(image_selector).resizable({
                                minWidth: 200,
                                minHeight: 100,
                                maxWidth: 350,
                                aspectRatio: $(image_selector).outerWidth() / $(image_selector).outerHeight(),
                            });
                        }
                        $(button_selector).removeClass("d-none");
                    }
                }
                ajax.upload.addEventListener("progress", progress_handler, false);
                ajax.open("POST", "/admin/ajax/upload-image", true);
                ajax.send(formdata);
            }

            function progress_handler(event){
                // Hitung prosentase
                var percent = (event.loaded / event.total) * 100;

                // Menampilkan prosentase ke komponen progress-bar
                $(".progress-bar").text(Math.round(percent) + '%').css({
                    'width' : Math.round(percent) + '%',
                    'color' : '#fff',
                    'margin-left' : '0px',
                    'margin-right' : '0px',
                }).attr('aria-valuenow', Math.round(percent));

                // Jika sudah mencapai 100% akan menutup modal
                if(Math.round(percent) == 100){
                    $("#file").val(null);
                    setTimeout(function(){
                        $("#modal-image").modal("toggle");
                        $(".progress").addClass("d-none");
                    }, 1500);
                }
            }

            function update_resizable_image(question_id){
                var tile = $(".tile-question[data-question="+(question_id+1)+"]");
                
                // Mencari gambar yang resizable
                var img_resizable = $(tile).find("img.ui-resizable");

                // Menampungnya dalam array
                var img_array = [];
                var img_height_array = [];
                var img_width_array = [];
                var choice_array = [];
                $(img_resizable).each(function(key,elem){
                    img_height_array.push($(elem).outerHeight());
                    img_width_array.push($(elem).outerWidth());
                    img_array.push($(elem).attr("src"));
                    $(elem).parents(".form-choice").length == 0 ? choice_array.push(0) : choice_array.push($(elem).parents(".form-choice").data("choice"));
                });
                
                // Loop gambar yang tertampung dalam array
                for(var i=0; i<choice_array.length; i++){
                    if(choice_array[i] == 0){
                        $(tile).find(".form-question").find(".ui-wrapper").before('<img src="'+img_array[i]+'" class="img-thumbnail mt-2" style="width: '+(img_width_array[i]+10)+'px; height: '+(img_height_array[i]+10)+'px;">');
                        $(tile).find(".form-question").find(".ui-wrapper").remove();
                        $(tile).find(".form-question").find("img").resizable({
                            minWidth: 200,
                            minHeight: 100,
                            maxWidth: 350,
                            aspectRatio: img_width_array[i] / img_height_array[i],
                        });
                    }
                    else{
                        $(tile).find(".form-choice[data-choice="+choice_array[i]+"]").find(".ui-wrapper").before('<img src="'+img_array[i]+'" class="img-thumbnail mt-2"  style="width: '+(img_width_array[i]+10)+'px; height: '+(img_height_array[i]+10)+'px;">');
                        $(tile).find(".form-choice[data-choice="+choice_array[i]+"]").find(".ui-wrapper").remove();
                        $(tile).find(".form-choice[data-choice="+choice_array[i]+"]").find("img").resizable({
                            minWidth: 200,
                            minHeight: 100,
                            maxWidth: 350,
                            aspectRatio: img_width_array[i] / img_height_array[i],
                        });
                    }
                }
            }
        </script>

    </body>
</html>
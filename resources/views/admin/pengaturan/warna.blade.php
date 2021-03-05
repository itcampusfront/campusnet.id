@extends('template/admin/main')

@section('title', 'Pengaturan Warna')

@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-cog"></i> Pengaturan Warna</h1>
      <p>Menu untuk melakukan pengaturan warna pada sistem</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
      <li class="breadcrumb-item">Warna</li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <form method="post" action="/admin/pengaturan/update">
            {{ csrf_field() }}
            <input type="hidden" name="category" value="2">
            <div class="tile-title-w-btn">
                <h3 class="title">Pengaturan Warna</h3>
                <p><button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-save mr-2"></i>Simpan</button></p>
            </div>
            <div class="tile-body">
                @if(Session::get('message') != null)
                <div class="alert alert-dismissible alert-success">
                    <button class="close" type="button" data-dismiss="alert">×</button>{{ Session::get('message') }}
                </div>
                @endif
                <div class="row">
                    @foreach($settings as $key=>$setting)
                        <div class="form-group col-md-6">
                            <label>{{ $settings[$key]->setting_name }} <span class="text-danger">{{ is_int(strpos($settings[$key]->setting_rules, 'required')) ? '*' : '' }}</span></label>
                            <input type="text" name="settings[{{ $settings[$key]->setting_key }}]" class="form-control colorpicker {{ $errors->has('settings.'.$settings[$key]->setting_key) ? 'border-danger' : '' }}" id="{{ $settings[$key]->setting_key }}" value="{{ $settings[$key]->setting_value }}" placeholder="Masukkan {{ $settings[$key]->setting_name }}">
                            @if($errors->has('settings.'.$settings[$key]->setting_key))
                            <div class="form-control-feedback text-danger">{{ $errors->first('settings.'.$settings[$key]->setting_key) }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tile-footer"><button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-save mr-2"></i>Simpan</button></div>
        </form>
      </div>
    </div>
  </div>
</main>

@endsection

@section('js-extra')

<script src="{{ asset('templates/matrix-admin/assets/libs/jquery-asColor/dist/jquery-asColor.min.js') }}"></script>
<script src="{{ asset('templates/matrix-admin/assets/libs/jquery-asGradient/dist/jquery-asGradient.js') }}"></script>
<script src="{{ asset('templates/matrix-admin/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js') }}"></script>
<script src="{{ asset('templates/matrix-admin/assets/libs/jquery-minicolors/jquery.minicolors.min.js') }}"></script>
<script type="text/javascript">
    // Colorpicker
    $(".colorpicker").each(function(){
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            position: $(this).attr('data-position') || 'bottom left',
            change: function(value, opacity) {
                if (!value) return;
                var color = value;
                if (opacity) value += ', ' + opacity;
                if (typeof console === 'object') {
                    var id = $(this).attr("id");
                    if(id == "warna_primer") $("#navbarSupportedContent").attr("style", "background:"+color+"!important");
                    else if(id == "warna_sekunder") $(".navbar-header[data-logobg=skin5]").attr("style", "background:"+color+"!important");
                    else if(id == "warna_tersier") $("#main-wrapper .left-sidebar[data-sidebarbg=skin5], #main-wrapper .left-sidebar[data-sidebarbg=skin5] ul").attr("style", "background:"+color+"!important");
                    else if(id == "warna_scroll_track") document.styleSheets[2].addRule("::-webkit-scrollbar-track", "background: "+color+";");
                    else if(id == "warna_scroll_thumb") document.styleSheets[2].addRule("::-webkit-scrollbar-thumb", "background: "+color+";");
                    // console.log(value);
                }
            },
            theme: 'bootstrap'
        });
    });
</script>

@endsection

@section('css-extra')

<link rel="stylesheet" type="text/css" href="{{ asset('templates/matrix-admin/assets/libs/jquery-minicolors/jquery.minicolors.css') }}">
<style type="text/css">
    .minicolors-theme-bootstrap .minicolors-swatch {cursor: pointer;}
</style>

@endsection
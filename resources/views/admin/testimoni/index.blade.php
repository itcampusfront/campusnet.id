@extends('template/admin/main')

@section('title', 'Testimoni')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="/admin/testimoni">Testimoni</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Testimoni</li>
    </ol>
</nav>
<div class="content">
    <div class="bg-white rounded-3 shadow-sm py-3 px-4 mb-4">
        <h5>Data Testimoni</h5>
        <a href="/admin/testimoni/create" class="btn btn-sm btn-theme-1 mb-2">Tambah Testimoni</a>
        @if(Session::get('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <p><em>Drag (geser) testimoni di bawah ini untuk mengurutkan dari yang teratas sampai terbawah.</em></p>
        @if(count($testimoni)>0)
        <ul class="list-group sortable">
            @foreach($testimoni as $data)
                <div class="list-group-item d-flex justify-content-between align-items-center tile-testimoni" data-id="{{ $data->id_testimoni }}">
                    <div class="d-flex justify-content-between w-100">
                        <blockquote class="blockquote">
                            <p class="mb-0">{{ $data->ucapan_testimoni }}</p>
                            <footer class="blockquote-footer"><cite title="Source Title">{{ $data->klien }}</cite></footer>
                        </blockquote>
                    </div>
                    <div class="btn-group">
                        <a href="/admin/testimoni/edit/{{ $data->id_testimoni }}" class="btn btn-sm btn-theme-1" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-theme-1 btn-delete" title="Hapus" data-id="{{ $data->id_testimoni }}" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            @endforeach
        </ul>
        <form id="form-delete" class="d-none" method="post" action="/admin/testimoni/delete">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        </form>
        @else
        <div class="alert alert-danger text-center">Tidak ada testimoni.</div>
        @endif
    </div>
</div>
  
@endsection

@section('js-extra')

<script type="text/javascript">
    // Button Delete
    $(document).on("click", ".btn-delete", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var ask = confirm("Anda yakin ingin menghapus data ini?");
        if(ask){
            $("#form-delete input[name=id]").val(id);
            $("#form-delete").submit();
        }
    });
    
    // Sortable
    $(".sortable").sortable({
        placeholder: "ui-state-highlight",
        start: function(event, ui){
            $(".ui-state-highlight").css("height", $(ui.item).outerHeight());
        },
        update: function(event, ui){
            update_testimoni();
        }
    });
    $(".sortable").disableSelection();

    // Update urutan testimoni
    function update_testimoni(){
        var ids = [];
        $(".tile-testimoni").each(function(key,elem){
            ids.push($(elem).data("id"));
        });
        $.ajax({
            type: "post",
            url: "/admin/testimoni/sort",
            data: {_token: "{{ csrf_token() }}", ids: ids},
            success: function(response){
                alert(response);
            }
        });
    }
</script>
  
@endsection

@section('css-extra')

<style>
    .sortable .list-group-item {cursor: move!important;}
    .blockquote {font-size: 1rem;}
</style>
  
@endsection
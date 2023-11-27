@extends('template/admin/main')

@section('title', 'Fitur')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-3 px-4">
        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="/admin/fitur">Fitur</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Fitur</li>
    </ol>
</nav>
<div class="content">
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-theme-1 rounded-3 shadow border-0 d-flex justify-content-between align-items-center">
            <h5 class="my-2">Data Fitur</h5>
            <a href="/admin/fitur/create" class="btn btn-light opacity-0 rounded-3">Tambah Fitur</a>
        </div>
        <div class="card-body">
        @if(Session::get('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <p><em>Drag (geser) fitur di bawah ini untuk mengurutkan dari yang teratas sampai terbawah.</em></p>
        @if(count($fitur)>0)
        <ul class="list-group sortable">
            @foreach($fitur as $data)
                <div class="list-group-item d-flex justify-content-between align-items-center tile-fitur" data-id="{{ $data->id_fitur }}">
                    <div class="d-flex justify-content-between w-100">
                        <span>{{ $data->nama_fitur }}</span>
                    </div>
                    <div class="btn-group">
                        <a href="/admin/fitur/edit/{{ $data->id_fitur }}" class="btn btn-sm btn-theme-1" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-theme-1 btn-delete" title="Hapus" data-id="{{ $data->id_fitur }}" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            @endforeach
        </ul>
        <form id="form-delete" class="d-none" method="post" action="/admin/fitur/delete">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        </form>
        @else
        <div class="alert alert-danger text-center">Tidak ada fitur.</div>
        @endif
        </div>
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
            update_fitur();
        }
    });
    $(".sortable").disableSelection();

    // Update urutan fitur
    function update_fitur(){
        var ids = [];
        $(".tile-fitur").each(function(key,elem){
            ids.push($(elem).data("id"));
        });
        $.ajax({
            type: "post",
            url: "/admin/fitur/sort",
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
</style>
  
@endsection
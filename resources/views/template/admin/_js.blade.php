<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('assets/js/app.js')}}"></script>
<!-- tooltip -->
<script type="text/javascript">
	$(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<!-- tooltip end -->
<script type="text/javascript">
    // Button Show Modal Image
    $(document).on("click", ".btn-image", function(e){
        e.preventDefault();
        $("#modal-image").modal("show");
    });
    
    // Button Browse File
    $(document).on("click", ".btn-browse-file", function(e){
        e.preventDefault();
        $(this).parents(".form-group").find("input[type=file]").trigger("click");
    });

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

    // Button Forbidden
    $(document).on("click", ".btn-forbidden", function(e){
        e.preventDefault();
        alert("Anda tidak mempunyai akses untuk membuka halaman ini!");
    });
</script>

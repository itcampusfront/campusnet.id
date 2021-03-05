
<script type="text/javascript" src="{{ asset('assets/plugins/croppie/croppie.min.js') }}"></script>
<script type="text/javascript">
    /* Croppie */
    var demo = $('#demo').croppie({
        viewport: {width: 400, height: 400},
        boundary: {width: 400, height: 400}
    });
    var imageURL;

    // Change photo
    $(document).on("click", ".btn-change-photo", function(e){
        e.preventDefault();
        $("#file").trigger("click");
    });

    // Change Input File
    $(document).on("change", "#file", function(){
        readURL(this);
        $("#modal-croppie").modal("show");
    });

    // Show Modal Croppie
    $('#modal-croppie').on('shown.bs.modal', function(){
        demo.croppie('bind', {
            url: imageURL
        }).then(function(){
            console.log('jQuery bind complete');
        });
    });

    // Hide Modal Croppie
    $('#modal-croppie').on('shown.bs.hidden', function(){
        $("#img-file").removeAttr("src");
        $("input[name=gambar]").val("");
        $("#file").val(null);
    });

    // Crop Image
    $(document).on("click", "#btn-crop", function(e){
        demo.croppie("result", {
            type: "base64",
            format: "png",
            size: {width: 400, height: 400}
        }).then(function(response){
            $("input[name=gambar]").val(response);
            $("#form-croppie").submit();
        });
    });

  function readURL(input){
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            imageURL = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
  }
</script>

<form id="form1" enctype="multipart/form-data" method="POST" action="test14_1.php">

    <div class='preview'>
        <img src="" id="img" width="100" height="100">
    </div>

    <label>Imagen
        <input id="campofotografia" name="campofotografia" type="file" />
    </label>

    <input id="enviar" name="enviar" type="submit" value="Enviar" />

</form>

<script src="js/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
  $("#form1").on("submit", function(e){
    e.preventDefault();
        var fd = new FormData();
        var files = $('#campofotografia')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: 'test14_1.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              console.log(response);
            },
        });
    });
</script>


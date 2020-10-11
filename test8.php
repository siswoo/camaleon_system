
<form id="form1" enctype="multipart/form-data" method="POST" action="recepcion.php">

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
            url: 'test8_1.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	console.log(response);
            	/*
                if(response != 0){
                    $("#img").attr("src",response); 
                    $(".preview img").show();
                }else{
                    alert('file not uploaded');
                }
                */
            },
        });
    });
</script>


<?php
exit;
// A few settings
$img_file = 'img/slider_welcome/slider1.png';

// Read image path, convert to base64 encoding
$imgData = base64_encode(file_get_contents($img_file));

// Format the image SRC:  data:{mime};base64,{data};
$src = 'data: '.mime_content_type($img_file).';base64,'.$imgData;

// Echo out a sample image
echo '<img src="'.$src.'">';

//echo '<img src="img/slider_welcome/slider1.png">';
exit;
$imagedata = file_get_contents("img/slider_welcome/slider1.png");
// alternatively specify an URL, if PHP settings allow
$base64 = base64_encode($imagedata);

echo $base64;

echo '<p> <img href="'.$base64.'">';

?>
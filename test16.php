<?php
session_start();
?>
<div class="col-12" id="respuesta" style="font-size: 30px; text-align: center;"></div>
<script src="js/jquery-3.5.1.min.js"></script>
<script>
    $(function() { // Ojo! uso jQuery, recuerda añadirla al html
        cron(); // Lanzo cron la primera vez
        function cron() {
            $.ajax({
                method: "POST",
                url: "test16_1.php", // Podrías separar las funciones de PHP en un fichero a parte
                data: {
                    action: 1
                }
            }).done(function(msg) {
                console.log(msg);
                if(msg=='On'){
                	$('#respuesta').html('Logeado');
                }else{
                	$('#respuesta').html('Desconectado');
                }
            });
        }
        setInterval(function() {
            cron();
        }, 10000); // Lanzará la petición cada 10 segundos
    });
</script>
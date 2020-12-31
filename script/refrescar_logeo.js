$(function() {

    cron();
    
    function cron() {
        $.ajax({
            method: "POST",
            url: "../script/refrescar_logeo2.php",
            data: {
                action: 1
            }
        }).done(function(msg) {
            console.log(msg);
            if(msg=='On'){
                //$('#respuesta').html('Logeado');
            }else{
                //$('#respuesta').html('Desconectado');
            }
        });
    }

    setInterval(function() {
        cron();
    }, 60000);
});
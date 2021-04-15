$(document).ready(function(){
    var hidden_ubicacion = $('#hidden_ubicacion').val();

    var hidden_modelo_view = $('#hidden_modelo_view').val();
    var hidden_modelo_edit = $('#hidden_modelo_edit').val();
    var hidden_modelo_delete = $('#hidden_modelo_delete').val();

    var hidden_roles_view = $('#hidden_roles_view').val();
    var hidden_roles_edit = $('#hidden_roles_edit').val();
    var hidden_roles_delete = $('#hidden_roles_delete').val();

    var hidden_pasante_view = $('#hidden_pasante_view').val();
    var hidden_pasante_edit = $('#hidden_pasante_edit').val();
    var hidden_pasante_delete = $('#hidden_pasante_delete').val();

    var hidden_seguridad_view = $('#hidden_seguridad_view').val();

    var hidden_usuario_view = $('#hidden_usuario_view').val();

    /*
    if(hidden_modelo_view==0){
        $('#a-modelo').addClass('disabled');
        $('#a-modelo').removeClass('navbar-active-a');
    }

    if(hidden_roles_view==0){
        $('#a-roles').addClass('disabled');
        $('#a-roles').removeClass('navbar-active-a');
    }

    if(hidden_seguridad_view==0){
        $('#a-seguridad').addClass('disabled');
        $('#a-seguridad').removeClass('navbar-active-a');
    }

    if(hidden_pasante_view==0){
        $('#a-pasante').addClass('disabled');
        $('#a-pasante').removeClass('navbar-active-a');
    }
    */

    /*
    if(hidden_usuario_view==0){
        $('#a-usuario').addClass('disabled');
        $('#a-usuario').removeClass('navbar-active-a');
    }
    */

    if(hidden_ubicacion=="welcome"){
        $('#navbar-home').attr('href','welcome.php');
        $('#a-modelo').attr('href','modelo/index.php');
        $('#a-modelo2').attr('href','modelo/index2.php');
        $('#a-roles').attr('href','roles/index.php');
        $('#a-seguridad').attr('href','seguridad/index.php');
        $('#a-pasante').attr('href','pasante/index.php');
        $('#a-usuario').attr('href','usuarios/index.php');
        $('#a-Rinicio').attr('href','reportes/reporte_inicio.php');
        $('#a-monitores').attr('href','monitores/index.php');
        $('#a-reportes').attr('href','reportes/index.php');
        $('#a-pagos').attr('href','pagos/index.php');
        $('#a-erick').attr('href','erick/index.php');
        $('#a-community').attr('href','community/index.php');
        $('#a-consultas').attr('href','consultas/index.php');
        $('#a-pqr').attr('href','pqr/index.php');
        $('#a-admin').attr('href','admin/index.php');
        $('#a-personal').attr('href','personal/index.php');
        $('#a-nomina').attr('href','nomina/index.php');
        $('#a-cargos').attr('href','cargos/index.php');
        $('#a-funciones').attr('href','funciones/index.php');
        $('#a-residuos').attr('href','residuos/index.php');
        $('#navbar-cerrarSesion').attr('href','script/cerrar_sesion.php');
    }else{
        $('#li-'+hidden_ubicacion).addClass('navbar-active');
    }
});
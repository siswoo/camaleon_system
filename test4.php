<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/modelo.css">
<link rel="stylesheet" href="css/validaciones.css">
<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
<section class="showcase">
<div class="container">
<div class="row padall">
<div class="col-lg-12" style="padding-bottom:10px; padding-top:10px;">
<!-- Bootstrap core JavaScript -->

<script src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/navbar.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<h3>Exportar a Excel, CSV, PDF, Print Datatables con PHP MySQL</h3>
</div>
</div>
<div class="row padall border-bottom">
<div class="col-lg-12">
<div class="table-responsive-sm">
<table id="render-data" class="table display nowrap" style="width:100%">
<thead>
<tr>
<th>Nombres</th>
<th>Apellidos</th>
<th>Email</th>
<th>Movil</th>
<th>Direccion</th>
<th>Salario</th>
</tr>
</thead>
<tbody>
</tbody>
<tfoot>
<tr>
<th>Nombres</th>
<th>Apellidos</th>
<th>Email</th>
<th>Movil</th>
<th>Direccion</th>
<th>Salario</th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
</div>
</div>
</section>


<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('#render-data').DataTable({
rowReorder: {
selector: 'td:nth-child(2)'
},
responsive: true,
"language": {
"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
},
"paging": true,
"processing": true,
'serverMethod': 'post',
"ajax": "data.php",
dom: 'lBfrtip',
buttons: [
'excel', 'csv', 'pdf', 'print', 'copy',
],
"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
} );
} );
</script>
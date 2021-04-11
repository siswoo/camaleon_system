<input type="text" name="campo1" id="campo1" onkeyup="validacionesPHP('espacios1',value,'','');">

<script src="jquery-3.5.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		//
	});

	function validacionesPHP(condicion,valor1,valor2,valor3){
		$.ajax({
			type: 'POST',
			url: 'libreria_validaciones.php',
			dataType: "JSON",
			data: {
				"condicion": condicion,
				"valor1": valor1,
				"valor2": valor2,
				"valor3": valor3,
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta['status']=='ok'){
					Swal.fire({
		 				title: 'Todo Ok',
		 				text: "...",
		 				icon: 'success',
		 				position: 'center',
		 				showConfirmButton: false,
		 				timer: 2000
					});
				}

				if(respuesta['status']=='error'){
					Swal.fire({
		 				title: 'Error',
		 				text: "...",
		 				icon: 'error',
		 				position: 'center',
		 				showConfirmButton: false,
		 				timer: 2000
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}
</script>
<?php
	session_start();
	session_destroy();
?>

<script src="../js/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
	$(document).ready(function() {
		Swal.fire({
		 	title: 'Cerrando Sesión',
		 	text: "Redireccionando...",
		 	icon: 'success',
		 	position: 'center',
		 	timer: 3000,
		 	showConfirmButton: false,
		}).then((result) => {
			if (result.value) {
				window.location.href = "../index.php";
			}
		})

		setTimeout(function() {
			window.location.href = "../index.php";
		},3100);
	});
</script>
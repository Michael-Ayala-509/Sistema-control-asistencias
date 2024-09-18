<?php  
	session_start();
	if (!$_SESSION['verificar']) {
		header("location:../../sesiones/close.php");
	}
?>
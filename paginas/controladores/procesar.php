<?php  

	include '../modelo/conexion.php';

	if (isset($_POST['iniciar'])) {
		verificar_existencia_user_y_pass();
	}

	function verificar_existencia_user_y_pass()
	{
		$user = $_POST['user'];
		$pass = $_POST['contra'];

		$validar=validar_user_y_pass($user,$pass);

		if ($validar==null) {
			echo "
				<script>
					alert('Usuario o Contraseña incorrectos');
					location.href = '../../index.php';
				</script>
			";
		}else{
			session_start();
			$_SESSION['verificar']=true;
			$_SESSION['id']=$validar['ID_Usuario'];
			$_SESSION['user']=$validar['User'];
			$_SESSION['nombre']=$validar['nom'];
			$_SESSION['apellido']=$validar['a'];
			$_SESSION['foto']=$validar['f'];
			$_SESSION['fp']=$validar['fp'];
			$_SESSION['cargo']=$validar['c'];
			$_SESSION['direc']=$validar['d'];
			$_SESSION['tel']=$validar['t'];
			$_SESSION['correo']=$validar['co'];
			$_SESSION['rol']=$validar['Rol'];

			header('location: ../vistas/panel.php');
		}
	}
?>
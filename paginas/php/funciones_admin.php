<?php  
	require '../modelo/conexion.php';

	function Permisios_Pendientes()
	{
		$key = conectar();

		$sql = "SELECT COUNT(Estado) Permisos FROM permisos WHERE Estado='Pendiente';";

		$resultado = $key->query($sql);

		$datos=$resultado->fetch_assoc();

		echo $datos['Permisos'];
	}

	function Maestros_Presentes()
	{
		$key = conectar();

		date_default_timezone_set('America/El_Salvador');

		$Fecha_Actual = date("Y-m-d");

		$sql = "SELECT COUNT(ID_Maestro) AS Presentes FROM asistencias WHERE Fecha = '$Fecha_Actual' AND Hora_Entrada <> '' AND Tipo_Asistencia ='presente';";

		$resultado = $key->query($sql);

		$datos = $resultado->fetch_assoc();

		echo $datos['Presentes'];
	}

	function Maestros_Ausentes()
	{
		$key = conectar();

		date_default_timezone_set('America/El_Salvador');

		$Fecha_Actual = date("Y-m-d");

		$sql = "SELECT COUNT(*) AS Ausentes FROM asistencias WHERE Fecha='$Fecha_Actual' AND Hora_Entrada IS NULL AND Hora_Salida IS NULL AND Tipo_Asistencia='ausente';;";

		$resultado = $key->query($sql);

		$datos = $resultado->fetch_assoc();

		echo $datos['Ausentes'];
	}

	function Permisos()
	{
		$key = conectar();

		$sql = "SELECT *, m.ID_Maestro id, m.Nombre m, m.Apellido a FROM permisos p, maestros m WHERE m.ID_Maestro=p.ID_Maestro AND Estado = 'Pendiente';";

		$resultado = $key->query($sql);

		$contador = 1;

		while ($datos = $resultado->fetch_assoc()) {
			echo "
				<tr>
					<td>".$contador."</td>
					<td scope='row'>".$datos['m']." ".$datos['a']."</td>
					<td>".$datos['Tipo_Permiso']."</td>
					<td>".$datos['Fecha_Inicio']."</td>
					<td>".$datos['Fecha_Fin']."</td>
					<td>".$datos['Motivo']."</td>
					<td><span class='badge bg-warning'>".$datos['Estado']."</span></td>
					<td><a href='../php/funciones_admin.php?boton=si&aprobado=si&idm=".$datos['id']."&idp=".$datos['ID_Permiso']."' class='btn btn-success'><i class='bi bi-check-circle'></i></a></td>
					<td><a href='../php/funciones_admin.php?boton=si&idm=".$datos['id']."&idp=".$datos['ID_Permiso']."' class='btn btn-danger'><i class='bi bi-exclamation-octagon'></i></a></td>
				</tr>
			";

			$contador++;
		}
	}

	function Asistencias()
	{
		$key = conectar();

		$sql = "SELECT m.Nombre n, m.Apellido ape, a.Fecha fecha, a.Hora_Entrada he, a.Hora_Salida hs, a.Tipo_Asistencia ta FROM asistencias a, maestros m WHERE a.ID_Maestro=m.ID_Maestro";

		$resultado = $key->query($sql);

		$contador = 1;

		while ($datos = $resultado->fetch_assoc()) {
			echo "
				<tr>
					<td>".$contador."</td>
					<td>".$datos['n']." ".$datos['ape']."</td>
					<td>".$datos['fecha']."</td>
					<td>".$datos['he']."</td>
					<td>".$datos['hs']."</td>
					<td>".$datos['ta']."</td>
				</tr>
			";

			$contador++;
		}
	}

	function Maestros()
	{
		$key = conectar();

		$sql = "SELECT * FROM maestros";

		$resultado = $key->query($sql);

		$contador = 1;

		while ($datos = $resultado->fetch_assoc()) {
			echo "
				<tr>
					<td>".$contador."</td>
					<td><img src='../../../Toma_Asistencias/".htmlspecialchars($datos['Foto'])."' width='70' height='60'></td>
					<td>".$datos['Nombre']." ".$datos['Apellido']."</td>
					<td>".$datos['Email']."</td>
					<td>".$datos['Fecha_de_Nacimiento']."</td>
					<td>".$datos['Sexo']."</td>
					<td>".$datos['DUI']."</td>
					<td>".$datos['Cargo']."</td>
					<td>".$datos['Telefono']."</td>
					<td>
						<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
							<button type='button' class='btn btn-success' onclick='mostrar()'><i class='ri-add-circle-line'></i> Mas</button>
							<button type='button' class='btn btn btn-primary'  onclick='actualizar()'><i class='ri-ball-pen-line'></i> Actualizar</button>
							<button type='button' class='btn btn-danger' onclick='eliminar(this)'><i class='ri-delete-bin-2-line'></i> Eliminar</button>
						<div>
					</td>
				</tr>
			";

			$contador++;
		}
	}

	function usuarios(){
		
		$key = conectar();

		$sql = "SELECT u.ID_Usuario id, m.Nombre n, m.Apellido ape, u.User us, u.Rol rol, u.Estado es FROM usuarios u, maestros m WHERE u.ID_Maestro = m.ID_Maestro";
		$resulatdo = $key->query($sql);

		$contador = 1;

		while ($datos = $resulatdo->fetch_assoc()){
			
			$estado = ($datos['es'] == 'Activo') ? "<button type='button' class='btn btn-success rounded-pill'><i class='ri-user-follow-line'></i> Activo</button>" : "<button type='button' class='btn btn-secondary rounded-pill'><i class='ri-user-unfollow-line'></i> Desabilitado</button>";

			echo "
				<tr>
					<td>".$contador."</td>
					<td>".$datos['n']." ".$datos['ape']."</td>
					<td>".$datos['us']."</td>
					<td>".$datos['rol']."</td>
					<td>$estado</td>
					<td>
						<button type='button' class='btn btn-danger' value='' onclick='eliminar()' id='eliminar'><i class='ri-delete-bin-2-line'></i> Eliminar</button>
						<button type='button' class='btn btn-warning' value='' onclick='eliminar()' id='eliminar'><i class='ri-user-unfollow-line'></i> Desabilitar</button>
					</td>
				</tr>
			";

			$contador++;
		}
	}

	if (isset($_GET['boton'])) {
		Apro_recha();
	}elseif(isset($_POST['Cambiar'])) {
		Cambiar_Contrasena();
	}

	function Apro_recha()
	{
		$idm = $_GET['idm'];
		$idp = $_GET['idp'];

		$key = conectar();

		if (isset($_GET['aprobado'])) {

			$sql = "SELECT * FROM maestros WHERE ID_Maestro=$idm";

			$resultado = $key->query($sql);

			$datos = $resultado->fetch_assoc();

			$to = $datos['Email'];

			$subject="Información de Aprobacion de Solicitud de Permiso";

			$headers = "MIME-Version: 1.0" . "\r\n";

			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			$headers .= 'From: michaelayala509@gmail.com'."\r\n".'Reply-To: michaelayala509@gmail.com';

			$message="

				<p>Estimado/a ".$datos['Nombre'].",</p>
			    <p>Espero que este mensaje te encuentre bien.</p>
			    <p>Se reviso su solicitud permiso <strong>Por lo tanto su solicitud fue</strong>:</p>
			    <p><strong>APROBADA</strong></p>
			    <p>Gracias y que tengas un excelente día.</p>
			";

			if (mail($to,$subject,$message,$headers)) {
				
				$sql = "UPDATE permisos SET Estado = 'Aprobado' WHERE ID_Permiso=$idp ";

				$resutado = $key->query($sql);

				echo "
					<script>
						alert('Aprovacion Exitosa');
						location.href = '../vistas/solicitud_permisos.php';
					</script>
				";
			}else{
				echo "
					<script>
						alert('El Correo no fue enviado correctamente');
						location.href = '../vistas/solicitud_permisos.php';
					</script>
				";
			}
		}else{

			$sql = "SELECT * FROM maestros WHERE ID_Maestro=$idm";

			$resultado = $key->query($sql);

			$datos = $resultado->fetch_assoc();

			$to = $datos['Email'];

			$subject="Información de Aprobacion de Solicitud de Permiso";

			$headers = "MIME-Version: 1.0" . "\r\n";

			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			$headers .= 'From: michaelayala509@gmail.com'."\r\n".'Reply-To: michaelayala509@gmail.com';

			$message="

				<p>Estimado/a ".$datos['Nombre'].",</p>
			    <p>Espero que este mensaje te encuentre bien.</p>
			    <p>Se reviso su solicitud permiso <strong>Por lo tanto su solicitud fue</strong>:</p>
			    <p><strong>Rechazada</strong></p>
			    <p>Gracias y que tengas un excelente día.</p>
			";

			if (mail($to,$subject,$message,$headers)) {
				
				$sql = "UPDATE permisos SET Estado = 'Rechazado' WHERE ID_Permiso=$idp ";

				$resutado = $key->query($sql);

				echo "
				<script>
					alert('Rechazacion Exitosa');
					location.href = '../vistas/solicitud_permisos.php';
				</script>
			";

			}else{
				echo "
				<script>
					alert('El Correo no fue enviado correctamente');
					location.href = '../vistas/solicitud_permisos.php';
				</script>
			";
			}
		}
	}

	function Cambiar_Contrasena(){
		$key = conectar();

		$id = $_POST['id'];
		$pass_actual = $_POST['password'];
		$pass_nueva = $_POST['newpassword'];

		$sql = "SELECT Password FROM usuarios WHERE ID_Usuario = $id AND Password = '$pass_actual'";
		$resultado = $key->query($sql);
		if ($resultado->num_rows > 0) {

			//Mensaje y autualizacion cuado las contraseñas sean igual
			$sql = "UPDATE usuarios SET Password ='$pass_nueva' WHERE ID_Usuario = $id";
			$resultado = $key->query($sql);

			session_start();
            $_SESSION['pass_new']="Se cambio la contraseña exitosamente.";
            header('location:../vistas/perfil_usuario.php');
			

		}else{
			
			//Mensaje cuando la contraseña registada es distinta a la enviada
			session_start();
            $_SESSION['pass_exit']="Error al cambiar la contraseña, vuelve a intentarlo mas tarde.";
            header('location:../vistas/perfil_usuario.php');
			
		}
	}
?>
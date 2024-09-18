<?php  
	//Funcion que realiza la conexion a la base de datos
	function conectar()
	{
		//Datos de la Conexion
		$host = "localhost";
		$user = "root";
		$pass = "";
		$bd = "control_de_asistencias";

		//Crea la Conexion hacia la base de datos ya que con ella ya no hay conexion😔😭
		$conexion = mysqli_connect($host,$user,$pass,$bd);

		//Verifica la conexion a la base de datos
		if (!$conexion) {
			die("Error en la Conexion" . mysql_connect_error());
		}

		//Devuelve la respuesta de la conexion
		return $conexion;
	}

	function validar_user_y_pass($u,$p)
	{

		$key = conectar();

		$sql = "SELECT *,u.Foto_Perfil fp, m.Nombre nom, m.Apellido a, m.Foto f, m.Cargo c, m.Direccion d, m.Telefono t, m.Email co FROM usuarios u, Maestros m WHERE u.User = '$u' AND u.Password = '$p' AND u.ID_Maestro=m.ID_Maestro;";

		$resultado = $key->query($sql);

		$datos = $resultado->fetch_Assoc();

		return $datos;
	}
?>
<?php
require_once("./alumnos.php");

$accion = isset($_POST["accion"]) ? $_POST["accion"] : 0;
$legajo = isset($_POST["legajo"]) ? (int) $_POST["legajo"] : 0;
$apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : NULL;
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;


if(isset($_GET["accion"]))
{
	$accion = "listar";
}


//CRUD - SOBRE ARCHIVOS


switch($accion)
{
	case "agregar"://Create (Alta)

		$ok = "OCURRIO UN ERROR";

		$pathFoto = "./archivos/fotos". date("ymd_His"). ".jpg";

		if(move_uploaded_file($_FILES["foto"]["tmp_name"], $pathFoto) )
		{
            $Ok = "true" . "-" . $pathFoto;

			$obj = new Alumno($legajo, $apellido, $nombre, $pathFoto);

			if(Alumno::agregar($obj))
			{
				$ok = "registro AGREGADO";
				echo $ok;	
			}
        }
		break;

	case "listar"://Read (listar)

		echo "<h1>".Alumno::listar()."</h1></br>";

		break;

    case "verificar":

        echo Alumno::verificar($legajo);

        break;

	case "modificar"://Update (Modificar)

		$ok = "OCURRIO UN ERROR";

		$pathFoto = "./archivos/fotos". date("ymd_His"). ".jpg";
		

		if(move_uploaded_file($_FILES["foto"]["tmp_name"], $pathFoto) )
		{
			$obj = new Alumno($legajo, $apellido, $nombre, $pathFoto);

			if(Alumno::modificar($obj))
			{
				$ok = "registro MODIFICADO";	
				echo $ok;
			}
	    }

		break;

	case "borrar"://Delete (Borrar)

		if(Alumno::borrar($legajo))
		{
			echo "registro BORRADO";			
		}

		break;
		
	case "listarObjetos":

		echo json_encode(Alumno::ArrayObjetos());

		break;

	case "listarTabla":

		echo json_encode(Alumno::ListarTabla());

		break;

	default:
		echo " </h1> Sin ejemplo </h1> ";
	
}
?>
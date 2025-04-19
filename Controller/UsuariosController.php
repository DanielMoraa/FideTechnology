<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/UsuariosModel.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/UtilitariosController.php";

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(isset($_POST["btnActualizarDatos"]))
    {
        $nombre = $_POST["txtNombre"];
        $correo = $_POST["txtCorreo"];

        $resultado = ActualizarDatosModel($_SESSION["IdUsuario"],$nombre,$correo);

        if($resultado == true)
        {
            $_SESSION["CorreoUsuario"] = $correo;
            $_SESSION["NombreUsuario"] = $nombre;

            header('location: ../../View/Home/home.php');
        }
        else
        {
            $_POST["Message"] = "No se pudo actualizar su información personal correctamente";
        }
    }
    
    function ConsultarUsuario($Id)
    {
        $resultado = ConsultarUsuarioModel($Id);
        return mysqli_fetch_array($resultado);
    }

    

?>
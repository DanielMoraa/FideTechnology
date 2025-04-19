<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/LoginModel.php";

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(isset($_POST["btnIniciarSesion"]))
    {
        $correo = $_POST["txtCorreo"];
        $contrasenna = $_POST["txtContrasenna"];
        $recordar = isset($_POST["cbRecordar"]);

        $resultado = IniciarSesionModel($correo,$contrasenna);

        if($resultado != null && $resultado -> num_rows > 0)
        {
            $datos = mysqli_fetch_array($resultado);
            $_SESSION["IdUsuario"] = $datos["Id"];
            $_SESSION["CorreoUsuario"] = $datos["Correo"];
            $_SESSION["NombreUsuario"] = $datos["NombreUsuario"];
            $_SESSION["NombrePerfil"] = $datos["NombrePerfil"];
            $_SESSION["IdPerfil"] = $datos["IdPerfil"];

            if($recordar) {
                setcookie("correo_recordado", $correo, time() + (86400 * 30), "/"); // 86400 = 1 día
            } else {
                if(isset($_COOKIE["correo_recordado"])) {
                    setcookie("correo_recordado", "", time() - 3600, "/");
                }
            }

            header('location: ../../View/Home/home.php');
        }
        else
        {
            $_POST["Message"] = "Su información no fue validada correctamente";
        }
    }

    $correoRecordado = "";
    if(isset($_COOKIE["correo_recordado"])) {
        $correoRecordado = $_COOKIE["correo_recordado"];
    }

    if(isset($_POST["cbRecordar"]))
    {
        $correo = $_POST["txtCorreo"];
        $contrasenna = $_POST["txtContrasenna"];

        $resultado = IniciarSesionModel($correo,$contrasenna);

        if($resultado != null && $resultado -> num_rows > 0)
        {
            $datos = mysqli_fetch_array($resultado);
            $_SESSION["NombreUsuario"] = $datos["NombreUsuario"];
            $_SESSION["NombrePerfil"] = $datos["NombrePerfil"];
            $_SESSION["IdPerfil"] = $datos["IdPerfil"];

            header('location: ../../View/Home/home.php');
        }
        else
        {
            $_POST["Message"] = "Su información no fue validada correctamente";
        }
    }

    if(isset($_POST["btnSalir"]))
    {
        session_destroy();
        header('location: ../View/Login/login.php');
    }

    function VerificarSesion()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION["NombreUsuario"])) {
        return $_SESSION["NombreUsuario"];
    } else {
        return null;
    }
}

    if (isset($_GET["token"])) {
    $token = $_GET["token"];

    $usuario = ValidarTokenModel($token); 
    if ($datos = mysqli_fetch_array($usuario)) {
        $idUsuario = $datos["Id"];

        if (ActivarCuentaModel($idUsuario)) {
            $_POST["Message"] = "Cuenta activada con éxito. Ahora puedes iniciar sesión.";
        } else {
            $_POST["Message"] = "Hubo un error al activar tu cuenta.";
        }
    } else {
        $_POST["Message"] =  "No se proporcionó un token válido.";
    }
        }


    function GenerarTokenCorreo() {
        return bin2hex(random_bytes(32));
    }

    function GenerarTokenContra() {
        return bin2hex(random_bytes(3));
    }

    
    if(isset($_POST["btnRecuperarContrasenna"]))
    {
        $correo = $_POST["txtCorreo"];

        $resultado = ValidarUsuarioCorreoModel($correo);

        if($resultado != null && $resultado -> num_rows > 0)
        {
            $datos = mysqli_fetch_array($resultado);
            $codigo = GenerarTokenContra();

            //Actualizar Contraseña por el código
            $resultadoActualizacion = ActualizarContrasennaModel($datos["Id"], $codigo);

            //Enviamos el correo
            $contenido = "<html><body>
            Estimado(a) " . $datos["NombreUsuario"] . "<br/><br/>
            Se ha generado el siguiente código de seguridad: <b>" . $codigo . "</b><br/>
            Recuerde realizar el cambio de contraseña una vez que ingrese al sistema. </b><br/>";

            $resultadoCorreo = EnviarCorreo("Recuperar Contraseña",$contenido, $datos["Correo"]);
        
            if($resultadoCorreo == true)
            {
                header('location: ../../View/Login/login.php');
            }
            else
            {
                $_POST["Message"] = "No se pudo recuperar el acceso al sistema correctamente";
            }
        }
        else{
            $_POST["ErrorCorreo"] = "Correo no válido";
        }
    }
    
    if(isset($_POST["btnRegistrar"])) {
        $nombre = $_POST["txtNombre"];
        $correo = $_POST["txtCorreo"];
        $contrasena = $_POST["txtContrasenna"]; 
        $activacion = GenerarTokenCorreo();
    
        try {
            // Registrar usuario sin token
            $idUsuario = RegistrarCuentaModel($nombre, $correo, $contrasena,$activacion);
    
            if ($idUsuario) {
                // Guardar token en la base de datos
                GuardarTokenActivacionModel($idUsuario, $activacion);
    
                // Generar enlace de activación
                $linkActivacion = "http://localhost:81/FideTechnology/View/Login/activarCuenta.php?token=" . $activacion;
                
                $contenido = "<html><body>
                Estimado(a) $nombre,<br/><br/>
                Gracias por registrarte. Para activar tu cuenta, haz clic en el siguiente enlace:<br/>
                <a href='$linkActivacion'>Activar Cuenta</a>
                </body></html>";
    
                if (EnviarCorreo("Activar Cuenta", $contenido, $correo)) {
                    $_POST["Exito"] = "Registro exitoso, por favor verifique su correo electrónico.";
                } else {
                    echo "Error al enviar el correo de activación.";
                }
            } else {
                echo "Error al registrar el usuario.";
            }
        } catch (Exception $e) {
            echo "Error inesperado: " . $e->getMessage();
        }
    }
    
    // Controlador para activar cuenta cuando el usuario hace clic en el enlace
    if (isset($_GET["activacion"])) {
        $activacion = $_GET["activacion"];
    
        try {
            // Validar el token y obtener datos del usuario
            $usuario = ValidarTokenModel($activacion);
            
    
            if ($validar = mysqli_fetch_array($usuario)) {
                // Activar la cuenta
                $idUsuario = $validar["Id"];
                if (ActivarCuentaModel($idUsuario)) {
                    echo "Cuenta activada con éxito. Ahora puedes iniciar sesión.";
                } else {
                    echo "Error al activar la cuenta.";
                }
            }
        } catch (Exception $e) {
            echo "Error inesperado: " . $e->getMessage();
        }
    }
    
    function EnviarCorreo($asunto, $contenido, $destinatario) {
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
    
        $correoSalida = "dmora00668@ufide.ac.cr";
        $contrasennaSalida = "ZT3J_86WK";
    
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP();
        $mail->IsHTML(true); 
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;                      
        $mail->SMTPAuth = true;
        $mail->Username = $correoSalida;               
        $mail->Password = $contrasennaSalida;                                
        
        $mail->SetFrom($correoSalida);
        $mail->Subject = $asunto;
        $mail->MsgHTML($contenido);   
        $mail->AddAddress($destinatario);
    
        try {
            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
    
    
?>


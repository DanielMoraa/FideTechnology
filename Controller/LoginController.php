<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/LoginModel.php";

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(isset($_POST["btnRegistrarCuenta"]))
    {
        $identificacion = $_POST["txtIdentificacion"];
        $nombre = $_POST["txtNombre"];
        $correo = $_POST["txtCorreo"];
        $contrasenna = $_POST["txtContrasenna"];

        $resultado = RegistrarCuentaModel($identificacion,$nombre,$correo,$contrasenna);

        if($resultado == true)
        {
            header('location: ../../View/Login/login.php');
        }
        else
        {
            $_POST["Message"] = "Su información no fue registrada correctamente";
        }
    }

    if(isset($_POST["btnIniciarSesion"]))
    {
        $identificacion = $_POST["txtIdentificacion"];
        $contrasenna = $_POST["txtContrasenna"];

        $resultado = IniciarSesionModel($identificacion,$contrasenna);

        if($resultado != null && $resultado -> num_rows > 0)
        {
            $datos = mysqli_fetch_array($resultado);
            $_SESSION["NombreUsuario"] = $datos["NombreUsuario"];
            $_SESSION["NombrePerfil"] = $datos["NombrePerfil"];
            $_SESSION["IdPerfil"] = $datos["IdPerfil"];

            header('location: ../../View/Login/home.php');
        }
        else
        {
            $_POST["Message"] = "Su información no fue validada correctamente";
        }
    }

    if(isset($_POST["btnSalir"]))
    {
        session_destroy();
        header('location: ../../View/Login/login.php');
    }


    function GenerarToken() {
        return bin2hex(random_bytes(32));
    }
    
    if(isset($_POST["btnRegistrar"])) {
        $nombre = $_POST["txtNombre"];
        $correo = $_POST["txtCorreo"];
        $contrasena = $_POST["txtContrasenna"]; 
        $activacion = GenerarToken();
    
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
    
        $correoSalida = "dirección outlook de la U";
        $contrasennaSalida = "contraseña";
    
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
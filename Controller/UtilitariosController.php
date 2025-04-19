<?php

    function EnviarCorreoUser($asunto,$contenido,$destinatario)
    {
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $correoSalida = "fchacon20461@ufide.ac.cr";
        $contrasennaSalida = "xxxxxxxxxx"; // Cambia esto por tu contraseña real

        $mail = new PHPMailer();
        $mail -> CharSet = 'UTF-8';

        $mail -> IsSMTP();
        $mail -> IsHTML(true); 
        $mail -> Host = 'smtp.office365.com';
        $mail -> SMTPSecure = 'tls';
        $mail -> Port = 587;                      
        $mail -> SMTPAuth = true;
        $mail -> Username = $correoSalida;               
        $mail -> Password = $contrasennaSalida;                                
        
        $mail -> SetFrom($correoSalida);
        $mail -> Subject = $asunto;
        $mail -> MsgHTML($contenido);   
        $mail -> AddAddress($destinatario);

        try 
        {
            if ($mail->send()) 
            {
                return true; // Envío exitoso
            } 
            else 
            {
                return true; // Falló el envío
            }
        } catch (Exception $e) 
        {
            return false;
        }
    }

?>
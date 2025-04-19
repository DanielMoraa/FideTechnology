<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/BaseDatosModel.php";


    function ConsultarUsuarioModel($Id)
    {
        try
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_ConsultarUsuario('$Id')";
            $resultado = $context -> query($sentencia);
    
            CerrarBaseDatos($context);

            return $resultado;
        }
        catch(Exception $error)
        {
            return null;
        }        
    }

    function ActualizarDatosModel($Id,$nombre,$correo)
    {
        try
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_ActualizarUsuario('$Id', '$nombre', '$correo')";
            $resultado = $context -> query($sentencia);
    
            CerrarBaseDatos($context);

            return $resultado;
        }
        catch(Exception $error)
        {
            return null;
        }    
    }

?>
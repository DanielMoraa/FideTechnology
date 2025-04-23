<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/BaseDatosModel.php";

    function RegistrarCuentaModel($nombre,$correo,$contrasenna,$activacion)
    {
        try 
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_RegistrarCuenta('$nombre','$correo','$contrasenna','$activacion')";
            $resultado = $context -> query($sentencia);

            CerrarBaseDatos($context);
            return $resultado;
        } 
        catch (Exception $error) 
        {
            return false;
        }        
    }

    function IniciarSesionModel($correo,$contrasenna)
    {
        try
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_IniciarSesion('$correo','$contrasenna')";
            $resultado = $context -> query($sentencia);

            CerrarBaseDatos($context);
            return $resultado;
        }
        catch(Exception $error)
        {
            return null;
        }        
    }

    function ValidarUsuarioCorreoModel($correo)
    {
        try
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_ValidarUsuarioCorreo('$correo')";
            $resultado = $context -> query($sentencia);

            CerrarBaseDatos($context);
            return $resultado;
        }
        catch(Exception $error)
        {
            return null;
        }        
    }   

    function ActualizarContrasennaModel($id, $codigo)
    {
        try
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_ActualizarContrasenna('$id', '$codigo')";
            $resultado = $context -> query($sentencia);

            CerrarBaseDatos($context);
            return $resultado;
        }
        catch(Exception $error)
        {
            return false;
        }        
    }

    function GuardarTokenActivacionModel($idUsuario, $token)
{
    try
    {
        $context = AbrirBaseDatos();
        $sentencia = "CALL SP_GuardarTokenActivacion('$idUsuario', '$token')";
        $resultado = $context -> query($sentencia);
        CerrarBaseDatos($context);
        return $resultado;
    }
    catch(Exception $error)
    {
        return null;
    }
}

function ValidarTokenModel($token)
{
    try
    {
        $context = AbrirBaseDatos();
        $sentencia = "CALL SP_ValidarToken('$token')";
        $resultado = $context -> query($sentencia);
        CerrarBaseDatos($context);
        return $resultado;
    }
    catch(Exception $error)
    {
        return null;
    }
}

function ActivarCuentaModel($idUsuario)
{
    try
    {
        $context = AbrirBaseDatos();
        $sentencia = "CALL SP_ActivarCuenta('$idUsuario')";
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

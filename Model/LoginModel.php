<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/BaseDatosModel.php";

    /**
     * Registra una nueva cuenta de usuario
     * @param string $nombre Nombre del usuario
     * @param string $correo Correo electrónico
     * @param string $contrasenna Contraseña del usuario
     * @param string $activacion Token de activación
     * @return mixed Resultado de la operación o false en caso de error
     */
    function RegistrarCuentaModel($nombre, $correo, $contrasenna, $activacion)
    {
        try 
        {
            $context = AbrirBaseDatos();

            // Prevención de SQL Injection con prepared statements
            $stmt = $context->prepare("CALL SP_RegistrarCuenta(?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nombre, $correo, $contrasenna, $activacion);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            // Nota: Si el SP devuelve el ID del usuario insertado, obtenerlo aquí
            
            $stmt->close();
            CerrarBaseDatos($context);
            return $resultado;
        } 
        catch (Exception $error) 
        {
            return false;
        }        
    }

    /**
     * Valida las credenciales del usuario para iniciar sesión
     * @param string $correo Correo electrónico
     * @param string $contrasenna Contraseña del usuario
     * @return mixed Resultado de la consulta o null en caso de error
     */
    function IniciarSesionModel($correo, $contrasenna)
    {
        try
        {
            $context = AbrirBaseDatos();

            // Prevención de SQL Injection con prepared statements
            $stmt = $context->prepare("CALL SP_IniciarSesion(?, ?)");
            $stmt->bind_param("ss", $correo, $contrasenna);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            $stmt->close();
            CerrarBaseDatos($context);
            return $resultado;
        }
        catch(Exception $error)
        {
            return null;
        }        
    }

    /**
     * Valida si existe un usuario con el correo especificado
     * @param string $correo Correo electrónico
     * @return mixed Resultado de la consulta o null en caso de error
     */
    function ValidarUsuarioCorreoModel($correo)
    {
        try
        {
            $context = AbrirBaseDatos();

            // Prevención de SQL Injection con prepared statements
            $stmt = $context->prepare("CALL SP_ValidarUsuarioCorreo(?)");
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            $stmt->close();
            CerrarBaseDatos($context);
            return $resultado;
        }
        catch(Exception $error)
        {
            return null;
        }        
    }   

    /**
     * Actualiza la contraseña de un usuario
     * @param int $id ID del usuario
     * @param string $codigo Nuevo código o contraseña
     * @return mixed Resultado de la operación o false en caso de error
     */
    function ActualizarContrasennaModel($id, $codigo)
    {
        try
        {
            $context = AbrirBaseDatos();

            // Prevención de SQL Injection con prepared statements
            $stmt = $context->prepare("CALL SP_ActualizarContrasenna(?, ?)");
            $stmt->bind_param("is", $id, $codigo);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            $stmt->close();
            CerrarBaseDatos($context);
            return $resultado ? true : false;
        }
        catch(Exception $error)
        {
            return false;
        }        
    }

    /**
     * Guarda el token de activación para un usuario
     * @param int $idUsuario ID del usuario
     * @param string $token Token de activación
     * @return mixed Resultado de la operación o null en caso de error
     */
    function GuardarTokenActivacionModel($idUsuario, $token)
    {
        try
        {
            $context = AbrirBaseDatos();
            
            // Prevención de SQL Injection con prepared statements
            $stmt = $context->prepare("CALL SP_GuardarTokenActivacion(?, ?)");
            $stmt->bind_param("is", $idUsuario, $token);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            $stmt->close();
            CerrarBaseDatos($context);
            return $resultado;
        }
        catch(Exception $error)
        {
            return null;
        }
    }

    /**
     * Valida un token de activación
     * @param string $token Token de activación
     * @return mixed Resultado de la consulta o null en caso de error
     */
    function ValidarTokenModel($token)
    {
        try
        {
            $context = AbrirBaseDatos();
            
            // Prevención de SQL Injection con prepared statements
            $stmt = $context->prepare("CALL SP_ValidarToken(?)");
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            $stmt->close();
            CerrarBaseDatos($context);
            return $resultado;
        }
        catch(Exception $error)
        {
            return null;
        }
    }

    /**
     * Activa la cuenta de un usuario
     * @param int $idUsuario ID del usuario
     * @return bool Resultado de la operación
     */
    function ActivarCuentaModel($idUsuario)
    {
        try
        {
            $context = AbrirBaseDatos();
            
            // Prevención de SQL Injection con prepared statements
            $stmt = $context->prepare("CALL SP_ActivarCuenta(?)");
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $resultado = $stmt->affected_rows > 0;
            
            $stmt->close();
            CerrarBaseDatos($context);
            return $resultado;
        }
        catch(Exception $error)
        {
            return false;
        }
    }
?>
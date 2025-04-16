<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/BaseDatosModel.php";

function ConsultarProductosModel()
{
    try {
        $context = AbrirBaseDatos();
        $sentencia = "CALL SP_ConsultarProductos()";
        $resultado = $context->query($sentencia);
        CerrarBaseDatos($context);
        return $resultado;
    } catch (Exception $error) {
        return null;
    }
}
?>
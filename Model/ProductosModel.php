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

function ConsultarProductosCategoriaModel()
{
    try {
        $context = AbrirBaseDatos();
        $sentencia = "CALL Consultar_Productos_Por_Categoria()";
        $resultado = $context->query($sentencia);
        CerrarBaseDatos($context);
        return $resultado;
    } catch (Exception $error) {
        return null;
    }
}

function ConsultarCategoriasModel() {

    try {
        $context = AbrirBaseDatos();
        $sentencia = "CALL SP_ObtenerCategorias()";
        $resultado = $context->query($sentencia);
        CerrarBaseDatos($context);
        return $resultado;
    } catch (Exception $error) {
        return null;
    }
}
?>
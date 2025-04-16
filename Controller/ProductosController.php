<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/ProductosModel.php";

function ConsultarProductos()
{
    return ConsultarProductosModel();
}

function ConsultarProductosCategoria()
{
    return ConsultarProductosCategoriaModel();
}

function ConsultarCategorias()
{
    return ConsultarCategoriasModel();
}
?>

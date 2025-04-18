<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/ProductosModel.php";

function ConsultarCategorias() {
    return ConsultarCategoriasModel();
}

function ConsultarProductosTodos() {
    return ConsultarProductosTodosModel();
}

function ConsultarProductosPorCategoria($categoria_id) {
    if ($categoria_id === null || $categoria_id === 0) {
        return ConsultarProductosTodosModel();
    }
    
    return ConsultarProductosPorCategoriaModel($categoria_id);
}

function BuscarProductos($keyword, $categoria_id = null) {
    return BuscarProductosModel($keyword, $categoria_id);
}

function ObtenerNombreCategoria($categoria_id) {
    return ObtenerNombreCategoriaModel($categoria_id);
}

function ProcesarSolicitudProductos() {
    $categoria_id = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    
    if (!empty($keyword)) {
        $productos = BuscarProductos($keyword, $categoria_id);
    } else {
        $productos = ConsultarProductosPorCategoria($categoria_id);
    }
    
    return $productos;
}
?>

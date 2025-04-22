<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/ProductosModel.php";

function ConsultarCategorias() {
    return ConsultarCategoriasModel();
}

function ConsultarProductosTodos() {
    return ConsultarProductosTodosModel();
}

function ConsultarProductoPorId($id) {
    return ObtenerProductoPorIdModel($id);
}

function ObtenerColoresProducto($idProducto) {
    return ObtenerColoresProductoModel($idProducto);
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


function ObtenerProductoPorId($id) {
    return ObtenerProductoPorIdModel($id);
}


if(isset($_POST["btnCrearProducto"]))
{
    $nombre = $_POST["txtNombre"];
    $descripcion = $_POST["txtDescripcion"];
    $precio = $_POST["txtPrecio"];
    $imagen = '../assets/img/img_subidas/' . $_FILES["txtImagen"]["name"];
    $disponibilidad = $_POST["txtDisponibilidad"];
    $categoria = $_POST["txtCategoria"];
    $origen = $_FILES["txtImagen"]["tmp_name"];
    $destino = $_SERVER["DOCUMENT_ROOT"] . '/FideTechnology/View/assets/img/img_subidas/' . $_FILES["txtImagen"]["name"];
    copy($origen,$destino);

    $resultado = AgregarProductoModel($nombre, $descripcion, $precio, $imagen, $disponibilidad, $categoria);

    if($resultado == true)
    {
        header('location: ../../View/Home/home.php');
    }
    else
    {
        $_POST["Message"] = "El producto no fue registrado correctamente";
    }
}


function ActualizarProductos($id, $nombre, $descripcion, $precio, $imagen, $disponibilidad) {
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/BaseDatosModel.php";
    $conn = AbrirBaseDatos(); 

    $stmt = $conn->prepare("UPDATE productos SET Nombre = ?, Descripcion = ?, Precio = ?, Imagen = ?, Disponibilidad = ? WHERE Id = ?");
    $stmt->bind_param("ssdssi", $nombre, $descripcion, $precio, $imagen, $disponibilidad, $id);

    $resultado = $stmt->execute();
    $stmt->close();
    CerrarBaseDatos($conn);

    return $resultado;
}


?>

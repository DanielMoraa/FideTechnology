<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/BaseDatosModel.php";

function ConsultarCategoriasModel() {
    try {
        $context = AbrirBaseDatos();
        $sentencia = "CALL Consultar_Categorias()";
        $resultado = $context->query($sentencia);
        CerrarBaseDatos($context);
        return $resultado;
    } catch (Exception $error) {
        return null;
    }
}

function ConsultarProductosTodosModel() {
    try {
        $context = AbrirBaseDatos();
        $sentencia = "CALL Consultar_Productos_Todos()";
        $resultado = $context->query($sentencia);
        CerrarBaseDatos($context);
        return $resultado;
    } catch (Exception $error) {
        return null;
    }
}

function ConsultarProductosPorCategoriaModel($categoria_id) {
    try {
        $context = AbrirBaseDatos();
        $sentencia = $context->prepare("CALL Consultar_Productos_Por_Categoria(?)");
        $sentencia->bind_param("i", $categoria_id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $sentencia->close();
        CerrarBaseDatos($context);
        return $resultado;
    } catch (Exception $error) {
        return null;
    }
}

function BuscarProductosModel($keyword, $categoria_id = null) {
    try {
        $context = AbrirBaseDatos();
        
        if ($categoria_id !== null && $categoria_id > 0) {
            $sentencia = $context->prepare("CALL Buscar_Productos(?, ?)");
            $sentencia->bind_param("si", $keyword, $categoria_id);
        } else {
            $sentencia = $context->prepare("CALL Buscar_Productos(?, 0)");
            $sentencia->bind_param("s", $keyword);
        }
        
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $sentencia->close();
        CerrarBaseDatos($context);
        return $resultado;
    } catch (Exception $error) {
        return null;
    }
}

function ObtenerNombreCategoriaModel($categoria_id) {
    try {
        $context = AbrirBaseDatos();
        $sentencia = $context->prepare("SELECT Nombre FROM categoria WHERE Id = ?");
        $sentencia->bind_param("i", $categoria_id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $nombre = "Todas las categorías";
        
        if ($fila = $resultado->fetch_assoc()) {
            $nombre = $fila['Nombre'];
        }
        
        $sentencia->close();
        CerrarBaseDatos($context);
        return $nombre;
    } catch (Exception $error) {
        return "Todas las categorías";
    }
}


function AgregarProductoModel($nombre, $descripcion, $precio, $imagen, $disponibilidad, $idCategoria) {
    try {
        $context = AbrirBaseDatos();
        $stmt = $context->prepare("CALL Agregar_Producto(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsii", $nombre, $descripcion, $precio, $imagen, $disponibilidad, $idCategoria);
        $stmt->execute();
        $stmt->close();
        CerrarBaseDatos($context);
        return true;
    } catch (Exception $error) {
        return false;
    }
}

function ActualizarProductoModel($id, $nombre, $descripcion, $precio, $imagen, $disponibilidad) {
    try {
        $context = AbrirBaseDatos();
        $stmt = $context->prepare("CALL Actualizar_Producto(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdsi", $id, $nombre, $descripcion, $precio, $imagen, $disponibilidad);
        $stmt->execute();
        $stmt->close();
        CerrarBaseDatos($context);
        return true;
    } catch (Exception $error) {
        return false;
    }
}


function ObtenerProductoPorIdModel($id) {
    try {
        $context = AbrirBaseDatos();
        $stmt = $context->prepare("SELECT * FROM productos WHERE Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $producto = $resultado->fetch_assoc();
        $stmt->close();
        CerrarBaseDatos($context);
        return $producto;
    } catch (Exception $error) {
        return null;
    }
}

?>
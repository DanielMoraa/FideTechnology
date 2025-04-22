<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/BaseDatosModel.php";

function ConsultarCategoriasModel() {
    try {
        $context = AbrirBaseDatos();
        $sentencia = "CALL SP_Consultar_Categorias()";
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
        $sentencia = "CALL SP_Consultar_Productos_Todos()";
        $resultado = $context->query($sentencia);
        CerrarBaseDatos($context);
        return $resultado;
    } catch (Exception $error) {
        return null;
    }
}

function ObtenerProductoPorIdModel($id) {
    try {
        $context = AbrirBaseDatos();
        $sentencia = $context->prepare("CALL SP_Consultar_Producto_Por_Id(?)");
        $sentencia->bind_param("i", $id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $producto = $resultado->fetch_assoc();
        CerrarBaseDatos($context);
        return $producto;
    } catch (Exception $error) {
        return null;
    }
}


function ConsultarProductosPorCategoriaModel($categoria_id) {
    try {
        $context = AbrirBaseDatos();
        $sentencia = $context->prepare("CALL SP_Consultar_Productos_Por_Categoria(?)");
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
            $sentencia = $context->prepare("CALL SP_Buscar_Productos(?, ?)");
            $sentencia->bind_param("si", $keyword, $categoria_id);
        } else {
            $sentencia = $context->prepare("CALL SP_Buscar_Productos(?, 0)");
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
        $sentencia = $context->prepare("CALL SP_Nombre_Categoria(?)");
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


function AgregarProductoModel($nombre, $descripcion, $precio, $imagen, $disponibilidad, $idcategoria) {
    try 
        {
            $context = AbrirBaseDatos();

            $sentencia = "CALL SP_Agregar_Producto('$nombre', '$descripcion', '$precio', '$imagen', '$disponibilidad', '$idcategoria')";
            $resultado = $context -> query($sentencia);

            CerrarBaseDatos($context);
            return $resultado;
        } 
        catch (Exception $error) 
        {
            return false;
        }    
}

function ActualizarProductoModel($id, $nombre, $descripcion, $precio, $imagen, $disponibilidad) {
    try {
        $context = AbrirBaseDatos();
        $stmt = $context->prepare("CALL SP_Actualizar_Producto(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdsi", $id, $nombre, $descripcion, $precio, $imagen, $disponibilidad);
        $stmt->execute();
        $stmt->close();
        CerrarBaseDatos($context);
        return true;
    } catch (Exception $error) {
        return false;
    }
}

function ObtenerColoresProductoModel($idProducto) {
    $colores = [];
    try {
        $context = AbrirBaseDatos(); // asegúrate de que esto retorna un objeto mysqli válido

        $sql = "CALL SP_Obtener_Colores_Producto(?)";
        $stmt = $context->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $context->error);
        }

        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $resultado = $stmt->get_result();

        while ($fila = $resultado->fetch_assoc()) {
            $colores[] = $fila;
        }

        $stmt->close();
        CerrarBaseDatos($context);
    } catch (Exception $e) {
        error_log("Error en ObtenerColoresProductoModel: " . $e->getMessage());
    }
    return $colores;
}


?>
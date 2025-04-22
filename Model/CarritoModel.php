<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/BaseDatosModel.php";

function AgregarAlCarritoModel($idUsuario, $idProducto, $color, $cantidad) {
    try {
        $context = AbrirBaseDatos();
        $sentencia = $context->prepare("CALL SP_Agregar_Al_Carrito(?, ?, ?, ?)");
        $sentencia->bind_param("iisi", $idUsuario, $idProducto, $color, $cantidad);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $conteo = $resultado->fetch_assoc()['total'];
        CerrarBaseDatos($context);
        return ['success' => true, 'conteo' => $conteo];
    } catch (Exception $error) {
        return ['success' => false, 'message' => $error->getMessage()];
    }
}

function EliminarDelCarritoModel($idUsuario, $idProducto, $color) {
    try {
        $context = AbrirBaseDatos();
        $sentencia = $context->prepare("CALL SP_Eliminar_Producto_Carrito(?, ?, ?)");
        $sentencia->bind_param("iis", $idUsuario, $idProducto, $color);
        $sentencia->execute();
        
        $resultado = $sentencia->get_result();
        $respuesta = $resultado->fetch_assoc();
        
        CerrarBaseDatos($context);
        
        return [
            'success' => ($respuesta['Resultado'] == 1),
            'message' => $respuesta['Mensaje'],
            'conteo' => $respuesta['Conteo']
        ];
    } catch (Exception $error) {
        return ['success' => false, 'message' => $error->getMessage(), 'conteo' => 0];
    }
}

function ObtenerCarritoModel($idUsuario) {
    try {
        $context = AbrirBaseDatos();
        $sentencia = $context->prepare("CALL SP_Obtener_Carrito(?)");
        $sentencia->bind_param("i", $idUsuario);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        CerrarBaseDatos($context);
        return $resultado;
    } catch (Exception $error) {
        return null;
    }
}

function ObtenerConteoCarritoModel($idUsuario) {
    try {
        $context = AbrirBaseDatos();
        $sentencia = $context->prepare("CALL SP_Obtener_Conteo_Carrito(?)");
        $sentencia->bind_param("i", $idUsuario);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $conteo = $resultado->fetch_assoc()['total'];
        CerrarBaseDatos($context);
        return $conteo;
    } catch (Exception $error) {
        return 0;
    }
}

function ActualizarCantidadCarritoModel($idUsuario, $idProducto, $color, $cantidad) {
    try {
        $context = AbrirBaseDatos();
        
        // Primero verificar si existe el producto en el carrito
        $checkSql = "SELECT COUNT(*) as existe FROM carrito WHERE IdUsuario = ? AND IdProducto = ? AND Color = ?";
        $checkStmt = $context->prepare($checkSql);
        $checkStmt->bind_param("iis", $idUsuario, $idProducto, $color);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $existe = $checkResult->fetch_assoc()['existe'];
        
        if ($existe == 0) {
            CerrarBaseDatos($context);
            return [
                'success' => false,
                'message' => 'El producto no existe en el carrito'
            ];
        }
        
        // Actualizar la cantidad
        $updateSql = "UPDATE carrito SET Cantidad = ? WHERE IdUsuario = ? AND IdProducto = ? AND Color = ?";
        $updateStmt = $context->prepare($updateSql);
        $updateStmt->bind_param("iiis", $cantidad, $idUsuario, $idProducto, $color);
        $updateResult = $updateStmt->execute();
        
        if ($updateResult) {
            CerrarBaseDatos($context);
            return [
                'success' => true,
                'message' => 'Cantidad actualizada con éxito',
                'cantidad' => $cantidad
            ];
        } else {
            CerrarBaseDatos($context);
            return [
                'success' => false,
                'message' => 'Error al actualizar la cantidad',
                'error' => $context->error
            ];
        }
    } catch (Exception $error) {
        return [
            'success' => false, 
            'message' => $error->getMessage(),
            'trace' => $error->getTraceAsString()
        ];
    }
}
?>
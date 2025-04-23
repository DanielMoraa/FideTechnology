<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/CarritoModel.php";

// Comprobar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Iniciar sesión si no está iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verificar si existe el ID de usuario
    $idUsuario = isset($_SESSION['IdUsuario']) ? $_SESSION['IdUsuario'] : null;
    
    if (!$idUsuario) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Sesión expirada. Por favor inicia sesión nuevamente.'
        ]);
        exit;
    }

    // Obtener y validar los datos
    $idProducto = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);
    $color = isset($_POST['color']) ? trim($_POST['color']) : null;
    
    // Validar los datos
    if (!$idProducto || !$cantidad || $cantidad < 1 || empty($color)) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Datos inválidos para la actualización',
            'debug' => [
                'idProducto' => $idProducto,
                'cantidad' => $cantidad,
                'color' => $color
            ]
        ]);
        exit;
    }
    
    // Llamar al modelo directamente
    try {
        $resultado = ActualizarCantidadCarritoModel($idUsuario, $idProducto, $color, $cantidad);
        
        if ($resultado['success']) {
            // Actualizar conteo en sesión
            $conteo = ObtenerConteoCarritoModel($idUsuario);
            $_SESSION['carrito_count'] = $conteo;
            
            // Obtener nuevos totales
            $productosCarrito = ObtenerCarritoModel($idUsuario);
            $subtotal = 0;
            
            if ($productosCarrito && $productosCarrito->num_rows > 0) {
                while ($producto = $productosCarrito->fetch_assoc()) {
                    $subtotal += $producto['Precio'] * $producto['Cantidad'];
                }
            }
            
            $costoEnvio = ($subtotal > 50.000) ? 0 : 25.000;
            $total = $subtotal + $costoEnvio;
            
            $resultado['subtotal'] = $subtotal;
            $resultado['envio'] = $costoEnvio;
            $resultado['total'] = $total;
            $resultado['conteo'] = $conteo;
        }
        
        header('Content-Type: application/json');
        echo json_encode($resultado);
    } catch (Exception $error) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => $error->getMessage()
        ]);
    }
} else {
    // Si no es una solicitud POST, redirigir
    header('Location: carritoDetalle.php');
    exit;
}
?>
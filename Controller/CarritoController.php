<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Model/CarritoModel.php";

function AgregarAlCarrito($idUsuario, $idProducto, $color, $cantidad = 1) {
    return AgregarAlCarritoModel($idUsuario, $idProducto, $color, $cantidad);
}

function ObtenerCarrito($idUsuario) {
    $resultado = ObtenerCarritoModel($idUsuario);
    $items = [];
    
    if ($resultado && $resultado->num_rows > 0) {
        while($producto = $resultado->fetch_assoc()) {
            $items[] = $producto;
        }
    }
    return $items;
}

function ObtenerConteoCarrito($idUsuario = null) {
    if ($idUsuario) {
        return ObtenerConteoCarritoModel($idUsuario);
    } else {
        return 0;
    }
}

function ProcesarAgregarAlCarrito() {
    session_start();
    
    $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['agregar_carrito']) || (isset($_POST['id_producto']) && isset($_POST['color'])))) {
        $idUsuario = isset($_SESSION['IdUsuario']) ? $_SESSION['IdUsuario'] : null;
        $idProducto = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);
        $color = trim(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING));
        $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT) ?? 1;
        
        if (!$idProducto || !$color || $cantidad < 1) {
            return ['success' => false, 'message' => 'Datos inválidos'];
        }
        
        if ($idUsuario) {
            $resultado = AgregarAlCarrito($idUsuario, $idProducto, $color, $cantidad);
            $_SESSION['carrito_count'] = $resultado['conteo'] ?? ObtenerConteoCarrito($idUsuario);
            return $resultado;
        } else {
            return [
                'success' => true, 
                'message' => 'Producto agregado al carrito local',
                'guest' => true
            ];
        }
    }
    
    return ['success' => false, 'message' => $isAjax ? 'Solicitud no válida' : ''];
}

function SincronizarCarrito($idUsuario, $carritoLocal) {
    $resultado = ['success' => true, 'conteo' => 0];
    $errores = [];
    
    foreach ($carritoLocal as $item) {
        if (!isset($item['id_producto']) || !isset($item['color']) || !isset($item['cantidad'])) {
            $errores[] = 'Item con estructura inválida';
            continue;
        }
        
        $idProducto = filter_var($item['id_producto'], FILTER_VALIDATE_INT);
        $color = trim(filter_var($item['color'], FILTER_SANITIZE_STRING));
        $cantidad = filter_var($item['cantidad'], FILTER_VALIDATE_INT);
        
        if (!$idProducto || !$color || !$cantidad || $cantidad < 1) {
            $errores[] = 'Datos inválidos en item del carrito';
            continue;
        }
        
        $res = AgregarAlCarrito($idUsuario, $idProducto, $color, $cantidad);
        if ($res['success']) {
            $resultado['conteo'] = $res['conteo'];
        } else {
            $errores[] = $res['message'] ?? 'Error al agregar producto';
        }
    }
    
    if (!empty($errores)) {
        $resultado['errores'] = $errores;
    }
    
    return $resultado;
}

function ProcesarSincronizarCarrito() {
    session_start();
    
    if (!isset($_SESSION['IdUsuario'])) {
        return ['success' => false, 'message' => 'No hay sesión activa'];
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['carrito_local'])) {
        $idUsuario = $_SESSION['IdUsuario'];
        $carritoLocal = json_decode($_POST['carrito_local'], true);
        
        if (is_array($carritoLocal)) {
            $resultado = SincronizarCarrito($idUsuario, $carritoLocal);
            $_SESSION['carrito_count'] = $resultado['conteo'];
            return $resultado;
        }
    }
    
    return ['success' => false, 'message' => 'Datos inválidos'];
}

function EliminarDelCarrito($idUsuario, $idProducto, $color) {
    $resultado = EliminarDelCarritoModel($idUsuario, $idProducto, $color);
    
    if ($resultado['success']) {
        $productosCarrito = ObtenerCarritoModel($idUsuario);
        $subtotal = 0;
        
        if ($productosCarrito && $productosCarrito->num_rows > 0) {
            while($producto = $productosCarrito->fetch_assoc()) {
                $subtotal += $producto['Precio'] * $producto['Cantidad'];
            }
        }
        
        $costoEnvio = ($subtotal > 50) ? 0 : 2;
        $total = $subtotal + $costoEnvio;
        
        $resultado['subtotal'] = $subtotal;
        $resultado['envio'] = $costoEnvio;
        $resultado['total'] = $total;
    }
    
    if (isset($_SESSION)) {
        $_SESSION['carrito_count'] = $resultado['conteo'];
    }
    
    return $resultado;
}

function ProcesarEliminarDelCarrito() {
    session_start();
    
    if (!isset($_SESSION['IdUsuario'])) {
        return ['success' => false, 'message' => 'Debes iniciar sesión'];
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idUsuario = $_SESSION['IdUsuario'];
        $idProducto = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);
        $color = trim(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING));
        
        if (!$idProducto || !$color) {
            return ['success' => false, 'message' => 'Datos inválidos'];
        }
        
        $resultado = EliminarDelCarrito($idUsuario, $idProducto, $color);
        return $resultado;
    }
    
    return ['success' => false, 'message' => 'Solicitud no válida'];
}

function ProcesarActualizarCantidad() {
    
    
    $idUsuario = $_SESSION['IdUsuario'];
    $idProducto = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);
    $color = trim(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING));
    
    if (!$idProducto || !$cantidad || $cantidad < 1 || empty($color)) {
        return ['success' => false, 'message' => 'Datos inválidos'];
    }
    
    try {
        $context = AbrirBaseDatos();
        $sentencia = $context->prepare("CALL SP_Actualizar_Cantidad_Carrito(?, ?, ?, ?)");
        $sentencia->bind_param("iisi", $idUsuario, $idProducto, $color, $cantidad);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $respuesta = $resultado->fetch_assoc();
        CerrarBaseDatos($context);
        
        $exito = ($respuesta['success'] == 1); 
        
        if ($exito) {
            $_SESSION['carrito_count'] = ObtenerConteoCarrito($idUsuario);
            
            $productosCarrito = ObtenerCarrito($idUsuario);
            $subtotal = 0;
            
            foreach ($productosCarrito as $producto) {
                $subtotal += $producto['Precio'] * $producto['Cantidad'];
            }
            
            $costoEnvio = ($subtotal > 50) ? 0 : 2;
            $total = $subtotal + $costoEnvio;
            
            return [
                'success' => true,
                'message' => $respuesta['message'] ?? 'Cantidad actualizada',
                'cantidad' => $respuesta['cantidad'] ?? $cantidad,
                'subtotal' => $subtotal,
                'envio' => $costoEnvio,
                'total' => $total,
                'conteo' => $_SESSION['carrito_count'] 
            ];
        } else {
            return [
                'success' => false,
                'message' => $respuesta['message'] ?? 'Error al actualizar',
                'cantidad' => $respuesta['cantidad'] ?? $cantidad
            ];
        }
    } catch (Exception $error) {
        return ['success' => false, 'message' => $error->getMessage()];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    if (isset($_POST['eliminar_carrito'])) {
        echo json_encode(ProcesarEliminarDelCarrito());
        exit;
    }
    
    if (isset($_POST['actualizar_cantidad'])) {
        echo json_encode(ProcesarActualizarCantidad());
        exit;
    }
    
    if (isset($_POST['agregar_carrito'])) {
        echo json_encode(ProcesarAgregarAlCarrito());
        exit;
    }
    
    if (isset($_POST['sincronizar_carrito'])) {
        echo json_encode(ProcesarSincronizarCarrito());
        exit;
    }
    
    echo json_encode(['success' => false, 'message' => 'Acción no reconocida']);
    exit;
}
?>
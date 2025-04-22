<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/CarritoController.php";

header('Content-Type: application/json');

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar que la solicitud sea POST y que haya un usuario autenticado
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['IdUsuario'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Acceso no autorizado'
    ]);
    exit;
}

// Obtener y validar los datos del carrito local
$carritoLocal = json_decode(file_get_contents('php://input'), true) ?? [];

// Validar estructura básica del carrito local
if (!is_array($carritoLocal)) {
    echo json_encode([
        'success' => false,
        'message' => 'Formato de carrito inválido'
    ]);
    exit;
}

// Procesar la sincronización
$resultado = SincronizarCarrito($_SESSION['IdUsuario'], $carritoLocal);

// Devolver respuesta
echo json_encode($resultado);
?>
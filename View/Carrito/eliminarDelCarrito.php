<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/CarritoController.php";

header('Content-Type: application/json');

if (!isset($_SESSION['IdUsuario'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Debes iniciar sesión para realizar esta acción'
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_SESSION['IdUsuario'];
    $idProducto = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);
    $color = trim(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING));
    
    if ($idProducto && $color) {
        echo json_encode(EliminarDelCarrito($idUsuario, $idProducto, $color));
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Datos incompletos o inválidos'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido'
    ]);
}
?>
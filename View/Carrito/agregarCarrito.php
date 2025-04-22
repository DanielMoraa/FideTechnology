<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/CarritoController.php";

header('Content-Type: application/json');

// Supongamos que llamas al SP y recoges el mensaje
$mensaje = 'Producto agregado al carrito';
$conteo = 4;

echo json_encode([
    'success' => true,
    'message' => $mensaje,
    'conteo' => $conteo
]);
?>
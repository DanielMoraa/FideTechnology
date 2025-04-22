<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/CarritoController.php";

header('Content-Type: application/json');

if (isset($_SESSION['IdUsuario'])) {
    $conteo = ObtenerConteoCarrito($_SESSION['IdUsuario']);
    echo json_encode(['success' => true, 'conteo' => $conteo]);
} else {
    // Para usuarios no autenticados, informamos que no hay sesión
    // El conteo se manejará en el cliente con localStorage
    echo json_encode(['success' => false, 'message' => 'Sin sesión activa']);
}
?>
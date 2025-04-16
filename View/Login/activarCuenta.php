<!DOCTYPE html>
<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/LoginController.php";

if (isset($_GET["token"])) {
    $token = $_GET["token"];

    $usuario = ValidarTokenModel($token); 
    if ($validar = mysqli_fetch_array($usuario)) {
        $idUsuario = $validar["Id"];

        if (ActivarCuentaModel($idUsuario)) {
            $mensaje = "Cuenta activada con éxito. Ahora puedes iniciar sesión.";
        } else {
            $mensaje = "Hubo un error al activar tu cuenta.";
        }
    } else {
    $mensaje = "No se proporcionó un token válido.";
}
}
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activación de Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container text-center">
        <div class="alert alert-info">
            <h4><?= $mensaje ?></h4>
        </div>
        <a href="login.php" class="btn btn-primary">Ir al Login</a>
    </div>
</body>
</html>
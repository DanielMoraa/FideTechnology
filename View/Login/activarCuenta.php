<!DOCTYPE html>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/LoginController.php";
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
            <h4> <?php
                                if(isset($_POST["Message"])){
                                    echo '<div class="Mensajes">' . $_POST["Message"] . '</div>';
                                }?></h4>
        </div>
        <a href="login.php" class="btn btn-primary">Ir al Login</a>
    </div>
</body>

</html>
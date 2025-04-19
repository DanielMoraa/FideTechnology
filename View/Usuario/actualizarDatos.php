<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/UsuariosController.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/UtilitariosController.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";

    $datosUsuario = ConsultarUsuario($_SESSION["IdUsuario"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cuenta</title>
    <?php PrintCss(); ?>
</head>

<body>

    <?php PrintNavBar(); ?>

    <section class="section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="p-5 shadow rounded bg-white">
                        <div class="text-center mb-4">
                            <h1 class="h4 text-gray-900">Actualizar Cuenta</h1>
                        </div>

                        <?php
                            if(isset($_POST["Message"]))
                            {
                                echo '<div class="alert alert-warning Mensajes">' . $_POST["Message"] . '</div>';                                   
                            }
                        ?>
                        
                        <form action="" method="POST">
                            <div class="form-group mb-3">
                                <label for="txtNombre">Nombre</label>
                                <input type="text" class="form-control"
                                id="txtNombre" name="txtNombre" required
                                value="<?php echo $datosUsuario["NombreUsuario"] ?>">
                            </div>

                            <div class="form-group mb-4">
                                <label for="txtCorreo">Correo</label>
                                <input type="email" class="form-control"
                                    id="txtCorreo" name="txtCorreo" required
                                    value="<?php echo $datosUsuario["Correo"] ?>">
                            </div>
                            
                            <div class="text-center">
                                <input type="submit" class="btn btn-danger px-5" value="Procesar"
                                        id="btnActualizarDatos" name="btnActualizarDatos">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php PrintFooter(); ?>
    <?php PrintScript(); ?>

</body>
</html>

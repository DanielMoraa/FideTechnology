<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutExterno.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/LoginController.php";
?>
<!DOCTYPE html>
<html lang="en">

<?php PrintCss(); ?>

<body class="bg-gradient-primary">
    <?php PrintNavBar();?>
    <section class="login_part section_padding vh-100">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="form-container">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Crear Cuenta</h1>
                        </div>
                        <form action="" method="POST" class="user">
                            <div class="form-outline mb-4">
                                <input type="text" class="form-control form-control-lg" placeholder="Nombre"
                                    id="txtNombre" name="txtNombre" required>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="email" class="form-control form-control-lg"
                                    placeholder="Correo electrónico" id="txtCorreo" name="txtCorreo" required>
                            </div>
                            <div class="form-outline mb-3">
                                <input type="password" class="form-control form-control-lg" placeholder="Contraseña"
                                    id="txtContrasenna" name="txtContrasenna" />
                            </div>
                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg w-100" id="btnRegistrar"
                                    name="btnRegistrar">
                                    Registrar
                                </button>
                                <?php
        
        if(isset($_POST["Exito"]))
        {
            echo '<div class="text-primary" style="margin-top:15px>' . $_POST["Exito"] . '</div>';                                   
        }?>
                        </form>
                    </div>
                </div>

    </section>
    <?php PrintFooter();?>
    <?php PrintScript(); ?>

</body>

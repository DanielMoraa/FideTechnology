<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutExterno.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/LoginController.php";
?>
<!DOCTYPE html>
<html lang="en">

<?php PrintCss();?>

<body>
<?php PrintNavBar();?>
<section class="login_part section_padding">
<div class="container py-5 ">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="text-center mb-4">
                <h2 class="mb-2">Recuperar Contraseña</h2>
                <p class="text-muted">Siga los siguientes pasos para recuperar su contraseña.</p>
            </div>

            <div class="card reset-card">
                <div class="card-body p-4">

                    <!-- Step 1: Email Verification -->
                    <div class="step-content" id="step1">
                        <h5 class="mb-4">Verificar Correo Electrónico</h5>
                        <form action="" method="POST">
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control"
                                        placeholder="Correo electrónico" id="txtCorreo" name="txtCorreo" required>
                                </div>
                                <div class="form-text">Le enviaremos un correo electrónico con su nueva contraseña</div>
                            </div>
                            <?php
                                if(isset($_POST["ErrorCorreo"])){
                                    echo '<div class="alert alert-danger Mensajes">' . $_POST["ErrorCorreo"] . '</div>';
                                }?>
                            <button type="submit" class="btn btn-primary w-100" id = "btnRecuperarContrasenna" name = "btnRecuperarContrasenna">Enviar correo</button>
                        </form>
                    </div>

                    <!-- Success State -->
                    <div class="step-content d-none text-center" id="success">
                        <div class="success-checkmark">
                            <i class="fas fa-check"></i>
                        </div>
                        <h5 class="mb-3">Correo enviado</h5>
                        <p class="text-muted mb-4">Su contraseña ha sido actualizada.</p>
                        <a href="../login.php" class="btn btn-primary">Iniciar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php PrintFooter();?>
<?php PrintScript(); ?>

</body>

</html>
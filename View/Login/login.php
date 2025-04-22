<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutExterno.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/LoginController.php";
?>
<!DOCTYPE html>
<html lang="es">

<?php PrintCss();?>
<body>
    
<?php PrintNavBar();?>
    <section class="login_part section_padding vh-100">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <!-- Columna de texto -->
                <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>¿Nuevo en nuestra tienda?</h2>
                            <p>Regístrate y sumérgete en una variada gama de celulares, tablets y accesorios de la mejor
                                calidad.</p>
                            <a href="registrarCuenta.php" class="btn_3">Crear una cuenta</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <form action="" method="POST" class="user">
                        <div class="d-flex justify-content-center mb-4">
                            <h1>Iniciar Sesión</h1>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="email" class="form-control form-control-lg"
                                placeholder="Correo electrónico" id="txtCorreo" name="txtCorreo" value="<?php echo htmlspecialchars($correoRecordado); ?>" required maxlength="45"/>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="password" class="form-control form-control-lg"
                                placeholder="Contraseña" id="txtContrasenna" name="txtContrasenna" required maxlength="15"/>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input me-2" type="checkbox" value="" id="cbRecordar" name="cbRecordar" <?php echo (isset($_COOKIE["correo_recordado"])) ? "checked" : ""; ?>/>
                                <label class="form-check-label" for="cbRecordar">
                                    Recordar
                                </label>
                            </div>
                            <a href="../Login/recuperarContrasenna.php" class="text-body fw-bold">¿Olvidaste tu contraseña?</a>
                        </div>
                        <?php
                            if(isset($_POST["Message"]))
                            {
                                echo '<div class="alert alert-danger Mensajes">' . htmlspecialchars($_POST["Message"]) . '</div>';                                   
                            }
                            if(isset($_POST["Exito"]))
                            {
                                echo '<div class="alert alert-success Mensajes">' . htmlspecialchars($_POST["Exito"]) . '</div>';                                   
                            }
                        ?>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;" id="btnIniciarSesion"
                                name="btnIniciarSesion">Iniciar Sesión</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">¿No tienes cuenta?
                                <a href="registrarCuenta.php" class="text-primary fw-bold">Registrar</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php PrintFooter();?>
    <?php PrintScript();?>
</body>
</html>
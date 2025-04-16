<?php

    function PrintCss()
    {
        echo '<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>FideTechnology </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="login.php">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="../Styles/bootstrap.min.css">
    <link rel="stylesheet" href="../Styles/owl.carousel.min.css">
    <link rel="stylesheet" href="../Styles/flaticon.css">
    <link rel="stylesheet" href="../Styles/slicknav.css">
    <link rel="stylesheet" href="../Styles/animate.min.css">
    <link rel="stylesheet" href="../Styles/magnific-popup.css">
    <link rel="stylesheet" href="../Styles/fontawesome-all.min.css">
    <link rel="stylesheet" href="../Styles/themify-icons.css">
    <link rel="stylesheet" href="../Styles/slick.css">
    <link rel="stylesheet" href="../Styles/nice-select.css">
    <link rel="stylesheet" href="../Styles/style.css">
    <link rel="stylesheet" href="../Styles/registro.css">
    <link rel="stylesheet" href="../Styles/recuperarContra.css">
    </head>';
    }
    function PrintNavBar()
    {
        echo '<header>
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top top-bg d-none d-lg-block">
                    <div class="container-fluid">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left d-flex">
                                    <div class="flag">
                                        <img src="../Img/icon/header_icon.png" alt="">
                                    </div>
                                    <div class="select-this">
                                        <form action="#">
                                            <div class="select-itms">
                                                <select name="select" id="select1">
                                                    <option value="">USA</option>
                                                    <option value="">SPN</option>
                                                    <option value="">CDA</option>
                                                    <option value="">USD</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <ul class="contact-now">
                                        <li>+777 2345 7886</li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul>
                                        <li><a href="login.html">Mi cuenta </a></li>
                                        <li><a href="product_list.html">Lista de Deseos</a></li>
                                        <li><a href="cart.html">Carrito</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                    <a href="home.php"><img src="../Img/logo/logo.png"></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="../Home/home.php">Inicio</a></li>
                                            <li><a href="#">Celulares</a>
                                                <ul class="submenu">
                                                    <li><a href="#"> Samsung</a></li>
                                                    <li><a href="single-product.html"> iPhone</a></li>
                                                    <li><a href="#"> Xiaomi</a></li>
                                                    <li><a href="#"> Honor</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="blog.html">Tablets</a>
                                                <ul class="submenu">
                                                    <li><a href="#">iPad</a></li>
                                                    <li><a href="#">Samsung</a></li>
                                                    <li><a href="#">Amazon</a></li>
                                                    <li><a href="#">Lenovo</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Accesorios</a>
                                                <ul class="submenu">
                                                    <li><a href="#">Cargadores</a></li>
                                                    <li><a href="#">Covers</a></li>
                                                    <li><a href="#">Audífonos</a></li>
                                                    <li><a href="#">Otros</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contacto.php">Contacto</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                                <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">
                                    <li class="d-none d-xl-block">
                                        <div class="form-box f-right ">
                                            <input type="text" name="Search" placeholder="Buscar productos">
                                            <div class="search-icon">
                                                <i class="fas fa-search special-tag"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class=" d-none d-xl-block">
                                        <div class="favorit-items">
                                            <i class="far fa-heart"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shopping-card">
                                            <a href="cart.html"><i class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>';
    }

    function PrintModal()
    {
        echo '
    <div class="modal-overlay" id="registerModal">
        <div class="modal-container position-relative">
            <button class="close-button" id="closeModal">&times;</button>
            <div class="modal-title">Únete a FideTechnology hoy</div>
            
            <form class="modal-form" method="POST" action="">
                <label for="username">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
                <div class="helper-text">Este es el nombre por el que te conocerán los demás en FideTechnology. Puedes cambiarlo más tarde.</div>
                
                <label for="password">Contraseña</label>
                <div class="password-container">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <button type="button" class="toggle-password" id="togglePassword">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                
                <label>Fecha de nacimiento</label>
                <div class="date-selects">
                    <select name="day" id="day" class="form-control" required>
                        <option value="" disabled selected>Día</option>
                        <?php for($i=1; $i<=31; $i++) { echo "<option value="$i">$i</option>"; } ?>
                    </select>
                    
                    <select name="month" id="month" class="form-control" required>
                        <option value="" disabled selected>Mes</option>
                        <?php 
                            $months = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                            foreach($months as $index => $month) {
                                echo "<option value=".($index+1).">$month</option>";
                            }
                        ?>
                    </select>
                    
                    <select name="year" id="year" class="form-control" required>
                        <option value="" disabled selected>Año</option>
                        <?php 
                            $currentYear = date("Y");
                            for($i=$currentYear; $i>=$currentYear-100; $i--) {
                                echo "<option value="$i">$i</option>";
                            }
                        ?>
                    </select>
                </div>
                
                <label for="phone">Número telefónico</label>
                <div class="input-group mb-3">
                    <select class="form-control" style="max-width: 35%;" name="country_code" id="country_code">
                        <option value="+506">Costa Rica +506</option>
                        <option value="+52">México +52</option>
                        <option value="+1">Estados Unidos +1</option>
                        <option value="+34">España +34</option>
                        <option value="+57">Colombia +57</option>
                    </select>
                    <input type="tel" class="form-control" name="phone" id="phone" required>
                </div>
                
                <div class="text-center mt-2">
                    <a href="#" id="useEmail">Usa un correo en su lugar</a>
                </div>
                
                <div class="helper-text">
                    FideTechnology puede usar tu número de teléfono para llamar o enviar mensajes de texto con información relacionada con tu cuenta.
                </div>
                
                <div class="helper-text">
                    Al hacer clic en Registrarse, aceptas los <a href="#">Términos de servicio</a> de FideTechnology y reconoces que se aplica nuestro <a href="#">Aviso de privacidad</a>.
                </div>
                
                <button type="submit" class="register-button" name="btnRegistrar" id="btnRegistrar">Registrarse</button>
                
                <div class="login-link">
                    ¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a>
                </div>
            </form>
        </div>
    </div>';
    }

    function PrintFooter()
    {
        echo '   <footer>
        <div class="footer-area footer-padding2">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <div class="footer-logo">
                                    <a href="home.php"><img src="../Img/logo/logo2_footer.png" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Acceso rápido</h4>
                                <ul>
                                    <li><a href="#">Acerca de</a></li>
                                    <li><a href="#"> Contáctenos</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Productos</h4>
                                <ul>
                                    <li><a href="#">Celulares</a></li>
                                    <li><a href="#">Tablets</a></li>
                                    <li><a href="#">Accesorios</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Servicio al cliente</h4>
                                <ul>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Términos y condiciones</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-7 col-lg-7 col-md-7">
                        <div class="footer-copy-right">
                            <p>
                                Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                                </script> Derechos reservados </p>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-5">
                        <div class="footer-copy-right f-right">
                            <div class="footer-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                                <a href="#"><i class="fas fa-globe"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>';
    }

    function PrintScript()
    {
        echo '<script src="../Scripts/modernizr-3.5.0.min.js"></script>
    <script src="../Scripts/jquery-1.12.4.min.js"></script>
    <script src="../Scripts/popper.min.js"></script>
    <script src="../Scripts/bootstrap.min.js"></script>
    <script src="../Scripts/jquery.slicknav.min.js"></script>
    <script src="../Scripts/owl.carousel.min.js"></script>
    <script src="../Scripts/slick.min.js"></script>
    <script src="../Scripts/wow.min.js"></script>
    <script src="../Scripts/animated.headline.js"></script>
    <script src="../Scripts/jquery.scrollUp.min.js"></script>
    <script src="../Scripts/jquery.nice-select.min.js"></script>
    <script src="../Scripts/jquery.sticky.js"></script>
    <script src="../Scripts/jquery.magnific-popup.js"></script>
    <script src="../Scripts/contact.js"></script>
    <script src="../Scripts/jquery.form.js"></script>
    <script src="../Scripts/jquery.validate.min.js"></script>
    <script src="../Scripts/mail-script.js"></script>
    <script src="../Scripts/jquery.ajaxchimp.min.js"></script>
    <script src="../Scripts/plugins.js"></script>
    <script src="../Scripts/main.js"></script>';
    }
    
?>
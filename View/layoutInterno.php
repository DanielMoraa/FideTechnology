<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/LoginController.php";

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }


    function PrintCss()
    {
        echo '<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>FideTechnology</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="../assets/css/flaticon.css">
        <link rel="stylesheet" href="../assets/css/slicknav.css">
        <link rel="stylesheet" href="../assets/css/animate.min.css">
        <link rel="stylesheet" href="../assets/css/magnific-popup.css">
        <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="../assets/css/themify-icons.css">
        <link rel="stylesheet" href="../assets/css/slick.css">
        <link rel="stylesheet" href="../assets/css/nice-select.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/efectos.css">
        </head>';   
    }
    

    function PrintNavBar()
    {
        $usuario = VerificarSesion();

        $nombrePerfil = "";
        if(isset($_SESSION["NombrePerfil"]))
        {
            $nombrePerfil = $_SESSION["NombrePerfil"];
        }
        echo '    <header>
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top top-bg d-none d-lg-block">
                   <div class="container-fluid">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left d-flex">
                                    <div class="flag">
                                        <img src="../assets/img/icon/header_icon.png" alt="">
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
                                  <a href="home.php"><img src="../assets/img/logo/logo.png"></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>                                                
                                        <ul id="navigation">                                                                                                                                     
                                            <li><a href="../Home/home.php">Inicio</a></li>
                                            <li><a href="../Productos/consultarProductos.php">Celulares</a>
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
    <ul class="header-right f-right d-none d-lg-flex align-items-center justify-content-between">
        <!-- Barra de búsqueda -->
        <li class="d-none d-xl-block ">
            <div class="form-box f-right">
                <input type="text" name="Search" placeholder="Buscar productos">
                <div class="search-icon">
                    <i class="fas fa-search special-tag"></i>
                </div>
            </div>
        </li>

        <!-- Favoritos -->
        <li class="d-none d-xl-block ml-3">
            <div class="favorit-items">
                <i class="far fa-heart"></i>
            </div>
        </li>

        <!-- Carrito -->
        <li class="ml-3">
            <div class="shopping-card">
                <a href="cart.html"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </li>';

                                    if ($usuario) {
                                        echo '<li class="nav-item dropdown no-arrow ml-3">
                                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="mr-2 d-none d-lg-inline text-gray-600" style="color: black">' . htmlspecialchars($usuario) . '</span>
                                                    <img class="img-profile rounded-circle" src="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg" height = "50px" width = "50px">
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                                     aria-labelledby="userDropdown">
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400 AlineacionOpciones"></i>
                                                        Perfil
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400 AlineacionOpciones"></i>
                                                        Seguridad
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">
                                                        <form method="POST" action="../../Controller/LoginController.php">
                                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                                                            <input class="AlineacionOpcionesSalir" id="btnSalir" name="btnSalir" type="submit" value="Salir">
                                                        </form>
                                                    </a>
                                                </div>
                                              </li>';
                                    } else {
                                        echo '<li class="d-none d-lg-block"> <a href="../Login/login.php" class="btn header-btn">Iniciar sesión</a></li>';
                                    }
                                
                                    echo '                  </ul>
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

    function PrintScript()
    {
        echo '<script src="../assets/js/modernizr-3.5.0.min.js"></script>
            <script src="../assets/js/jquery-1.12.4.min.js"></script>
            <script src="../assets/js/popper.min.js"></script>
            <script src="../assets/js/bootstrap.min.js"></script>
            <script src="../assets/js/jquery.slicknav.min.js"></script>
            <script src="../assets/js/owl.carousel.min.js"></script>
            <script src="../assets/js/slick.min.js"></script>
            <script src="../assets/js/wow.min.js"></script>
            <script src="../assets/js/animated.headline.js"></script>
            <script src="../assets/js/jquery.scrollUp.min.js"></script>
            <script src="../assets/js/jquery.nice-select.min.js"></script>
            <script src="../assets/js/jquery.sticky.js"></script>
            <script src="../assets/js/jquery.magnific-popup.js"></script>
            <script src="../assets/js/contact.js"></script>
            <script src="../assets/js/jquery.form.js"></script>
            <script src="../assets/js/jquery.validate.min.js"></script>
            <script src="../assets/js/mail-script.js"></script>
            <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
            <script src="../assets/js/plugins.js"></script>
            <script src="../assets/js/main.js"></script>';
    }

    function PrintFooter()
    {
        echo '<footer>

       <div class="footer-area footer-padding">
           <div class="container">
               <div class="row d-flex justify-content-between">
                   <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                      <div class="single-footer-caption mb-50">
                        <div class="single-footer-caption mb-30">
                             <!-- logo -->
                            <div class="footer-logo">
                                <a href="index.html"><img src="../assets/img/logo/logo2_footer.png" alt=""></a>
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
                                   <li><a href="#">  Contáctenos</a></li>
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
                Copyright &copy; <script> document.write(new Date().getFullYear() );</script> Derechos reservados</div>
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

?>
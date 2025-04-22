<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/LoginController.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/ProductosController.php";
    $categoria_id = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;
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
        <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="../assets/css/flaticon.css">
        <link rel="stylesheet" href="../assets/css/slicknav.css">
        <link rel="stylesheet" href="../assets/css/animate.min.css">
        <link rel="stylesheet" href="../assets/css/magnific-popup.css">
        <link rel="stylesheet" href="../assets/css/themify-icons.css">
        <link rel="stylesheet" href="../assets/css/slick.css">
        <link rel="stylesheet" href="../assets/css/nice-select.css">
         <link rel="stylesheet" href="../assets/css/inicio.css">
        <link rel="stylesheet" href="../assets/css/efectos.css">
        <link rel="stylesheet" href="../assets/css/agregarProductos.css">
        <link rel="stylesheet" href="../assets/css/detalleProductos.css">
        <link rel="stylesheet" href="../assets/css/carrito.css">
        <link rel="stylesheet" href="../assets/css/fide-custom.css">
        <link rel="stylesheet" href="../assets/css/carritoDetalle.css">
        <link rel="stylesheet" href="../assets/css/notificaciones.css">
        </head>';   
    }
    

function PrintNavBar()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    $usuario = VerificarSesion();
    
    // Inicializar contador de carrito si no existe
    if (!isset($_SESSION["carrito_count"])) {
        $_SESSION["carrito_count"] = 0;
    }
    
    // Obtener información del perfil y carrito
    $nombrePerfil = isset($_SESSION["NombrePerfil"]) ? $_SESSION["NombrePerfil"] : "";
    $carrito_count = $_SESSION["carrito_count"] ?? 0;
    
    // Obtener parámetros de búsqueda si existen
    $keyword = isset($_GET["keyword"]) ? htmlspecialchars($_GET["keyword"]) : "";
    $categoria_id = isset($_GET["categoria"]) ? intval($_GET["categoria"]) : 0;
    
    echo '<header>
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
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <ul class="contact-now">     
                                    <li>+777 2345 7886</li>
                                </ul>
                            </div>
                            <div class="header-info-right">
                               <ul>';
    
    // Enlaces condicionales basados en si hay un usuario logueado
    if ($usuario) {
        echo '<li><a href="../Usuario/actualizarDatos.php">Mi cuenta </a></li>
              <li><a href="product_list.html">Lista de Deseos</a></li>
              <li><a href="../Carrito/carritoDetalle.php">Carrito</a></li>
              <li><a href="checkout.html">Checkout</a></li>';
    } else {
        echo '<li><a href="../Login/login.php">Ingresar</a></li>
              <li><a href="../Login/registrarCuenta.php">Registrarse</a></li>';
    }
    
    echo '</ul>
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
                              <a href="../Home/home.php"><img src="../assets/img/logo/logo.png"></a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>                                                
                                    <ul id="navigation">                                                                                                                                     
                                        <li><a href="../Home/home.php">Inicio</a></li>
                                        <li><a href="../Productos/consultarProducto.php?categoria=1">Celulares</a>
                                            <ul class="submenu">
                                                <li><a href="../Productos/consultarProducto.php?keyword=Samsung&categoria=1"> Samsung</a></li>
                                                <li><a href="../Productos/consultarProducto.php?keyword=Iphone&categoria=1"> iPhone</a></li>
                                                <li><a href="../Productos/consultarProducto.php?keyword=Xiaomi&categoria=1"> Xiaomi</a></li>
                                                <li><a href="../Productos/consultarProducto.php?keyword=Honor&categoria=1"> Honor</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="../Productos/consultarProducto.php?categoria=2">Tablets</a>
                                            <ul class="submenu">
                                                <li><a href="../Productos/consultarProducto.php?keyword=iPad&categoria=2">iPad</a></li>
                                                <li><a href="../Productos/consultarProducto.php?keyword=Samsung&categoria=2">Samsung</a></li>
                                                <li><a href="../Productos/consultarProducto.php?keyword=Amazon&categoria=2">Amazon</a></li>
                                                <li><a href="../Productos/consultarProducto.php?keyword=Lenovo&categoria=2">Lenovo</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="../Productos/consultarProducto.php?categoria=3">Accesorios</a>
                                            <ul class="submenu">
                                                <li><a href="../Productos/consultarProducto.php?keyword=Cargador&categoria=3">Cargadores</a></li>
                                                <li><a href="../Productos/consultarProducto.php?keyword=Cover&categoria=3">Covers</a></li>
                                                <li><a href="../Productos/consultarProducto.php?keyword=Audifonos&categoria=3">Audífonos</a></li>
                                                <li><a href="../Productos/consultarProducto.php?keyword=Otros&categoria=3">Otros</a></li>
                                            </ul>
                                        </li>';
                                        
    // Agregar opción "Agregar productos" solo para vendedores
    if(isset($_SESSION["IdPerfil"]) && $_SESSION["IdPerfil"] == "3") {
        echo '<li><a href="../Productos/gestionProducto.php">Gestionar productos</a></li>';
    }
                                        
    echo '<li><a href="contacto.php">Contacto</a></li>
    </ul>
    </nav>
    </div>
    </div> 
    <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
    <ul class="header-right f-right d-none d-lg-flex align-items-center justify-content-between">
        <!-- Barra de búsqueda -->
        <li class="d-none d-xl-block">
            <div class="form-box f-right">
                <form action="../Productos/consultarProducto.php" method="GET" id="searchForm">
                    <input type="text" class="ft_search_input" name="keyword" 
                           placeholder="Buscar productos..." 
                           value="' . $keyword . '">';
                    
    // Agregar campo oculto para categoría si existe
    if($categoria_id > 0) {
        echo '<input type="hidden" name="categoria" value="' . $categoria_id . '">';
    }
    
    echo '</form>
            </div>
        </li>

        <!-- Favoritos -->
        <li class="d-none d-xl-block ml-3">
            <div class="favorit-items">
                <i class="far fa-heart"></i>
            </div>
        </li>
        
        <!-- Carrito -->
        <li class="d-none d-xl-block ml-3">
  <div class="fide-carrito-icon">
    <a href="../Carrito/carritoDetalle.php" class="nav-link">
      <i class="fas fa-shopping-cart fa-lg"></i>
                <span class="carrito-counter" style="display:none;">0</span>
        </a>
  </div>
</li>';

    // UI específica para usuarios autenticados
    if ($usuario) {
        echo '<li class="nav-item dropdown no-arrow ml-3">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600" style="color: black">' . htmlspecialchars($usuario) . '</span>
                    <img class="img-profile rounded-circle" src="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg" height="50px" width="50px">
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../Usuario/perfil.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400 AlineacionOpciones"></i>
                        Perfil
                    </a>
                    <a class="dropdown-item" href="../Usuario/seguridad.php">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400 AlineacionOpciones"></i>
                        Seguridad
                    </a>';
                    
        // Menú específico para vendedores
        if(isset($_SESSION["IdPerfil"]) && $_SESSION["IdPerfil"] == "3") {
            echo '<a class="dropdown-item" href="../Productos/agregarProducto.php">
                <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400 AlineacionOpciones"></i>
                Administrar Productos
            </a>';
        }
                    
        echo '<div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <form method="POST" action="../../Controller/LoginController.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    <input class="AlineacionOpcionesSalir" id="btnSalir" name="btnSalir" type="submit" value="Salir">
                </form>
            </a>
        </div>
      </li>';
    } else {
        // Botón de inicio de sesión para usuarios no autenticados
        echo '<li class="d-none d-lg-block"> <a href="../Login/login.php" class="btn header-btn">Iniciar sesión</a></li>';
    }
                            
    echo '</ul>
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
        echo '            <script src="../assets/js/jquery.min.js"></script>

        <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
            <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap4.js"></script>
        <script src="../assets/js/modernizr-3.5.0.min.js"></script>
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
            <script src="../assets/js/main.js"></script>
            <script src="../assets/js/productos.js"></script>
            <script src="../assets/js/detalleProductos.js"></script>
            <script src="../assets/js/carrito.js"></script>
            <script src="../assets/js/carritoDetalle.js"></script>

            ';
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
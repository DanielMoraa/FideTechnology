<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/LoginController.php";
?>
<!doctype html>
<html lang="zxx">
    <head>
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
    </head>

    <body>
    
    <header>
        <!-- Header Start -->
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
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                  <a href="home.php"><img src="../Img/logo/logo.png"></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>                                                
                                        <ul id="navigation">                                                                                                                                     
                                            <li><a href="home.php">Inicio</a></li>
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
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>

    <!--================login_part Area =================-->
    <section class="login_part section_padding vh-100">
    <div class="container h-100">
    <div class="row align-items-center justify-content-center h-100">
      <!-- Columna de texto -->
      <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
        <div class="login_part_text text-center">
          <div class="login_part_text_iner">
            <h2>¿Nuevo en nuestra tienda?</h2>
            <p>Regístrate y sumérgete en una variada gama de celulares, tablets y accesorios de la mejor calidad.</p>
            <a href="#" class="btn_3">Crear una cuenta</a>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-6 col-xl-5">
        <form action = "" method = "POST" class = "user">
          <div class="d-flex justify-content-center mb-4">
            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-facebook-f"></i>
            </button>
            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-twitter"></i>
            </button>
            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-linkedin-in"></i>
            </button>
          </div>
          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">O</p>
          </div>
          <div class="form-outline mb-4">
            <input type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Correo electrónico" />
          </div>
          <div class="form-outline mb-3">
            <input type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Contraseña" />
          </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Recordar
              </label>
            </div>
            <a href="#!" class="text-body fw-bold">¿Olvidaste tu contraseña?</a>
          </div>
          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;"
            id = "btnIniciarSesion" name = "btnIniciarSesion">Iniciar Sesión</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">¿No tienes cuenta?
              <a href="#!" class="text-primary fw-bold">Registrar</a>
            </p>
          </div>
        </form>
      </div>
    </div>
    </div>
    </section>

    <!--================login_part end =================-->

    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding2">
            <div class="container">
            <div class="row d-flex justify-content-between">
                   <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                      <div class="single-footer-caption mb-50">
                        <div class="single-footer-caption mb-30">
                             <!-- logo -->
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
                <!-- Footer bottom -->
                <div class="row">
                 <div class="col-xl-7 col-lg-7 col-md-7">
                     <div class="footer-copy-right">
                         <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> Derechos reservados 
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>                </div>
                 </div>
                  <div class="col-xl-5 col-lg-5 col-md-5">
                     <div class="footer-copy-right f-right">
                         <!-- social -->
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
    
    </footer>


    <script src="../Scripts/modernizr-3.5.0.min.js"></script>
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
    <script src="../Scripts/main.js"></script>

</body>
</html>


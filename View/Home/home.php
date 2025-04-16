<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";
?>
<!doctype html>
<html lang="en">

    <?php PrintCss();?>
   <body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="../assets/img/logo/logo.png">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <?php PrintNavBar();?>
    <main>
        <div class="slider-area ">
            <div class="slider-active">
                <div class="single-slider slider-height" data-background="../assets/img/hero/h1_hero.jpg">
                    <div class="container">
                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-none d-md-block">
                                <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                    <img src="../assets/img/hero/hero_man.png" alt="">
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-8">
                                <div class="hero__caption">
                                    <span data-animation="fadeInRight" data-delay=".4s">20% de Descuento</span>
                                    <h1 data-animation="fadeInRight" data-delay=".6s">Iphone 16 <br> Pro Max</h1>
                                    <p data-animation="fadeInRight" data-delay=".8s">Aprovecha esta temporada de ofertas!</p>
                                    <div class="hero__btn" data-animation="fadeInRight" data-delay="1s">
                                        <a href="industries.html" class="btn hero-btn">Comprar Ahora</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

   <?php PrintFooter();?>
   <?php PrintScript();?>
    </body>
</html>


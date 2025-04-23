<?php
        include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php PrintCss();?>
</head>
<body class="ft-about">
<?php PrintNavBar();?>
    <section class="ft-about hero">
        <div class="ft-about container">
            <div class="ft-about hero-content">
                <h1 style = "color:white">Innovación tecnológica a tu alcance</h1>
                <p style = "color:white">En FideTechnology conectamos a las personas con la tecnología más avanzada del mercado, ofreciendo productos de calidad con un servicio excepcional.</p>
            </div>
        </div>
    </section>
    
    <section class="ft-about about-section">
        <div class="ft-about container">
            <h2 class="ft-about section-title">Nuestra Historia</h2>
            <div class="ft-about about-grid">
                <div class="ft-about about-card">
                    <i class="fas fa-lightbulb"></i>
                    <h3>Nacimiento</h3>
                    <p>Fundada en 2015 por un grupo de entusiastas de la tecnología, FideTechnology comenzó como un pequeño emprendimiento con la visión de hacer la tecnología accesible para todos.</p>
                </div>
                <div class="ft-about about-card">
                    <i class="fas fa-chart-line"></i>
                    <h3>Crecimiento</h3>
                    <p>Gracias a nuestra dedicación y enfoque en el cliente, en solo 3 años nos convertimos en una de las tiendas de tecnología más confiables de la región.</p>
                </div>
                <div class="ft-about about-card">
                    <i class="fas fa-globe"></i>
                    <h3>Expansión</h3>
                    <p>Hoy operamos en 5 países de Latinoamérica y seguimos creciendo, manteniendo siempre nuestros valores de honestidad, innovación y servicio al cliente.</p>
                </div>
            </div>
        </div>
    </section>
    
    
    <section class="ft-about values">
        <div class="ft-about container">
            <h2 class="ft-about section-title">Nuestros Valores</h2>
            <div class="ft-about values-list">
                <div class="ft-about value-item">
                    <div class="ft-about value-icon">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <div class="ft-about value-content">
                        <h3>Compromiso con el cliente</h3>
                        <p>Nuestros clientes son nuestra prioridad. Nos esforzamos por superar sus expectativas en cada interacción, ofreciendo productos de calidad y un servicio excepcional.</p>
                    </div>
                </div>
                <div class="ft-about value-item">
                    <div class="ft-about value-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="ft-about value-content">
                        <h3>Innovación constante</h3>
                        <p>Estamos siempre a la vanguardia tecnológica, buscando las últimas tendencias y productos para ofrecer a nuestros clientes lo mejor del mercado.</p>
                    </div>
                </div>
                <div class="ft-about value-item">
                    <div class="ft-about value-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="ft-about value-content">
                        <h3>Transparencia y honestidad</h3>
                        <p>Creemos en relaciones comerciales claras y honestas. No hay letras pequeñas ni sorpresas desagradables para nuestros clientes.</p>
                    </div>
                </div>
                <div class="ft-about value-item">
                    <div class="ft-about value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ft-about value-content">
                        <h3>Trabajo en equipo</h3>
                        <p>Valoramos la colaboración y el respeto mutuo. Nuestro éxito es el resultado del esfuerzo conjunto de un equipo talentoso y comprometido.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php PrintFooter();?>
    <?php PrintScript();?>
</body>
</html>
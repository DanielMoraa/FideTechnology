<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/ProductosController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";

$productos = ConsultarProductos();
?>

<!DOCTYPE html>
<html lang="es">
<?php PrintCss(); ?>
<body>
    <div id="wrapper">
        <?php MenuNavegacion(); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php BarraNavegacion(); ?>
                <div class="container-fluid">
                    <h5>Catálogo de Productos</h5>
                    <div class="row">
                        <?php while ($producto = mysqli_fetch_array($productos)) { ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="<?= $producto['Imagen'] ?>" class="card-img-top" alt="<?= $producto['Nombre'] ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $producto['Nombre'] ?></h5>
                                        <p class="card-text">Precio: $<?= number_format($producto['Precio'], 2) ?></p>
                                        <p class="card-text">Disponibilidad: <?= $producto['Disponibilidad'] ? 'En stock' : 'Agotado' ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php PrintFooter(); ?>
            </div>
        </div>
    </div>
    <?php PrintScript(); ?>
</body>
</html>

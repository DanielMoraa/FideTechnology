<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/ProductosController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";
$categoria_id = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$categorias = ConsultarCategorias();
$productos = ProcesarSolicitudProductos();

$nombre_categoria_actual = ObtenerNombreCategoria($categoria_id);

$tiene_resultados = ($productos && $productos->num_rows > 0);
?>

<?php PrintCss(); ?>

<body>
<?php PrintNavBar(); ?>

<section class="product_list section_padding">
    <div class="container">
        <div class="fmr-section-title">
            <h2>Productos</h2>
        </div>

        <!-- Filtros -->
        <div class="ft_filters_container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ft_filter_title">Buscar Productos</div>
                    <form action="" method="GET" id="searchForm">
                        <input type="text" class="ft_search_input" name="keyword"
                               placeholder="Buscar productos..."
                               value="<?php echo htmlspecialchars($keyword); ?>">
                        <?php if ($categoria_id > 0): ?>
                            <input type="hidden" name="categoria" value="<?php echo $categoria_id; ?>">
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>

        <?php if ($tiene_resultados): ?>
            <div class="ft_products_grid">
                <?php while ($producto = $productos->fetch_assoc()): ?>
                    <div class="ft_product_wrapper" data-category="<?php echo $producto['IdCategoria']; ?>">
                        <div class="ft_product_card">
                            <div class="ft_image_container">
                                <img src="<?php echo $producto['Imagen']; ?>"
                                     alt="<?php echo $producto['NombreProducto']; ?>"
                                     class="img-fluid">
                                <div class="ft_cart_button <?php echo !$producto['Disponibilidad'] ? 'disabled' : ''; ?>"
                                     <?php if ($producto['Disponibilidad']): ?>
                                         onclick="addToCart(<?php echo $producto['IdProducto']; ?>)"
                                     <?php endif; ?>>
                                    <i class="fas fa-shopping-cart"></i>
                                    <?php echo $producto['Disponibilidad'] ? 'Añadir al carrito' : 'Agotado'; ?>
                                </div>
                            </div>
                            <div class="ft_product_info">
                                <h3 class="ft_product_title">
                                    <a href="detalleProducto.php?id=<?php echo $producto['IdProducto']; ?>">
                                        <?php echo $producto['NombreProducto']; ?>
                                    </a>
                                </h3>
                                <div class="ft_price_category">
                                    <div class="ft_price_tag">
                                    ₡<?php echo number_format($producto['Precio'], 3, ",",","); ?>
                                    </div>
                                    <div class="ft_category_tag">
                                        <?php echo $producto['NombreCategoria']; ?>
                                    </div>
                                </div>
                                <?php if ($producto['Disponibilidad']): ?>
                                    <span class="ft_badge ft_in_stock">En stock</span>
                                <?php else: ?>
                                    <span class="ft_badge ft_out_stock">Agotado</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="text-center">
                <button class="ft_load_more" id="loadMoreBtn">Cargar más productos</button>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12 text-center">
                    <img src="../assets/img/product/sinproductos.jpeg" alt="No hay productos"
                         style="max-width: 200px; margin-bottom: 20px;">
                    <h3>No hay productos disponibles</h3>
                    <p>Lo sentimos, no hemos encontrado productos que coincidan con tu búsqueda.</p>
                    <a href="consultarProducto.php" class="btn btn-primary mt-3">Ver todos los productos</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php PrintScript(); ?>
<?php PrintFooter(); ?>
</body>
</html>

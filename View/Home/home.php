<?php
        include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/ProductosController.php";
        include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";
        $categoria_id = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    
        $categorias_result = ConsultarCategorias();
        $categorias_array = [];
        
        // Guardar los resultados en un array para reutilizarlos
        if($categorias_result != null) {
            while($fila = mysqli_fetch_array($categorias_result)) {
                $categorias_array[] = $fila;
            }
        }
        
        $productos = ProcesarSolicitudProductos();
        $nombre_categoria_actual = ObtenerNombreCategoria($categoria_id);
        $tiene_resultados = ($productos && $productos->num_rows > 0);
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
    <section class="fmr-hero">
            <div class="fmr-container">
                <div class="fmr-hero-content">
                    <div class="fmr-hero-text">
                        <span class="fmr-discount-badge">20% de Descuento</span>
                        <h1 class="fmr-hero-title">iPhone 16 <br>Pro Max</h1>
                        <p class="fmr-hero-subtitle">Aprovecha esta temporada de ofertas!</p>
                        <a href="../Productos/detalleProducto.php?id=8" class="fmr-btn">Comprar Ahora</a>
                    </div>
                    <div class="fmr-hero-image">
                        <img src="../assets/img/hero/hero_man.png" alt="iPhone 16 Pro Max">
                    </div>
                </div>
            </div>
        </section>
        <section class="fmr-categories">
            <div class="fmr-container">
            <div class="fmr-category-grid">
            <?php
if(!empty($categorias_array)) {
    foreach($categorias_array as $fila) {
        echo '
        <a href="productos/' . htmlspecialchars(strtolower(str_replace(' ', '-', $fila["Nombre"]))) . '.html" class="fmr-category-card">
            <div class="fmr-category-image">
                <img src="' . htmlspecialchars($fila["Imagen"]) . '" alt="' . htmlspecialchars($fila["Nombre"]) . '">
            </div>
            <h3 class="fmr-category-name">' . htmlspecialchars($fila["Nombre"]) . '</h3>
        </a>';
    }
} else {
    echo '
        <a href="productos/pino.html" class="fmr-category-card">
            <div class="fmr-category-image">
                <img src="../assets/img/categories/default.jpg" alt="Categoría por defecto">
            </div>
            <h3 class="fmr-category-name">CATEGORÍAS</h3>
        </a>';
}
?>
</div>
    </div>
        </section>
    
    <!-- Sección de productos -->
    <section class="product_list section_padding">
        <div class="container">
            <div class="fmr-section-title">
                <h2>Productos</h2>
            </div>
            
            <!-- Filtros -->
            <div class="ft_filters_container">
                <div class="row">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <div class="ft_filter_title">Filtrar por</div>
                        <div class="ft_category_dropdown">
                            <button class="ft_category_button" id="categoryDropdown">
                                <?php echo $nombre_categoria_actual; ?> <i class="fas fa-caret-down"></i>
                            </button>
                            <div class="ft_dropdown_menu" id="categoryMenu">
                                <div class="ft_dropdown_item">
                                    <a href="<?php echo !empty($keyword) ? '?keyword=' . urlencode($keyword) : ''; ?>">
                                        Todas las categorías
                                    </a>
                                </div>
                                
                                <?php if (!empty($categorias_array)): ?>
                                <?php foreach ($categorias_array as $categoria): ?>
                                <div class="ft_dropdown_item <?php echo ($categoria_id == $categoria['Id']) ? 'active' : ''; ?>">
                                    <a href="?categoria=<?php echo $categoria['Id']; 
                                        echo !empty($keyword) ? '&keyword=' . urlencode($keyword) : ''; ?>">
                                        <?php echo $categoria['Nombre']; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if ($tiene_resultados): ?>
                <!-- Productos -->
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
                                        <a href="../Productos/detalleProducto.php?id=<?php echo $producto['IdProducto']; ?>">
                                            <?php echo $producto['NombreProducto']; ?>
                                        </a>
                                    </h3>
                                    <div class="ft_price_category">
                                        <div class="ft_price_tag">
                                            $<?php echo number_format($producto['Precio'], 2); ?>
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
                
                <!-- Botón para cargar más productos -->
                <div class="text-center">
                    <button class="ft_load_more" id="loadMoreBtn">Cargar más productos</button>
                </div>
            <?php else: ?>
                <!-- Mensaje de no hay productos -->
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="../assets/img/product/sinproductos.jpeg" alt="No hay productos" 
                             style="max-width: 200px; margin-bottom: 20px;">
                        <h3>No hay productos disponibles</h3>
                        <p>Lo sentimos, no hemos encontrado productos que coincidan con tu búsqueda.</p>
                        <a href="home.php" class="btn btn-primary mt-3">Ver todos los productos</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
   <?php PrintFooter();?>
   <?php PrintScript();?>
    </body>
</html>


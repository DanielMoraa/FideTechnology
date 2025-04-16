<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/ProductosController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";
?>

<?php PrintCss();?>

<body>

    <?php PrintNavBar();?>
    <main>
        <!-- slider Area Start-->
        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="single-slider slider-height2 d-flex align-items-center"
                data-background="../assets/img/hero/category.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Productos</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    $datos = ConsultarProductos(); 

    if ($datos != null) {
        echo '
        <!-- product list part start-->
        <section class="product_list section_padding">
            <div class="container">
                <h2 class="ft_section_title">Descubre Nuestros Productos</h2>
                
                <!-- Filtros mejorados -->
                <div class="ft_filters_container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="ft_filter_title">Buscar Productos</div>
                            <form action="">
                                <input type="text" class="ft_search_input" name="keyword" placeholder="Buscar productos...">
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="ft_filter_title">Filtrar por</div>
                            <div class="ft_category_dropdown">
                                <button class="ft_category_button">Categoría <i class="fas fa-caret-down"></i></button>
                                <div class="ft_dropdown_menu">';
        
        echo '<div class="ft_dropdown_item"><a href="productos.php">Todas las categorías</a></div>';

        $categorias = ConsultarCategorias();
        if ($categorias) {
            while ($row = mysqli_fetch_array($categorias)) {
                echo '<div class="ft_dropdown_item">
                    <a href="productos.php?categoria=' . $row['Id'] . '">' . $row['Nombre'] . '</a>
                </div>';
            }
        }
        
        echo '          </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Productos con mejor espaciado -->
                <div class="ft_products_grid">';

        while ($fila = mysqli_fetch_array($datos)) {
            
            echo '
                <div class="ft_product_wrapper">
                    <div class="ft_product_card">
                        <div class="ft_image_container">
                            <img src="' . $fila["Imagen"] . '" alt="' . $fila["NombreProducto"] . '" class="img-fluid">
                            <div class="ft_cart_button" onclick="addToCart(' . $fila["IdProducto"] . ')">
                                <i class="fas fa-shopping-cart"></i> Añadir al carrito
                            </div>
                        </div>
                        <div class="ft_product_info">
                            <h3 class="ft_product_title"><a href="product-details.php?id=' . $fila["IdProducto"] . '">' . $fila["NombreProducto"] . '</a></h3>
                            <div class="ft_price_tag">$' . number_format($fila["Precio"], 2) . '</div>
                        </div>
                    </div>
                </div>';
        }

        echo '
                </div>
                <div class="text-center">
                    <button class="ft_load_more">Cargar más productos</button>
                </div>
            </div>
        </section>
        <!-- product list part end-->';
    } else {
        echo '
        <section class="product_list section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="../assets/img/no-products.svg" alt="No hay productos" style="max-width: 200px; margin-bottom: 20px;">
                        <h3>No hay productos disponibles</h3>
                        <p>Lo sentimos, no hemos encontrado productos para mostrar.</p>
                    </div>
                </div>
            </div>
        </section>';
    }
?>

    </main>
    <?php PrintFooter();?>
    <?php PrintScript();?>

    <script>
        function addToCart(productId) {
            // You can implement your cart functionality here
            console.log("Producto añadido al carrito: " + productId);
            // Example: Show a toast notification
            alert("¡Producto añadido al carrito!");
            // In a real implementation, you'd use AJAX to add the product to the cart
        }

        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtn = document.querySelector('.ft_category_button');
            const dropdownMenu = document.querySelector('.ft_dropdown_menu');
            
            if (dropdownBtn && dropdownMenu) {
                dropdownBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    dropdownMenu.classList.toggle('show');
                });
            
                document.addEventListener('click', function(e) {
                    if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.classList.remove('show');
                    }
                });
            }
        });
    </script>

</body>

</html>
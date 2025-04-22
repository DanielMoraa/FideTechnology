<?php 
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/ProductosController.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";

    if (isset($_GET['id'])) {
        $idProducto = intval($_GET['id']); 
        $producto = ConsultarProductoPorId($idProducto); 

        if (!$producto) {
            echo "<h2>Producto no encontrado.</h2>";
            exit;
        }

        // Obtener nombre de la categoría si existe
        $nombreCategoria = isset($producto['IdCategoria']) ? ObtenerNombreCategoria($producto['IdCategoria']) : "Todas las categorías";
    } else {
        echo "<h2>ID de producto no especificado.</h2>";
        exit;
    }

    $categorias = ConsultarCategorias();
    $colores = ObtenerColoresProducto($idProducto);
    $colorActivo = $colores[0] ?? null;
?>


<!DOCTYPE html>
<html>

<head>
    <?php PrintCss(); ?>
    <link rel="stylesheet" href="../assets/css/detalleProductos.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <meta name="robots" content="noindex,follow" />
</head>

<head>
    <?php PrintCss(); ?>
    <link rel="stylesheet" href="../assets/css/detalleProductos.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <meta name="robots" content="noindex,follow" />
</head>

<body>
<?php PrintNavBar(); ?>
    <div class="producto-container">
        <div class="producto-breadcrumb">
            <a href="../Home/home.php">Inicio</a> /
            <a href="../Productos/consultarProducto.php?categoria=<?= $producto['IdCategoria'] ?>"><?= htmlspecialchars($nombreCategoria) ?></a> /
            <span><?= htmlspecialchars($producto['Nombre']) ?></span>
        </div>
        
        <main class="producto-main">
            <!-- Left Column / Product Gallery -->
            <div class="producto-gallery">
                <div class="producto-gallery-main">
                    <?php foreach ($colores as $index => $color): ?>
                    <img 
                        data-image="<?= htmlspecialchars($color['Color']) ?>" 
                        src="<?= htmlspecialchars($color['Imagen']) ?>" 
                        alt="<?= htmlspecialchars($producto['Nombre']) ?> <?= htmlspecialchars($color['Color']) ?>" 
                        class="<?= $index === 0 ? 'active' : '' ?>"
                    >
                    <?php endforeach; ?>
                </div>

                <div class="producto-thumbnails">
                    <?php foreach ($colores as $index => $color): ?>
                    <div class="producto-thumbnail <?= $index === 0 ? 'active' : '' ?>" data-image="<?= htmlspecialchars($color['Color']) ?>">
                        <img 
                            src="<?= htmlspecialchars($color['Imagen']) ?>" 
                            alt="<?= htmlspecialchars($producto['Nombre']) ?> <?= htmlspecialchars($color['Color']) ?>"
                        >
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Right Column / Product Details -->
            <div class="producto-details">
                <div class="producto-header">
                    <?php if (isset($producto['EnOferta']) && $producto['EnOferta']): ?>
                    <span class="producto-badge">Oferta</span>
                    <?php endif; ?>

                    <h1 class="producto-title"><?= htmlspecialchars($producto['Nombre']) ?></h1>

                    <div class="producto-rating">
                        <div class="producto-stars">★★★★★</div>
                        <div class="producto-rating-count">(4.4) 159 opiniones</div>
                    </div>
                </div>

                <div class="producto-price-container">
                    <span class="producto-price"><?= number_format($producto['Precio'], 0) ?>$</span>
                    <?php if (isset($producto['PrecioRegular']) && $producto['PrecioRegular'] > $producto['Precio']): ?>
                    <span class="producto-price-regular"><?= number_format($producto['PrecioRegular'], 0) ?>$</span>
                    <?php endif; ?>
                </div>

                <div class="producto-description">
                    <h3>Descripción</h3>
                    <p><?= htmlspecialchars($producto['Descripcion']) ?></p>
                </div>

                <div class="producto-status">
                    <span class="producto-status-label">Disponible</span>
                    <span class="producto-status-shipping">Envío Gratis</span>
                </div>

                <?php if (isset($producto['RegaloAdicional']) && $producto['RegaloAdicional']): ?>
                <div class="producto-gift-card">
                    Gift Card por <?= number_format($producto['ValorRegalo'], 0) ?>$ aplicable a esta misma compra
                </div>
                <?php endif; ?>

                <!-- Color Configuration -->
                <div class="producto-color-options">
                    <span class="producto-color-title">Color: <strong id="selected-color"><?= htmlspecialchars($colorActivo['Color']) ?></strong></span>
                    <div class="producto-color-selector">
                        <?php foreach ($colores as $index => $color): ?>
                        <div class="producto-color-option <?= $index === 0 ? 'active' : '' ?>" data-image="<?= htmlspecialchars($color['Color']) ?>">
                            <img 
                                src="<?= htmlspecialchars($color['Imagen']) ?>" 
                                alt="<?= htmlspecialchars($color['Color']) ?>"
                            >
                            <span><?= htmlspecialchars($color['Color']) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="producto-quantity">
                    <label for="quantity">Cantidad:</label>
                    <select id="quantity">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

            <form id="add-to-cart-form" method="post" action="../Carrito/agregarCarrito.php">
                <input type="hidden" name="id_producto" value="<?= $producto['Id'] ?>">
                <input type="hidden" name="color" id="form-color" value="<?= htmlspecialchars($colorActivo['Color']) ?>">
                <input type="hidden" name="cantidad" id="form-quantity" value="1">
                <input type="hidden" name="agregar_carrito" value="1"> <!-- Campo crucial para identificar la acción -->
                
                <button type="submit" class="producto-add-to-cart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    Agregar al Carrito
                </button>
            </form>
        

            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Click en miniatura o color
            $('.producto-thumbnail, .producto-color-option').on('click', function() {
                const color = $(this).attr('data-image');
                
                // Actualizar imagen principal
                $('.producto-gallery-main img').removeClass('active');
                $('.producto-gallery-main img[data-image="' + color + '"]').addClass('active');
                
                // Actualizar miniatura activa
                $('.producto-thumbnail').removeClass('active');
                $('.producto-thumbnail[data-image="' + color + '"]').addClass('active');
                
                // Actualizar color seleccionado
                $('.producto-color-option').removeClass('active');
                $('.producto-color-option[data-image="' + color + '"]').addClass('active');
                
                // Actualizar texto del color seleccionado
                $('#selected-color').text(color);
            });
        });
    </script>
    <?php PrintScript(); ?>
    <?php PrintFooter(); ?>
    <script>
$(document).ready(function() {
    // Manejar cambio de color
    $('.producto-thumbnail, .producto-color-option').on('click', function() {
        const color = $(this).attr('data-image');
        
        // Actualizar imagen principal
        $('.producto-gallery-main img').removeClass('active');
        $('.producto-gallery-main img[data-image="' + color + '"]').addClass('active');
        
        // Actualizar miniatura activa
        $('.producto-thumbnail').removeClass('active');
        $('.producto-thumbnail[data-image="' + color + '"]').addClass('active');
        
        // Actualizar color seleccionado
        $('.producto-color-option').removeClass('active');
        $('.producto-color-option[data-image="' + color + '"]').addClass('active');
        
        // Actualizar texto del color seleccionado
        $('#selected-color').text(color);
        
        // Actualizar valor del color en el formulario
        $('#form-color').val(color);
    });

    // Manejar cambio de cantidad
    $('#quantity').on('change', function() {
        $('#form-quantity').val($(this).val());
    });

    // Manejar envío del formulario con AJAX
    $('#add-to-cart-form').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Mostrar notificación de éxito
                    alert('Producto agregado al carrito');
                    
                    // Actualizar contador del carrito
                    if (response.conteo !== undefined) {
                        $('.carrito-counter').text(response.conteo).show();
                    }
                    
                    // Si es usuario invitado, actualizar carrito local
                    if (response.guest) {
                        // Aquí puedes agregar lógica para el carrito local si es necesario
                    }
                } else {
                    alert(response.message || 'Error al agregar al carrito');
                }
            },
        });
    });
});
</script>
</body>

</html>
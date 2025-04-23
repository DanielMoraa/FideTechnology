<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/ProductosController.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/CarritoController.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";

// 1. GESTIÓN DE SESIÓN
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['IdUsuario'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_carrito'])) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Sesión expirada. Por favor inicia sesión nuevamente.'
        ]);
        exit;
    } else {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header("Location: ../Login/login.php");
        exit;
    }
}

$idUsuario = $_SESSION['IdUsuario'];

// 2. OBTENER CONTENIDO DEL CARRITO
$productosCarrito = ObtenerCarrito($idUsuario);

// 3. ACTUALIZAR CONTADOR EN SESIÓN
$_SESSION['carrito_count'] = ObtenerConteoCarrito($idUsuario);

// 4. CÁLCULO DE TOTALES
$subtotal = 0;
$cantidadTotal = 0;
$itemsCarrito = [];

if (!empty($productosCarrito)) {
    foreach ($productosCarrito as $producto) {
        $subtotal += $producto['Precio'] * $producto['Cantidad'];
        $cantidadTotal += $producto['Cantidad'];
        $itemsCarrito[] = $producto;
    }
}

$costoEnvio = ($subtotal > 50000) ? 0 : 2500;
$total = $subtotal + $costoEnvio;
?>
<!DOCTYPE html>
<html lang="es">
    <?php PrintCss(); ?>
<body>
    <?php PrintNavBar(); ?>
    
    <div class="fide1-carrito-container">
        <div class="fide1-carrito-breadcrumb">
            <a href="../Home/home.php">Inicio</a> / <span>Carrito</span>
        </div>
        
        <h1 class="fide1-carrito-title">Mi Carrito de Compras</h1>
        
        <?php if (empty($itemsCarrito)): ?>
            <div class="fide1-carrito-empty">
                <p>Tu carrito está vacío</p>
                <a href="../Productos/consultarProducto.php" class="fide1-btn">Seguir comprando</a>
            </div>
        <?php else: ?>
            <div class="fide1-carrito-content">
                <div class="fide1-carrito-items">
                    <?php foreach ($itemsCarrito as $producto): ?>
                        <div class="fide1-carrito-item" data-id="<?= htmlspecialchars($producto['Id']) ?>" data-color="<?= htmlspecialchars($producto['Color']) ?>">
    <div class="fide1-carrito-item-image">
        <img src="<?= htmlspecialchars($producto['Imagen']) ?>" alt="<?= htmlspecialchars($producto['Nombre']) ?>">
    </div>
    <div class="fide1-carrito-item-details">
        <h3><?= htmlspecialchars($producto['Nombre']) ?></h3>
        <p class="fide1-carrito-item-color">Color: <?= htmlspecialchars($producto['Color']) ?></p>
        <div class="fide1-carrito-item-price">
            <span>₡<?= number_format($producto['Precio'], 3, ',', '.') ?></span>
        </div>
        <div class="fide1-carrito-item-quantity">
            <label>Cantidad:</label>
            <div class="fide1-quantity-control">
                <button class="fide1-quantity-btn decrement" data-id="<?= $producto['Id'] ?>" data-color="<?= htmlspecialchars($producto['Color']) ?>">−</button>
                <input type="text" value="<?= $producto['Cantidad'] ?>" class="fide1-quantity-input" data-id="<?= $producto['Id'] ?>" data-color="<?= htmlspecialchars($producto['Color']) ?>" readonly>
                <button class="fide1-quantity-btn increment" data-id="<?= $producto['Id'] ?>" data-color="<?= htmlspecialchars($producto['Color']) ?>">+</button>
            </div>
        </div>
    </div>
    <div class="fide1-carrito-item-actions">
        <button class="fide1-remove-item remove-item" 
                data-id="<?= htmlspecialchars($producto['Id']) ?>" 
                data-color="<?= htmlspecialchars($producto['Color']) ?>">
            Eliminar
        </button>
    </div>
</div>
                    <?php endforeach; ?>
                </div>
                
                <div class="fide1-carrito-summary">
                    <div class="fide1-summary-box">
                        <h3>Resumen de la Orden</h3>
                        <div class="fide1-summary-row">
                            <span>Subtotal:</span>
                            <span>₡<?= number_format($subtotal, 3, ',', '.') ?></span>
                        </div>
                        <div class="fide1-summary-row">
                            <span>Envío:</span>
                            <span>₡<?= number_format($costoEnvio, 3, ',', '.') ?></span>
                        </div>
                        <div class="fide1-summary-total">
                            <span>Total:</span>
                            <span>₡<?= number_format($total, 3, ',', '.') ?></span>
                        </div>
                        <button class="fide1-btn-checkout">Proceder al pago</button>
                    </div>
                    
                    <div class="fide1-carrito-beneficios">
                        <div class="fide1-beneficio">
                            <div class="fide1-beneficio-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="fide1-beneficio-text">
                                <h4>Envío gratis</h4>
                                <p>En compras superiores a $20.000</p>
                            </div>
                        </div>
                        <div class="fide1-beneficio">
                            <div class="fide1-beneficio-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="fide1-beneficio-text">
                                <h4>Compra segura</h4>
                                <p>Protegemos tus datos personales</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="fide1-carrito-help">
            <h3>¿Necesitas ayuda?</h3>
            <p>Contáctanos a través de nuestras plataformas:</p>
            <div class="fide1-contact-options">
                <a href="mailto:soporte@fidetechnology.com" class="fide1-contact-option">
                    <i class="fas fa-envelope"></i>
                    <span>Email</span>
                </a>
                <a href="tel:+573001234567" class="fide1-contact-option">
                    <i class="fas fa-phone"></i>
                    <span>Teléfono</span>
                </a>
                <a href="https://wa.me/573001234567" class="fide1-contact-option">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
    
    <?php PrintFooter(); ?>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php PrintScript(); ?>
    
    <script>
    $(document).ready(function() {
        const carrito_count = <?= json_encode($_SESSION['carrito_count'] ?? 0) ?>;
        if (carrito_count > 0) {
            $('.carrito-counter').text(carrito_count).show();
        }
    });
    </script>
</body>
</html>
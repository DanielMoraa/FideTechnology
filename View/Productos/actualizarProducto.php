<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/ProductosController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID de producto no válido.'); window.location.href = 'consultarProductos.php';</script>";
    exit();
}

$id = intval($_GET['id']);
$producto = ObtenerProductoPorId($id);

if (!$producto) {
    echo "<script>alert('Producto no encontrado.'); window.location.href = 'consultarProductos.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $imagen = $_POST["imagen"];
    $disponibilidad = isset($_POST["disponibilidad"]) ? 1 : 0;

    $exito = ActualizarProducto($id, $nombre, $descripcion, $precio, $imagen, $disponibilidad);

    if ($exito) {
        header("Location: consultarProductos.php?mensaje=actualizado");
        exit();
    } else {
        echo "<script>alert('Error al actualizar el producto');</script>";
    }
}
?>

<?php PrintCss(); ?>
<body>
<?php PrintNavBar(); ?>
<div class="container mt-5">
    <h2>Actualizar Producto</h2>
    <form method="post">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($producto['Nombre']) ?>" required>
        </div>
        <div class="form-group">
            <label>Descripción:</label>
            <input type="text" name="descripcion" class="form-control" value="<?= htmlspecialchars($producto['Descripcion']) ?>" required>
        </div>
        <div class="form-group">
            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" class="form-control" value="<?= $producto['Precio'] ?>" required>
        </div>
        <div class="form-group">
            <label>Imagen (URL):</label>
            <input type="text" name="imagen" class="form-control" value="<?= htmlspecialchars($producto['Imagen']) ?>" required>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="disponibilidad" class="form-check-input" <?= $producto['Disponibilidad'] ? 'checked' : '' ?>>
            <label class="form-check-label">Disponible</label>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
    </form>
</div>
</body>
</html>

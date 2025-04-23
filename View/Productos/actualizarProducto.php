<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/ProductosController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID de producto no válido.'); window.location.href = 'consultarProducto.php';</script>";
    exit();
}

$id = intval($_GET['id']);
$producto = ObtenerProductoPorId($id);
$categorias = ConsultarCategorias();

if (!$producto) {
    echo "<script>alert('Producto no encontrado.'); window.location.href = 'consultarProducto.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["txtNombre"];
    $descripcion = $_POST["txtDescripcion"];
    $precio = $_POST["txtPrecio"];
    $imagen = $_FILES["txtImagen"]["name"] ?: $producto['Imagen'];
    $disponibilidad = isset($_POST["txtDisponibilidad"]) ? 1 : 0;
    $idCategoria = $_POST["txtCategoria"];

    if ($_FILES["txtImagen"]["name"]) {
        $rutaDestino = $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Assets/img/" . basename($imagen);
        move_uploaded_file($_FILES["txtImagen"]["tmp_name"], $rutaDestino);
    }

    $exito = ActualizarProductos($id, $nombre, $descripcion, $precio, $imagen, $disponibilidad, $idCategoria);

    if ($exito) {
        header("Location: consultarProducto.php?mensaje=actualizado");
        exit();
    } else {
        echo "<script>alert('Error al actualizar el producto');</script>";
    }
}
?>

<?php PrintCss(); ?>
<body>
    <?php PrintNavBar(); ?>

    <div class="container mt-5 fide-product-container">
        <h2 class="fide-product-title">Actualizar Producto</h2>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="fide-form-group">
                <label for="txtNombre" class="fide-form-label">Nombre del producto</label>
                <input type="text" name="txtNombre" id="txtNombre" class="fide-form-control" value="<?= htmlspecialchars($producto['Nombre']) ?>" required>
            </div>

            <div class="fide-form-group">
                <label for="txtDescripcion" class="fide-form-label">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="fide-form-control fide-textarea" required><?= htmlspecialchars($producto['Descripcion']) ?></textarea>
            </div>

            <div class="fide-form-group">
                <label for="txtPrecio" class="fide-form-label">Precio</label>
                <input type="number" step="0.03" name="txtPrecio" id="txtPrecio" class="fide-form-control" value="<?= $producto['Precio'] ?>" required>
            </div>

            <div class="fide-form-group">
                <label for="txtImagen" class="fide-form-label">Imagen del producto</label>
                <input type="file" class="fide-form-control fide-file-input" name="txtImagen" id="txtImagen" accept="image/png, image/jpg, image/jpeg">
                <small class="text-muted">Actual: <?= htmlspecialchars($producto['Imagen']) ?> — solo selecciona si deseas cambiarla.</small>
            </div>

            <div class="fide-form-group">
                <label class="fide-form-label">Disponibilidad</label>
                <div class="fide-checkbox-group">
                    <input type="hidden" name="txtDisponibilidad" value="0">
                    <input type="checkbox" name="txtDisponibilidad" id="txtDisponibilidad" class="fide-checkbox" value="1" <?= $producto['Disponibilidad'] ? 'checked' : '' ?>>
                    <label for="txtDisponibilidad">En stock</label>
                </div>
            </div>

            <div class="fide-form-group">
                <label for="txtCategoria" class="fide-form-label">Categoría</label>
                <select name="txtCategoria" id="txtCategoria" class="fide-form-control" required>
                    <option value="">Seleccione una categoría...</option>
                    <?php while ($categoria = $categorias->fetch_assoc()): ?>
                        <option value="<?= $categoria['Id'] ?>" <?= $producto['IdCategoria'] == $categoria['Id'] ? 'selected' : '' ?>>
                            <?= $categoria['Nombre'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="fide-form-group mt-100">
                <button type="submit" class="fide-btn-submit" id="btnActualizarProducto" name="btnActualizarProducto">
                    <i class="fas fa-save mr-2"></i> Actualizar Producto
                </button>
            </div>
        </form>
    </div>

    <?php PrintFooter(); ?>
    <?php PrintScript(); ?>
</body>
</html>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/ProductosController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";

$categorias = ConsultarCategorias();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = floatval($_POST["precio"]);
    $imagen = $_POST["imagen"];
    $disponibilidad = isset($_POST["disponibilidad"]) ? 1 : 0;
    $idCategoria = intval($_POST["id_categoria"]);

    if (AgregarProducto($nombre, $descripcion, $precio, $imagen, $disponibilidad, $idCategoria)) {
        $mensaje = "Producto agregado correctamente.";
    } else {
        $mensaje = "Error al agregar el producto.";
    }
}
?>

<?php PrintCss(); ?>
<body>
<?php PrintNavBar(); ?>
<div class="container mt-5">
    <h2>Agregar Producto</h2>
    <?php if ($mensaje): ?>
        <div class="alert alert-info"><?php echo $mensaje; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" required>
        </div>
        <div class="form-group">
            <label>URL de Imagen</label>
            <input type="text" name="imagen" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Disponibilidad</label><br>
            <input type="checkbox" name="disponibilidad" checked> En stock
        </div>
        <div class="form-group">
            <label>Categoría</label>
            <select name="id_categoria" class="form-control" required>
                <option value="">Seleccione...</option>
                <?php while ($categoria = $categorias->fetch_assoc()): ?>
                    <option value="<?= $categoria['Id'] ?>"><?= $categoria['Nombre'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </form>
</div>
<?php PrintFooter(); ?>
<?php PrintScript(); ?>
</body>
</html>

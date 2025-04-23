<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/ProductosController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";

$categorias = ConsultarCategorias();
?>

<?php PrintCss(); ?>
<body>
    <?php PrintNavBar(); ?>
    
    <div class="container mt-5 fide-product-container">
        <h2 class="fide-product-title">Agregar Producto</h2>
        
        <?php if(isset($_POST["Message"])) { 
            echo '<div class="fide-alert">' . $_POST["Message"] . '</div>'; 
        } ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="fide-form-group">
                <label for="txtNombre" class="fide-form-label">Nombre del producto</label>
                <input type="text" name="txtNombre" id="txtNombre" class="fide-form-control" placeholder="Ingrese nombre del producto" required>
            </div>
            
            <div class="fide-form-group">
                <label for="txtDescripcion" class="fide-form-label">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="fide-form-control fide-textarea" placeholder="Ingrese la descripción del producto" required></textarea>
            </div>
            
            <div class="fide-form-group">
                <label for="txtPrecio" class="fide-form-label">Precio</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="number" step="0.01" name="txtPrecio" id="txtPrecio" class="fide-form-control" placeholder="$0.000" required>
                </div>
            </div>
            
            <div class="fide-form-group">
                <label for="txtImagen" class="fide-form-label">Imagen del producto</label>
                <input type="file" class="fide-form-control fide-file-input" name="txtImagen" id="txtImagen" required accept="image/png, image/jpg, image/jpeg">
                <small class="text-muted">Formatos aceptados: PNG, JPG, JPEG</small>
            </div>
            
            <div class="fide-form-group">
                <label class="fide-form-label">Disponibilidad</label>
                <div class="fide-checkbox-group">
                    <input type="hidden" name="txtDisponibilidad" value="0">
                    <input type="checkbox" name="txtDisponibilidad" id="txtDisponibilidad" class="fide-checkbox" value="1" checked>
                    <label for="txtDisponibilidad">En stock</label>
                </div>
            </div>
            
            <div class="fide-form-group">
                <label for="txtCategoria" class="fide-form-label">Categoría</label>
                <select name="txtCategoria" id="txtCategoria" class="fide-form-control" required>
                    <option value="">Seleccione una categoría...</option>
                    <?php while ($categoria = $categorias->fetch_assoc()): ?>
                        <option value="<?= $categoria['Id'] ?>"><?= $categoria['Nombre'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="fide-form-group mt-100">
                <button type="submit" class="fide-btn-submit" id="btnCrearProducto" name="btnCrearProducto">
                    <i class="fas fa-plus-circle mr-2"></i> Agregar Producto
                </button>
            </div>
        </form>
    </div>
    
    <?php PrintFooter(); ?>
    <?php PrintScript(); ?>
</body>
</html>

<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/Controller/ProductosController.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php PrintCss(); ?>
</head>

<body id="page-top">
    <?php PrintNavBar(); ?>
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid fide-container-fluid">
                    <h5 class="fide-page-title">Consulta de Productos Disponibles</h5>
                    
                    <div class="fide-card">
                        <div class="fide-card-header">
                            <div class="fide-filter-group">
                                <label class="fide-filter-label">Mostrar</label>
                                <select class="fide-filter-select">
                                    <option value="">-- registros</option>
                                    <option value="10">10 registros</option>
                                    <option value="25">25 registros</option>
                                    <option value="50">50 registros</option>
                                    <option value="100">100 registros</option>
                                </select>
                            </div>
                            
                            <a href="agregarProducto.php" class="fide-btn fide-btn-primary fide-add-btn">
                                <i class="fa fa-plus"></i> Agregar
                            </a>
                        </div>
                        
                        <div class="fide-search-wrapper">
                            <label class="fide-search-label">Buscar:</label>
                            <input type="text" class="fide-search-input" placeholder="Ingrese texto para buscar...">
                        </div>
                        
                        <?php
                            if(isset($_POST["Message"])) {
                                echo '<div class="fide-alert fide-alert-warning"><i class="fas fa-exclamation-triangle fide-alert-icon"></i>' . $_POST["Message"] . '</div>';                                   
                            }
                        ?>
                        
                        <div class="fide-table-container">
                            <table id="example" class="table fide-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>PRODUCTO</th>
                                        <th>PRECIO</th>
                                        <th>DISPONIBILIDAD</th>
                                        <th>CATEGORÍA</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $datos = ConsultarProductosTodosModel();

                                        while($row = mysqli_fetch_array($datos)) {
                                            echo "<tr>";
                                            echo "<td>" . $row["IdProducto"] . "</td>";
                                            echo "<td>" . $row["NombreProducto"] . "</td>";
                                            echo "<td class='fide-price'>₡ " . number_format($row["Precio"], 3) . "</td>";
                                            
                                            $statusClass = $row["Disponibilidad"] == 1 ? "fide-status-available" : "fide-status-unavailable";
                                            $statusText = $row["Disponibilidad"] == 1 ? "En stock" : "Agotado";
                                            echo "<td><span class='fide-status {$statusClass}'>{$statusText}</span></td>";
                                            
                                            echo "<td>" . $row["NombreCategoria"] . "</td>";
                                            echo "<td><a href='actualizarProducto.php?id=" . $row["IdProducto"] . "' class='fide-action-btn'><i class='fas fa-edit' style='color: #0008ff;'></i></a></td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="fide-record-count">
                            Mostrando 1 a 8 de 8 registros
                        </div>
                        
                        <ul class="fide-pagination">
                            <li class="fide-pagination-item"><a class="fide-pagination-link" href="#">Primero</a></li>
                            <li class="fide-pagination-item"><a class="fide-pagination-link" href="#">Anterior</a></li>
                            <li class="fide-pagination-item fide-pagination-active"><a class="fide-pagination-link" href="#">1</a></li>
                            <li class="fide-pagination-item"><a class="fide-pagination-link" href="#">Siguiente</a></li>
                            <li class="fide-pagination-item"><a class="fide-pagination-link" href="#">Último</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php PrintFooter(); ?>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>       

    <?php PrintScript(); ?>

    <script>
    $(document).ready(function() {
    // Inicializar DataTable con opciones personalizadas
    var table = $('#example').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json',
        },
        columnDefs: [
            { targets: "_all", className: "dt-left" }
        ],
        // Disable built-in search and length controls completely
        searching: true,
        lengthChange: false,
        // Use custom DOM layout without f (filter) and l (length) elements
        dom: '<"fide-dataTables_wrapper"rt<"fide-pagination-row"<"fide-info"i><"fide-pagination"p>>>',
        initComplete: function() {
            var api = this.api();
            
            // Connect custom search box to DataTable
            $('.fide-search-input').on('keyup', function() {
                api.search(this.value).draw();
            });
            
            // Connect custom length dropdown to DataTable
            $('.fide-filter-select').on('change', function() {
                var val = $(this).val();
                if (val) {
                    api.page.len(parseInt(val)).draw();
                }
            });
        }
    });
    
    // Hide DataTables default controls - make sure to add !important if needed
    $('.dataTables_filter, .dataTables_length').css('display', 'none');
});
    </script>
</body>
</html>
// Archivo: assets/js/productos.js

document.addEventListener('DOMContentLoaded', function() {
    // Autoenvío del formulario al escribir en el buscador
    const searchInput = document.querySelector('.ft_search_input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            // Esperar 500ms después de que el usuario deje de escribir
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                // Solo enviar si hay al menos 3 caracteres o si está vacío
                if (this.value.length >= 3 || this.value.length === 0) {
                    document.getElementById('searchForm').submit();
                }
            }, 500);
        });
    }
    
    // Abrir/cerrar el menú desplegable de categorías
    const categoryBtn = document.getElementById('categoryDropdown');
    const categoryMenu = document.getElementById('categoryMenu');
    
    if (categoryBtn && categoryMenu) {
        categoryBtn.addEventListener('click', function(e) {
            e.preventDefault();
            categoryMenu.classList.toggle('show');
        });
        
        // Cerrar el menú cuando se hace clic fuera
        document.addEventListener('click', function(e) {
            if (!categoryBtn.contains(e.target) && !categoryMenu.contains(e.target)) {
                categoryMenu.classList.remove('show');
            }
        });
    }
    
    // Función para añadir al carrito (se implementará en un archivo separado)
    window.addToCart = function(productId) {
        // Implementar función para añadir al carrito con AJAX
        fetch('ajax/agregar_carrito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'producto_id=' + productId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarNotificacion('Producto añadido al carrito', 'success');
                
                // Actualizar contador del carrito si existe
                const cartCounter = document.querySelector('.cart_count');
                if (cartCounter) {
                    cartCounter.textContent = data.cartCount;
                }
            } else {
                mostrarNotificacion(data.message || 'Error al añadir el producto', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarNotificacion('Error de conexión', 'error');
        });
    };
    
    // Función para mostrar notificaciones
    function mostrarNotificacion(mensaje, tipo) {
        const notificacion = document.createElement('div');
        notificacion.className = 'ft_notification ' + tipo;
        notificacion.textContent = mensaje;
        
        document.body.appendChild(notificacion);
        
        // Animar entrada
        setTimeout(() => {
            notificacion.style.transform = 'translateY(0)';
            notificacion.style.opacity = '1';
        }, 10);
        
        // Eliminar después de 3 segundos
        setTimeout(() => {
            notificacion.style.transform = 'translateY(-20px)';
            notificacion.style.opacity = '0';
            setTimeout(() => {
                notificacion.remove();
            }, 300);
        }, 3000);
    }
    
    // Implementación de cargar más productos (necesitaría un endpoint AJAX)
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    let currentPage = 1;
    
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            currentPage++;
            
            // Obtener parámetros de la URL
            const urlParams = new URLSearchParams(window.location.search);
            const categoria = urlParams.get('categoria') || 0;
            const keyword = urlParams.get('keyword') || '';
            
            // Mostrar estado de carga
            loadMoreBtn.textContent = 'Cargando...';
            loadMoreBtn.disabled = true;
            
            // Solicitud AJAX
            fetch(`ajax/cargar_mas_consultarProducto.php?page=${currentPage}&categoria=${categoria}&keyword=${encodeURIComponent(keyword)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.productos && data.productos.length > 0) {
                        const productsGrid = document.querySelector('.ft_products_grid');
                        
                        // Añadir nuevos productos al grid
                        data.productos.forEach(producto => {
                            productsGrid.insertAdjacentHTML('beforeend', crearHtmlProducto(producto));
                        });
                        
                        // Restaurar estado del botón
                        loadMoreBtn.textContent = 'Cargar más productos';
                        loadMoreBtn.disabled = false;
                        
                        // Ocultar botón si no hay más productos
                        if (!data.hayMas) {
                            loadMoreBtn.style.display = 'none';
                        }
                    } else {
                        // No hay más productos
                        loadMoreBtn.textContent = 'No hay más productos';
                        setTimeout(() => {
                            loadMoreBtn.style.display = 'none';
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    loadMoreBtn.textContent = 'Error al cargar más productos';
                    setTimeout(() => {
                        loadMoreBtn.textContent = 'Intentar de nuevo';
                        loadMoreBtn.disabled = false;
                    }, 2000);
                });
        });
    }
    
    // Función para crear HTML de un producto
    function crearHtmlProducto(producto) {
        const disponibilidadBadge = producto.Disponibilidad ? 
            '<span class="ft_badge ft_in_stock">En stock</span>' : 
            '<span class="ft_badge ft_out_stock">Agotado</span>';
        
        return `
            <div class="ft_product_wrapper" data-category="${producto.IdCategoria}">
                <div class="ft_product_card">
                    <div class="ft_image_container">
                        <img src="${producto.Imagen}" alt="${producto.NombreProducto}" class="img-fluid">
                        <div class="ft_cart_button${!producto.Disponibilidad ? ' disabled' : ''}" 
                            ${producto.Disponibilidad ? `onclick="addToCart(${producto.IdProducto})"` : ''}>
                            <i class="fas fa-shopping-cart"></i> ${producto.Disponibilidad ? 'Añadir al carrito' : 'Agotado'}
                        </div>
                    </div>
                    <div class="ft_product_info">
                        <h3 class="ft_product_title">
                            <a href="producto.php?id=${producto.IdProducto}">${producto.NombreProducto}</a>
                        </h3>
                        <div class="ft_price_category">
                            <div class="ft_price_tag">₡${parseFloat(producto.Precio).toFixed(2)}</div>
                            <div class="ft_category_tag">${producto.NombreCategoria}</div>
                        </div>
                        ${disponibilidadBadge}
                    </div>
                </div>
            </div>
        `;
    }
});
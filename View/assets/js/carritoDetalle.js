$(document).ready(function() {
    // Manejar cambio de cantidad
    $('.fide1-carrito-items').on('click', '.increment, .decrement', function() {
        const $btn = $(this);
        const $input = $btn.siblings('.fide1-quantity-input');
        let quantity = parseInt($input.val());
        const productId = $btn.data('id');
        
        if ($btn.hasClass('increment')) {
            quantity += 1;
        } else if ($btn.hasClass('decrement') && quantity > 1) {
            quantity -= 1;
        }
        
        $input.val(quantity);
        updateQuantity(productId, quantity);
    });
    
    // Eliminar item del carrito
    $('.fide1-carrito-items').on('click', '.remove-item', function(e) {
        e.preventDefault();
        const $item = $(this).closest('.fide1-carrito-item');
        const productId = $(this).data('id');
        const color = $(this).data('color'); // Obtener color del data-attribute
        
        if (confirm('¿Eliminar este producto del carrito?')) {
            removeItem(productId, color, $item);
        }
    });
    
    // Función para actualizar cantidad
    function updateQuantity(productId, quantity) {
        // Obtener el color del producto directamente del DOM
        const $item = $(`.fide1-carrito-item[data-id="${productId}"]`);
        const color = $item.find('.fide1-carrito-item-color').text().replace('Color: ', '').trim();
        
        console.log("Actualizando producto:", productId, "Color:", color, "Cantidad:", quantity);
        
        $.ajax({
            url: '../Carrito/actualizarCantidadCarrito.php',
            type: 'POST',
            data: {
                id_producto: productId,
                cantidad: quantity,
                color: color,
                actualizar_cantidad: true
            },
            dataType: 'json',
            success: function(response) {
                console.log("Respuesta:", response);
                if (response.success) {
                    // Actualizar el contador del carrito en el navbar
                    if (response.conteo !== undefined) {
                        $('.carrito-counter').text(response.conteo).show();
                    }
                    updateTotals(response);
                } else {
                    alert(response.message || 'Error al actualizar');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", status, error);
                alert("Error al actualizar la cantidad. Por favor, inténtalo de nuevo.");
            }
        });
    }
    
    // Función para eliminar item
    function removeItem(productId, color, $item) {
        $.ajax({
            url: '../Carrito/eliminarDelCarrito.php',
            type: 'POST',
            data: {
                id_producto: productId,
                color: color,
                eliminar_carrito: true
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $item.fadeOut(300, function() {
                        $(this).remove();
                        updateTotals(response);
                        if (response.conteo === 0) location.reload();
                    });
                } else {
                    alert(response.message || 'Error al eliminar');
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", status, error);
                alert("Error al eliminar el producto. Por favor, inténtalo de nuevo.");
            }
        });
    }
    
    // Actualizar totales del carrito
    function updateTotals(data) {
        if (data.subtotal !== undefined) {
            $('.fide1-summary-row:eq(0) span:eq(1)').text('$' + formatNumber(data.subtotal));
            $('.fide1-summary-row:eq(1) span:eq(1)').text('$' + formatNumber(data.envio));
            $('.fide1-summary-total span:eq(1)').text('$' + formatNumber(data.total));
        }
        
        // Actualizar el contador del carrito en el navbar
        if (data.conteo !== undefined) {
            $('.carrito-counter').text(data.conteo);
            if (data.conteo > 0) {
                $('.carrito-counter').show();
            } else {
                $('.carrito-counter').hide();
            }
        }
    }
    
    // Formatear número con separadores de miles
    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
});
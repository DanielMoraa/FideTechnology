// assets/js/carrito.js
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar el carrito local si no existe
    if (!localStorage.getItem('carrito')) {
        localStorage.setItem('carrito', JSON.stringify([]));
    }
    
    // Sincronizar carrito si hay sesión activa
    sincronizarCarritoConServidor();
    
    // Actualizar contador del carrito al cargar la página
    actualizarContadorCarrito();
    
    // Configurar interceptor para formularios de carrito
    document.querySelectorAll('form[id="add-to-cart-form"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const idProducto = formData.get('id_producto');
            const color = formData.get('color');
            const cantidad = parseInt(formData.get('cantidad') || '1');
            
            // Guardar en localStorage primero
            agregarAlCarritoLocal(idProducto, color, cantidad);
            
            // También intentar guardar en el servidor
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (!data.guest) {
                        // Si es un usuario autenticado, usamos el conteo del servidor
                        actualizarContadorCarrito(data.conteo);
                    } else {
                        // Para usuarios invitados, usamos el conteo local
                        actualizarContadorDesdeLocalStorage();
                    }
                    mostrarNotificacion('Producto agregado al carrito');
                } else {
                    mostrarNotificacion(data.message, 'error');
                }
            })
            .catch(error => {
                // Si hay error de conexión, al menos tenemos el producto en localStorage
                actualizarContadorDesdeLocalStorage();
                mostrarNotificacion('Producto guardado en carrito local', 'warning');
            });
        });
    });
});

// Función para agregar un producto al carrito local
function agregarAlCarritoLocal(idProducto, color, cantidad) {
    const carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
    
    // Buscar si ya existe el producto en el carrito
    const existente = carrito.findIndex(item => 
        item.id_producto == idProducto && item.color === color
    );
    
    if (existente >= 0) {
        // Si existe, incrementar la cantidad
        carrito[existente].cantidad += cantidad;
    } else {
        // Si no existe, agregar nuevo item
        carrito.push({
            id_producto: idProducto,
            color: color,
            cantidad: cantidad
        });
    }
    
    // Guardar carrito actualizado
    localStorage.setItem('carrito', JSON.stringify(carrito));
    return carrito.length;
}

// Función para sincronizar carrito local con el servidor al iniciar sesión
function sincronizarCarritoConServidor() {
    // Verificar si hay una sesión activa consultando el contador del servidor
    fetch('../Carrito/obtenerConteoCarrito.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Si hay una sesión activa y tenemos items locales, sincronizar
                const carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
                if (carrito.length > 0) {
                    const formData = new FormData();
                    formData.append('carrito_local', JSON.stringify(carrito));
                    
                    fetch('../Carrito/sincronizarCarrito.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(carrito)
                    })
                    .then(response => response.json())
                    .then(resultado => {
                        if (resultado.success) {
                            // Limpiar carrito local después de sincronizar exitosamente
                            localStorage.setItem('carrito', JSON.stringify([]));
                            actualizarContadorCarrito(resultado.conteo);
                        }
                    });
                } else {
                    // No hay carrito local, usar contador del servidor
                    actualizarContadorCarrito(data.conteo);
                }
            } else {
                // No hay sesión, usar contador local
                actualizarContadorDesdeLocalStorage();
            }
        })
        .catch(error => {
            // Error de conexión, usar contador local
            actualizarContadorDesdeLocalStorage();
        });
}

function actualizarContadorDesdeLocalStorage() {
    const carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
    const conteo = carrito.reduce((sum, item) => sum + item.cantidad, 0);
    
    document.querySelectorAll('.carrito-counter').forEach(el => {
        el.textContent = conteo;
        el.style.display = conteo > 0 ? 'inline-block' : 'none';
    });
    
    return conteo;
}

function actualizarContadorCarrito(conteo = null) {
    if (conteo !== null) {
        // Actualizar desde parámetro
        document.querySelectorAll('.carrito-counter').forEach(el => {
            el.textContent = conteo;
            el.style.display = conteo > 0 ? 'inline-block' : 'none';
        });
        return;
    }
    
    // Obtener conteo del servidor
    fetch('../Carrito/obtenerConteoCarrito.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelectorAll('.carrito-counter').forEach(el => {
                    el.textContent = data.conteo;
                    el.style.display = data.conteo > 0 ? 'inline-block' : 'none';
                });
            } else {
                // Si no hay sesión, usar contador local
                actualizarContadorDesdeLocalStorage();
            }
        })
        .catch(() => {
            // Error de conexión, usar contador local
            actualizarContadorDesdeLocalStorage();
        });
}

function mostrarNotificacion(mensaje, tipo = 'success') {
    const notificacion = document.createElement('div');
    notificacion.className = `notificacion ${tipo}`;
    notificacion.textContent = mensaje;
    
    document.body.appendChild(notificacion);
    
    setTimeout(() => {
        notificacion.classList.add('mostrar');
    }, 10);
    
    setTimeout(() => {
        notificacion.classList.remove('mostrar');
        setTimeout(() => {
            document.body.removeChild(notificacion);
        }, 300);
    }, 3000);
}

// Función para eliminar producto del carrito local
function eliminarDelCarritoLocal(idProducto, color) {
    const carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
    
    const nuevoCarrito = carrito.filter(item => 
        !(item.id_producto == idProducto && item.color === color)
    );
    
    localStorage.setItem('carrito', JSON.stringify(nuevoCarrito));
    return nuevoCarrito.length;
}
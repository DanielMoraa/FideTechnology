document.addEventListener('DOMContentLoaded', function() {
    if (!localStorage.getItem('carrito')) {
        localStorage.setItem('carrito', JSON.stringify([]));
    }
    
    sincronizarCarritoConServidor();
    
    actualizarContadorCarrito();
    
    document.querySelectorAll('form[id="add-to-cart-form"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const idProducto = formData.get('id_producto');
            const color = formData.get('color');
            const cantidad = parseInt(formData.get('cantidad') || '1');
            
            agregarAlCarritoLocal(idProducto, color, cantidad);
            
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (!data.guest) {
                        actualizarContadorCarrito(data.conteo);
                    } else {
                        actualizarContadorDesdeLocalStorage();
                    }
                    mostrarNotificacion('Producto agregado al carrito');
                } else {
                    mostrarNotificacion(data.message, 'error');
                }
            })
            .catch(error => {
                actualizarContadorDesdeLocalStorage();
                mostrarNotificacion('Producto guardado en carrito local', 'warning');
            });
        });
    });
});

function agregarAlCarritoLocal(idProducto, color, cantidad) {
    const carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
    
    const existente = carrito.findIndex(item => 
        item.id_producto == idProducto && item.color === color
    );
    
    if (existente >= 0) {
        carrito[existente].cantidad += cantidad;
    } else {
        carrito.push({
            id_producto: idProducto,
            color: color,
            cantidad: cantidad
        });
    }
    
    localStorage.setItem('carrito', JSON.stringify(carrito));
    return carrito.length;
}


function sincronizarCarritoConServidor() {
    fetch('../Carrito/obtenerConteoCarrito.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
                if (carrito.length > 0 && !sessionStorage.getItem('carrito_sincronizado')) {
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
                            localStorage.setItem('carrito', JSON.stringify([]));
                            sessionStorage.setItem('carrito_sincronizado', 'true');
                            actualizarContadorCarrito(resultado.conteo);
                        }
                    });
                } else {
                    actualizarContadorCarrito(data.conteo);
                }
            } else {
                actualizarContadorDesdeLocalStorage();
            }
        })
        .catch(error => {
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
        document.querySelectorAll('.carrito-counter').forEach(el => {
            el.textContent = conteo;
            el.style.display = conteo > 0 ? 'inline-block' : 'none';
        });
        return;
    }
    
    fetch('../Carrito/obtenerConteoCarrito.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelectorAll('.carrito-counter').forEach(el => {
                    el.textContent = data.conteo;
                    el.style.display = data.conteo > 0 ? 'inline-block' : 'none';
                });
            } else {
                actualizarContadorDesdeLocalStorage();
            }
        })
        .catch(() => {
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

function eliminarDelCarritoLocal(idProducto, color) {
    const carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
    
    const nuevoCarrito = carrito.filter(item => 
        !(item.id_producto == idProducto && item.color === color)
    );
    
    localStorage.setItem('carrito', JSON.stringify(nuevoCarrito));
    return nuevoCarrito.length;
}
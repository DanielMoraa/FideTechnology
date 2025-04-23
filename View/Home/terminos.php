<?php
        include_once $_SERVER["DOCUMENT_ROOT"] . "/FideTechnology/View/layoutInterno.php";
?>
<!doctype html>
<html lang="en">
<?php PrintCss();?>
<bodyfaq>
<?php PrintNavBar();?>
<div class="containerfaq">
    <div class="faq-header">
        <h1>Preguntas Frecuentes</h1>
        <p>Encuentra respuestas a nuestras preguntas más comunes a continuación.</p>
    </div>
    
    <div class="faq-search">
        <input type="text" placeholder="Busca respuestas..." id="searchInput">
        <button>Buscar</button>
    </div>
    
    <ul class="faq-list">
        <li class="faq-item">
            <div class="faq-question">Términos y condiciones</div>
                <p style = "padding:10px">1. Introducción:
                Bienvenido a FideTechnology. Al acceder y utilizar nuestro sitio web www.fidetechnology.com (en adelante, “el Sitio”), usted acepta estar sujeto a los presentes Términos y Condiciones. Si no está de acuerdo con ellos, por favor no utilice nuestros servicios.</p>
                <p style = "padding:10px">2. Información de la Empresa:
                FideTechnology es una tienda en línea dedicada a la venta de Celulares, Tablets y Accesorios tecnológicos. Operamos bajo las leyes aplicables en [País de operación] y nos comprometemos a brindar productos de calidad y una atención confiable.</p>
                <p style = "padding:10px">3. Uso del Sitio:
El usuario se compromete a:

Utilizar el sitio únicamente para fines legales.

Proporcionar información veraz y actualizada al realizar compras o registrarse.

No realizar actividades que puedan dañar, sobrecargar o afectar el funcionamiento del sitio.</p>
                <p style = "padding:10px">4. Productos y Precios:
Todos los productos ofrecidos están sujetos a disponibilidad.

Nos reservamos el derecho de modificar precios, descripciones y promociones sin previo aviso.

Las imágenes son referenciales y pueden variar ligeramente del producto final.</p>
                <p style = "padding:10px">5. Proceso de Compra:
El usuario selecciona los productos y los añade al carrito.

Al confirmar el pedido, recibirá un correo con los detalles de la compra.

El pedido será procesado tras la verificación del pago.</p>
                <p style = "padding:10px">6. Métodos de Pago:
Aceptamos pagos mediante:

Tarjetas de crédito y débito (Visa, MasterCard, etc.)

Transferencias bancarias

Otros métodos que puedan estar disponibles en el Sitio

Todos los pagos se procesan de forma segura a través de plataformas certificadas.</p>
                <p style = "padding:10px">7. Envíos y Entregas:
Realizamos envíos a todo el territorio nacional.

Los tiempos de entrega varían según la ubicación del cliente.

El costo del envío será indicado antes de finalizar la compra.

Una vez despachado el producto, el cliente recibirá un número de seguimiento.</p>
                <p style = "padding:10px">8. Devoluciones y Garantías:
El cliente podrá solicitar cambios o devoluciones dentro de los primeros 7 días hábiles posteriores a la entrega, siempre que el producto esté en su empaque original y sin señales de uso.

Los productos cuentan con garantía del fabricante. FideTechnology actuará como intermediario en caso de reclamos.

No se aceptarán devoluciones por daños ocasionados por mal uso o manipulación indebida.</p>
                <p style = "padding:10px">9. Privacidad y Protección de Datos:
                FideTechnology se compromete a proteger la información personal de sus usuarios. Todos los datos proporcionados se manejan conforme a nuestra [Política de Privacidad] y no serán compartidos con terceros sin consentimiento.</p>
                <p style = "padding:10px">10. Propiedad Intelectual:
                Todo el contenido del sitio (textos, imágenes, logos, diseño, etc.) es propiedad de FideTechnology o cuenta con licencias de uso. Queda prohibida su reproducción total o parcial sin autorización.</p>
        </li>
    <?php PrintFooter();?>
    <?php PrintScript();?>
</body>
</html>
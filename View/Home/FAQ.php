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
            <div class="faq-question">¿Qué productos/servicios ofrecen?</div>
            <div class="faq-answer">
                <p>Ofrecemos una amplia gama de productos y servicios diseñados para satisfacer tus necesidades. Nuestra oferta incluye Celulares, Tablets y Accesorios. Cada uno está diseñado con calidad y satisfacción del cliente en mente. Para ver la lista completa, visita nuestra página de Productos/Servicios.</p>
            </div>
        </li>
        
        <li class="faq-item">
            <div class="faq-question">¿Cómo realizo un pedido?</div>
            <div class="faq-answer">
                <p>¡Hacer un pedido es muy fácil! Solo navega por nuestro sitio web, selecciona los artículos que deseas y agrégalos a tu carrito. Cuando estés listo para pagar, haz clic en el ícono del carrito, revisa tu pedido y sigue el proceso de compra. Necesitarás proporcionar tu información de envío y detalles de pago para completar la compra.</p>
            </div>
        </li>
        
        <li class="faq-item">
            <div class="faq-question">¿Qué métodos de pago aceptan?</div>
            <div class="faq-answer">
                <p>Aceptamos varios métodos de pago para tu comodidad, incluyendo todas las principales tarjetas de crédito (Visa, MasterCard, American Express), PayPal y transferencias bancarias. Todos los pagos se procesan de forma segura para proteger tu información financiera.</p>
            </div>
        </li>
        
        <li class="faq-item">
            <div class="faq-question">¿Cuál es su política de envíos?</div>
            <div class="faq-answer">
                <p>Realizamos envíos a la mayoría de las ubicaciones en todo el mundo. El envío estándar normalmente tarda entre 3-5 días hábiles a nivel nacional y entre 7-14 días hábiles a nivel internacional. Opciones de envío exprés están disponibles al momento del pago. Los costos de envío se calculan en base al peso de tu pedido y tu ubicación. El envío es gratuito para pedidos superiores a $50.</p>
            </div>
        </li>
        
        <li class="faq-item">
            <div class="faq-question">¿Cuál es su política de devoluciones?</div>
            <div class="faq-answer">
                <p>Ofrecemos una política de devoluciones de 30 días para la mayoría de los artículos. Los productos deben estar en su estado original y con su empaque intacto. Para iniciar una devolución, por favor contacta a nuestro equipo de atención al cliente con tu número de pedido y el motivo de la devolución. Una vez aprobada, te proporcionaremos instrucciones para enviar el artículo de regreso. Los reembolsos se procesan generalmente dentro de 5-7 días hábiles después de recibir el artículo devuelto.</p>
            </div>
        </li>
        
        <li class="faq-item">
            <div class="faq-question">¿Cómo puedo rastrear mi pedido?</div>
            <div class="faq-answer">
                <p>Una vez que tu pedido sea enviado, recibirás un correo de confirmación con un número de rastreo y un enlace. Puedes usar esta información para seguir el progreso de tu paquete. Alternativamente, puedes iniciar sesión en tu cuenta en nuestro sitio web y ver el estado y la información de rastreo desde la sección "Historial de Pedidos".</p>
            </div>
        </li>
        
        <li class="faq-item">
            <div class="faq-question">¿Ofrecen envíos internacionales?</div>
            <div class="faq-answer">
                <p>Sí, realizamos envíos a la mayoría de los países del mundo. Los tiempos de envío internacional varían según el destino, pero normalmente oscilan entre 7-14 días hábiles. Ten en cuenta que los pedidos internacionales pueden estar sujetos a aranceles e impuestos aduaneros, los cuales son responsabilidad del destinatario y no están incluidos en nuestros cargos de envío.</p>
            </div>
        </li>
        
        <li class="faq-item">
            <div class="faq-question">¿Cómo contacto al servicio de atención al cliente?</div>
            <div class="faq-answer">
                <p>Nuestro equipo de atención al cliente está disponible de lunes a viernes, de 9 AM a 6 PM EST. Puedes contactarnos por correo electrónico a support@example.com, por teléfono al (555) 123-4567, o mediante el formulario de contacto en nuestro sitio web. Nos esforzamos por responder a todas las consultas dentro de las 24 horas en días hábiles.</p>
            </div>
        </li>
    </ul>
</div>

    
    <script>
        // Toggle FAQ items
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                // Close all other items
                document.querySelectorAll('.faq-item').forEach(item => {
                    if (item !== question.parentElement) {
                        item.classList.remove('active');
                    }
                });
                
                question.parentElement.classList.toggle('active');
            });
        });
        
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            
            document.querySelectorAll('.faq-item').forEach(item => {
                const question = item.querySelector('.faq-question').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
        
        document.querySelector('.faq-search button').addEventListener('click', function() {
            const searchEvent = new Event('keyup');
            document.getElementById('searchInput').dispatchEvent(searchEvent);
        });
    </script>
    <?php PrintFooter();?>
    <?php PrintScript();?>
</body>
</html>
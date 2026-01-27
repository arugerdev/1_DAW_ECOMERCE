<?php include_once __DIR__ . "/../components/navbar.php" ?>

<section class="bg text container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>

                    <h1 class="display-5 fw-bold mb-3">¡Pedido confirmado!</h1>

                    <p class="lead mb-4">
                        Tu pedido ha sido procesado correctamente.
                        <br>Te hemos enviado un email con todos los detalles.
                    </p>

                    <div class="alert alert-info mb-4">
                        <h5 class="alert-heading mb-2">
                            <i class="fas fa-receipt me-2"></i>
                            Número de pedido:
                            <span class="badge bg-primary fs-6" id="order-number">
                                <?php echo isset($_GET['orderNumber']) ? '#' . $_GET['orderNumber'] : ''; ?>
                            </span>
                        </h5>
                        <p class="mb-0">Guarda este número para cualquier consulta</p>
                    </div>

                    <div class="row text-start mb-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">Resumen del pedido:</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Fecha:</strong> <span id="order-date"><?php echo date('d/m/Y'); ?></span></li>
                                <li class="mb-2"><strong>Total:</strong> <span id="order-total">0.00€</span></li>
                                <li class="mb-2" id="status-container"><strong>Estado:</strong></li>
                                <li><strong>Método de pago:</strong> <span id="payment-method">Tarjeta</span></li>
                                <li><strong>Método de envio:</strong> <span id="send-method">Standard</span></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">¿Qué pasa ahora?</h5>
                            <ol class="ps-3">
                                <li class="mb-2">Recibirás un email de confirmación</li>
                                <li class="mb-2">Prepararemos tu pedido en 24-48h</li>
                                <li class="mb-2">Te enviaremos el número de seguimiento</li>
                                <li>Recibirás tu pedido en 5-7 días laborables</li>
                            </ol>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="/" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-home me-2"></i>Volver a la tienda
                        </a>
                        <a href="/orders" class="btn btn-primary btn-lg">
                            <i class="fas fa-eye me-2"></i>Ver mis pedidos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'templates/components/footer.php' ?>


<script>
    $(document).ready(function() {
        // Obtener datos desde bd filtrando por $_GET['orderNumber'] y colocar los datos en la pantalla:
        selectData('*', 'orders', 'WHERE order_number = "<?php echo $_GET['orderNumber'] ?>"', (data) => {
            const order = data.data[0];

            $('#order-total').html(order.total_amount + "<?php echo SHOP_DATA->currency_symbol ?>")
            $('#status-container').html(getStatus(order.status))
            $('#payment-method').html(order.payment_method)
            $('#send-method').html(order.shipping_method)
        })

        // 

        // Limpiar carrito
        $.ajax({
            url: "../../utils/cart_utils.php",
            type: "POST",
            data: {
                "action": "clear"
            },
            success: () => {
                // Carrito limpiado
            }
        });
    });
</script>
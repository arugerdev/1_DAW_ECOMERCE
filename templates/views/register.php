<?php


require_once __DIR__ . "/../../utils/checkout_utils.php";
require_once __DIR__ . "/../../utils/auth_utils.php";

function isLoggedIn()
{
    return isset($_SESSION['customer']) && !empty($_SESSION['customer']);
}

if (isLoggedIn()) {
    header("Location: /");
    exit;
}

?>

<?php include __DIR__ . "/../components/navbar.php"; ?>

<!-- # checkout form -->

<?php

/*

 <?php include_once __DIR__ . "/../components/navbar.php" ?>



<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Progreso del checkout -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center flex-fill">
                            <span class="badge bg-success rounded-circle p-2" style="width: 28px; height:28px">
                                <i class="fas fa-check"></i>
                            </span>
                            <p class="mt-2 mb-0 small fw-bold">Información</p>
                        </div>
                        <div class="flex-fill">
                            <hr class="my-0">
                        </div>
                        <div class="text-center flex-fill">
                            <span class="badge bg-primary rounded-circle p-2" style="width: 28px; height:28px">2</span>
                            <p class="mt-2 mb-0 small fw-bold">Confirmación</p>
                        </div>
                        <div class="flex-fill">
                            <hr class="my-0">
                        </div>
                        <div class="text-center flex-fill">
                            <span class="badge bg-secondary rounded-circle p-2" style="width: 28px; height:28px">3</span>
                            <p class="mt-2 mb-0 small text-muted">Pago</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Información del cliente -->
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="fs-5 mb-0">
                                <i class="fas fa-user me-2"></i>Información del cliente
                            </h4>
                        </div>
                        <div class="card-body">
                            <div id="customer-info">
                                <p><strong>Nombre:</strong> <span id="customer-name"></span></p>
                                <p><strong>Email:</strong> <span id="customer-email"></span></p>
                                <p><strong>Teléfono:</strong> <span id="customer-phone"></span></p>
                                <p><strong>Dirección:</strong> <span id="customer-address"></span></p>
                                <p><strong>Ciudad:</strong> <span id="customer-city"></span>, <span id="customer-zip"></span></p>
                                <p><strong>País:</strong> <span id="customer-country"></span></p>
                            </div>
                            <a href="/checkout" class="btn btn-outline-primary btn-sm mt-3">
                                <i class="fas fa-edit me-1"></i> Editar información
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Resumen del pedido -->
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="fs-5 mb-0">
                                <i class="fas fa-shopping-bag me-2"></i>Resumen del pedido
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover m-0">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th class="text-center">Cant.</th>
                                            <th class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="order-summary-items">
                                        <!-- Los productos se cargarán con JS -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end"><strong>Subtotal:</strong></td>
                                            <td class="text-end" id="order-subtotal">0.00<?php echo SHOP_DATA->currency_symbol ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end"><strong>Envío:</strong></td>
                                            <td class="text-end" id="order-shipping">5.00<?php echo SHOP_DATA->currency_symbol ?></td>
                                        </tr>
                                        <tr class="table-active">
                                            <td colspan="2" class="text-end"><strong>TOTAL:</strong></td>
                                            <td class="text-end fw-bold" id="order-total">0.00<?php echo SHOP_DATA->currency_symbol ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Método de envío y pago -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="fs-5 mb-0">
                                <i class="fas fa-truck me-2"></i>Método de envío
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="shipping_method" id="shipping_standard" value="standard" checked>
                                <label class="form-check-label" for="shipping_standard">
                                    <strong>Envío estándar</strong> (5-7 días laborables) - 5.00<?php echo SHOP_DATA->currency_symbol ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shipping_method" id="shipping_express" value="express">
                                <label class="form-check-label" for="shipping_express">
                                    <strong>Envío exprés</strong> (1-2 días laborables) - 10.00<?php echo SHOP_DATA->currency_symbol ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="fs-5 mb-0">
                                <i class="fas fa-credit-card me-2"></i>Método de pago
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_card" value="card" checked>
                                <label class="form-check-label" for="payment_card">
                                    <strong>Tarjeta de crédito/débito</strong>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_paypal" value="paypal">
                                <label class="form-check-label" for="payment_paypal">
                                    <strong>PayPal</strong>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_transfer" value="transfer">
                                <label class="form-check-label" for="payment_transfer">
                                    <strong>Transferencia bancaria</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Condiciones y botones -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="accept_terms" required>
                        <label class="form-check-label" for="accept_terms">
                            He leído y acepto los <a href="/terms" target="_blank">términos y condiciones</a>
                            y la <a href="/privacy" target="_blank">política de privacidad</a> *
                        </label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/checkout" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Volver atrás
                        </a>
                        <button id="confirm-order-btn" class="btn btn-success btn-lg">
                            <i class="fas fa-lock me-2"></i>Confirmar y pagar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'templates/components/footer.php'?>


<script>
    $(document).ready(function() {
       
        function loadCustomerInfo() {
            $.ajax({
                url: "../../utils/checkout_utils.php",
                type: "POST",
                data: {
                    "action": "get_customer_info"
                },
                success: (response) => {
                    const result = JSON.parse(response);
                    console.log (result);
                    if (result.success) {
                        const customer = result.customer;

                        $('#customer-name').text(customer.name + ' ' + customer.last_name);
                        $('#customer-email').text(customer.email);
                        $('#customer-phone').text(customer.phone_number);
                        $('#customer-address').text(customer.address);
                        $('#customer-city').text(customer.city);
                        $('#customer-zip').text(customer.cp);
                        $('#customer-country').text(getCountryName(customer.country));
                    } else {
                       
                       
                    }
                }
            });
        }

        function getCountryName(countryCode) {
            const countries = {
                'ES': 'España',
                'FR': 'Francia',
                'IT': 'Italia',
                'DE': 'Alemania',
                'PT': 'Portugal'
            };
            return countries[countryCode] || countryCode;
        }

       
        function loadOrderSummary() {
            $.ajax({
                url: "../../utils/cart_utils.php",
                type: "POST",
                data: {
                    "action": "select"
                },
                success: (response) => {
                    const result = JSON.parse(response);
                    const cartItems = result.cart || [];

                    let html = '';
                    let subtotal = 0;

                   
                    const groupedProducts = {};
                    cartItems.forEach(product => {
                        const id = product.id;
                        if (!groupedProducts[id]) {
                            groupedProducts[id] = {
                                product: product,
                                quantity: 0,
                                price: parseFloat(product.price)
                            };
                        }
                        groupedProducts[id].quantity++;
                    });

                   
                    Object.values(groupedProducts).forEach(item => {
                        const product = item.product;
                        const quantity = item.quantity;
                        let price = item.price;

                       
                        if (product.on_sale === '1' && product.sale_discound) {
                            price = price * (1 - parseFloat(product.sale_discound) / 100);
                        }

                        const itemTotal = price * quantity;
                        subtotal += itemTotal;

                        html += `
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="/uploads/img/products/${product.id}/0.png" 
                                         class="img-thumbnail me-2" 
                                         style="width: 40px; height: 40px;"
                                         onerror="this.onerror=null; this.src='https://placehold.co/40x40'">
                                    <div>
                                        <strong>${product.name}</strong>
                                        ${product.on_sale === '1' && product.sale_discound ? 
                                            `<br><small class="text-danger">-${product.sale_discound}%</small>` : ''}
                                    </div>
                                </div>
                            </td>
                            <td class="text-center align-middle">${quantity}</td>
                            <td class="text-end align-middle">${itemTotal.toFixed(2)}<?php echo SHOP_DATA->currency_symbol ?></td>
                        </tr>
                    `;
                    });

                    $('#order-summary-items').html(html);
                    updateOrderTotal(subtotal);
                }
            });
        }

       
        function updateOrderTotal(subtotal) {
            const shippingMethod = $('input[name="shipping_method"]:checked').val();
            let shipping = 5.00;

            if (shippingMethod === 'express') {
                shipping = 10.00;
            }

            const total = subtotal + shipping;

            $('#order-subtotal').text(subtotal.toFixed(2) + '<?php echo SHOP_DATA->currency_symbol ?>');
            $('#order-shipping').text(shipping.toFixed(2) + '<?php echo SHOP_DATA->currency_symbol ?>');
            $('#order-total').text(total.toFixed(2) + '<?php echo SHOP_DATA->currency_symbol ?>');
        }

       
        $('input[name="shipping_method"]').on('change', function() {
            const subtotal = parseFloat($('#order-subtotal').text().replace('<?php echo SHOP_DATA->currency_symbol ?>', ''));
            updateOrderTotal(subtotal);
        });

       
        $('#confirm-order-btn').on('click', function() {
            if (!$('#accept_terms').is(':checked')) {
                alert('Debes aceptar los términos y condiciones');
                return;
            }

            const shippingMethod = $('input[name="shipping_method"]:checked').val();
            const paymentMethod = $('input[name="payment_method"]:checked').val();

            $.ajax({
                url: "../../utils/checkout_utils.php",
                type: "POST",
                data: {
                    "action": "create_order",
                    "shipping_method": shippingMethod,
                    "payment_method": paymentMethod
                },
                success: (response) => {
                    const result = JSON.parse(response);
                    if (result.success) {
                        window.location.href = '/checkout/success?orderNumber=' + result.orderNumber;
                    } else {

                        alert(JSON.stringify(result) || 'Error al crear el pedido');
                    }
                }
            });
        });

       
        loadCustomerInfo();
        loadOrderSummary();
    });
</script>
*/ ?>

<!-- #end checkout form -->

<!-- Register form similar to checkout form -->

<!-- ... -->
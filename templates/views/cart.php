<?php
include_once __DIR__ . "/../components/navbar.php";
require __DIR__ . "/../../utils/images_utils.php";

?>


<section class="card p-0 p-lg-4 min-vh-100">
    <section class="card-header">
        <h1 class="fs-4">Carrito de compra</h1>
    </section>
    <section class="card-body py-0 py-lg-5">
        <?php if (empty($_SESSION["cart_products"])): ?>
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">Tu carrito está vacío</h3>
                <p class="text-muted">Agrega algunos productos para comenzar</p>
                <a href="/" class="btn btn-primary mt-3">Ir a la tienda</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table id="cart-table" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 80px;">Imagen</th>
                            <th scope="col">Producto</th>
                            <th scope="col" style="width: 160px;">Cantidad</th>
                            <th scope="col" style="width: 100px;">Precio U.</th>
                            <th scope="col" style="width: 100px;">Subtotal</th>
                            <th scope="col" style="width: 80px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $groupedProducts = [];
                        foreach ($_SESSION["cart_products"] as $product) {
                            $id = $product['id'];
                            if (!isset($groupedProducts[$id])) {
                                $groupedProducts[$id] = [
                                    'product' => $product,
                                    'quantity' => 0,
                                    'total' => 0
                                ];
                            }
                            $groupedProducts[$id]['quantity']++;
                            $price = floatval($product['price']);
                            if (isset($product['on_sale']) && $product['on_sale'] == '1' && isset($product['sale_discound'])) {
                                $price = $price * (1 - floatval($product['sale_discound']) / 100);
                            }
                            $groupedProducts[$id]['total'] += $price;
                        }

                        $cartTotal = 0;

                        foreach ($groupedProducts as $id => $item):
                            $product = $item['product'];
                            $quantity = $item['quantity'];
                            $subtotal = $item['total'];
                            $cartTotal += $subtotal;
                            $unitPrice = floatval($product['price']);
                            if (isset($product['on_sale']) && $product['on_sale'] == '1' && isset($product['sale_discound'])) {
                                $discount = floatval($product['sale_discound']);
                                $unitPrice = $unitPrice * (1 - $discount / 100);
                            }
                        ?>
                            <tr id="cart-item-<?php echo $id; ?>" data-product-id="<?php echo $id; ?>">
                                <td>
                                    <img src="<?php echo getProductMainImage($id) ?? 'https://placehold.co/100x100?text=Producto'; ?>"
                                        style="width: 80px; height: 80px; object-fit: contain;"
                                        class="img-thumbnail"
                                        alt="<?php echo htmlspecialchars($product['name']); ?>">
                                </td>
                                <td>
                                    <h6 class="mb-1"><?php echo htmlspecialchars($product['name']); ?></h6>
                                    <small class="text-muted">Código: <?php echo $id; ?></small>
                                    <?php if (isset($product['on_sale']) && $product['on_sale'] == '1' && isset($product['sale_discound'])): ?>
                                        <span class="badge bg-danger ms-2">-<?php echo $product['sale_discound']; ?>%</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <button class="btn btn-outline-secondary quantity-minus" type="button" data-id="<?php echo $id; ?>">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number"
                                            style="min-width: 64px;"
                                            class="form-control text-center quantity-input"
                                            value="<?php echo $quantity; ?>"
                                            min="1"
                                            max="<?php echo isset($product['stock']) ? $product['stock'] : '999'; ?>"
                                            data-id="<?php echo $id; ?>">
                                        <button class="btn btn-outline-secondary quantity-plus" type="button" data-id="<?php echo $id; ?>">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <?php if (isset($product['stock']) && $quantity > $product['stock']): ?>
                                        <small class="text-danger">Stock disponible: <?php echo $product['stock']; ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (isset($product['on_sale']) && $product['on_sale'] == '1' && isset($product['sale_discound'])): ?>
                                        <span class="text-muted text-decoration-line-through">
                                            <?php echo number_format(floatval($product['price']), 2); ?>€
                                        </span><br>
                                    <?php endif; ?>
                                    <span class="fw-bold"><?php echo number_format($unitPrice, 2); ?>€</span>
                                </td>
                                <td class="subtotal" data-subtotal="<?php echo $subtotal; ?>">
                                    <span class="fw-bold"><?php echo number_format($subtotal, 2); ?>€</span>
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger btn-sm remove-item" data-id="<?php echo $id; ?>" title="Eliminar del carrito">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total del carrito:</td>
                            <td class="fw-bold fs-5" id="cart-total"><?php echo number_format($cartTotal, 2); ?>€</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="/products" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Seguir comprando
                    </a>
                    <div>
                        <button class="btn btn-outline-danger me-2" id="clear-cart">
                            <i class="fas fa-trash me-2"></i>Vaciar carrito
                        </button>
                        <a class="btn btn-success" href="/checkout" id="checkout-btn">
                            <i class="fas fa-shopping-bag me-2"></i>Proceder al pago
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
</section>
<?php include 'templates/components/footer.php' ?>


<script>
    $(document).ready(function() {

        $('.quantity-input').on('change', function() {
            if (!$(this).val() || $(this).val() < 1) {
                $(this).val(1)
                $(this).trigger('change');

            }

            const productId = $(this).data('id');
            const newQuantity = parseInt($(this).val());
            const stock = parseInt($(this).attr('max'));


            if (newQuantity > stock) {
                $(this).val(stock);
                alert(`No hay suficiente stock. Máximo disponible: ${stock}`);
                return;
            }

            updateCartQuantity(productId, newQuantity);
        });
        $('.quantity-plus').on('click', function() {
            const productId = $(this).data('id');
            const input = $(`#cart-item-${productId} .quantity-input`);
            const currentValue = parseInt(input.val());
            const max = parseInt(input.attr('max'));

            if (currentValue < max) {
                input.val(currentValue + 1).trigger('change');
            } else {
                alert(`No hay suficiente stock. Máximo disponible: ${max}`);
            }
        });

        $('.quantity-minus').on('click', function() {
            const productId = $(this).data('id');
            const input = $(`#cart-item-${productId} .quantity-input`);
            const currentValue = parseInt(input.val());

            if (currentValue > 1) {
                input.val(currentValue - 1).trigger('change');
            }
        });
        $('.remove-item').on('click', function() {
            const productId = $(this).data('id');
            if (confirm('¿Estás seguro de que quieres eliminar este producto del carrito?')) {
                deleteFromCart(productId, (result) => {
                    if (result.success) {
                        $(`#cart-item-${productId}`).remove();
                        updateCartTotal();
                        checkEmptyCart();
                    }
                })
            }
        });
        $('#clear-cart').on('click', function() {
            if (confirm('¿Estás seguro de que quieres vaciar todo el carrito?')) {
                $.ajax({
                    url: "../../utils/cart_utils.php",
                    type: "POST",
                    data: {
                        "action": "clear"
                    },
                    success: (data) => {
                        const result = JSON.parse(data);
                        if (result.success) {
                            location.reload();
                        }
                    }
                });
            }
        });

        function updateCartQuantity(productId, newQuantity) {
            $.ajax({
                url: "../../utils/cart_utils.php",
                type: "POST",
                data: {
                    "action": "update_quantity",
                    "product_id": productId,
                    "quantity": newQuantity
                },
                success: (data) => {
                    const result = JSON.parse(data);
                    if (result.success) {

                        const unitPrice = result.unit_price;
                        const subtotal = unitPrice * newQuantity;

                        $(`#cart-item-${productId} .subtotal`).html(
                            `<span class="fw-bold">${subtotal.toFixed(2)}€</span>`
                        ).data('subtotal', subtotal);

                        updateCartTotal();
                    }
                }
            });
        }

        function updateCartTotal() {
            let total = 0;
            $('.subtotal').each(function() {
                total += parseFloat($(this).data('subtotal') || 0);
            });
            $('#cart-total').text(total.toFixed(2) + '€');
        }

        function checkEmptyCart() {
            if ($('#cart-table tbody tr').length === 0) {
                location.reload();
            }
        }
    });
</script>
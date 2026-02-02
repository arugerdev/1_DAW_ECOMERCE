<div class="modal fade" id="modal-order-details" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Ver detalles</h4>
                <button id="details-close" type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="edit_order_form">

                    <div class="form-group">
                        <label>Número de pedido</label>
                        <input type="text" id="details-order-number" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label>Estado</label>
                        <select disabled id="details-order-status" class="form-control">
                            <option value="pending">Pendiente</option>
                            <option value="paid">Pagado</option>
                            <option value="sent">Enviado</option>
                            <option value="completed">Completado</option>
                            <option value="cancelled">Cancelado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Método de envío</label>
                        <input disabled type="text" id="details-shipping-method" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Método de pago</label>
                        <input disabled type="text" id="details-payment-method" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>
                            <input disabled type="checkbox" id="details-order-received">
                            Pedido recibido
                        </label>
                    </div>

                    <hr>

                    <div class="form-group">
                        <h5>Información del cliente</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nombre:</strong> <span id="details-customer-name">-</span></p>
                                <p><strong>Email:</strong> <span id="details-customer-email">-</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Teléfono:</strong> <span id="details-customer-phone">-</span></p>
                            </div>
                            <p><strong>Direccion:</strong> <span id="details-customer-address">-</span></p>
                            <div class="col-md-4">
                                <p><strong>Ciudad:</strong> <span id="details-customer-city">-</span></p>
                                <p><strong>Codigo postal:</strong> <span id="details-customer-cp">-</span></p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <h5>Productos del pedido</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="products-table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" id="details-close" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>



<script defer>
    function getOrderData(id, callback) {
        selectData(`
        o.*, 
        c.*,
        GROUP_CONCAT(p.id) as product_ids,
        GROUP_CONCAT(p.name) as product_names,
        GROUP_CONCAT(p.price) as product_prices,
        GROUP_CONCAT(p.w_tax_price) as w_tax_prices,
        GROUP_CONCAT(po.quantity) as product_quantities
    `,
            "orders o LEFT JOIN customers c ON o.customer_id = c.id LEFT JOIN prodToOrder po ON po.orderId = o.id LEFT JOIN products p ON po.productId = p.id ",
            `WHERE o.id = ${id} 
     GROUP BY o.id`,
            (res) => {
                callback(res.data[0])
            })
    }

    $('#modal-order-details').on('show.bs.modal', () => {

        $('*[id*=details-close]').on('click', () => {
            $('#modal-order-details').modal('hide');
        });

        const id = $('#modal-order-details').data('id')

        getOrderData(id, (order) => {
           
            $('#details-order-number').val(order.order_number)
            $('#details-order-status').val(order.status)
            $('#details-shipping-method').val(order.shipping_method)
            $('#details-payment-method').val(order.payment_method)
            $('#details-order-received').prop('checked', order.received == 1)

           
            $('#details-customer-name').text(order.name || '-')
            $('#details-customer-email').text(order.email || '-')
            $('#details-customer-phone').text(order.phone_number || '-')
            $('#details-customer-address').text(order.address || '-')
            $('#details-customer-city').text(order.city || '-')
            $('#details-customer-cp').text(order.cp || '-')

           
            displayOrderProducts(order)
        })

        function displayOrderProducts(order) {
            const tableBody = $('#products-table-body');
            tableBody.empty();

           
            if (!order.product_ids || order.product_ids === null) {
                tableBody.append(`
                <tr>
                    <td colspan="4" class="text-center">No hay productos en este pedido</td>
                </tr>
            `);
                return;
            }

           
            const productIds = order.product_ids.split(',');
            const productNames = order.product_names.split(',');
            const productPrices = order.w_tax_prices.split(',');
            const productQuantities = order.product_quantities.split(',');
            const productImages = order.product_images ? order.product_images.split(',') : [];

            let total = 0;

           
            productIds.forEach((productId, index) => {
                const price = parseFloat(productPrices[index]);
                const quantity = parseInt(productQuantities[index]);
                const subtotal = price * quantity;
                total += subtotal;

               
                let imageHtml = '<td>-</td>';
                if (productImages[index] && productImages[index] !== 'null') {
                    imageHtml = `
                    <td>
                        <img src="${productImages[index]}" 
                             alt="${productNames[index]}" 
                             style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                `;
                }

                getProductImages(productId, (res) => {
                    tableBody.append(`
                    <tr>
                    <td>
                    <img src="/uploads/img/products/${productId}/${res.images[0]}" 
                        class="img-thumbnail me-2" 
                        style="width: 40px; height: 40px;"
                        onerror="this.onerror=null; this.src='https://placehold.co/40x40'">
                    </td>
                    <td>
                    <strong>${productNames[index]}</strong><br>
                    <small class="text-muted">${price.toFixed(2)}<?php echo SHOP_DATA->currency_symbol ?>/u</small>
                    </td>
                    <td>${quantity}</td>
                    <td>
                    <button type="button" class="btn btn-sm btn-info" 
                    onclick="viewProduct(${productId})">
                    Ver producto
                    </button>
                    </td>
                    </tr>
                    `);
                })
            });

           
            tableBody.append(`
            <tr class="table-active">
                <td colspan="2" class="text-end"><strong>Total:</strong></td>
                <td colspan="2"><strong>${total.toFixed(2)}<?php echo SHOP_DATA->currency_symbol ?></strong></td>
            </tr>
        `);
        }

       
        window.viewProduct = function(productId) {
           
            window.location.href = `/admin/products?edit=${productId}`
        }

        $('#edit_order_form').on('submit', (e) => {
            e.preventDefault()

            const status = $('#details-order-status').val()
            const shipping = $('#details-shipping-method').val()
            const payment = $('#details-payment-method').val()
            switch (payment) {
                case 'transfer':
                    payment = 'Transferencia';
                    break;
            }
            const received = $('#details-order-received').is(':checked') ? 1 : 0

            updateData(
                "orders",
                `
          status = "${status}",
          shipping_method = "${shipping}",
          payment_method = "${payment}",
          received = ${received}
        `,
                `WHERE id = ${id}`,
                () => location.reload()
            )
        })
    })
</script>
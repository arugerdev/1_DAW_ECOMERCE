<?php
session_start();

require __DIR__ . "/../../utils/checkout_utils.php";
require __DIR__ . "/../../utils/auth_utils.php";

function isLoggedIn()
{
    return isset($_SESSION['customer']) && !empty($_SESSION['customer']);
}

if (!isLoggedIn()) {
    header("Location: /login?redirect=/orders");
    exit;
}
?>

<?php include __DIR__ . "/../components/navbar.php"; ?>

<div class="container mt-5">
    <h2 class="mb-4">Mis pedidos</h2>

    <div id="orders-container">
        <!-- Orders will be injected here -->
    </div>
</div>

<script>
    function loadOrders() {
        selectData(
            '*',
            'orders',
            'WHERE customer_id = <?php echo $_SESSION["customer"]["id"]; ?> ORDER BY create_at DESC',
            function(response) {

                if (!response.success) {
                    alert('Error cargando pedidos');
                    return;
                }

                const container = $('#orders-container');
                container.html('');

                if (response.data.length === 0) {
                    container.html('<p>No tienes pedidos todavía.</p>');
                    return;
                }

                response.data.forEach(order => {
                    const orderId = order.id;
                    const colors = {
                        pending: 'warning',
                        paid: 'info',
                        sent: 'primary',
                        completed: 'success',
                        cancelled: 'danger'
                    }
                    const card = `
                <div class="card bg-gradient collapsed-card collapsed btn" data-card-widget="collapse">
                    <div class="card-header border-0 ui-sortable-handle" >
                        <h3 class="card-title">
                            Pedido <b>#${order.order_number ?? order.id}</b>
                            <small class="text-muted ml-2">
                                ${new Date(order.create_at).toLocaleDateString()}
                            </small>
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Estado:</b>
                            
                            <span class="badge badge-${colors[order.status] || 'secondary'}">${order.status}</span>
                            </div>
                            <div class="col-md-4"><b>Pago:</b> ${order.payment_method ?? '-'}</div>
                            <div class="col-md-4"><b>Envío:</b> ${order.shipping_method ?? '-'}</div>
                        </div>

                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Producto</th>
                                    <th>Precio unit.</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="products-${orderId}">
                                <tr>
                                    <td colspan="4" class="text-center">Cargando productos...</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="text-right mt-3">
                            <h5>Total: <b>${order.total_amount.toFixed(2)} €</b></h5>
                        </div>
                    </div>
                </div>
                `;

                    container.append(card);
                    loadOrderProducts(orderId);
                });
            }
        );
    }

    function loadOrderProducts(orderId) {
        selectData(
            `
            p.id,
            p.name,
            po.quantity,
            po.unit_price,
            po.total_price
            `,
            'prodToOrder po INNER JOIN products p ON p.id = po.productId',
            `WHERE po.orderId = ${orderId}`,
            function(response) {

                const tbody = $(`#products-${orderId}`);
                tbody.html('');

                if (!response.success || response.data.length === 0) {
                    tbody.html('<tr><td colspan="4">Sin productos</td></tr>');
                    return;
                }

                const groupedProducts = {};

                response.data.forEach(prod => {
                    if (!groupedProducts[prod.id]) {
                        // Primer registro de este producto
                        groupedProducts[prod.id] = {
                            id: prod.id,
                            name: prod.name,
                            unit_price: prod.unit_price,
                            quantity: prod.quantity,
                            total_price: prod.total_price
                        };
                    } else {
                        // Producto ya existe, sumar cantidades y total
                        groupedProducts[prod.id].quantity += prod.quantity;
                        groupedProducts[prod.id].total_price += prod.total_price;
                    }
                });

                // Convertir el objeto agrupado a array y mostrar
                Object.values(groupedProducts).forEach(prod => {
                    getProductImages(prod.id, (data) => {
                        const images = data.images;
                        console.log(images)

                        tbody.append(`
                        <tr>
                            <td>
                                <img src="${images[0] ? `/uploads/img/products/${prod.id}/${images[0]}` : 'https://placehold.co/86x86'}" alt="Product Image" style=" max-width: 86px; max-height: 86px; aspect-ratio: 1/1; object-fit: contain;" class="product-image">    
                            </td>
                            <td>${prod.name}</td>
                            <td>${prod.unit_price.toFixed(2)} €</td>
                            <td>${prod.quantity}</td>
                            <td>${prod.total_price.toFixed(2)} €</td>
                        </tr>
                    `);
                    });
                });
            }
        );
    }

    $(document).ready(function() {
        loadOrders();
    });
</script>
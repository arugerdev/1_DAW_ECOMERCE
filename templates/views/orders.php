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
    <h2 class="mb-4">📦 Tus pedidos</h2>

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

                    const card = `
                <div class="card bg-gradient collapsed-card collapsed  ">
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
                            
                            <div class="badge badge-${
                              order.status === 'Pending'
                                ? 'warning'
                                : order.status === 'Shipped'
                                ? 'info'
                                : order.status === 'Delivered'
                                ? 'success'
                                : order.status === 'Cancelled'
                                ? 'danger'
                                : 'secondary'
                            }">

                            ${order.status}
                            </div>
                            </div>
                            <div class="col-md-4"><b>Pago:</b> ${order.payment_method ?? '-'}</div>
                            <div class="col-md-4"><b>Envío:</b> ${order.shipping_method ?? '-'}</div>
                        </div>

                        <h5>🛒 Productos</h5>
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

                response.data.forEach(prod => {
                    // Solucion valida pero no funciona con distintos tipos

                    // $.ajax({
                    //     type: 'GET',
                    //     url: `/uploads/products/${prod.id}/0.`,
                    //     async: false,
                    //     success: function(data) {
                    //         prod.image_url = data.length > 0 ? data[0] : null;
                    //     },
                    //     error: function() {
                    //         prod.image_url = null;
                    //     }
                    // });

                    // Con distintos tipos:
                    // const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    // prod.image_url = null;
                    // for (const ext of imageExtensions) {
                    //     const imageUrl = `/uploads/products/${prod.id}/0.${ext}`;
                    //     $.ajax({
                    //         type: 'HEAD',
                    //         url: imageUrl,
                    //         async: false,
                    //         success: function() {
                    //             prod.image_url = imageUrl;
                    //             return false; // break loop
                    //         }
                    //     });
                    //     if (prod.image_url) break;
                    // }

                    prod.image_url = null;

                });

                response.data.forEach(prod => {
                    tbody.append(`
                    <tr>
                        <td>
                            <img src="${prod.image_url ? prod.image_url : 'https://placehold.co/86'}" alt="Product Image" style=" max-width: 86px; max-height: 86px; aspect-ratio: 1/1; object-fit: contain;" class="product-image">    
                        </td>
                        <td>${prod.name}</td>
                        <td>${prod.unit_price.toFixed(2)} €</td>
                        <td>${prod.quantity}</td>
                        <td>${prod.total_price.toFixed(2)} €</td>
                    </tr>
                `);
                });
            }
        );
    }

    $(document).ready(function() {
        loadOrders();
    });
</script>
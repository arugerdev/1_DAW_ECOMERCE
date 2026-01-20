<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Inicio</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <!-- Estadísticas principales -->
        <section class="connectedSortable ui-sortable">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="recently-orders">0</h3>
                            <p>Pedidos Hoy</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/admin/orders" class="small-box-footer">Ver pedidos <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="total-revenue">0.00<sup style="font-size: 20px">€</sup></h3>
                            <p>Ingresos Totales</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/admin/orders" class="small-box-footer">Ver ventas <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="current-active-products">0</h3>
                            <p>Productos Activos</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cube"></i>
                        </div>
                        <a href="/admin/products" class="small-box-footer">Ver productos <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="low-stock-products">0</h3>
                            <p>Bajo Stock</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-alert-circled"></i>
                        </div>
                        <a href="/admin/products" class="small-box-footer">Ver stock <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gráficos y estadísticas -->
        <div class="row">
            <!-- Gráfico de ventas mensuales -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-1"></i>
                            Ventas Mensuales
                        </h3>
                        <div class="card-tools">
                            <select id="sales-period" class="form-control form-control-sm" style="width: auto;">
                                <option value="30">Últimos 30 días</option>
                                <option value="90">Últimos 3 meses</option>
                                <option value="180">Últimos 6 meses</option>
                                <option value="365">Último año</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estadísticas de productos -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Categorías de Productos
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4">
                            <canvas id="categories-chart" height="250"></canvas>
                        </div>
                        <div id="categories-legend" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información adicional -->
        <div class="row">
            <!-- Productos más vendidos -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-star mr-1"></i>
                            Productos Más Vendidos
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover m-0">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-center">Ventas</th>
                                        <th class="text-center">Stock</th>
                                        <th class="text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="top-products">
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="fas fa-spinner fa-spin mr-2"></i>
                                            Cargando datos...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pedidos recientes -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clock mr-1"></i>
                            Pedidos Recientes
                        </h3>
                        <div class="card-tools">
                            <span class="badge badge-danger" id="pending-orders">0 pendientes</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover m-0">
                                <thead>
                                    <tr>
                                        <th>Pedido #</th>
                                        <th>Cliente</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody id="recent-orders">
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-spinner fa-spin mr-2"></i>
                                            Cargando datos...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas rápidas -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="info-box bg-gradient-light">
                    <span class="info-box-icon bg-info"><i class="fas fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pedidos del Mes</span>
                        <span class="info-box-number" id="month-orders">0</span>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 0%" id="month-orders-progress"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="info-box bg-gradient-light">
                    <span class="info-box-icon bg-success"><i class="fas fa-euro-sign"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ingresos del Mes</span>
                        <span class="info-box-number" id="month-revenue">0€</span>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 0%" id="month-revenue-progress"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="info-box bg-gradient-light">
                    <span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Clientes Nuevos</span>
                        <span class="info-box-number" id="new-customers">0</span>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: 0%" id="customers-progress"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="info-box bg-gradient-light">
                    <span class="info-box-icon bg-danger"><i class="fas fa-chart-bar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Conversión</span>
                        <span class="info-box-number" id="conversion-rate">0%</span>
                        <div class="progress">
                            <div class="progress-bar bg-danger" style="width: 0%" id="conversion-progress"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Variables para los gráficos
        let salesChart = null;
        let categoriesChart = null;

        // Cargar estadísticas principales
        loadDashboardStats();

        // Cargar gráficos
        loadSalesChart(30);
        loadCategoriesChart();

        // Cargar productos más vendidos
        loadTopProducts();

        // Cargar pedidos recientes
        loadRecentOrders();

        // Evento para cambiar periodo del gráfico de ventas
        $('#sales-period').on('change', function() {
            const days = $(this).val();
            loadSalesChart(days);
        });

        // Función para cargar estadísticas del dashboard
        function loadDashboardStats() {
            // Productos activos
            selectData("id", "products", "WHERE is_visible = TRUE", (res) => {
                $('#current-active-products').html(res.data.length);
            });

            // Pedidos totales (ajustar según tu estructura de orders)
            selectData("COUNT(*) as total, SUM(total_amount) as revenue", "orders", "", (res) => {
                if (res.data.length > 0) {
                    const order = res.data[0];
                    $('#recently-orders').html(order.total || 0);
                    $('#total-revenue').html((order.revenue || 0).toFixed(2) + '€');
                }
            });

            // Productos con bajo stock
            selectData("id", "products", "WHERE stock < 10 AND stock > 0", (res) => {
                $('#low-stock-products').html(res.data.length);
            });

            // Pedidos del mes actual
            const currentMonth = new Date().getMonth() + 1;
            const currentYear = new Date().getFullYear();
            selectData("COUNT(*) as total, SUM(total_amount) as revenue", "orders",
                `WHERE MONTH(create_at) = ${currentMonth} AND YEAR(create_at) = ${currentYear}`,
                (res) => {
                    if (res.data.length > 0) {
                        const monthData = res.data[0];
                        $('#month-orders').html(monthData.total || 0);
                        $('#month-revenue').html((monthData.revenue || 0).toFixed(2) + '€');

                        // Actualizar barras de progreso
                        $('#month-orders-progress').css('width', `${Math.min(100, monthData.total || 0)}%`);
                        $('#month-revenue-progress').css('width', `${Math.min(100, (monthData.revenue || 0) / 1000)}%`);
                    }
                }
            );
        }

        // Función para cargar gráfico de ventas
        function loadSalesChart(days) {
            // Obtener datos de ventas por día
            const endDate = new Date();
            const startDate = new Date();
            startDate.setDate(startDate.getDate() - days);

            // Aquí deberías adaptar la consulta según tu estructura de orders
            selectData("DATE(create_at) as date, COUNT(*) as orders, SUM(total_amount) as revenue", "orders",
                `WHERE create_at >= '${startDate.toISOString().split('T')[0]}' 
             AND create_at <= '${endDate.toISOString().split('T')[0]}'
             GROUP BY DATE(create_at) ORDER BY date`,
                (res) => {
                    if (salesChart) {
                        salesChart.destroy();
                    }

                    const data = res.data;
                    const dates = [];
                    const orders = [];
                    const revenues = [];

                    // Generar fechas para todo el periodo
                    for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
                        const dateStr = d.toISOString().split('T')[0];
                        dates.push(new Date(d).toLocaleDateString('es-ES', {
                            month: 'short',
                            day: 'numeric'
                        }));

                        const dayData = data.find(item => item.date === dateStr);
                        orders.push(dayData ? parseInt(dayData.orders) : 0);
                        revenues.push(dayData ? parseFloat(dayData.revenue) : 0);
                    }

                    // Crear gráfico
                    const ctx = document.getElementById('sales-chart').getContext('2d');
                    salesChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: dates,
                            datasets: [{
                                label: 'Ventas (€)',
                                data: revenues,
                                borderColor: '#007bff',
                                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4
                            }, {
                                label: 'Pedidos',
                                data: orders,
                                borderColor: '#28a745',
                                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                                borderWidth: 2,
                                fill: false,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            if (this.datasetIndex === 0) {
                                                return value + '€';
                                            }
                                            return value;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            );
        }

        // Función para cargar gráfico de categorías
        function loadCategoriesChart() {
            selectData("c.name as category, COUNT(p.id) as count",
                "products p LEFT JOIN categories c ON p.category = c.id",
                "WHERE p.is_visible = TRUE GROUP BY p.category",
                (res) => {
                    if (categoriesChart) {
                        categoriesChart.destroy();
                    }

                    const data = res.data;
                    const labels = data.map(item => item.category || 'Sin categoría');
                    const counts = data.map(item => parseInt(item.count));

                    const colors = [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                        '#9966FF', '#FF9F40', '#FF6384', '#C9CBCF'
                    ];

                    // Crear gráfico de pastel
                    const ctx = document.getElementById('categories-chart').getContext('2d');
                    categoriesChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: counts,
                                backgroundColor: colors.slice(0, labels.length),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });

                    // Crear leyenda personalizada
                    let legendHtml = '';
                    labels.forEach((label, index) => {
                        legendHtml += `
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge mr-2" style="background-color: ${colors[index]}; width: 15px; height: 15px;"></span>
                            <small>${label}</small>
                            <small class="ml-auto font-weight-bold">${counts[index]}</small>
                        </div>
                    `;
                    });
                    $('#categories-legend').html(legendHtml);
                }
            );
        }

        // Función para cargar productos más vendidos
        function loadTopProducts() {
            selectData("p.name, p.price, p.stock, p.on_sale, p.sale_discound, " +
                "COUNT(oi.id) as sales",
                "products p LEFT JOIN prodToOrder oi ON p.id = oi.productId",
                "WHERE p.is_visible = TRUE GROUP BY p.id ORDER BY sales DESC LIMIT 5",
                (res) => {
                    let html = '';
                    if (res.data.length > 0) {
                        res.data.forEach((product, index) => {
                            const badgeColor = index === 0 ? 'bg-warning' :
                                index === 1 ? 'bg-secondary' :
                                index === 2 ? 'bg-danger' : 'bg-info';

                            html += `
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="badge ${badgeColor} mr-2">${index + 1}</span>
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bold">${product.name}</span>
                                            <small class="text-muted">
                                                ${product.on_sale == '1' ? 
                                                    `<span class="text-success">${product.sale_discound}% OFF</span>` : 
                                                    `<span>${parseFloat(product.price).toFixed(2)}€</span>`
                                                }
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-primary">${product.sales || 0}</span>
                                </td>
                                <td class="text-center">
                                    <span class="${product.stock < 10 ? 'text-danger' : 'text-success'}">
                                        ${product.stock}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge ${product.stock > 0 ? 'badge-success' : 'badge-danger'}">
                                        ${product.stock > 0 ? 'En stock' : 'Agotado'}
                                    </span>
                                </td>
                            </tr>
                        `;
                        });
                    } else {
                        html = `
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="fas fa-box-open mr-2"></i>
                                No hay datos de ventas disponibles
                            </td>
                        </tr>
                    `;
                    }
                    $('#top-products').html(html);
                }
            );
        }

        // Función para cargar pedidos recientes
        function loadRecentOrders() {
            selectData("o.id, c.name as customer_name, o.total_amount, o.status, o.create_at",
                "customers c LEFT JOIN orders o ON c.id = o.customer_id ",
                "ORDER BY o.create_at DESC LIMIT 5",
                (res) => {
                    let html = '';
                    let pendingCount = 0;

                    if (res.data.length > 0) {
                        res.data.forEach(order => {
                            if (order.status === 'pending' || order.status === 'processing') {
                                pendingCount++;
                            }

                            const statusColors = {
                                'completed': 'success',
                                'processing': 'info',
                                'pending': 'warning',
                                'cancelled': 'danger',
                                'shipped': 'primary'
                            };

                            const statusText = {
                                'completed': 'Completado',
                                'processing': 'Procesando',
                                'pending': 'Pendiente',
                                'cancelled': 'Cancelado',
                                'shipped': 'Enviado'
                            };

                            const date = new Date(order.create_at);
                            const formattedDate = date.toLocaleDateString('es-ES', {
                                day: '2-digit',
                                month: '2-digit',
                                hour: '2-digit',
                                minute: '2-digit'
                            });

                            html += `
                            <tr>
                                <td>
                                    <a href="/admin/orders/edit/${order.id}" class="font-weight-bold">
                                        #${order.id.toString().padStart(6, '0')}
                                    </a>
                                </td>
                                <td>${order.customer_name || 'Cliente'}</td>
                                <td class="text-center font-weight-bold">${parseFloat(order.total_amount).toFixed(2)}€</td>
                                <td class="text-center">
                                    <span class="badge badge-${statusColors[order.status] || 'secondary'}">
                                        ${statusText[order.status] || order.status}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <small class="text-muted">${formattedDate}</small>
                                </td>
                            </tr>
                        `;
                        });
                    } else {
                        html = `
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="fas fa-shopping-bag mr-2"></i>
                                No hay pedidos recientes
                            </td>
                        </tr>
                    `;
                    }

                    $('#recent-orders').html(html);
                    $('#pending-orders').html(`${pendingCount} pendientes`);
                }
            );
        }

        // Actualizar datos cada 60 segundos
        setInterval(() => {
            loadDashboardStats();
            loadRecentOrders();
        }, 60000);
    });
</script>
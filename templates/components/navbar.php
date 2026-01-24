<nav class="fixed-top navbar navbar-expand-md navbar-light bg-light" style="min-height: 64px;">
    <div class="container p-0 m-0" style="width: 100%; justify-content:space-between; place-items:center; max-width:100vw;display: flex; flex-direction: row; align-content: center; align-items: center;">
        <a class="navbar-brand" href="/">
            <img src="/assets/img/logo-brand.png" alt="" style="max-height: 38px; padding:0; margin:0;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Inicio</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="/productos" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tienda</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/products">Todos los productos</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <!-- Categorias -->
                        <div id="categories-list">
                            <!-- Las categorías se cargarán aquí dinámicamente -->
                            <li class="text-center py-2">
                                <div class="spinner-border spinner-border-sm text-secondary" role="status">
                                    <span class="visually-hidden">Cargando categorías...</span>
                                </div>
                            </li>
                        </div>
                        <!-- Subcategorías si las tienes -->
                        <div id="subcategories-list" style="display: none;">
                            <!-- Subcategorías podrían cargarse aquí -->
                        </div>
                    </ul>
                </li>
            </ul>

            <section class="d-flex flex-row gap-2">
                <a class="btn btn-outline-dark" href="/orders">
                    <i class="fa-solid fa-circle-user"></i>
                    Mis Compras
                </a>
                <a class="btn btn-outline-dark" href="/cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Carrito
                    <span id="cart-products-quantity" class="badge bg-dark text-white ms-1 rounded-pill"> <?php echo (count($_SESSION["cart_products"]  ?? [])) ?></span>
                </a>
            </section>
        </div>
    </div>
</nav>
<div style="width: 100vw; height:64px; top:0; display:flex;"></div>

<script>
    function upCart() {
        const el = $("#cart-products-quantity");
        var currentValue = Number(el.html())
        el.html(++currentValue)
    }

    // Cache para categorías
    let categoriesCache = null;
    let categoriesLoaded = false;

    // Función para cargar categorías
    function loadCategories() {
        // Si ya tenemos las categorías en caché, usarlas
        if (categoriesCache) {
            renderCategories(categoriesCache);
            return;
        }

        // Mostrar indicador de carga
        $('#categories-list').html(`
            <li class="text-center py-2">
                <div class="spinner-border spinner-border-sm text-secondary" role="status">
                    <span class="visually-hidden">Cargando categorías...</span>
                </div>
            </li>
        `);

        selectData('*', 'categories', 'ORDER BY name ASC', function(response) {
            if (!response.success) {
                showCategoriesError();
                return;
            }

            // Guardar en caché
            categoriesCache = response.data;
            categoriesLoaded = true;

            // Renderizar categorías
            renderCategories(response.data);
        });
    }

    // Función para renderizar categorías
    function renderCategories(categories) {
        const categoriesList = $('#categories-list');

        if (!categories || categories.length === 0) {
            categoriesList.html(`
                <li class="dropdown-item text-muted text-center">
                    <small>No hay categorías</small>
                </li>
            `);
            return;
        }

        // Limpiar el contenedor
        categoriesList.html('');

        // Agregar cada categoría
        categories.forEach(category => {
            // Si la categoría tiene icono o imagen, puedes agregarlo aquí
            if (category.id == 1) return;

            const icon = category.icon ? `<i class="${category.icon} me-2"></i>` : '';
            const categoryItem = `
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="/products/category?id=${category.id}">
                        ${icon}
                        <span>${category.name}</span>
                        ${category.product_count ? `<span class="badge bg-secondary ms-auto">${category.product_count}</span>` : ''}
                    </a>
                </li>
            `;
            categoriesList.append(categoryItem);
        });

    }

    // Función para mostrar error
    function showCategoriesError() {
        $('#categories-list').html(`
            <li class="dropdown-item text-danger text-center">
                <small>Error cargando categorías</small>
                <button class="btn btn-sm btn-link p-0 ms-1" onclick="loadCategories()">
                    <i class="fas fa-redo"></i>
                </button>
            </li>
        `);
    }

    // Recargar categorías cuando se hace clic en el dropdown (opcional)
    $(document).ready(function() {
        // Cargar categorías al cargar la página
        loadCategories();

        // Opcional: recargar al abrir el dropdown
        $('#navbarDropdown').on('click', function() {
            if (!categoriesLoaded) {
                loadCategories();
            }
        });

        // Actualizar automáticamente cada 5 minutos
        setInterval(function() {
            categoriesCache = null;
            categoriesLoaded = false;
        }, 300000); // 5 minutos
    });
</script>
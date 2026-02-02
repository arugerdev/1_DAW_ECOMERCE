<nav class="fixed-top navbar navbar-expand-md bg" style="min-height: 64px;">
    <div class="container p-0 m-0" style="width: 100%; justify-content:space-between; place-items:center; max-width:100vw;display: flex; flex-direction: row; align-content: center; align-items: center;">
        <a class="navbar-brand" href="/">
            <img src="" id="logo-brand" alt="" style="max-height: 38px; padding:0; margin:0;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars" style="color:var(--text-color)"></i>

        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="text nav-link active" aria-current="page" href="/">Inicio</a></li>
                <li class="nav-item dropdown">
                    <a class="text nav-link dropdown-toggle" id="navbarDropdown" href="/productos" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tienda</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/products">Todos los productos</a></li>
                        <section id="categories-container">

                        </section>
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
                    <span id="cart-products-quantity" class="badge bg-dark text-white ms-1 rounded-pill"></span>
                </a>
            </section>
        </div>
    </div>
</nav>
<div style="width: 100vw; height:64px; top:0; display:flex;"></div>

<script>
    updateCartQuantity()

    getShopImage((res) => {
        $('#logo-brand')
            .attr('src', '/uploads/img/shop/' + res.images.filter((p) => p.includes('logo-brand.'))[0])
            .removeClass('d-none');
    })

    function updateCartQuantity() {
        const el = $("#cart-products-quantity");
        loadOrderSummary((data) => {
            el.html(new Set(data.cart.map((i) => i.id)).size)
        })
    }

   
    let categoriesCache = null;
    let categoriesLoaded = false;

   
    function loadCategories() {
       
        if (categoriesCache) {
            renderCategories(categoriesCache);
            return;
        }

        autoLoader(
            selectData('*', 'categories', 'ORDER BY name ASC', () => {}),
            function(res) {
                const response = JSON.parse(res)
                if (!response.success) {
                    showCategoriesError();
                    return;
                }
                if (response.data.length > 1) {
                    $('#categories-container').html(`
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <div id="categories-list">
                            <li class="text-center py-2">
                                <div class="spinner-border spinner-border-sm text-secondary" role="status">
                                    <span class="visually-hidden">Cargando categorías...</span>
                                </div>
                            </li>
                        </div>
                    `)
                }

               
                categoriesCache = response.data;
                categoriesLoaded = true;

               
                renderCategories(response.data);
            }, $('#categories-container'))
    }

   
    function renderCategories(categories) {
        const categoriesList = $('#categories-list');

        if (!categories || categories.length === 0) {
            return;
        }

       
        categoriesList.html('');

       
        categories.forEach(category => {
           
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

   
    $(document).ready(function() {
       
        loadCategories();

       
        $('#navbarDropdown').on('click', function() {
            if (!categoriesLoaded) {
                loadCategories();
            }
        });

       
        setInterval(function() {
            categoriesCache = null;
            categoriesLoaded = false;
        }, 300000);
    });
</script>
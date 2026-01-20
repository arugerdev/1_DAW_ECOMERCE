<?php require 'utils/sessions.php'; ?>



<?php include_once __DIR__ . "/components/navbar.php" ?>


<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder fs-2">Plantilla EviMerce</h1>
            <p class="lead fw-normal text-white-50 mb-0">Esto es el inicio</p>
        </div>
    </div>
</header>

<section class="card p-1 p-lg-4 w-100 min-vh-100">

    <section class="card-header">
        <h1 class="fs-4">Productos Destacados</h1>
    </section>
    <section class="card-body py-0 py-lg-5 w-100">
        <div class="px-0 px-lg-5 mt-5 w-100">
            <div class="product-list-container w-100 row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6">
            </div>
        </div>
    </section>
</section>

<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; <a href="#">EviMerce</a> 2026</p>
    </div>
</footer>


<script defer>
    const container = $('.product-list-container')

    selectData('*', 'products', 'WHERE is_visible = TRUE LIMIT 10', (result) => {
        const data = result.data;

        data.map((result) => {
            $.ajax({
                type: 'GET',
                url: '/templates/components/product-card.php',
                data: {
                    'PROD_DATA': JSON.stringify(result)
                },
                success: (result) => {
                    container.html(container.html() + result)
                }
            })
        })
    });
</script>
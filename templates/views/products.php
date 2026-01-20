
<?php include_once __DIR__ . "/../components/navbar.php" ?>


<section class="card p-0 p-lg-4">

    <section class="card-header">
        <h1 class="fs-4">Catalogo de productos</h1>
    </section>
    <section class="card-body py-2 py-lg-5">
        <form action="simple-results.html">
            <div class="input-group">
                <input type="search" class="form-control form-control-lg" placeholder="Escribe algo para buscar...  ">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-lg btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="mt-4">
            <div class="product-list-container row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6">
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

    selectData('*', 'products', 'WHERE is_visible = TRUE', (result) => {
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
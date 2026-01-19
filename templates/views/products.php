<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/">Plantilla EviMerce</a>
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
                        <li><a class="dropdown-item" href="#!">Productos populares</a></li>
                        <li><a class="dropdown-item" href="#!">Novedades</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                <a class="btn btn-outline-dark" type="submit" href="/cart">
                    <i class="bi-cart-fill me-1"></i>
                    Carrito
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </a>
            </form>
        </div>
    </div>
</nav>

<!-- Section-->
<section class="card p-4">

    <section class="card-header">
        <h1>Catalogo de productos</h1>
    </section>
    <section class="card-body py-5">
        <form action="simple-results.html">
            <div class="input-group">
                <input type="search" class="form-control form-control-lg" placeholder="Type your keywords here">
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
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; <a href="#">EviMerce</a> 2026</p>
    </div>
</footer>



<script defer>
    const container = $('.product-list-container')

    selectData('*', 'products', 'WHERE is_visible = TRUE', (result) => {
        const data = result.data;
        console.log(result)

        data.map((result) => {
            console.log(result)
            $.ajax({
                type: 'GET',
                url: '/templates/components/product-card.php',
                data: {
                    'PROD_DATA': JSON.stringify(result)
                },
                success: (result) => {
                    console.log(result)
                    container.html(container.html() + result)
                }
            })
            console.log(result)
        })
        console.log(data)
    });
</script>
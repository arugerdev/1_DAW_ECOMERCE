<?php require __DIR__ . '/../../utils/sessions.php' ?>

<nav class="fixed-top navbar navbar-expand-lg navbar-light bg-light" style="min-height: 64px;">
    <div class="container p-0 m-0" style="width: 100%; justify-content:space-between; place-items:center; max-width:100vw;display: flex; flex-direction: row; align-content: center; align-items: center;">
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
                    <i class="fa-solid fa-cart-shopping"></i>
                    Carrito
                    <span id="cart-products-quantity" class="badge bg-dark text-white ms-1 rounded-pill"> <?php echo (count($_SESSION["cart_products"]  ?? [])) ?></span>
                </a>
            </form>
        </div>
    </div>

</nav>
<div style="width: 100vw; height:64px; top:0; display:flex;"></div>
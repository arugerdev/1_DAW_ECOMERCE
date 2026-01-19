<?php
// Add shopping cart 

// $option = $_REQUEST["action"];

// switch ($option) {
//     case "add":
//         if (!empty($_POST["quantity"])) {
//             // $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . . "'");
//             // $itemArray = array($productByCode[0]["code"] => array('name' => $productByCode[0]["name"], 'code' => $productByCode[0]["code"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"], 'image' => $productByCode[0]["image"]));

//             if (!empty($_SESSION["cart_item"])) {
//                 if (in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
//                     foreach ($_SESSION["cart_item"] as $k => $v) {
//                         if ($productByCode[0]["code"] == $k) {
//                             if (empty($_SESSION["cart_item"][$k]["quantity"])) {
//                                 $_SESSION["cart_item"][$k]["quantity"] = 0;
//                             }
//                             $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
//                         }
//                     }
//                 } else {
//                     $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
//                 }
//             } else {
//                 $_SESSION["cart_item"] = $itemArray;
//             }
//         }
//         break;
// }
?>

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
        <h1>Carrito de compra</h1>
    </section>
    <section class="card-body py-5">

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


<!-- 
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
</script> -->
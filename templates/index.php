<?php require 'utils/sessions.php'; ?>
<?php include_once __DIR__ . "/components/navbar.php" ?>

<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/utils/sessions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

if (!isset($_SESSION["cart_products"]) || gettype($_SESSION["cart_products"]) != "array") {
    $_SESSION["cart_products"] = [];
}

$groupedProducts = [];
foreach ($_SESSION["cart_products"] as $product) {
    $id = $product['id'];
    if (!isset($groupedProducts[$id])) {
        $groupedProducts[$id] = [
            'product' => $product,
            'quantity' => 0
        ];
    }
    $groupedProducts[$id]['quantity'] += 1;
}

$validatedCart = [];

foreach ($groupedProducts as $id => $data) {
    $query = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    $productData = $query->fetch(PDO::FETCH_ASSOC);

    if ($productData && $productData['is_visible'] == TRUE) {
        $updatedProduct = $data['product'];
        $updatedProduct['price'] = $productData['price'];
        $updatedProduct['on_sale'] = $productData['on_sale'];
        $updatedProduct['sale_discound'] = $productData['sale_discound'];

        for ($i = 0; $i < $data['quantity']; $i++) {
            $validatedCart[] = $updatedProduct;
        }
    }
}

$_SESSION["cart_products"] = $validatedCart;
?>

<header class="bg-dark p-0 m-0" style="z-index:-1; min-height:186px; height:186px; display: flex; place-items:center; justify-content:center">
    <div class="px-0 px-lg-0 m-0" style="width: 100%; height:100%">
        <div class="text-center text-white" style="width: 100%; height:100%; position: relative; display:flex; place-items:center; justify-content:center; flex-direction:row;">
            <img src="/assets/img/banner.jpg" style="position: absolute; z-index:0; opacity:0.6; object-fit:cover; width:100%; height:100%;" alt="">
            <!-- <img src="/assets/img/logo.png" style="z-index:1; padding-left: 2rem;" width="128px"  alt=""> -->

            <div style="padding-left: 2rem; display:flex; flex-direction:column; justify-content:start; text-align:start; width:100%">
                <h1 class="display-4 fw-bolder fs-2" style="z-index:1; ">ElectricMer</h1>
                <p class="lead fw-normal text-white-50 mb-0" style="z-index:1">Electronica y electricidad de calidad al mejor precio</p>
            </div>
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

<?php include 'templates/components/footer.php' ?>

<script defer>
    const container = $('.product-list-container')

    selectData('p.*, COUNT(oi.id) as sales', 'products p LEFT JOIN prodToOrder oi ON p.id = oi.productId', 'WHERE is_visible = TRUE GROUP BY p.id ORDER BY sales DESC LIMIT 12', (result) => {
        const data = result.data;
        console.log(data)
        data.map((result) => {
            $.ajax({
                type: 'GET',
                url: '/templates/components/product-card.php',
                async: false,
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
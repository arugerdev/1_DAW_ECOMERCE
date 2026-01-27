<?php
include_once __DIR__ . "/components/navbar.php";

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

<header class="bg-black p-0 m-0" style="z-index:-1; min-height:186px; height:186px; display: flex; place-items:center; justify-content:center">
    <div class="px-0 px-lg-0 m-0" style="width: 100%; height:100%">
        <div class="text-center text-white" style="width: 100%; height:100%; position: relative; display:flex; place-items:center; justify-content:center; flex-direction:row;">
            <img src="/uploads/img/shop/banner.png" id="banner-img" style="position: absolute; z-index:0; opacity:0.7; object-fit:cover; width:100%; height:100%;" alt="">
            <!-- <img src="/assets/img/logo.png" style="z-index:1; padding-left: 2rem;" width="128px"  alt=""> -->

            <div style="padding-left: 2rem; display:flex; flex-direction:column; justify-content:start; text-align:start; width:100%">
                <h1 class="display-4 fw-bolder fs-2 text-white" style="z-index:1; "><?php echo SHOP_DATA->name ?></h1>
                <p class="lead fw-normal text-white-50 mb-0" style="z-index:1"><?php echo SHOP_DATA->slogan ?></p>
            </div>
        </div>
    </div>
</header>

<?php
if (SHOP_DATA->description) {
    echo "<section class='p-1 p-lg-4 bg'><h1>Sobre nosotros</h1><p>" . SHOP_DATA->description . "</p></section>";
}
?>

<section class=" p-1 p-lg-4 w-100 bg" id="grant-container">


</section>

<?php include 'templates/components/footer.php' ?>

<script defer>
    getShopImage((res) => {
        $('#banner-img')
            .attr('src', '/uploads/img/shop/' + res.images.filter((p) => p.includes('banner.'))[0])
            .removeClass('d-none');
    })


    selectData('p.*, COUNT(oi.id) as sales', 'products p LEFT JOIN prodToOrder oi ON p.id = oi.productId', 'WHERE is_visible = TRUE GROUP BY p.id ORDER BY sales DESC LIMIT 12', (result) => {
        const data = result.data;
        if (data.length > 0) {
            $('#grant-container').html(
                "<h1 class='fs-4'>Productos Destacados</h1> <div class = 'px-0 px-lg-5 mt-5 w-100' ><div class = 'product-list-container w-100 row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6' ></div> </div>"
            )
            const container = $('.product-list-container')

            data.map((result) => {
                $.ajax({
                    type: 'GET',
                    url: '/templates/components/product-card.php',
                    async: false,
                    data: {
                        'PROD_DATA': JSON.stringify(result),
                        'CURRENCY_SYMBOL': '<?php echo SHOP_DATA->currency_symbol ?>'

                    },
                    success: (result) => {
                        container.html(container.html() + result)
                    }
                })
            })
            return;
        }

        $('#grant-container').html(`
        <section class="d-flex flex-column justify-center" style="align-items: center;justify-content: center; min-height: 30vh">
            <h1 class='fs-2'>No hay productos actualmente</h1>
        </section>
        `)
    });
</script>
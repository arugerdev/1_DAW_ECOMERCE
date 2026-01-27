<?php include_once __DIR__ . "/../components/navbar.php" ?>
<section class="bg p-0 p-lg-4">

    <h1 class="fs-2">Catalogo de productos</h1>
    <section class="card-body py-2 py-lg-5" style="min-height: 75.7vh;">
        <div class="input-group">
            <input type="search" id="search-input" class="bg text form-control form-control-lg" placeholder="Escribe algo para buscar...  ">
            <div class="input-group-append">
                <button type="submit" class="btn btn-lg btn-default">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <div class="mt-4">
            <div class="product-list-container row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6">
            </div>
        </div>
    </section>
</section>

<?php include 'templates/components/footer.php' ?>



<script defer>
    const container = $('.product-list-container')
    var searchValue = ''

    function getContent() {

        selectData('p.*, COUNT(oi.id) as sales', 'products p LEFT JOIN prodToOrder oi ON p.id = oi.productId', `WHERE is_visible = TRUE ${(searchValue != null && searchValue != '') ? `AND ( p.name LIKE '${searchValue}' OR p.short_description LIKE '${searchValue}')` : '' }  GROUP BY p.id ORDER BY sales DESC`, (result) => {
            const data = result.data;
            container.empty()
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
        });

    }

    getContent()

    $('#search-input').on('input', (evt) => {
        searchValue = "%" + evt.target.value + "%"
        getContent()

    })
</script>
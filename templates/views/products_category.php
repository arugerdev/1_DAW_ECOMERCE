<?php

include_once __DIR__ . "/../components/navbar.php";

$id = $_GET['id'];

$_REQUEST["select"] = "*";
$_REQUEST["table"] = "categories";
$_REQUEST["extra"] = "WHERE id = $id";

$recibe = json_decode((string) selectData());

$data = $recibe->data[0];

?>
<section class="bg card p-0 p-lg-4">

    <section class="card-header">
        <h1 class="fs-4" id="categoryTitle"><?php echo $data->name ?></h1>
    </section>
    <section class="card-body py-2 py-lg-5" style="min-height: 75.7vh;">
        <form action="simple-results.html">
            <div class="input-group">
                <input type="search" id="search-input" class="text bg form-control form-control-lg" placeholder="Escribe algo para buscar...  ">
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

<?php include 'templates/components/footer.php' ?>

<script defer>
    const container = $('.product-list-container')

    var searchValue = ''

    function getContent() {
        selectData('*', 'products', `WHERE is_visible = TRUE AND category = <?php echo $data->id ?> ${(searchValue != null && searchValue != '') ? `AND ( name LIKE '${searchValue}' OR short_description LIKE '${searchValue}')` : '' }`, (result) => {
            const data = result.data;
            container.empty()
            data.map((result) => {
                $.ajax({
                    type: 'GET',
                    url: '/templates/components/product-card.php',
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
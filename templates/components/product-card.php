<?php
$data = json_decode($_GET["PROD_DATA"]);
$SHOP_DATA = $_GET['SHOP_DATA'];
$tax = $SHOP_DATA['tax_percent'];
?>
<div class="col">
    <div class="bg text card pt-4" style="filter: brightness(110%); display: flex; flex-direction:column; place-items:center; justify-content: center; height:95%">
        <a href="/product?id=<?php echo $data->id ?>" style="display: flex; flex-direction:column; place-items:center; justify-content:center; text-align:start; width: 100%; height: 100%;" class="p-0 m-0">

            <?php if ($data->on_sale == 1): ?>
                <div class="badge bg-warning position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
            <?php endif ?>
            <?php
            if (is_dir($_SERVER['DOCUMENT_ROOT'] . "/uploads/img/products/$data->id/")) {
                $files = array_diff(scandir($_SERVER['DOCUMENT_ROOT'] . "/uploads/img/products/$data->id/"), array('.', '..'));
                if (!$files) {
                    $imgSrc = "https://placehold.co/128";
                } else {
                    $imgSrc = "/uploads/img/products/$data->id/" . array_values($files)[0];
                }
            } else {
                $imgSrc = "https://placehold.co/128";
            }

            echo "<img class=\"card-img-top\" src=\"$imgSrc\" alt=\"...\"  onerror=\"this.onerror=null; this.src='https://placehold.co/128'\" style=\" max-width:128px; max-height: 128px; aspect-ratio:1/1; object-fit:contain;\" />";
            ?>
            <div class="card-body p-0 px-2" style="width: 100%;">
                <div class="text-start text-secondary w-100">
                    <h5 class="text-weight-bold text-md p-0 m-0"><?php echo $data->name ?></h5>
                    <h6 class="text-weight-light text-xs p-0 m-0" style="text-overflow: ellipsis; overflow: hidden;white-space: unset;-webkit-line-clamp: 3;display: -webkit-box;-webkit-box-orient: vertical; opacity:0.75;"><?php echo $data->short_description ?></h6>

                    <?php if ($data->on_sale == 1): ?>
                        <span class="text-muted text-decoration-line-through p-0 m-0 text-xs"><?php echo number_format($data->price + ($data->price * $tax / 100), 2) ?> <?php echo $SHOP_DATA['currency_symbol'] ?></span>
                        <p class="p-0 m-0 text-md price-contrast" data-originalcolor="#28a745" data-color="<?php echo $SHOP_DATA['secondary_color'] ?>"><?php echo number_format($data->price + (($data->price * $tax) / 100) - ($data->price * $data->sale_discound / 100), 2)  ?> <?php echo $SHOP_DATA['currency_symbol'] ?></p>
                    <?php endif ?>

                    <?php if (!$data->on_sale == 1): ?>
                        <br>
                        <p class="p-0 m-0 text-md price-contrast" data-originalcolor="#28a745" data-color="<?php echo $SHOP_DATA['secondary_color'] ?>"><?php echo number_format($data->price + (($data->price * $tax) / 100), 2) ?> <?php echo $SHOP_DATA['currency_symbol'] ?></p>
                    <?php endif ?>
                </div>

            </div>
        </a>
        <div class="card-footer border-top-0 bg-transparent p-2" style="width:100%;justify-content: start; place-items:start;">
            <div class="text-center text-xs">
                <a id="add-to-cart-<?php echo $data->id ?>" class="<?php echo ($data->stock <= 0) ? 'btn-disabled btn-danger disabled' : '' ?> btn btn-outline-primary text-xs" style="display:flex; flex-direction:row; gap:4px; place-items:center; justify-content:center; text-align:center;">

                    <?php echo ($data->stock > 0) ? '<i class="fa-solid fa-cart-arrow-down"></i>' : '';
                    ?>
                    <?php echo ($data->stock <= 0) ? '<p class="p-0 m-0 price-contrast" data-originalcolor="#dc3545" data-color="' . $SHOP_DATA['secondary_color'] . '" >Fuera de stock</p>' : '' ?>
                </a>
            </div>
        </div>
    </div>
</div>

<script defer>
    $("#add-to-cart-<?php echo $data->id ?>").on("click", (evnt) => {
        const prodData = <?php echo json_encode($data) ?>;
        loadOrderSummary((res) => {
            if ((res.cart.filter((p) => p.id == prodData.id).length + 1) <= prodData.stock) {
                addToCart(prodData, (data) => {
                    updateCartQuantity()
                })
            }
        })
    })
    updateContrast();
</script>
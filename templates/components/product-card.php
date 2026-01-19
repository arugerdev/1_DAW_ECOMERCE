<?php
$data = json_decode($_GET["PROD_DATA"]);
?>


<div class="col">
    <div>
        <a style="width: 100%; height:100%; display:flex; flex-direction:column; justify-content:center; place-items:center;" href="/product?id=<?php echo $data->id ?>">
            <div class="card pt-4" style="display: flex; flex-direction:column; place-items:center; justify-content: center;">
                <?php if ($data->on_sale == 1): ?>
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                <?php endif ?>
                <?php
                echo "<img class=\"card-img-top\" src=\"/uploads/img/products/$data->id/0.png\" alt=\"...\"  onerror=\"this.onerror=null; this.src='/assets/img/logo.png'\" style=\"max-width:128px; max-height: 128px; aspect-ratio:1/1; object-fit:contain;\" />";
                ?>
                <div class="card-body p-0 px-2 w-100">
                    <div class="text-start text-secondary w-100">
                        <h5 class="text-weight-bold text-md p-0 m-0"><?php echo $data->name ?></h5>
                        <h6 class="text-weight-light text-xs p-0 m-0 "><?php echo $data->short_description ?></h6>

                        <?php if ($data->on_sale == 1): ?>
                            <span class="text-muted text-decoration-line-through p-0 m-0"><?php echo $data->price ?> €</span>
                            <p class="text-success p-0 m-0"><?php echo number_format($data->price - ($data->price * $data->sale_discound / 100), 2)  ?> €</p>
                        <?php endif ?>

                        <?php if (!$data->on_sale == 1): ?>
                            <p class="text-success p-0 m-0"><?php echo number_format($data->price, 2) ?> €</p>
                        <?php endif ?>
                    </div>

                </div>
                <div class="card-footer border-top-0 bg-transparent p-2" style="width:100%;justify-content: start; place-items:start;">
                    <div class="text-center text-xs">
                        <a class="btn btn-outline btn-primary text-xs" href="#">
                            <i class="fa-solid fa-cart-arrow-down"></i>
                        </a>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<?php
$data = json_decode($_GET["PROD_DATA"]);
?>


<div class="col mb-5">
    <a href="/product?id=<?php echo $data->id ?>">
        <div class="card h-100">
            <?php if ($data->onSale == 1): ?>
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
            <?php endif ?>

            <img class="card-img-top" src="/assets/img/logo.png" alt="..." />
            <div class="card-body p-4">
                <div class="text-center text-secondary">
                    <h5 class="text-weight-bold"><?php echo $data->name ?></h5>
                    <h6 class="text-weight-light text-xs "><?php echo $data->shortDescription ?></h6>

                    <?php if ($data->onSale == 1): ?>
                        <span class="text-muted text-decoration-line-through"><?php echo $data->price ?> €</span>
                        <p class="text-success"><?php echo ($data->price - ($data->price * $data->saleDiscound / 100)) ?> €</p>
                    <?php endif ?>

                    <?php if (!$data->onSale == 1): ?>
                        <p class="text-success"><?php echo ($data->price) ?> €</p>
                    <?php endif ?>
                </div>
            </div>
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Añadir al carrito</a></div>
            </div>
        </div>
    </a>
</div>
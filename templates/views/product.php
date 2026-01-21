<?php
require __DIR__ . "/../../utils/db_utils.php";

$id = $_GET['id'];

$_REQUEST["select"] = "*";
$_REQUEST["table"] = "products";
$_REQUEST["extra"] = "WHERE id = $id";

$recibe = json_decode((string) selectData());

$data = $recibe->data[0];

?>

<?php include __DIR__ . "/../components/navbar.php"; ?>

<div class="card card-solid">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none"><?php $data->name ?></h3>
                <div class="col-12" style="place-items:center; justify-content:center; display:flex;">
                    <?php
                    echo '<img src="/uploads/img/products/' . $id . '/0.png" onerror="this.onerror=null; this.src=\'https://placehold.co/512\'" style=" max-width: 512px; max-height: 512px; aspect-ratio: 1/1; object-fit: contain;" class="product-image" alt="Product Image">'
                    ?>
                </div>
                <div class="col-12 product-image-thumbs" style="display: flex; place-items:center; justify-content:center">
                    <?php

                    $dir =  $_SERVER['DOCUMENT_ROOT'] . "/uploads/img/products/" . $id . "/";
                    $files = array_diff(scandir($dir), array('.', '..'));


                    foreach ($files as $fil) {
                        echo '
                        <div class="product-image-thumb cursor-pointer">
                        <img src="/uploads/img/products/' . $id  . '/' . $fil . '" onerror="this.onerror=null; this.src=\'https://placehold.co/100\'" alt="Product Image">
                        </div>
                        ';
                    }

                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3"><?php echo $data->name; ?></h3>
                <p><?php echo $data->short_description ?></p>

                <hr>
                <!-- <h4>Colores permitidos</h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-default text-center active">
                        <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked="">
                        Green
                        <br>
                        <i class="fas fa-circle text-green"></i>
                    </label>
                    <label class="btn btn-default text-center">
                        <input type="radio" name="color_option" id="color_option_a2" autocomplete="off">
                        Blue
                        <br>
                        <i class="fas fa-circle text-blue"></i>
                    </label>
                    <label class="btn btn-default text-center">
                        <input type="radio" name="color_option" id="color_option_a3" autocomplete="off">
                        Purple
                        <br>
                        <i class="fas fa-circle text-purple"></i>
                    </label>
                    <label class="btn btn-default text-center">
                        <input type="radio" name="color_option" id="color_option_a4" autocomplete="off">
                        Red
                        <br>
                        <i class="fas fa-circle text-red"></i>
                    </label>
                    <label class="btn btn-default text-center">
                        <input type="radio" name="color_option" id="color_option_a5" autocomplete="off">
                        Orange
                        <br>
                        <i class="fas fa-circle text-orange"></i>
                    </label>
                </div>

                <h4 class="mt-3">Talla <small>Por favor selecciona una talla</small></h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-default text-center">
                        <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                        <span class="text-md">S</span>
                        <br>
                        Small
                    </label>
                    <label class="btn btn-default text-center">
                        <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
                        <span class="text-md">M</span>
                        <br>
                        Medium
                    </label>
                    <label class="btn btn-default text-center">
                        <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
                        <span class="text-md">L</span>
                        <br>
                        Large
                    </label>
                    <label class="btn btn-default text-center">
                        <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                        <span class="text-md">XL</span>
                        <br>
                        Xtra-Large
                    </label>
                </div> -->

                <div class="text-success py-0 px-0 mt-4">

                    <?php

                    echo '<h2 class="mb-0 '  . ($data->on_sale ? 'text-md text-danger danger color-danger" style="text-decoration: line-through;"' : 'text-success success color-success " ') . '>' . number_format($data->price, 2) . ' €</h2>' .
                        ($data->on_sale ? ('<h2 class="mb-0 text-xl text-success success color-success" >' . number_format($data->price - ($data->price * $data->sale_discound / 100), 2) . ' €</h2>') : '') .
                        '<h4 class="mt-0">
                <small>IVA Incl.</small>
                </h4>
                '
                    ?>
                </div>

                <div class="mt-4">
                    <button id="add-to-cart" <?php echo ($data->stock <= 0) ? 'disabled' : '' ?> class=" <?php echo ($data->stock <= 0) ? 'btn-secondary btn-light disabled text-danger' : '' ?> btn btn-primary btn-lg btn-flat rounded">
                        <i class="fas fa-cart-plus fa-lg mr-2"></i>

                        <?php echo ($data->stock <= 0) ? 'Fuera de stock' : ' Añadir al carrito' ?>
                    </button>

                </div>

                <div class="mt-4 product-share">
                    <a href="#" class="text-gray">
                        <i class="fab fa-facebook-square fa-2x"></i>
                    </a>
                    <a href="#" class="text-gray">
                        <i class="fab fa-twitter-square fa-2x"></i>
                    </a>
                    <a href="#" class="text-gray">
                        <i class="fas fa-envelope-square fa-2x"></i>
                    </a>
                    <a href="#" class="text-gray">
                        <i class="fas fa-rss-square fa-2x"></i>
                    </a>
                </div>

            </div>
        </div>
        <div class="row mt-4">
            <h2>Descripcion</h2>
            <p style="max-width: 200ch;" class="tab-pane p-4 text-justify fade active show" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><?php echo $data->description ?></p>
        </div>
    </div>

</div>


<script>
    const mainImg = $(".product-image")
    const imgs = $(".product-image-thumb")

    imgs.on('click', (event) => {
        mainImg.attr("src", event.target.src);
    })


    $("#add-to-cart").on("click", (evnt) => {
        console.log(evnt)
        addToCart(<?php echo json_encode($data) ?>, (data) => {
            console.log(data)
            $(document).Toasts('create', {
                position: "bottomRight",
                title: 'Añadido correctamente al carrito',
                class: "toasts-success text-succes color-success success bg-success",
                showHideTransition: 'slide',
                icon: 'success'
            })

        })
    })
</script>
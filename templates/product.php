<?php

use function PHPSTORM_META\type;

$id = $_GET['id'];

$_REQUEST["select"] = "*";
$_REQUEST["table"] = "products";
$_REQUEST["extra"] = "WHERE id = $id";

$recibe = json_decode((string) selectData());

$data = $recibe->data[0];

?>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/">Plantilla EviMerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Inicio</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tienda</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Todos los productos</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="#!">Productos populares</a></li>
                        <li><a class="dropdown-item" href="#!">Novedades</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Carrito
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </form>
        </div>
    </div>
</nav>
<div class="card card-solid">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none"><?php $data->name ?></h3>
                <div class="col-12">
                    <img src="../../dist/img/prod-1.jpg" class="product-image" alt="Product Image">
                </div>
                <div class="col-12 product-image-thumbs">
                    <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div>
                    <div class="product-image-thumb"><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
                    <div class="product-image-thumb"><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
                    <div class="product-image-thumb"><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
                    <div class="product-image-thumb"><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3"><?php echo $data->name; ?></h3>
                <p><?php echo $data->shortDescription ?></p>

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
                    <h2 class="mb-0">
                        <?php echo $data->price ?> €
                    </h2>
                    <h4 class="mt-0">
                        <small>IVA Incl.</small>
                    </h4>
                </div>

                <div class="mt-4">
                    <div class="btn btn-primary btn-lg btn-flat rounded">
                        <i class="fas fa-cart-plus fa-lg mr-2"></i>
                        Añadir al carrito
                    </div>

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
            <p style="max-width: 100ch;" class="tab-pane fade active show" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><?php echo $data->description ?></p>
        </div>
    </div>
    <!-- /.card-body -->
</div>
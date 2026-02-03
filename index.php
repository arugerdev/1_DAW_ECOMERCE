<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/sessions.php';

include_once "./utils/router.php";

// error_reporting(0);
// ini_set('display_errors', 'Off');

require_once './utils/db_utils.php';

define("SHOP_DATA", json_decode(getShopData())->data[0]);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/uploads/img/shop/logo.png" type="image/x-icon">

    <?php
    echo ("<title>" . (is_admin_route() ? "EviMerce - Admin Panel" : SHOP_DATA->name) . "</title>")
    ?>
    <link rel="stylesheet" href="/assets/css/index.css">

    <?php include "./includes/dependencies.php"; ?>
    <?php include "./utils/elementsGenerator.php"; ?>
    <script src="/assets/js/cart_utils.js"></script>
    <script src="/assets/js/db_utils.js"></script>
    <script src="/assets/js/auth_utils.js"></script>
    <script src="/assets/js/images_utils.js"></script>
    <script src="/assets/js/utils.js"></script>
    <script src="/assets/js/elements_generator.js"></script>

    </script>
</head>


<?php if (!is_admin_route()): ?>

    <script>
        $(document).ready(function() {
            updateContrast();
        });
    </script>

    <style>
        :root {
            --primary-color: <?php echo SHOP_DATA->primary_color ?>;
            --accent-color: <?php echo SHOP_DATA->accent_color ?>;
            --secondary-color: <?php echo SHOP_DATA->secondary_color ?>;
            --bg-color: <?php echo SHOP_DATA->background_color ?>;
            --text-color: <?php echo SHOP_DATA->text_color ?>;

            /* Colores base */
            --bs-primary: <?php echo SHOP_DATA->primary_color ?>;
            --bs-secondary: <?php echo SHOP_DATA->secondary_color ?>;
            --bs-success: <?php echo SHOP_DATA->accent_color ?>;
            --bs-body-bg: <?php echo SHOP_DATA->background_color ?>;
            --bs-body-color: <?php echo SHOP_DATA->text_color ?>;

            /* RGB (OBLIGATORIO para botones, outlines, hovers, etc) */
            --bs-primary-rgb: <?php echo implode(',', sscanf(SHOP_DATA->primary_color, "#%02x%02x%02x")); ?>;
            --bs-secondary-rgb: <?php echo implode(',', sscanf(SHOP_DATA->secondary_color, "#%02x%02x%02x")); ?>;
            --bs-success-rgb: <?php echo implode(',', sscanf(SHOP_DATA->accent_color, "#%02x%02x%02x")); ?>;
        }

        .bg {
            background-color: var(--bg-color);
        }

        .text-bg {
            color: var(--bg-color);
        }

        p,
        a,
        button,
        li,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .text,
        .nav-link {
            color: var(--text-color);
        }

        .nav-link,
        a {
            color: var(--text-color);
        }

        .nav-link:hover,
        .nav-link:focus,
        a:hover {
            color: var(--accent-color);
        }

        .dropdown-item {
            color: var(--text-color);
        }

        .dropdown-item:active {
            background-color: var(--primary-color);

        }

        .btn,
        .btn-outline-dark,
        button {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--bg-color);
        }

        .btn:hover,
        .btn-outline-dark:hover,
        button:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--bg-color);

        }

        .navbar-toggler:hover {
            background-color: transparent;
            border-color: transparent;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active,
        .nav-tabs>li>.active {
            background-color: var(--accent-color);
            border-color: var(--primary-color);
            border-radius: 4px;
        }

        .nav-tabs {
            background-color: transparent;
            border-color: var(--primary-color);
            border-radius: 4px;

        }

        .nav-tabs>li,
        .nav-tabs>li>button {
            background-color: var(--primary-color);
            color: var(--bg-color);

        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }


        .text-danger {
            color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #e7707c;
            border-color: #e7707c;
        }

        .dropdown-menu,
        .card {
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .form-control,
        input {
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .form-check-input:checked {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }
    </style>
<?php endif ?>

<body class="sidebar-mini sidebar-collapse layout-fixed bg">
    <main>
        <?php
        include "./templates/routes.php";
        ?>
    </main>
    </section>

</body>



</html>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/sessions.php';

include_once "./utils/router.php";

// error_reporting(0);
// ini_set('display_errors', 'Off');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <?php

    echo ("<title>" . (is_admin_route() ? "EviMerce - Admin Panel" : "ElectricMer") . "</title>")
    ?>
    <link rel="stylesheet" href="/assets/css/index.css">

    <?php include "./includes/dependencies.php"; ?>
    <?php include "./utils/elementsGenerator.php"; ?>
    <script src="/assets/js/cart_utils.js"></script>
    <script src="/assets/js/db_utils.js"></script>
    <script src="/assets/js/auth_utils.js"></script>
    <script src="/assets/js/images_utils.js"></script>
    <script src="/assets/js/utils.js"></script>

    </script>
</head>

<body class="sidebar-mini sidebar-collapse layout-fixed ">
    <main>
        <?php
        include "./templates/routes.php";
        ?>
    </main>
    </section>

</body>

</html>
<?php
ini_set('display_errors', 'Off');


include "./utils/router.php";
// include "./utils/db_utils.php";

$option = $_POST['option'];

if ($option == "?") {

    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <?php

    echo ("<title>" . (is_admin_route() ? "EviMerce - Admin Panel" : "EviMerce") . "</title>")
    ?>
    <link rel="stylesheet" href="/assets/css/index.css">

    <?php include "./includes/dependencies.php"; ?>

    <script src="/assets/js/cart_utils.js"></script>
    <script src="/assets/js/db_utils.js"></script>
    <script src="/assets/js/utils.js"></script>

    </script>
</head>

<body class="sidebar-mini layout-fixed sidebar-closed sidebar-collapse">


    <main>
        <?php
        include "./templates/routes.php";
        ?>
    </main>
    </section>

</body>

</html>
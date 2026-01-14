<?php
ini_set('display_errors', 'Off');

// DEBUG
$_REQUEST["user"] = (object) ['is_authenticated' => true];
// 


include "./utils/router.php";
include "./utils/db_utils.php";

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
    <title>EviMerce</title>

    <link rel="stylesheet" href="./assets/css/index.css">
    <script>
        <?php
        include "./assets/plugins/jquery-3.7.1.min.js";
        ?>
    </script>
    <script>
        <?php
        include "./assets/js/db_utils.js";
        
        include "./assets/js/utils.js";
        ?>
    </script>
</head>

<body>
    <?php
    if ($_REQUEST["user"]->is_authenticated) {
        include "./templates/admin/navbar.php";
    }
    ?>

    <main>
        <?php
        // if ($_REQUEST["user"]->is_authenticated) {
        //     include "./templates/admin_routes.php";
        // } else {
        // include "./templates/routes.php";
        // }
        include "./templates/routes.php";
        ?>
    </main>


</body>

</html>
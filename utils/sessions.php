    <?php

    session_start();

    $hora = time(); 
    $duracion = 7000;

    if (isset($_SESSION['last_activity']) && ($hora - $_SESSION['last_activity']) > $duracion) {
        session_unset();
        session_destroy();
        $_SESSION['state'] = 'expired';
    }

    $_SESSION['last_activity'] = $hora;
    ?>
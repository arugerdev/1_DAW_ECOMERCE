<?php

ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',        // MUY IMPORTANTE en local
    'secure' => false,     // HTTP local
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

$timeout = 7000;

if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $timeout) {
    session_destroy();
    session_start();
    $_SESSION['state'] = 'expired';
}

$_SESSION['last_activity'] = time();

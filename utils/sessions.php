<?php

ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',       
    'secure' => false,    
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

$timeout = 7000;

// Nueva configuración para tokens en BD
define('SESSION_TOKEN_EXPIRE_DAYS', 7);
define('SESSION_TOKEN_NAME', 'db_auth_token');

// Función para generar token seguro
function generateSessionToken() {
    return bin2hex(random_bytes(32));
}

// Función para crear y almacenar token en BD
function createDatabaseAuthSession($userId) {
    require $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";
    
   
    $token = generateSessionToken();
    
   
    $expiresAt = date('Y-m-d H:i:s', time() + (SESSION_TOKEN_EXPIRE_DAYS * 24 * 3600));
    
    try {
       
        $query = $pdo->prepare("
            INSERT INTO user_sessions 
            (user_id, token, expires_at, created_at) 
            VALUES (?, ?, ?, NOW())
        ");
        
        $query->execute([$userId, $token, $expiresAt]);
        
       
        setcookie(
            SESSION_TOKEN_NAME,
            $token,
            [
                'expires' => time() + (SESSION_TOKEN_EXPIRE_DAYS * 24 * 3600),
                'path' => '/',
                'domain' => '',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Lax'
            ]
        );
        
        return $token;
    } catch (PDOException $e) {
        error_log("Error creando sesión en BD: " . $e->getMessage());
        return false;
    }
}

// Función para validar sesión basada en token de BD
function validateDatabaseSession() {
   
    if (!isset($_COOKIE[SESSION_TOKEN_NAME])) {
        return false;
    }
    
    $token = $_COOKIE[SESSION_TOKEN_NAME];
    
   
    if (isset($_SESSION['user']) && $_SESSION['state'] == 'authenticated') {
       
        $_SESSION['last_activity'] = time();
        return true;
    }
    
   
    require $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";
    
    try {
       
        $query = $pdo->prepare("
            SELECT us.*, u.username 
            FROM user_sessions us
            JOIN users u ON us.user_id = u.id
            WHERE us.token = ? 
            AND us.expires_at > NOW()
            AND us.is_active = 1
        ");
        
        $query->execute([$token]);
        $sessionData = $query->fetch(PDO::FETCH_OBJ);
        
        if (!$sessionData) {
           
            setcookie(SESSION_TOKEN_NAME, '', time() - 3600, '/');
            return false;
        }
        
       
        $newExpiresAt = date('Y-m-d H:i:s', time() + (SESSION_TOKEN_EXPIRE_DAYS * 24 * 3600));
        $updateQuery = $pdo->prepare("
            UPDATE user_sessions 
            SET expires_at = ?, last_activity = NOW() 
            WHERE id = ?
        ");
        
        $updateQuery->execute([$newExpiresAt, $sessionData->id]);
        
       
        $_SESSION['user'] = $sessionData->username;
        $_SESSION['user_id'] = $sessionData->user_id;
        $_SESSION['state'] = 'authenticated';
        $_SESSION['last_activity'] = time();
        $_SESSION['session_type'] = 'database_token';
        
        return true;
    } catch (PDOException $e) {
        error_log("Error validando sesión: " . $e->getMessage());
        return false;
    }
}

// Función para cerrar sesión (token y sesión PHP)
function logoutDatabaseSession() {
   
    if (isset($_COOKIE[SESSION_TOKEN_NAME])) {
        $token = $_COOKIE[SESSION_TOKEN_NAME];
        
        require $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";
        
        try {
            $query = $pdo->prepare("
                UPDATE user_sessions 
                SET is_active = 0, expires_at = NOW() 
                WHERE token = ?
            ");
            
            $query->execute([$token]);
        } catch (PDOException $e) {
            error_log("Error cerrando sesión BD: " . $e->getMessage());
        }
        
       
        setcookie(SESSION_TOKEN_NAME, '', time() - 3600, '/');
    }
    
   
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();
}

// Middleware de verificación (mantiene tu timeout)
function checkSessionActivity() {
    global $timeout;
    
   
    $hasValidSession = validateDatabaseSession();
    
   
    if (!$hasValidSession && isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $timeout) {
        logoutDatabaseSession();
        session_start();
        $_SESSION['state'] = 'expired';
        return false;
    }
    
   
    if ($hasValidSession) {
        $_SESSION['last_activity'] = time();
    }
    
    return $hasValidSession || (isset($_SESSION['state']) && $_SESSION['state'] == 'authenticated');
}

// Función para obtener usuario actual
function getCurrentUser() {
    if (isset($_SESSION['user'])) {
        return [
            'username' => $_SESSION['user'],
            'user_id' => $_SESSION['user_id'] ?? null,
            'session_type' => $_SESSION['session_type'] ?? 'php_session'
        ];
    }
    return null;
}


// Verificación automática al incluir el archivo
if (!checkSessionActivity() && basename($_SERVER['PHP_SELF']) !== 'login') {
   
    if (strpos($_SERVER['REQUEST_URI'], '/admin') !== false) {
        header('Location: /admin/login');
        exit;
    }
}
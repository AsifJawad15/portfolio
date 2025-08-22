<?php
// admin/logout.php
// make sure no output is sent before headers
session_start();

// Unset all session variables
$_SESSION = [];

// If you want to remove the session cookie as well (recommended)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Destroy the session on server
session_destroy();

// Redirect to public home page (one level up from admin/)
header('Location: ../index.php');
exit();

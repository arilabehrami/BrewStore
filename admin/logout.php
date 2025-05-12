<?php
/*session_start();
session_unset(); // Pastron të gjitha variablat e sesionit
session_destroy(); // Shkatërron sesionin
header("Location: index.php"); // Ridrejtimi pas logout-it
exit();*/

include 'includes/header.php';

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
header("Location: index.php");
exit();
?>
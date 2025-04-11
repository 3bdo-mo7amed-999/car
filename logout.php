<?php
session_start();
require_once 'includes/connect.php';

// Unset all session variables
$_SESSION = array();

// Delete remember me cookies
if (isset($_COOKIE['remember_token']) && isset($_COOKIE['user_id'])) {
    $stmt = $conn->prepare("UPDATE users SET remember_token = NULL, token_expires = NULL WHERE id = ?");
    $stmt->bind_param("i", $_COOKIE['user_id']);
    $stmt->execute();
    
    setcookie('remember_token', '', time() - 3600, '/');
    setcookie('user_id', '', time() - 3600, '/');
}

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
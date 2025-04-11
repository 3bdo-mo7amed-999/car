<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// تحقق من تسجيل الدخول
function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

// تحقق إذا كان المستخدم مسجل الدخول
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// بيانات المستخدم المسجل الدخول
function current_user() {
    if (is_logged_in()) {
        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email'],
            'avatar' => $_SESSION['user_avatar'] ?? null
        ];
    }
    return null;
}
?>
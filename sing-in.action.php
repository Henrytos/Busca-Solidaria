<?php
session_start();
include './database/database-connection.php';
include './utils/sonner.php';
include './database/users-repository.php';

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
$user = find_by_email($connection, $email);

if (!$user) {
    $_SESSION['user_id'] = '';
    sonner('error', 'usuario não encontrado');
    header("Location: index.php");
}

$is_password_valid = password_verify($password, $user['user_password']);
if ($is_password_valid) {
    $_SESSION['user_id'] = $user['user_id'];
    sonner('success', 'Bem Vindo ' . $user["username"]);
} else {
    $_SESSION['user_id'] = '';
    sonner('error', 'password invalida');
}

if (isset($_SERVER['HTTP_REFERER'])) {
    $previousPage = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);

    if ($previousPage) {
        header("Location: $previousPage");
        exit;
    }
}


header("Location: index.php");

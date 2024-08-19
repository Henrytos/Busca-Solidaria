<?php
session_start();
include './database/database-connection.php';
include './utils/sonner.php';
include './database/users-repository.php';

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = filter_var($_POST['senha'], FILTER_SANITIZE_SPECIAL_CHARS);


$is_password_valid = password_verify($password, $user['senha_usuario']);
if ($is_password_valid) {
    $_SESSION['user_id'] = $user['id_usuario'];
    sonner('success', 'Bem Vindo');
} else {
    $_SESSION['user_id'] = '';
    sonner('error', 'credencias envalidas');
}

header('Location: index.php');

<?php

declare(strict_types=1);

function handleAuthentication(PDO $pdo, string $email, string $password): ?array
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return null;
    }

    $stmt = $pdo->prepare('SELECT id, nome, senha FROM users WHERE email = :email LIMIT 1');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['senha'])) {
        return $user;
    }

    return null;
}

function establishSecureSession(array $user): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_regenerate_id(true);
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['nome'];
    $_SESSION['auth_time'] = time();
}

function redirect(string $location): void
{
    header('Location: ' . $location);
    exit();
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pdo = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$user = handleAuthentication($pdo, $email, $password);

if ($user) {
    establishSecureSession($user);
    redirect('panel/');
} else {
    $_SESSION['flash_message'] = 'Credenciais inválidas.';
    redirect('index.php');
}
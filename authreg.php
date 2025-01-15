<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['register'])){
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if (!$email){
        die('Эл.почта введена неверно');
    }
    if (!preg_match('/^[a-zA-Z0-9]{8,}$/', $password)){
        die('Пароль должен содержать только латинские символы и цифры, и должен быть не менее 8 символов');
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
    $stmt->execute([$email, $hashedPassword]);

    header('Location: authorization.php');
    exit;
}
//
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user=$stmt->fetch();

    if ($user && password_verify($password, $user['password'])){
        session_start();
        $_SESSION['user'] = $user;
        header('Location: authorization.php');
        exit;
    }else{
        die('Ваш логин или пароль были введены неверно');
    }
}
?>
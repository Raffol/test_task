<?php
require 'classes/DataBase.php';
require 'classes/User.php';

use App\User;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = new User();
    try {
        if ($user->login($_POST['email'], $_POST['password'])){
            header('Location: lk.php');
            exit;
        }
        $error = 'Неверный логин или пароль';
    }catch(Exception $e){
        $error = $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous"
    >
    <link rel="stylesheet" href="styles/style.css">
    <title>Авторизация</title>
</head>
<body>
<h2 class="justify-content-center d-flex mt-3">Авторизация</h2>
<div class="containter mt-5">
    <?php if ($error): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
<form method="post">
<div class="form-group justify-content-center d-flex m-3 p-2">
    <p class="">Введите электронную почту</p>
    <input type="email" name="email" class="for-control" required>
</div>
<div class="form-group justify-content-center d-flex m-3 p-2">
    <p>Введите пароль</p>
    <input type="password" name="password" class="for-control" required>
</div>
    <div class="col text-center mt-3">
<button type="submit" class="btn btn-primary ">
    Войти
</button>
    </div>
</form>
<p class="mt-3 justify-content-center d-flex">
    Нет учётной записи?
    <a href="registration.php">
         Зарегистрироваться
    </a>
</p>
</div>
</body>
</html>
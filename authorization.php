<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Авторизация</h2>
    <form action="authorization.php" method="post">
        <div class="form-group">
            <label>Электронная почта</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Пароль</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary">Войти</button>
        <p class="mt-3">Нет учётной записи? <a href="registration.php">Регистрация</a></p>
    </form>
</div>
</body>
</html>

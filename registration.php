<?php
require 'classes/DataBase.php';
require 'classes/User.php';

use App\User;

$error = null;

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    try {
        // Передача данных из формы в метод регистрации
        $user->register($_POST['email'], $_POST['password']);
        header('Location: lk.php'); // После успешной регистрации перенаправляем на авторизацию
        exit;
    } catch (\Exception $e) {
        $error = $e->getMessage(); // Показываем ошибку
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous"
    >
</head>
<body>
<div class="container mt-5">
    <h2 class="justify-content-center d-flex mt-3">Регистрация</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group mt-3">
            <p class="justify-content-center">Введите электронную почту</p>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <p>Введите пароль</p>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col text-center mt-3">
        <button type="submit" class="btn btn-primary mt-3">
            Зарегистрироваться
        </button>
        </div>
    </form>
    <p class="mt-3 justify-content-center d-flex">Уже есть аккаунт? <a href="authorization.php">Авторизация</a></p>
</div>
</body>
</html>

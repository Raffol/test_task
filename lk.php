<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: authorization.php');
    exit;
}
require 'classes/API.php';

use App\API;

// URL вашего API
$apiUrl = 'https://dog.ceo/api/breeds/image/random'; // Укажите реальный адрес API
$api = new API($apiUrl);

$message = ''; // Сообщение по умолчанию

try {
    // Получаем данные из API
    $data = $api->fetchData();

    // Проверяем, есть ли сообщение
    if (isset($data['message'])) {
        $message = $data['message'];
    }
} catch (\Exception $e) {
    $message = 'Ошибка получения данных из API: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"></head>
<body>
<div class="container mt-5">
    <div class="justify-content-center d-flex">
    <h2>Добро пожаловать, <?php echo $_SESSION['user']['email']; ?>!</h2>
</div>
    <p class="justify-content-center d-flex"><?php echo htmlspecialchars($message); ?></p>
    <div class="justify-content-center d-flex">
    <a href="logout.php" class="btn btn-danger mt-3">Выйти</a>
</div>
</div>
</body>
</html>

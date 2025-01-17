<?php
session_start();
if (!isset($_SESSION['user'])){
    header('Location: authorization.php');
    exit;
}
require 'classes/API.php';

use App\API;

$apiUrl = 'https://api.example.com/news';

try {
    $api = new API($apiUrl);
    $news = $api->fetchData();
} catch (\Exception $e) {
    $error = $e->getMessage();
}

$user = $_SESSION['user'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Личный кабинет</title>
</head>
<body>
<div class="container mt-5">
    <h2>Добро пожаловать, <?php echo $_SESSION['user']['email']; ?>!</h2>
    <p>Здесь будет информация из API.</p>
    <a href="logout.php" class="btn btn-danger">Выйти</a>
</div>
</body>
</html>

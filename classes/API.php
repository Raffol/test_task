<?php
//$apiUrl = 'https://catfact.ninja/fact';
namespace App;

class API {
    private $apiUrl;

    public function __construct(string $url) {
        $this->apiUrl = $url;
    }

    public function fetchData(): array {
        // Выполняем HTTP-запрос
        $response = file_get_contents($this->apiUrl);

        if ($response === false) {
            throw new \Exception('Ошибка подключения к API');
        }

        // Преобразуем JSON в массив
        $data = json_decode($response, true);

        if ($data === null) {
            throw new \Exception('Ошибка обработки данных API');
        }

        return $data;
    }
}
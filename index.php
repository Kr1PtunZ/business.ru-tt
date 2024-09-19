<?php
require 'vendor/autoload.php';

use App\Controllers\FigureGeneratorController;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

// Создаем экземпляр RouteCollector
$router = new RouteCollector();

// Определяем маршруты
$router->get("/", [FigureGeneratorController::class, 'getFiguresList']);

// Получаем HTTP-метод и URI
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$uri = strtok($uri, '?'); // Удаляем параметры запроса

// Создаем диспетчер
$dispatcher = new Dispatcher($router->getData());

// Обрабатываем запрос
try {
    $response = $dispatcher->dispatch($httpMethod, $uri);
    echo $response;
} catch (Exception $e) {
    http_response_code(404);
    echo '404 Not Found';
}

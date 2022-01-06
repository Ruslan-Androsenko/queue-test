<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Подключаем необходимые классы
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

try {
    // Создаем соединение
    $connection = new AMQPStreamConnection('rabbitmq.loc', 5672, 'guest', 'guest');

    // Берем канал и декларируем в нем новую очередь, важно чтобы названия очередей совпадали
    $channel = $connection->channel();
    $channel->queue_declare('hello', false, false, false, false);

    echo " [x] Waiting for messages. To exit press Ctrl+C \n";

    // Функция, которая будет обрабатывать данные, полученные из очереди
    $callback = function ($msg) {
        echo " [x] Received {$msg->body} - " . date("H:i:s") . " \n";
    };

    // Уходим слушать сообщения из очереди в бесконечный цикл
    $channel->basic_consume('hello', '', false, true, false, false, $callback);

    while (count($channel->callbacks)) {
        $channel->wait();
    }

    // Не забываем закрыть канал и соединение
    $channel->close();
    $connection->close();
} catch (Exception $ex) {
    echo "<p>Exception : " . $ex->getMessage() . "</p> \n";
}


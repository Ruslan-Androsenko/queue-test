<?php
require_once $_SERVER["DOCUMENT_ROOT"] .  '/../vendor/autoload.php';

// Подключаем необходимые классы
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

try {
    // Создаем соединение
    $connection = new AMQPStreamConnection('rabbitmq.loc', 5672, 'guest', 'guest');

    // Берем канал и декларируем в нем новую очередь, первый аргумент - название
    $channel = $connection->channel();
    $channel->queue_declare('hello', false, false, false, false);

    // Создаем новое сообщение
    $message = new AMQPMessage('Hello World!');

    // Отправляем его в очередь
    $channel->basic_publish($message, '', 'hello');

    echo " [x] Sent 'Hello World!' - " . date("H:i:s") . " \n";


    // Не забываем закрыть канал и соединение
    $channel->close();
    $connection->close();
} catch (Exception $ex) {
    echo "<p>Exception : " . $ex->getMessage() . "</p> \n";
}


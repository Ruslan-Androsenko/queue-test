<?php

$server = $_SERVER;

echo "<pre alt='arResult'>";
print_r($_POST);
echo "</pre>";

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

    echo " [x] Sent 'Hello World!' \n";

    // Не забываем закрыть канал и соединение
    $channel->close();
    $connection->close();
} catch (Exception $ex) {
    echo "<p>Exception : " . $ex->getMessage() . "</p>";
    $string = "dfdjhf";
    $number = 234;

//    echo "<pre alt='arResult'>";
//    print_r($_SERVER);
//    echo "</pre>";
}


/**
 * 5bb1e9282e7f   rabbitmq:3-management   "docker-entrypoint.s…"
 * 34 minutes ago   Up 30 seconds
 * 4369/tcp, 5671/tcp,
 * 0.0.0.0:5672->5672/tcp,
 * :::5672->5672/tcp,
 * 15671/tcp,
 * 15691-15692/tcp,
 * 25672/tcp,
 * 0.0.0.0:15672->15672/tcp,
 * :::15672->15672/tcp
 * rabbitmq
 */
<?php //-->

use PhpAmqpLib\Connection\AMQPStreamConnection;

return array (
	'sql-main' 		=> new PDO('mysql:host=127.0.0.1;dbname=framework', 'root', ''),
	'rabbitmq-main' => new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest')
);
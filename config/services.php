<?php //-->

use Cradle\Sql\MySql;
use Cradle\RabbitMQ\Queue;
use Cradle\RabbitMQ\Dispatcher;

return array (
	'sql-main' 					=> new MySql('127.0.0.1', 'framework', 'root', ''),
	'rabbitmq-queue-main' 		=> new Queue('127.0.0.1', 5672, 'guest', 'guest'),
	'rabbitmq-dispatch-main' 	=> new Dispatcher('127.0.0.1', 5672, 'guest', 'guest')
);
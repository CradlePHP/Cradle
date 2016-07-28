<?php //-->

use Cradle\Sql\MySql;
use Cradle\RabbitMQ\Queue;
use Cradle\RabbitMQ\Dispatcher;

return array(
	'services' => array(
		'sql-main' => new MySql('127.0.0.1', 'testing_db', 'root', '')
	)
);
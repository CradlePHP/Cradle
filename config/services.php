<?php //-->

use PhpAmqpLib\Connection\AMQPLazyConnection;

return array (
	'sql-main' 	 => new PDO('mysql:host=127.0.0.1;dbname=framework', 'root', ''),
	'queue-main' => new AMQPLazyConnection('127.0.0.1', 5672, 'guest', 'guest')
);
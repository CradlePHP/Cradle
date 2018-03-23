<?php //-->

use PDO as SqlResource;
use Predis\Client as RedisResource;
use Elasticsearch\ClientBuilder as ElasticResource;
use PhpAmqpLib\Connection\AMQPLazyConnection as RabbitResource;

return function ($request, $response) {
    //case for test injections
    $host = $request->getServer('HTTP_HOST');

    //create some global methods
    $this->package('global')

    /**
     * Gets a service from config
     *
     * @param *string|array name
     *
     * @return mixed
     */
    ->addMethod('service', function ($name) {
        static $services = null;

        if (is_array($name) || is_null($name)) {
            $services = $name;
            return $this;
        }

        if (is_null($services)) {
            $services = cradle()->package('global')->config('services');
        }

        if (!isset($services[$name])) {
            return null;
        }

        if (!is_array($services[$name])) {
            return $services[$name];
        }

        foreach ($services[$name] as $value) {
            //if there are still default values
            if (strpos($value, '<') === 0) {
                return null;
            }
        }

        //if sql array
        if (strpos($name, 'sql-') === 0
            && isset(
                $services[$name]['host'],
                $services[$name]['user']
            )
        ) {
            $config = $services[$name];
            if (!isset($config['pass'])) {
                $config['pass'] = '';
            }

            $info = 'mysql:host=' . $config['host'];
            if (isset($config['name'])) {
                $info .= ';dbname=' . $config['name'];
            }

            $services[$name] = new SqlResource(
                $info,
                $config['user'],
                $config['pass']
            );
        //if elastic array
        } else if (strpos($name, 'elastic-') === 0) {
            $config = $services[$name];
            $services[$name] = ElasticResource::create();

            if (!empty($config)) {
                $services[$name]->setHosts($config);
            }

            $services[$name] = $services[$name]->build();
        //if redis array
        } else if (strpos($name, 'redis-') === 0) {
            $services[$name] = new RedisResource($services[$name]);
        //if rabbitmq array
        } else if (strpos($name, 'rabbitmq-') === 0
            && isset(
                $services[$name]['host'],
                $services[$name]['port'],
                $services[$name]['user'],
                $services[$name]['pass']
            )
        ) {
            $services[$name] = new RabbitResource(
                $services[$name]['host'],
                $services[$name]['port'],
                $services[$name]['user'],
                $services[$name]['pass']
            );
        }

        return $services[$name];
    });
};

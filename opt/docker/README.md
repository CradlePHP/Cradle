To use Docker with this app:

#Easy Way

- Copy `.env.sample` as `.env` in your base directory

`$ cp .env.sample .env`

- Edit `.env` with your Custom Settings if needed

`$ vi .env`

	Sample File:
	```
	## docker-compose.yml

	# service: db
	DB_HOST=db:3306
	DB_DATABASE=cradlephp_kitchen_sink
	DB_USER=cradlephp
	DB_PASSWORD=cradlephp
	DB_ROOT_PASSWORD=cradlephp

	# service: web
	WEB_PORT=8001

	## docker-compose.override.yml

	# service: web
	WEB_SOURCE_DIR=.

	# service: composer
	COMPOSER_HOME_DIR=~/.composer
	```

- Run `docker-compose up` from your main directory to start the docker instance

`$ docker-compose up`

- Your docker containers will now be running at `http://${DOCKER_IP}:${WEB_PORT}`, your `${DOCKER_IP}` depends on what machine is running your local docker instance but it usually is `0.0.0.0`

- If this is the first time proceed to the `Setting Up` section

#Setting Up

Once the servers are online, the remaining large data needs to be imported into the DB Server

- Connect into your DB container
  * `docker-compose exec db bash`

- Download and unzip the MySQL Data:

- Import the MySQL Data

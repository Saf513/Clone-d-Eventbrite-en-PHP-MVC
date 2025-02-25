# Clone-d-Eventbrite-en-PHP-MVC

## Overview
This project is a clone of Eventbrite built using PHP and MVC architecture.

## Documentation
For detailed instructions on how to use Docker and configure the `.env` file, please refer to the [USAGE.md](USAGE.md) file.

## Quick Start
### Start services
```shell

docker-compose up -d --build

docker exec -it postgres_db_youcode psql -U user -d dbname
```

### Check Running Containers
```shell
docker ps
```
PGADMIN_DEFAULT_PASSWORD=
```

## Step 2: Build and Start Docker Containers

Run the following command to build and start the Docker containers:

```shell
docker-compose up -d --build
```

## Step 3: Check Running Containers

To check the status of the running containers, use the following command:

```shell
docker ps
```

## Step 4: Stop Docker Containers

To stop the Docker containers, run:

```shell
docker-compose down
```

## Accessing the Services

- **PHP App**: Open your browser and go to [http://localhost:8080](http://localhost:8080)
- **pgAdmin**: Open your browser and go to [http://localhost:8082](http://localhost:8082)




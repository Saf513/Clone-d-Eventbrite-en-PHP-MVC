# How to Use Docker and Configure .env File

## Prerequisites

- Docker installed on your machine
- Docker Compose installed on your machine

## Step 1: Configure the .env File

Create a `.env` file in the root directory of your project with the following content:

```properties
DB_HOST=
DB_NAME=
DB_USER=
DB_PASSWORD=
DB_DRIVER=
PGADMIN_DEFAULT_EMAIL=
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




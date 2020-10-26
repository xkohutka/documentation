# ASICDE - Deployment in Docker

This repository holds Docker compose files for the ASICDE software stack. With these docker-compose files you can start a production-ready or a development version of ASICDE without the need to build the code yourself.

## Contents

- [docker-compose.yml](docker-compose.yml) - Deployment configuration for the production-ready backend
- [docker-compose.frontend.yml](docker-compose.frontend.yml) - Deployment configuration for the production-ready frontend
- [docker-compose.dev.yml](docker-compose.dev.yml) - Deployment configuration for the development version of backend
- [docker-compose.frontend.dev.yml](docker-compose.frontend.dev.yml) - Deployment configuration for the development version of frontend

## Requirements

- Linux or Windows server
- [Docker](https://docs.docker.com/get-docker/)

## Usage

The software stack consists of two sections - backend and frontend - and the backend is divided further into submodules and one orchestrator (router). These submodules serve different API requests.

You may deploy the submodules separately, but it is better to keep them in one Docker stack (one docker-compose file) with the router.

To deploy the backend and frontend, follow the steps below:

1. Download or clone the repository
2. [Configure the services](#configuration)
3. Deploy the software stack
   1. If you want to run the frontend and backend in the same stack (on the same machine)
      - Rename `docker-compose.frontend.yml` to `docker-compose.override.yml`
      - Start the stack with `docker-compose up -d`
   2. If you want to run frontend separate from backend (different machines)
      - On one machine, only use `docker-compose.yml` for the backend 
      - On the other machine, rename `docker-compose.frontend.yml` to `docker-compose.yml`, to only run the frontend
      - Run `docker-compose up -d` on both machines
4. Verify the instance is working

*Note: If you choose to use non-production version of the software, do the steps with files ending with `.dev.yml.`*

You may also specify the exact version of the services be changing the `:latest` tag to `:<version-id>`.

## Configuration

### Backend - `docker-compose.yml`

#### Database service - `db`

Set the appropriate database configuration:
- `POSTGRES_DB: asicde`
- `POSTGRES_PASSWORD: password`
- `POSTGRES_USER: asicde`

#### Orchestrator service - `router`

Set the TCP port that will be exposed on the machine to serve HTTP requests:

- `10000:80` - `host-port : container-port` - do not change the container port (this is the port of the service inside the Docker container)
- TODO - other config

### Frontend - `docker-compose.frontend.yml`

Set the TCP port that will be exposed on the machine to serve the web application:

- `10001:80` - `host-port : container-port` - do not change the container port (this is the port of the service inside the Docker container)
- TODO - other config

### Environment files

Each service has it's own environment variables. These variables are injected into the Java virtual machine on startup. All environment files contain a directive to disable debugging messages during runtime (`spring.jpa.properties.hibernate.generate_statistics=false`).

#### Authentication API - `auth.env`

The authentication service needs definitions for the database connection which is used both in Spring for data persistance and Flyway to boot-up the database structure when the application runs for the first time.

```ini
# Metrics
spring.jpa.properties.hibernate.generate_statistics=false

# Persistence
spring.datasource.url=jdbc:postgresql://db:5432/asicde?currentSchema=${repo.datasource.schema}
spring.datasource.driverclassname=org.postgresql.Driver
spring.datasource.username=asicde
spring.datasource.password=password
spring.jpa.show-sql=true

# Flyway
spring.flyway.url=jdbc:postgresql://db:5432/asicde
spring.flyway.user=asicde
spring.flyway.password=password
```

#### Parser API - `parser.env`

```ini
# Metrics
spring.jpa.properties.hibernate.generate_statistics=false
```

#### Repo API - `repo.env`

The repo service needs definitions for the database connection which is used both in Spring for data persistance and Flyway to boot-up the database structure when the application runs for the first time.

A definition for the API auth endpoint also needs to be provided together with storage location path (where repository files are stored on the backend).

```ini
# Metrics
spring.jpa.properties.hibernate.generate_statistics=false

# Persistence
spring.datasource.url=jdbc:postgresql://db:5432/asicde?currentSchema=${repo.datasource.schema}
spring.datasource.driverclassname=org.postgresql.Driver
spring.datasource.username=asicde
spring.datasource.password=password
spring.jpa.show-sql=true

# Flyway
spring.flyway.url=jdbc:postgresql://db:5432/asicde
spring.flyway.user=asicde
spring.flyway.password=password

# Auth
auth.url=http://auth:8080/api/auth

# Storage
app.storage.location=/data
```

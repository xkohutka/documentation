[<< Return to documentation overview](README.md)

[>> Go to the docker repository](https://github.com/ASICDE/asicde-docker)

[>> Go to the docker-dev repository](https://github.com/ASICDE/asicde-docker-dev)

# ASICDE - Deployment in Docker

This repository holds Docker compose files for the ASICDE software stack. With these docker-compose files you can start a production-ready or a development version of ASICDE without the need to build the code yourself.

---

## Important notes

1. __Please read the documentation and any relevant notes carefully__ to avoid confusion and mismatching of services.
2. Two main versions of ASICDE exist currently. One older version, that is contained in the `master` git branch and one new (staging, containing new features) contained in the `dev` branch. __These versions differ, so please choose your version carefully and do not mix services from different versions.__
3. Use ONLY the `master` branch of the `asicde-docker` and `asicde-docker-dev` repositories.
4. Docker deployment has two forms. One enables [deployment of the whole application stack](#production-deployment) (frontend with backend - or just frontend or just backend), the other form enables [local development of the backend](#backend-development-deployment).

---

## Repository contents

- [docker-compose.yml](https://github.com/ASICDE/asicde-docker/blob/master/docker-compose.yml) - Docker software stack for the production-ready backend
- [docker-compose.frontend.yml](https://github.com/ASICDE/asicde-docker/blob/master/docker-compose.frontend.yml) - Docker software stack for the production-ready frontend
- [docker-compose.dev.yml](https://github.com/ASICDE/asicde-docker/blob/master/docker-compose.dev.yml) - Docker software stack for the development version of backend
- [docker-compose.frontend.dev.yml](https://github.com/ASICDE/asicde-docker/blob/master/docker-compose.frontend.dev.yml) - Docker software stack for the development version of frontend
- [env](https://github.com/ASICDE/asicde-docker/blob/master/env) - Produciton-ready environment configuration
- [env-dev](https://github.com/ASICDE/asicde-docker/blob/master/env-dev) - Development environment configuration

---

## Requirements

- Linux or Windows server / desktop PC
- [Docker](https://docs.docker.com/get-docker/)

---

## Usage

The software stack consists of two sections - backend and frontend - and the backend is divided further into submodules and one orchestrator (router). These submodules serve different API requests.

You may deploy the submodules separately, but it is better to keep them in one Docker stack (one docker-compose file) with the router.

__This Docker stack will deploy the whole backend or frontend portion of the project. You may also deploy both services at once.__

__NOTE: You may also want to regularly update your deployment. To do this, simply stop the running services, and run `docker-compose pull` with the chosen compose files which are described below.__

### Production deployment

With the docker-compose files in this repository, you can deploy the whole production-ready environment onto your server. Two docker-compose files are needed for this - __docker-compose.yml__ and __docker-compose.frontend.yml__. As the names suggest, one contains the software stack for the backend and one for the frontend. You may decide to deploy frontend separately from the backend - e.g. on different servers.

__NOTE: If want to deploy the latest version of the code (development/staging version), append `.dev` to each docker-compose file name, like so: `docker-compose.dev.yml` & `docker-compose.frontend.dev.yml`.__

Follow the steps below:

1. Download or clone the repository - the __master__ branch
   - `git clone git@github.com:ASICDE/asicde-docker.git`
2. [Configure the services](#configuration)
3. Deploy the software stack
   1. If you want to run the frontend and backend in the same stack (on the same machine)
      - Start the stack with `docker-compose up -f docker-compose.yml -f docker-compose.frontend.yml`
      - You may add `-d` parameter to run the services in background - in __detached mode__.
   2. If you want to run frontend separate from backend (different machines)
      - On one machine, run: `docker-compose up -f docker-compose.yml`
      - On the other machine, run: `docker-compose up -f docker-compose.frontend.yml`
4. Verify the instance is working by sending HTTP requests to the backend or by visiting the frontend.

### Frontend development deployment - Custom <u>FRONTEND</u> with Docker backend

For development purposes, you may deploy only part of the stack for development on the frontend.

This configuration below allows you to __serve your frontend from any IDE__ and connect to a stable and all-in-one solution for the backend.

1. Download or clone the repository - the __master__ branch
   - `git clone git@github.com:ASICDE/asicde-docker.git`
2. [Configure the services](#configuration)
3. Deploy the backend stack
   1. Running production-ready backend (`master` branch)
      - Run `docker-compose up -f docker-compose.yml`
   2. Running development/staging backend (`dev` branch)
      - Run `docker-compose up -f docker-compose.dev.yml`
4. Your backend will be ready on the port defined in the `router` module - the default is `TCP 10000`

<h3 id="backend-development-deployment">Backend development deployment - Custom <u>BACKEND</u> with Docker frontend and database</h3>

This configuration below allows you to __serve your backend from any IDE__ and connect to a stable software stack for the frontend, collab module, databases and a custom router.

This software stack will serve the development/staging version of frontend (port `TCP 10001`), a database (port `TCP 5432`) for the backend, the collab module (port `TCP 7070`) with it's database (port `TCP 27017`), a custom service router (proxy - port `TCP 10000`) and PGAdmin (port `TCP 5050`). The mentioned ports are only default values - you may change these.

1. Download or clone the DEV repository - the __master__ branch
   - `git clone git@github.com:ASICDE/asicde-docker-dev.git`
   - __NOTE: Be sure to include the `-dev` suffix. This repository is different from the previous one. It contains scripts and configuration for the development (custom) router along with a different docker-compose file.__
2. [Configure the services](#configuration)
3. Deploy the software stack - run `docker-compose up`
4. Wait for all of the services to start
5. Start the backend AsicdeCoreApplication and ParserApplication in your IDE.
6. Your backend will now use the software stack for the database and other modules. The custom router will properly route any API requests to the backend. You can visit the frontend on localhost on port `TCP 10001`.

---

## Configuration

### Production deployment

Configuration for the production software stack. [https://github.com/ASICDE/asicde-docker](https://github.com/ASICDE/asicde-docker)

#### \# Produciton-ready code (`master` branch)

The `docker-compose.yml` file consists of the following backend services:
- `db` - PostgreSQL database server for the backend
   - Here you may change the database name, user and password and also change the location fo the database files. By default a Docker volume is created to serve as a permanent storage.
   - NOTE: when changing database credentials, be sure to change these credentials in all of the backend modules also
- `auth` - Authentication API module
- `repo` - Repository management API module
   - You can set the location of data storage for the repositories. By default a Docker volume is created to serve as a permanent storage.
- `parser` - SystemVerilog code parser API module
- `router` - NginX proxy router for routing traffic
   - You may change the port on which NginX will listen. By default the port `10000` is used.

The `docker-compose.frontend.yml` file consists of the following frontend services:
- `frontend` - The frontend static application.
   - Here you can change the port on which the frontend will be served. The default is `10001`.
   - You may also specify the target URL for the backend API endpoint. This URL must point to the deployed router from the backend service stack.

The `env/auth.env` file contains configuration of the Authentication API module:

```ini
# Set the JWT authorization header:
app.jwt.authorization.header=Authorization

# Set the JWT token prefix string
app.jwt.prefix=Bearer

# Set the JWT token encryption key
app.jwt.secret=JWTSuperSecretKey

# Set the JWT token expiration time in milliseconds
app.jwt.expiration.time=86400000
```

The `env/database.env` file contains configuration for the backend database:

```ini
# Set the PostgreSQL database connection URL
# You may also use different databases - see: https://docs.oracle.com/cd/E17952_01/connector-j-8.0-en/connector-j-reference-jdbc-url-format.html
spring.datasource.url=jdbc:postgresql://db:5432/asicde?currentSchema=${auth.datasource.schema}

# Set the database driver
spring.datasource.driverclassname=org.postgresql.Driver

# Set the database username
spring.datasource.username=asicde

# Set the database password
spring.datasource.password=password

# Show or hide RAW SQL queries - debugging
spring.jpa.show-sql=true
```

The `env/repo.env` file contains configuration of the Repository management API module:

```ini
# Set the URL for the Authentication API module
auth.url=http://auth:8080/api/auth

# Set the storage location for repository data inside of the container
app.storage.location=/data

# Enable file upload
spring.servlet.multipart.enabled=true

# Set the maximum file size to be accepted by the server
spring.servlet.multipart.max-file-size=500MB

# Set the maximum request size to be accepted by the server
spring.servlet.multipart.max-request-size=500MB
```

The `env/spring.metrics.env` file contains configuration for miscellaneous features:

```ini
# Enable or disable statistics and metrics
spring.jpa.properties.hibernate.generate_statistics=false
```

#### \# Development/staging code (`dev` branch)

The `docker-compose.dev.yml` file consists of the following backend services:
- `db` - PostgreSQL database server for the backend
   - Here you may change the database name, user and password and also change the location fo the database files. By default a Docker volume is created to serve as a permanent storage.
   - NOTE: when changing database credentials, be sure to change these credentials in all of the backend modules also
- `collab_db` - Mongo database server for the Collaboration API module
   - You may set the database file location here. By default a Docker volume is created to serve as a permanent storage.
- `core` - ASICDE Core API module
   - You can set the location of data storage for the repositories. By default a Docker volume is created to serve as a permanent storage.
- `parser` - SystemVerilog code parser API module
- `collab` - Collaboration API module
   - Here you can change the URLs for the API endpoints for the Core module access.
   - You can also change the Mongo database connection URL
- `router` - NginX proxy router for routing traffic
   - You may change the port on which NginX will listen. By default the port `10000` is used.

The `docker-compose.frontend.dev.yml` file consists of the following frontend services:
- `frontend` - The frontend static application.
   - Here you can change the port on which the frontend will be served. The default is `10001`.
   - You may also specify the target URL for the backend API endpoint. This URL must point to the deployed router from the backend service stack.

The `env-dev/core.env` file contains configuration of the ASICDE Core API module:

```ini
# Set the JWT authorization header:
app.jwt.authorization.header=Authorization

# Set the JWT token prefix string
app.jwt.prefix=Bearer

# Set the JWT token encryption key
app.jwt.secret=JWTSuperSecretKey

# Set the JWT token expiration time in milliseconds
app.jwt.expiration.time=86400000

# Set the URL for the Authentication API module
auth.url=http://auth:8080/api/auth

# Set the storage location for repository data inside of the container
app.storage.location=/data

# Enable file upload
spring.servlet.multipart.enabled=true

# Set the maximum file size to be accepted by the server
spring.servlet.multipart.max-file-size=500MB

# Set the maximum request size to be accepted by the server
spring.servlet.multipart.max-request-size=500MB
```

The `env-dev/database.env` file contains configuration for the backend database:

```ini
# Set the PostgreSQL database connection URL
# You may also use different databases - see: https://docs.oracle.com/cd/E17952_01/connector-j-8.0-en/connector-j-reference-jdbc-url-format.html
spring.datasource.url=jdbc:postgresql://db:5432/asicde?currentSchema=${auth.datasource.schema}

# Set the database driver
spring.datasource.driverclassname=org.postgresql.Driver

# Set the database username
spring.datasource.username=asicde

# Set the database password
spring.datasource.password=password

# Show or hide RAW SQL queries - debugging
spring.jpa.show-sql=true
```

The `env-dev/spring.metrics.env` file contains configuration for miscellaneous features:

```ini
# Enable or disable statistics and metrics
spring.jpa.properties.hibernate.generate_statistics=false
```

### Development deployment

Configuration for the development software stack only. This is different from the previous configuration. [https://github.com/ASICDE/asicde-docker-dev](https://github.com/ASICDE/asicde-docker-dev)

The `docker-compose.yml` file consists of the following backend services:
- `pgadmin` - PostgreSQL administration GUI
   - Here you can change the credentials used to access the GUI as well as the port whre the service will be hosted. The default port is `TCP 5050`.
- `db` - PostgreSQL database server for the backend
   - Here you may change the database name, user and password and also change the location fo the database files. By default a Docker volume is created to serve as a permanent storage.
   - NOTE: when changing database credentials, be sure to change these credentials in all of the backend modules also - create a `application-local.properties` in `src/main/resources` and choose the `local` profile in the application configuration so these new credentials would be used by Spring.
- `collab_db` - Mongo database server for the Collaboration API module
   - You may set the database file location here. By default a Docker volume is created to serve as a permanent storage.
- `collab` - Collaboration API module
   - Here you can change the URLs for the API endpoints for the Core module access.
   - You can also change the Mongo database connection URL
- `router` - Custom NginX proxy router for routing traffic
   - Here you need to set on which URL addresses and ports your backend services listen.
   - These values are set in Spring with the `server.port` directive. By default, the router is set-up so it will try to find:
      - Core API: localhost:8080
      - Parser API: localhost:8081
      - Collab API: localhost:7070

      ```ini
      AUTH_HOST: "http\\:\\/\\/host.docker.internal\\:8080"
      PARSER_HOST: "http\\:\\/\\/host.docker.internal\\:8081"
      REPO_HOST: "http\\:\\/\\/host.docker.internal\\:8082"
      ```

   - The `host.docker.internal` hostname represents `localhost` on the host machine where Docker is running. This means that Docker can connect to services running in Intellij IDEA.
   - You may also change the port on which NginX will listen. By default the port `10000` is used.
- `frontend` - The frontend static application.
   - Here you can change the port on which the frontend will be served. The default is `10001`.
   - You may also specify the target URL for the backend API endpoint. This URL must point to the deployed router from the backend service stack.

[<< Return to documentation overview](README.md)

# ASICDE - Local development docker stack configuration

This repository holds a Docker compose file which starts services needed for backend development.

A PostgreSQL database will be started on port `5432`, development router service that will orchestrate services running using Intellij IDEA locally and an instance of the frontend that will use the development router as it's API host.

## Contents

- [docker-compose.yml](docker-compose.yml) - Deployment configuration for the local development
- [Dockerfile](Dockerfile) - Docker image configuration for the custom API orchestrator (router)
- [nginx-default.conf](nginx-default.conf) - NginX common configuration for all endpoints
- [nginx.conf](nginx.conf) - NginX configuration for the HTTP proxy service
- [run.sh](run.sh) - Custom script for injecting environment variables into NginX configuration files

## Requirements

- [Docker](https://docs.docker.com/get-docker/)

## Usage

```bash
git clone git@github.com:ASICDE/asicde-docker-dev.git
cd asicde-docker-dev
docker-compose up -d
```

If dependencies are updated, you should download latest versions of the Docker images with `docker-compose pull <service>`:

```bash
docker-compose pull frontend
```

If the NginX proxy configuration changes, you may need to rebuild the container with:

```bash
docker-compose build
```

### Database

A PostgreSQL database will be started on port `5432`.

### Router

A router service build from the local Dockerfile will be started on port `10000`.

You may edit the Dockerfile, nginx.conf and nginx-default.conf to further configure your local development. The default configuration provided is designed to work with the project without modifications.

### Frontend

A frontend service (development version) will be started on port `10001`.

### Exploring docker-compose.yml

The router service has environment variables that can be used to specify where each backend service is located at. The default configuration looks like the following:

```ini
AUTH_HOST: "http\\:\\/\\/host.docker.internal\\:8080"
PARSER_HOST: "http\\:\\/\\/host.docker.internal\\:8081"
REPO_HOST: "http\\:\\/\\/host.docker.internal\\:8082"
```

The `host.docker.internal` hostname represents `localhost` on the host machine where Docker is running. This means that Docker can connect to services running in Intellij IDEA. If you are running a different configuration, you may change these environment variables to change the API endpoint URLs.

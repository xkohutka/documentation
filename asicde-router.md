[<< Return to documentation overview](README.md)

[>> Go to repository](https://github.com/ASICDE/asicde-router)

# ASICDE - Web proxy router

This repository holds the configuration files for NginX web server and proxy. A Dockerfile is also provided to build a ready-to-use Docker container.

This repository has two branches for the different versions of code. Note that the production (`master`) version is different from the staging/development (`dev`) version. Please do not mix the different versions.

## NginX configuration - `nginx.conf` (`master`)

The NginX web server is used as a proxy for all backend modules. It will forward requests comming to the central endpoint to individual services that should serve the requests.

The backend consists of three separate modules right now:

- auth - all requests for `/api/auth/*`
- parser - all requests for `/api/parser/*`
- repo - all requests for `/api/repo/*`

These modules run as separate (Docker) services, so this web proxy combines them into one URL endpoint.

## NginX configuration - `nginx.conf` (`dev`)

The staging branch has new features and is quite different.

The backend consists of three separate modules right now:

- core - all requests for `/api/auth/*` and `/api/repo/*`
- parser - all requests for `/api/parser/*`
- collab - all requests for `/api/collab/*`

These modules run as separate (Docker) services, so this web proxy combines them into one URL endpoint.

This version also implements the use of a secondary [configuration file](https://github.com/ASICDE/asicde-router/blob/dev/nginx-default.conf) which defines common settings for each proxy. An addition to this is the presence of CORS handling for all requests.

## Using the Docker container

The container needs to be placed in the same Docker network as all of the backend services.

The container exposes the default HTTP port (80) which can be forwarded to any other with port mapping in Docker. You can see the backend stack Docker configuration in the [asicde-docker](https://github.com/ASICDE/asicde-docker) repository.

[<< Return to documentation overview](README.md)

[>> Go to repository](https://github.com/ASICDE/asicde-chat)

# ASICDE Chat

Server-side implementation of ASICDE chat based on [socket.io](https://socket.io/).

## Prerequisities 

- [NodeJS](https://nodejs.org/en/)

## Installation

In order to install dependencies, run following command in the root folder:

```bash
cd asicde-chat
npm install
```

## Usage

Server accepts `API_URL` and `WS_PATH` as arguments. Arguments can be passed directly from CLI such as `API_URL=http://localhost:10000/api/v2 npm run server` or as environment variables e.g. through `docker-compose`. 

- `API_URL` specifies URL of the [ASICDE API](https://github.com/ASICDE/asicde-api). Based on deployment and environment it could point to [asicde-router](https://github.com/ASICDE/asicde-router) or [asicde-backend](https://github.com/ASICDE/asicde-backend)

For example, in local environment it can point to router as `http://localhost:10000/api/v2`, in docker-compose setup it can point directly to backend as `http://core:8080/api` (default is `http://localhost:10000/api/v2`).

- `WS_PATH` specifies the path where the websocket will listen e.g. `/api/v2/ws/chat` (default is `/ws/chat`)


### Development

To run the server in development mode with `API_URL` parameter (example API URL), run the following command: 

```bash
API_URL=http://localhost:10000/api/v2 npm run server
```
### Build

In order to build source code, run the following command: 

```bash
npm run build
```
### Production

In order to run the server in production environment, run the following command:

```bash
npm run prod
```

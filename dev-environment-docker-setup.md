[<< Return to documentation overview](README.md)

# Setting up a Docker environment for frontend development

This document describes the process of setting up a development environment for the ASICDE project. At the end of this process, you will be able to run ASICDE application using Docker as your backend environment.

## Prerequisites
-Docker:
    If you don't have Docker installed on your machine you can download it from this the official [Docker page](https://www.docker.com/).


## Clone repositories

In your project folder, clone all of these repositories:

```bash
git clone -b local-dev https://github.com/ASICDE/asicde-router.git
git clone -b docker-dev https://github.com/ASICDE/asicde-docker.git
git clone https://github.com/ASICDE/asicde-chat.git
git clone https://github.com/ASICDE/asicde-collab.git
git clone -b dev https://github.com/ASICDE/asicde-parent.git
git clone -b dev https://github.com/ASICDE/asicde-api.git
git clone -b dev https://github.com/ASICDE/asicde-backend.git
```


## Open Docker


## Build your own Docker images

In your project folder, use the terminal to go asicde-docker folder

```bash
cd asicde-docker
```

Inside asicde-docker folder run the following command to build your own docker images.

```bash
docker-compose -f docker-compose.tmp.yml build
```
Run time for this command can take couple of minutes to finish.

## Build your own Docker images

If your build was sucessful, without any errors, then you can procced to running your Docker images. You can run them using the following command.

```bash
docker-compose -f docker-compose.tmp.yml up
```

Now open Docker Desktop and you should see 7 containers running. At this point you are running docker environment for ASICDE project. 

You can now run your frontend development environment as described in [asicde-frontend](https://github.com/ASICDE/asicde-frontend) documentation. 


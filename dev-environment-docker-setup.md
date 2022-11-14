[<< Return to documentation overview](README.md)

# Setting up a Docker environment for frontend development

This document describes the process of setting up a development environment for the ASICDE project. At the end of this process, you will be able to run ASICDE application using Docker as your backend environment.

## Prerequisites
- Docker
    If you don't have Docker installed on your machine you can download it from this the official [Docker page](https://www.docker.com/).
- JDK 13
    - Download and install JDK 13 (other versions may work as well, not tested)
        - (Optional) [Create Oracle account](https://profile.oracle.com/myprofile/account/create-account.jspx) if you don't have one yet
        - (Optional) [Download](https://www.oracle.com/java/technologies/javase/jdk13-archive-downloads.html) and install Java JDK 13 from archive 
    - Make sure you have `$JAVA_HOME` environment variable [set on your machine](https://www.thewindowsclub.com/set-java_home-in-windows-10)
    - Configure Java sources in your IDE as well to overcome issues such as dependency resolving failure 
- [Maven 3.6.3](https://maven.apache.org/download.cgi) 
    - Current version works as well
    - Download the package containing compiled binary files for your desired operating system
    - Extract the package
    - Set environment variables for `M2_HOME` and `MAVEN_HOME` to point to the base installation directory (same process as JAVA_HOME setup)
- [IntelliJ IDEA](https://www.jetbrains.com/idea/download/) 
    - This guide is primarily centered on this IDE, as is offers integrated utilities for all necessary frameworks
    - (Optional) [Create Jetbrains student account](https://www.jetbrains.com/shop/eform/students) if you don't have one yet
    - (Optional) Download and use **Ultimate version**, login with your account


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

Open Docker and go to Settings > General and there disable the option `Use Docker Compose V2`. This is necessary because the current version of Docker Compose is not compatible with the current version of Docker.

After that, click apply and restart Docker.

## Build ASICDE backend

At first, you need to open `asicde-backend`, `asicde-parent` and `asicde-api` folders all in one IntelliJ window. Then, follow the steps as described in the [Install Maven Dependencies](asicde-backend.md#install-maven-dependencies).

After that, you can build the project by clicking on the green hammer icon in the top right corner of the IntelliJ window.


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


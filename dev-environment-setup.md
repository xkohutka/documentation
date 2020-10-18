# Setting up a development environment

This document describes the process of setting up a development environment for the ASICDE project.

## Setting up development environment for backend

### Prerequisites

- [Maven](http://maven.apache.org/)
- [Oracle JDK 13](https://www.oracle.com/java/technologies/javase-jdk13-downloads.html)
- [Intellij Idea](https://www.jetbrains.com/idea/)
- [Git](https://git-scm.com/)
- *(Optional)* [Docker](https://www.docker.com/)

#### Setting up JDK 13

- Download the installation package for your desired operating system
- Install the JDK
- [Set environment variable](https://www.architectryan.com/2018/08/31/how-to-change-environment-variables-on-windows-10/) for `JAVA_HOME` to point to the base installation directory
  - In Windows, e.g.: `C:\Program Files\Java\jdk-13.0.2`
  - In Linux, e.g.: `/usr/lib/jvm/jdk-13.0.2/`
- Add Java to your `PATH` environment variable
  - In Windows, e.g.: `C:\Program Files\Java\jdk-13.0.2\bin`
  - In Linux, e.g.: `/usr/lib/jvm/jdk-13.0.2/bin`

#### Setup Maven
- Download the package containing compiled binary files for your desired operating system
- Extract the package
- Set environment variables for `M2_HOME` and `MAVEN_HOME` to point to the base installation directory
  - In Windows, e.g.: `C:\apache-maven-3.6.3`
  - In Linux, e.g.: `/opt/apache-maven-3.6.3`
- Add Maven to your `PATH` environment variable
  - In Windows, e.g.: `C:\apache-maven-3.6.3\bin`
  - In Linux, e.g.: `/opt/apache-maven-3.6.3/bin`

### Clone backend repositories

It is advised to create one folder as your workspace, where you will clone all of the project repositories, so let's create it.

```bash
mkdir ASICDE
cd ASICDE
```

Now clone all backend repositories:

```bash
git clone -b dev git@github.com:ASICDE/asicde-parent.git
git clone -b dev git@github.com:ASICDE/asicde-api.git
git clone -b dev git@github.com:ASICDE/asicde-backend.git
```

All repositories have been cloned by using the `dev` branch which is dedicated for project development and holds the latest versions of the code.

### Using Intellij Idea

TODO

For an overview of the project module structure, please refer to each repository's Readme file ([parent](https://github.com/ASICDE/asicde-parent/blob/master/README.md), [api](https://github.com/ASICDE/asicde-api/blob/master/README.md), [backend](https://github.com/ASICDE/asicde-backend/blob/master/README.md)).

## Setting up development environment for frontend

### Prerequisites

- [NodeJS](https://nodejs.org/en/)
- NPM - usually packaged together with NodeJS
- [Docker](https://www.docker.com/)
- [Visual Studio Code](https://code.visualstudio.com/)

### Setup Visual Studio Code

Install the following plugins to help you develop in Angular & NodeJS:
- Prettier
- HTML CSS Support
- DotENV
- Path Intellisense
- *(Optional)* Bracket Pair Colorizer 2
- *(Optional)* Material Icon Theme
- *(Optional)* Markdown All in One
- *(Optional)* Markdown Preview Enhanced

### Clone frontend and docker repository

```bash
git clone -b dev git@github.com:ASICDE/asicde-frontend.git
git clone git@github.com:ASICDE/asicde-docker.git
```

Frontend has been cloned by using the `dev` branch which is dedicated for project development and holds the latest versions of the code.

### Start the backend

In order to work on the frontend, you need to have a backend service to serve your API requests. For this purpose, you should clone the docker repository holding docker-compose stack configuration and start it locally. 

To have the latest version of the backend services, you can rename `docker-compose.dev.yml` to `docker-compose.yml` (or rename it to `docker-compose.override.yml` if you do not want to overwrite the original file). Although these versions may not be 100% stable.

The backend should be already configured to have it's own database and the orchestrator service running locally on port `10000`, so no extra modifications are needed.

```bash
cd asicde-docker
docker-compose up -d
```

### Using Visual Studio Code

As a reference for the project structure, please refer to the repository's [Readme file](https://github.com/ASICDE/asicde-frontend/blob/master/README.md).

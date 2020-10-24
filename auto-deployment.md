# Automatic deployment with Jenkins and Docker

Based on the [development lifecycle](dev-lifecycle.md), you can see that our project is split into two environments - one for production ready version and one for development version. Because of these split environments, our Jenkins server is set-up to build & serve two distinct versions of the application concurrently.

To properly use Jenkins, please follow the full [development stack installation guide](dev-stack-installation.md).

## Separate project modules

- [ASICDE-router](#asicde-router)
- [ASICDE-website](#asicde-website)

### ASICDE-router

[Jenkinsfile](https://github.com/ASICDE/asicde-router/blob/master/Jenkinsfile) for the router is very simple and the module is practically built only once as almost no changes will be applied to the source codes. It contains only one section that builds the Docker images according to the Dockerfile provided in the repository.

```groovy
    pipeline {
        
        agent any
        
        stages {
            stage("Clean workspace"){
                steps{
                    cleanWs()
                }
            }
            stage("Pull repository"){
                steps{
                    withCredentials([sshUserPrivateKey(credentialsId: "github", keyFileVariable: 'keyfile')]) {    
                        script{
                            sh "GIT_SSH_COMMAND='ssh -i ${keyfile} -o IdentitiesOnly=yes' git clone git@github.com:ASICDE/asicde-router.git ."
                        }
                    }
                }
            }
            stage('Build & push docker images') {
                steps {
                    script {
                            withCredentials([usernamePassword(credentialsId: 'nexus', usernameVariable: 'user', passwordVariable: 'pass')]) {
                            sh "docker login -u ${user} -p ${pass} http://localhost:8082"
                            
                            docker.build("localhost:8082/asicde/router:${env.BUILD_ID}")
                            sh "docker image tag localhost:8082/asicde/router:${env.BUILD_ID} localhost:8082/asicde/router:latest"
                            sh "docker push localhost:8082/asicde/router:${env.BUILD_ID}"
                            sh "docker push localhost:8082/asicde/router:latest"
                        }
                    }
                }
            }
        }
        post {
            failure {
                slackSend (
                    color: "danger", 
                    message: "Build FAILED: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
                )
            }
            success {
                slackSend (
                    color: "good", 
                    message: "Build SUCCESS: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
                )
            }
        }
    }
```

### ASICDE-website

The project website is also built automatically and served to the users without any downtime. The [Jenkinsfile](https://github.com/ASICDE/website/blob/main/Jenkinsfile) builds the source codes, then builds a Docker image and refreshes the localy hosted container with the latest version.

```groovy
    pipeline {
        
        agent any
    
        stages {
            stage("Clean workspace"){
                steps{
                    cleanWs()
                }
            }
            stage("Pull repository"){
                steps{
                    withCredentials([sshUserPrivateKey(credentialsId: "github", keyFileVariable: 'keyfile')]) {    
                        script{
                            sh "GIT_SSH_COMMAND='ssh -i ${keyfile} -o IdentitiesOnly=yes' git clone --recurse-submodules git@github.com:ASICDE/website.git ."
                        }
                    }
                }
            }
            stage('Build app') {
                steps {
                    script {
                        nodejs(nodeJSInstallationName: 'nodejs') {
                            sh "npm install"
                            sh "npm run build"
                        }
                    }
                }
            }
            stage('Build & push docker images') {
                steps {
                    script {
                        withCredentials([usernamePassword(credentialsId: 'nexus', usernameVariable: 'user', passwordVariable: 'pass')]) {
                            sh "docker login -u ${user} -p ${pass} http://localhost:8082"
                            
                            def frontendImage = docker.build("localhost:8082/asicde/website:${env.BUILD_ID}")
                            sh "docker image tag localhost:8082/asicde/website:${env.BUILD_ID} localhost:8082/asicde/website:latest"
                            sh "docker push localhost:8082/asicde/website:${env.BUILD_ID}"
                            sh "docker push localhost:8082/asicde/website:latest"
                        }
                    }
                }
            }
            stage('Deploy website container') {
                steps {
                    script {
                        sh "docker kill asicde-website || true"
                        sh "docker rm asicde-website || true"
                        sh "docker run -d -p 8083:80 --restart unless-stopped --name asicde-website localhost:8082/asicde/website:latest"
                    }
                }
            }
        }
        post {
            failure {
                slackSend (
                    color: "danger", 
                    message: "Build FAILED: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
                )
            }
            success {
                slackSend (
                    color: "good", 
                    message: "Build SUCCESS: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
                )
            }
        }
    }
```

## Development version deployment

The development environment has separate build and deployment tasks for each project module:

- [ASICDE-dev-parent](#asicde-dev-parent)
- [ASICDE-dev-api](#asicde-dev-api)
- [ASICDE-dev-backend](#asicde-dev-backend)
- [ASICDE-dev-frontend](#asicde-dev-frontend)
- [ASICDE-deploy-dev](#asicde-deploy-dev)

### ASICDE-dev-parent

The [Jenkinsfile](https://github.com/ASICDE/asicde-parent/blob/master/Jenkinsfile) which defines the build instructions is rather simple and only builds the code and pushes it into the Nexus repository. The file is displayed below and as you may see, it contains two sections, one for cloning the Github repository and one for building the source codes.

This build task (or pipeline) is automatically triggered when any new code is pushed to the `dev` branch of the `asicde-parent` repository.

```groovy
pipeline {
    
    agent any

    stages {
        stage("Clean workspace"){
            steps{
                cleanWs()
            }
        }
        stage("Pull repository"){
            steps{
                withCredentials([sshUserPrivateKey(credentialsId: "github", keyFileVariable: 'keyfile')]) {    
                    script{
                        sh "GIT_SSH_COMMAND='ssh -i ${keyfile} -o IdentitiesOnly=yes' git clone -b dev git@github.com:ASICDE/asicde-parent.git ."
                    }
                }
            }
        }
        stage("Gather POM dependencies"){
            steps{
                script{
                    sh "mvn -DskipTests clean deploy"
                }
            }
        }
    }
    post {
        failure {
            mattermostSend (
                color: "danger", 
                message: "Build FAILED: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
            )
        }
        success {
            mattermostSend (
                color: "good", 
                message: "Build SUCCESS: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
            )
        }
    }
}
```

### ASICDE-dev-api

[Jenkinsfile](https://github.com/ASICDE/asicde-api/blob/master/Jenkinsfile) for the api module is similar to the one for parent module but also runs Maven tests after a successfull build was produced.

This build task (or pipeline) is automatically triggered when any new code is pushed to the `dev` branch of the `asicde-api` repository or when the ASICDE-dev-parent task finishes successfully.

```groovy
    pipeline {
        
        agent any
        
        stages {
            stage("Clean workspace"){
                steps{
                    cleanWs()
                }
            }
            stage("Pull repository"){
                steps{
                    withCredentials([sshUserPrivateKey(credentialsId: "github", keyFileVariable: 'keyfile')]) {    
                        script{
                            sh "GIT_SSH_COMMAND='ssh -i ${keyfile} -o IdentitiesOnly=yes' git clone -b dev git@github.com:ASICDE/asicde-api.git ."
                        }
                    }
                }
            }
            stage("Build maven project"){
                steps{
                    script{
                        sh "mvn -DskipTests clean deploy"
                    }
                }
            }
            stage('Run tests') { 
                steps {
                    sh 'mvn test' 
                }
            }
        }
        post {
            failure {
                slackSend (
                    color: "danger", 
                    message: "Build FAILED: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
                )
            }
            success {
                slackSend (
                    color: "good", 
                    message: "Build SUCCESS: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
                )
            }
        }
    }
```

### ASICDE-dev-backend

The [Jenkinsfile](https://github.com/ASICDE/asicde-backend/blob/master/Jenkinsfile) for the backend module is also similar but adds another step to deploy built Docker images into the Nexus repository to be later served to any Docker pull request.

This build task (or pipeline) is automatically triggered when any new code is pushed to the `dev` branch of the `asicde-backend` repository or when the ASICDE-dev-api task finishes successfully.

```groovy
    pipeline {
        
        agent any

        stages {
            stage("Clean workspace"){
                steps{
                    cleanWs()
                }
            }
            stage("Pull repository"){
                steps{
                    withCredentials([sshUserPrivateKey(credentialsId: "github", keyFileVariable: 'keyfile')]) {    
                        script{
                            sh "GIT_SSH_COMMAND='ssh -i ${keyfile} -o IdentitiesOnly=yes' git clone -b dev git@github.com:ASICDE/asicde-backend.git ."
                        }
                    }
                }
            }
            stage("Build maven project"){
                steps{
                    script{
                        sh "mvn -DskipTests clean deploy"
                    }
                }
            }
            stage('Run tests') { 
                steps {
                    sh 'mvn test' 
                }
            }
            stage('Build & push docker images') {
                steps {
                    script {
                            withCredentials([usernamePassword(credentialsId: 'nexus', usernameVariable: 'user', passwordVariable: 'pass')]) {
                            sh "docker login -u ${user} -p ${pass} http://localhost:8082"
                            
                            dir("auth"){
                                docker.build("localhost:8082/asicde/auth-dev:${env.BUILD_ID}")
                                sh "docker image tag localhost:8082/asicde/auth-dev:${env.BUILD_ID} localhost:8082/asicde/auth-dev:latest"
                                sh "docker push localhost:8082/asicde/auth-dev:${env.BUILD_ID}"
                                sh "docker push localhost:8082/asicde/auth-dev:latest"
                            }
                            dir("parser"){
                                docker.build("localhost:8082/asicde/parser-dev:${env.BUILD_ID}")
                                sh "docker image tag localhost:8082/asicde/parser-dev:${env.BUILD_ID} localhost:8082/asicde/parser-dev:latest"
                                sh "docker push localhost:8082/asicde/parser-dev:${env.BUILD_ID}"
                                sh "docker push localhost:8082/asicde/parser-dev:latest"
                            }
                            dir("repo"){
                                docker.build("localhost:8082/asicde/repo-dev:${env.BUILD_ID}")
                                sh "docker image tag localhost:8082/asicde/repo-dev:${env.BUILD_ID} localhost:8082/asicde/repo-dev:latest"
                                sh "docker push localhost:8082/asicde/repo-dev:${env.BUILD_ID}"
                                sh "docker push localhost:8082/asicde/repo-dev:latest"
                            }
                        }
                    }
                }
            }
        }
        post {
            failure {
                slackSend (
                    color: "danger", 
                    message: "Build FAILED: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
                )
            }
            success {
                slackSend (
                    color: "good", 
                    message: "Build SUCCESS: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
                )
            }
        }
    }
```

### ASICDE-dev-frontend

The Jenkinsfile for the frontend service gets rather complicated since multiple alterations need to be performed in order to prepare the source codes for development build and later deployment with Docker.

In the section "Prepare for dev deployment", you may see that the URL for the API endpoint is being replaced with the actual URL. Next the Dockerfile is replaced since Jenkins builds the project files before it creates a Docker images and the default Dockerfile would build the project once again (which is wasteful). The Jenkins pipeline continues with similar processes of building afterwards.

This build task (or pipeline) is automatically triggered when any new code is pushed to the `dev` branch of the `asicde-frontend` repository.

```groovy
    pipeline {
        
        agent any
    
        stages {
            stage("Clean workspace"){
                steps{
                    cleanWs()
                }
            }
            stage("Pull repository"){
                steps{
                    withCredentials([sshUserPrivateKey(credentialsId: "github", keyFileVariable: 'keyfile')]) {    
                        script{
                            sh "GIT_SSH_COMMAND='ssh -i ${keyfile} -o IdentitiesOnly=yes' git clone -b dev git@github.com:ASICDE/asicde-frontend.git ."
                        }
                    }
                }
            }
            stage("Prepare for dev deployment") {
                steps {
                    script {
                        sh "find . -type f -exec sed -i -e 's/http:\\/\\/localhost:10000/https:\\/\\/api-dev.asicde.org/g' {} \\;"
                        sh 'echo "FROM nginx:1.14.1-alpine \\nCOPY nginx/default.conf /etc/nginx/conf.d/ \\nRUN rm -rf /usr/share/nginx/html/* \\nCOPY dist/asicde-frontend/ /usr/share/nginx/html \\nCMD [\\"nginx\\", \\"-g\\", \\"daemon off;\\"]" > Dockerfile'
                    }
                }
            }
            stage('Build app') {
                steps {
                    script {
                        nodejs(nodeJSInstallationName: 'nodejs') {
                            sh "npm install"
                            sh "npm run build"
                        }
                    }
                }
            }
            stage('Build & push docker images') {
                steps {
                    script {
                            withCredentials([usernamePassword(credentialsId: 'nexus', usernameVariable: 'user', passwordVariable: 'pass')]) {
                            sh "docker login -u ${user} -p ${pass} http://localhost:8082"
                            
                            docker.build("localhost:8082/asicde/frontend-dev:${env.BUILD_ID}")
                            sh "docker image tag localhost:8082/asicde/frontend-dev:${env.BUILD_ID} localhost:8082/asicde/frontend-dev:latest"
                            sh "docker push localhost:8082/asicde/frontend-dev:${env.BUILD_ID}"
                            sh "docker push localhost:8082/asicde/frontend-dev:latest"
                        }
                    }
                }
            }
        }
        post {
            failure {
                slackSend (
                    color: "danger", 
                    message: "Build FAILED: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
                )
            }
            success {
                slackSend (
                    color: "good", 
                    message: "Build SUCCESS: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
                )
            }
        }
    }
```

### ASICDE-deploy-dev

The deployment Jenkinsfile is different from the other pipelines. A lot of preparation of the default file structure is needed in order to set-up the development environment. This task deploys the whole stack from the frontend, the backend, the database and router all in one cluster.

To include frontend in the deployment stack, the `docker-compose.frontend.yml` file is renamed to `docker-compose.override.yml` as the name says, to override and add additional services into the Docker stack. Next a couple of text replacements are made to change the default port mapping and ensure Docker can successfully download images within the internal server network.

After the preparation tasks are complete, the old deployment stack is destroyed and replaced with the new versions of services.

This build task (or pipeline) is automatically triggered when any new code is pushed to the `dev` branch of the `asicde-frontend` repository.

```groovy
    pipeline {
        
        agent any
        
        stages {
            stage("Clean workspace"){
                steps{
                    cleanWs()
                }
            }
            stage("Pull repository"){
                steps{
                    withCredentials([sshUserPrivateKey(credentialsId: "github", keyFileVariable: 'keyfile')]) {    
                        script{
                            sh "GIT_SSH_COMMAND='ssh -i ${keyfile} -o IdentitiesOnly=yes' git clone git@github.com:ASICDE/asicde-docker.git ."
                        }
                    }
                }
            }
            stage("Prepare for dev deployment") {
                steps {
                    script {
                        sh "mv docker-compose.frontend.yml docker-compose.override.yml"
                        sh "sed -i -e 's/- 10000:80/- 10002:80/g' docker-compose.yml"
                        sh "sed -i -e 's/- 10001:80/- 10003:80/g' docker-compose.override.yml"
                        sh "sed -i -e 's/hub.asicde.org\\/asicde\\/router/localhost:8082\\/asicde\\/router/g' docker-compose*"
                        sh "sed -i -e 's/hub.asicde.org\\/asicde\\/auth/localhost:8082\\/asicde\\/auth-dev/g' docker-compose*"
                        sh "sed -i -e 's/hub.asicde.org\\/asicde\\/repo/localhost:8082\\/asicde\\/repo-dev/g' docker-compose*"
                        sh "sed -i -e 's/hub.asicde.org\\/asicde\\/parser/localhost:8082\\/asicde\\/parser-dev/g' docker-compose*"
                        sh "sed -i -e 's/hub.asicde.org\\/asicde\\/frontend/localhost:8082\\/asicde\\/frontend-dev/g' docker-compose*"
                    }
                }
            }
            stage('Deploy website container') {
                steps {
                    script {
                        sh "docker-compose -p asicde-dev down --remove-orphans || true"
                        sh "docker-compose -p asicde-dev up -d"
                    }
                }
            }
        }
        post {
            failure {
                slackSend (
                    color: "danger", 
                    message: "Build FAILED: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
                )
            }
            success {
                slackSend (
                    color: "good", 
                    message: "Build SUCCESS: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
                )
            }
        }
    }
```

## Production version deployment

The production Jenkins pipeline is pretty much a combination of all of the previous tasks. First all repositories are downloaded, the each source code is built, then tested and transformed into a Docker image. The last step is to re-deploy the production-ready application stack that is served on the web.

```groovy
pipeline {
    
    agent any

    stages {
        stage("Clean workspace"){
            steps{
                cleanWs()
            }
        }
        stage("Pull asicde-parent"){
            steps{
                withCredentials([sshUserPrivateKey(credentialsId: "github", keyFileVariable: 'keyfile')]) {    
                    script{
                        sh "GIT_SSH_COMMAND='ssh -i ${keyfile} -o IdentitiesOnly=yes' git clone git@github.com:ASICDE/asicde-parent.git"
                    }
                }
            }
        }
        stage("Pull asicde-api"){
            steps{
                withCredentials([sshUserPrivateKey(credentialsId: "github", keyFileVariable: 'keyfile')]) {    
                    script{
                        sh "GIT_SSH_COMMAND='ssh -i ${keyfile} -o IdentitiesOnly=yes' git clone git@github.com:ASICDE/asicde-api.git"
                    }
                }
            }
        }
        stage("Pull asicde-backend"){
            steps{
                withCredentials([sshUserPrivateKey(credentialsId: "github", keyFileVariable: 'keyfile')]) {    
                    script{
                        sh "GIT_SSH_COMMAND='ssh -i ${keyfile} -o IdentitiesOnly=yes' git clone git@github.com:ASICDE/asicde-backend.git"
                    }
                }
            }
        }
        stage("Pull asicde-frontend"){
                steps{
                withCredentials([sshUserPrivateKey(credentialsId: "github", keyFileVariable: 'keyfile')]) {    
                    script{
                        sh "GIT_SSH_COMMAND='ssh -i ${keyfile} -o IdentitiesOnly=yes' git clone git@github.com:ASICDE/asicde-frontend.git"
                    }
                }
            }
        }
        stage("Pull asicde-docker"){
            steps{
                withCredentials([sshUserPrivateKey(credentialsId: "github", keyFileVariable: 'keyfile')]) {    
                    script{
                        sh "GIT_SSH_COMMAND='ssh -i ${keyfile} -o IdentitiesOnly=yes' git clone git@github.com:ASICDE/asicde-docker.git"
                    }
                }
            }
        }
        stage("Gather POM dependencies"){
            steps{
                script{
                    dir("asicde-parent") {
                        sh "mvn -DskipTests clean install -nsu"
                    }
                }
            }
        }
        stage("Build API"){
            steps{
                script{
                    dir("asicde-api") {
                        sh "mvn -DskipTests clean install -nsu"
                    }
                }
            }
        }
        stage("Test API"){
            steps{
                script{
                    dir("asicde-api") {
                        sh "mvn test"
                    }
                }
            }
        }
        stage("Build backend"){
            steps{
                script{
                    dir("asicde-backend") {
                        sh "mvn -DskipTests clean install -nsu"
                    }
                }
            }
        }
        stage("Test backend"){
            steps{
                script{
                    dir("asicde-backend") {
                        sh "mvn test"
                    }
                }
            }
        }
        stage("Prepare frontend for deployment") {
            steps {
                script {
                    dir("asicde-frontend") {
                        sh "find . -type f -exec sed -i -e 's/http:\\/\\/localhost:10000/https:\\/\\/api.asicde.org/g' {} \\;"
                    }
                }
            }
        }
        stage('Build app') {
            steps {
                script {
                    dir("asicde-frontend") {
                        nodejs(nodeJSInstallationName: 'nodejs') {
                            sh "npm install"
                            sh "npm run build"
                        }
                    }
                }
            }
        }
        stage('Build & push docker images') {
            steps {
                script {
                    dir("asicde-backend") {
                        withCredentials([usernamePassword(credentialsId: 'nexus', usernameVariable: 'user', passwordVariable: 'pass')]) {
                            sh "docker login -u ${user} -p ${pass} http://localhost:8082"
                            
                            dir("auth"){
                                docker.build("localhost:8082/asicde/auth:${env.BUILD_ID}")
                                sh "docker image tag localhost:8082/asicde/auth:${env.BUILD_ID} localhost:8082/asicde/auth:latest"
                                sh "docker push localhost:8082/asicde/auth:${env.BUILD_ID}"
                                sh "docker push localhost:8082/asicde/auth:latest"
                            }
                            dir("parser"){
                                docker.build("localhost:8082/asicde/parser:${env.BUILD_ID}")
                                sh "docker image tag localhost:8082/asicde/parser:${env.BUILD_ID} localhost:8082/asicde/parser:latest"
                                sh "docker push localhost:8082/asicde/parser:${env.BUILD_ID}"
                                sh "docker push localhost:8082/asicde/parser:latest"
                            }
                            dir("repo"){
                                docker.build("localhost:8082/asicde/repo:${env.BUILD_ID}")
                                sh "docker image tag localhost:8082/asicde/repo:${env.BUILD_ID} localhost:8082/asicde/repo:latest"
                                sh "docker push localhost:8082/asicde/repo:${env.BUILD_ID}"
                                sh "docker push localhost:8082/asicde/repo:latest"
                            }
                        }
                    }
                    dir("asicde-frontend") {
                        withCredentials([usernamePassword(credentialsId: 'nexus', usernameVariable: 'user', passwordVariable: 'pass')]) {
                            sh "docker login -u ${user} -p ${pass} http://localhost:8082"
                            
                            docker.build("localhost:8082/asicde/frontend:${env.BUILD_ID}")
                            sh "docker image tag localhost:8082/asicde/frontend:${env.BUILD_ID} localhost:8082/asicde/frontend:latest"
                            sh "docker push localhost:8082/asicde/frontend:${env.BUILD_ID}"
                            sh "docker push localhost:8082/asicde/frontend:latest"
                        }
                    }
                }
            }
        }
        stage("Prepare docker-compose for deployment") {
            steps {
                script {
                    dir("asicde-docker") {
                        sh "mv docker-compose.frontend.yml docker-compose.override.yml"
                        sh "sed -i -e 's/hub.asicde.org\\/asicde\\/router/localhost:8082\\/asicde\\/router/g' docker-compose*"
                        sh "sed -i -e 's/hub.asicde.org\\/asicde\\/auth/localhost:8082\\/asicde\\/auth/g' docker-compose*"
                        sh "sed -i -e 's/hub.asicde.org\\/asicde\\/repo/localhost:8082\\/asicde\\/repo/g' docker-compose*"
                        sh "sed -i -e 's/hub.asicde.org\\/asicde\\/parser/localhost:8082\\/asicde\\/parser/g' docker-compose*"
                        sh "sed -i -e 's/hub.asicde.org\\/asicde\\/frontend/localhost:8082\\/asicde\\/frontend/g' docker-compose*"
                    }
                }
            }
        }
        stage('Deploy application stack') {
            steps {
                script {
                    dir("asicde-docker") {
                        sh "docker-compose -p asicde-prod down --remove-orphans || true"
                        sh "docker-compose -p asicde-prod up -d"
                    }
                }
            }
        }
    }
    post {
        failure {
            slackSend (
                color: "danger", 
                message: "Build FAILED: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
            )
        }
        success {
            slackSend (
                color: "good", 
                message: "Build SUCCESS: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
            )
        }
    }
}
```

[<< Return to documentation overview](README.md)

[>> Go to repository](https://github.com/ASICDE/asicde-frontend)

# ASICDE Frontend

This repository holds source code for the Frontend interface for ASICDE. It is a fully-fledged application developed in AngularJS.

## Prerequisites for development

In order to successfully install and run the application, the following tools need to be installed:

- [NodeJS](https://nodejs.org/en/)
- [Angular CLI](https://cli.angular.io/)
- (Optional) [Docker](https://www.docker.com/) - When a production-ready backend is needed for development and testing - for more information please take a look at [Docker deployment](asicde-docker.md)

## Installation

Before you are able to serve the application, you need to install all of the dependencies. To do this, run the following commands inside of the project folder:

```bash
cd asicde-fronted
npm install
```

## Development server

Run `ng serve` for a dev server. Navigate to `http://localhost:4200/`. The app will automatically reload if you change any of the source files.

## Code scaffolding

Run `ng generate component component-name` to generate a new component. You can also use `ng generate directive|pipe|service|class|guard|interface|enum|module`.

## Build

Run `ng build` to build the project. The build artifacts will be stored in the `dist/` directory. Use the `--prod` flag for a production build.

## Running unit tests

Run `ng test` to execute the unit tests via [Karma](https://karma-runner.github.io).

## Running end-to-end tests

Run `ng e2e` to execute the end-to-end tests via [Protractor](http://www.protractortest.org/).

## Further help

To get more help on the Angular CLI use `ng help` or go check out the [Angular CLI README](https://github.com/angular/angular-cli/blob/master/README.md).


## Isomorphic-git
To compile Isomorphic-git module you have to @ts-ignore every problematic line of cone in library. The library is not compiled in TypeScript.

[<< Return to documentation overview](README.md)

# ASICDE project website

This project contains the official website for the ASICDE project. You can visit the site over at [www.asicde.org](https://www.asicde.org).

## Requirements

The website is build with the ReactJS framework. To build it on your own, you will need the following prerequisites:

- [NodeJS](https://nodejs.org/en/download/) (verify if you have access to `nodejs` and `npm` commands)
- (Optional) [Docker](https://docs.docker.com/desktop/) - for deployment of Docker image

## Building the web application

### Local development

- `git clone git@github.com:ASICDE/website.git`
- `cd ./website`
- `npm install`
- `npm start`

### Production deployment

- `git clone git@github.com:ASICDE/website.git`
- `cd ./website`
- `npm install`
- `npm run build`

The above command will build the source code and provide you with HTML, CSS and JavaScript files in the `./build` directory that are ready for deployment.

You may also use the included `Dockerfile` to build an independent Docker image. To do this, run the following commands:

- `git clone git@github.com:ASICDE/website.git`
- `cd ./website`
- `npm install`
- `npm run build`
- `docker build -t website .`

These command will create a Docker image with the tag of `website`. To deploy the Docker image, you can run the following command:

- `docker run -d -p 80:80 --name website website`

## Available Scripts

In the project directory, you can run:

### `npm start`

Runs the app in the development mode.<br />
Open [http://localhost:3000](http://localhost:3000) to view it in the browser.

The page will reload if you make edits.<br />
You will also see any lint errors in the console.

### `npm test`

Launches the test runner in the interactive watch mode.<br />
See the section about [running tests](https://facebook.github.io/create-react-app/docs/running-tests) for more information.

### `npm run build`

Builds the app for production to the `build` folder.<br />
It correctly bundles React in production mode and optimizes the build for the best performance.

The build is minified and the filenames include the hashes.<br />
Your app is ready to be deployed!

See the section about [deployment](https://facebook.github.io/create-react-app/docs/deployment) for more information.

### `npm run eject`

**Note: this is a one-way operation. Once you `eject`, you can’t go back!**

If you aren’t satisfied with the build tool and configuration choices, you can `eject` at any time. This command will remove the single build dependency from your project.

Instead, it will copy all the configuration files and the transitive dependencies (webpack, Babel, ESLint, etc) right into your project so you have full control over them. All of the commands except `eject` will still work, but they will point to the copied scripts so you can tweak them. At this point you’re on your own.

You don’t have to ever use `eject`. The curated feature set is suitable for small and middle deployments, and you shouldn’t feel obligated to use this feature. However we understand that this tool wouldn’t be useful if you couldn’t customize it when you are ready for it.
# ASICDE-SYNTHESIS

Synthesis process is dynamicaly run in docker container. You need to build `syn` image first.

Build command:
`docker build -t syn .`

This image uses `Qflow - An Open-Source Digital Synthesis Flow` package of tools.
This package includes:
- **Yosys** - Verilog parser, high-level synthesis, and logic optimization and verification
- **Odin-II** - Verilog parser and logic verification
- **Graywolf** - Placement
- **Qrouter** - Detail Router
- **Vesta** - Static Timing Analysis
- **Magic 8.1** - Layout viewer

All parts except Magic are used to complete the synthsis process. Magic is not used in ASICDE synthesis implementation at all.

**Qflow** is installed using APT during image build process (with added packages, such as `zip` package and so...). - See Dockerfile

**You dont need to install anything to build this image. Everything will be installed during the docker build process...**

For more information about Qflow, visit: [Qflow documentation page](http://opencircuitdesign.com/qflow/ "Qflow documentation")

## For local development
Obviously, you need to have docker installed on your computer.
Run build command (above) in the `asicde-synthesis` folder (root directory).
This will build image with the name `syn`. No additional configuration is needed.

#### Main parts of the image
`Dockerfile` - defines the image

`syn.py` - Python script that runs the synthesis in container's console and communicates with BE (core).

## Production use
Using the github actions, image is being built after every change (commit) in `asicde-synthesis` repository in the branch `main`
To properly comminucate with BE, container created using this image needs to be in `asicde-network`.

## Testing
You should be able to run synthesis process from the ASICDE app.
You can test the functionalities using `/asicde-synthesis/sources/map9v3.v` code. This code is recommended for testing by Qflow authors.

You will not be able to run container manually. Python script uses enviroment variables:

- AUTHOR_UUID
- SYNTHESIS_UUID
- REPOSITORY_UUID
- AUTH_TOKEN
- STOP_AT
- TECHNOLOGY

to create correct URLs for communication with BE, to authorize requests and to provide correct settings for the synthtisation process. These variables are provided by BE during container creation and are specific for . Therefore, there is no way to authorize requests from manually created container.


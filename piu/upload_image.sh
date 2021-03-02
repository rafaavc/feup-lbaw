#!/bin/bash

# Stop execution if a step fails
set -e

DOCKER_USERNAME=2dukes
IMAGE_NAME=lbaw2135-piu

docker build -t $DOCKER_USERNAME/$IMAGE_NAME .
docker push $DOCKER_USERNAME/$IMAGE_NAME

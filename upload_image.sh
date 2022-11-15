#!/bin/bash

# Stop execution if a step fails
set -e

IMAGE_NAME=git.fe.up.pt:5050/lbaw/lbaw2122/lbaw2294 # Replace with your group's image name

# Ensure that dependencies are available
composer install
php artisan clear-compiled
php artisan optimize

#docker buildx build --push --platform linux/amd64 -t $IMAGE_NAME .
docker build -f Dockerfile.prod -t $IMAGE_NAME .
docker push $IMAGE_NAME

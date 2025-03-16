# Payment Mircoservice
An awesome payment microservice!

## Getting Started
1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run docker compose build --no-cache to build fresh images
3. Run docker compose up -d --wait to set up and start the project
4. open http://localhost/api/doc in your browser to see the swagger documentation.
5. Run `docker compose down --remove-orphans` to stop the Docker containers.
6. Run `make test "c=--coverage"` to run the tests.
7. Run `make sf app:purchase-one-time shift4` to run the command.

## Features
1. Purchase one time.
* Using Shift4 integration.
* Using ACI (Oppwa) integration.
2. Code test coverage +90%.

## Credits
Created by [Ahmed Yahia](https://www.linkedin.com/in/ahmad-yahia/).

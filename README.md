# Payment Mircoservice
An awesome payment microservice!

## Getting Started
1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run docker compose build --no-cache to build fresh images
3. Run docker compose up -d --wait to set up and start the project
4. open http://localhost/api/doc in your browser to see the swagger documentation.
5. Run `make test "c=--coverage"` to run the tests.
6. Run `make sf "c=app:purchase-one-time shift4"` to run the command.

## Features
1. One-time purchase capabilities.
   * Integration with Shift4.
   * Integration with ACI (Oppwa).
2. Test coverage exceeding 90%.
3. Architecture tests.
4. Swagger documentation available at http://localhost/api/doc
5. Dockerized and containerized platform.
6. Makefile with all the necessary commands to run the application.

## Credits
Created by [Ahmed Yahia](https://www.linkedin.com/in/ahmad-yahia/).

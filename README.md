# Payment Mircoservice

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run docker compose build --no-cache to build fresh images
3. Run docker compose up -d --wait to set up and start the project
4. Run `docker compose down --remove-orphans` to stop the Docker containers.
5. Run `docker compose exec -T php /app/vendor/bin/pest --coverage` to run the tests.
6. Run `docker compose exec -T php /app/bin/console app:purchase-one-time shift4` to run the command.

## Features
1. Purchase one time.
* Using Shift4 integration.
* Using ACI (Oppwa) integration.
2. Code test coverage.

## Docs
1. TODO: [How to add a new external system](docs/add-external-system.md)

## Credits

Created by [Ahmed Yahia](https://www.linkedin.com/in/ahmad-yahia/).
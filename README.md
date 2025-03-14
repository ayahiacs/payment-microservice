# Payment Mircoservice

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose up -d --wait` to start
3. Run `docker compose down --remove-orphans` to stop the Docker containers.
4. Run `docker compose exec -T php /app/vendor/bin/pest --coverage` to run the tests.

## Features
1. Purchase one time.
* For Shift4
* For ACI (Oppwa)
2. 100% test coverage.

## Docs
1. TODO: [How to add a new external system](docs/add-external-system.md)

## Credits

Created by [Ahmed Yahia](https://www.linkedin.com/in/ahmad-yahia/).
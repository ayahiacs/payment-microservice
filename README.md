# Payment Mircoservice

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run docker compose build --no-cache to build fresh images
3. Run docker compose up -d --wait to set up and start the project
4. open http://localhost/api/doc in your browser to see the swagger documentation.
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

## Todo
1. Handle the third party error responses.
2. Add extensive logs.
3. Retry the failed calls in case of server error.
4. Save them as failed if failed for many times.
5. Swagger documentation.
6. Code comments.
7. PHPStan, PHP_CodeSniffer, PHPat.
8. CI/CD.
9. Caching, Cron jobs.
10. Jobs.

## Credits

Created by [Ahmed Yahia](https://www.linkedin.com/in/ahmad-yahia/).
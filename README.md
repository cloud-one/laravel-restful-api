# laravel RESTful API Boilerplate

## Running the app
```bash
# going up the containers
docker-compose up -d

# installing the dependencies
composer install

# or
docker exec -it app-api composer install
```

Rename the file `.env.example` for `.env`.

Execute as migrations e seeds:
`docker exec -it app-api php artisan migrate --seed`

## Updating the documentation
`docker exec -it app-api php artisan api:generate --routePrefix="api/v1/*" --noResponseCalls --force`
or
`./docs`

Documentation will be available at `localhost:8080/docs/`

## Tests
`docker exec -it app-api vendor/bin/phpunit`

# API Documentation

http://localhost/docs/

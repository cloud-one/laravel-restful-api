# laravel RESTful API Boilerplate

## Rodando a aplicação
```bash
# subindo os containers
docker-compose up -d

# instalando as dependências
composer install

# ou
docker exec -it app-api composer install
```

Renomeie o arquivo `.env.example` para `.env`.

Execute as migrations e seeds:
`docker exec -it app-api php artisan migrate --seed`

## Atualizando a documentação
`docker exec -it app-api php artisan api:generate --routePrefix="api/v1/*" --noResponseCalls --force`
ou
`./docs`

A documentação ficará disponível em `localhost:8080/docs/`

## Testes
`docker exec -it app-api vendor/bin/phpunit`

# Documentação da API

http://localhost/docs/
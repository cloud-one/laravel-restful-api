FROM petronetto/php-nginx-alpine

MAINTAINER Juliano Petronetto <juliano@petronetto.com.br>

COPY ./ /app

RUN chown -R www:www /app

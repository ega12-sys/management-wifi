FROM dunglas/frankenphp:php8.4

WORKDIR /var/www

RUN install-php-extensions pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

COPY Caddyfile /etc/caddy/Caddyfile

RUN composer install

EXPOSE 8000

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile", "--adapter", "caddyfile"]

FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
cron \
libpq-dev \
librabbitmq-dev \
&& docker-php-ext-install pdo pdo_pgsql

COPY crontab /etc/cron.d/crontab

RUN chmod 0644 /etc/cron.d/crontab \
    && crontab /etc/cron.d/crontab \
    && touch /var/log/cron.log

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 5432

CMD cron && tail -f /var/log/cron.log
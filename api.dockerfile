FROM devpledge/phpfpm-swoole:latest

WORKDIR /var/www

COPY ./ /var/www

RUN apt-get update \
    mysql-client libssl-dev --no-install-recommends \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --prefer-source --no-interaction

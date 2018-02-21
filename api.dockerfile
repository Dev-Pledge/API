FROM devpledge/phpfpm-swoole:latest

WORKDIR /var/www

COPY ./ /var/www

RUN composer install --prefer-source --no-interaction

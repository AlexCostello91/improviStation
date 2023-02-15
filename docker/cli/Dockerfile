FROM php:8.2.1-cli-alpine
RUN apk update \
    && apk add --no-cache sudo bash git vim less pv curl nodejs npm \
    && docker-php-ext-install pdo_mysql \
    && sudo chown -R www-data:www-data /var/www/html \
    && curl -sSL https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && npm install --global yarn
CMD ["sleep", "infinity"]

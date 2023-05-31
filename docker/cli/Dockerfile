FROM php:8.2.1-cli-alpine
RUN apk update \
    && addgroup -g 1000 -S dev && adduser -u 1000 -D dev -G dev \
    && apk add --no-cache sudo bash git vim less pv curl nodejs npm mysql-client openssh \
    && docker-php-ext-install pdo_mysql \
    && curl -sSL https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && npm install --global yarn
CMD ["sleep", "infinity"]

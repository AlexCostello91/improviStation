FROM php:8.2.1-fpm
RUN  apt-get update \
    && apt-get install -y sudo \
        vim \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
		git \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql \
    && pecl install redis \
	&& docker-php-ext-enable redis \
	&& curl -sSL https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

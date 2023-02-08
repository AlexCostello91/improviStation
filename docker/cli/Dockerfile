FROM php:8.2.1-cli
# ENV NODE_VERSION=16.13.0
# RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
# ENV NVM_DIR=/root/.nvm
# RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
# RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
# RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
# ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"
RUN  apt-get update \
    && apt-get install -y sudo \
        vim \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
		git \
        npm \
        nodejs \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql \
	&& curl -sSL https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
	&& chown -R www-data:www-data /var/www
CMD ["sleep", "infinity"]

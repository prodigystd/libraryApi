FROM php:8.1-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev libxml2-dev zip wget gcc libpq-dev libpng-dev \
    && docker-php-ext-install intl opcache pdo pdo_mysql pdo_pgsql xml ctype \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install mysqli \
    && rm -r /var/lib/apt/lists/*

ENV PATH "/composer/vendor/bin:$PATH"
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV COMPOSER_VERSION 2.1.14
ENV COMPOSER_MEMORY_LIMIT=1G
ENV TZ=Europe/UTC

RUN EXPECTED_COMPOSER_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig) \
	&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
	&& php -r "if (hash_file('SHA384', 'composer-setup.php') === '${EXPECTED_COMPOSER_SIGNATURE}') { echo 'Composer.phar Installer verified'; } else { echo 'Composer.phar Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
	&& php composer-setup.php --no-ansi --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION} \
	&& php -r "unlink('composer-setup.php');" \
    && composer config --global repo.packagist composer https://packagist.org && \
       composer --ansi --version --no-interaction && \
       composer clear-cache

COPY symfony.pool.conf  /usr/local/etc/
COPY opcache.ini /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

RUN usermod -u 1000 www-data

WORKDIR /var/www/html
EXPOSE 9000
CMD ["php-fpm", "-F"]


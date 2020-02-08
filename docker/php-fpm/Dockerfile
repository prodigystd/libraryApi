FROM php:7.1-fpm

MAINTAINER Nicola Pietroluongo <nik.longstone@gmail.com>

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        apt-utils \
        libxml2-dev \
        zlib1g-dev \
        zip \
        libcurl4 \
        libpcre3-dev \
        libcurl4-openssl-dev \
    && docker-php-ext-install -j$(nproc) iconv mcrypt pdo_mysql mbstring \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install soap \
    && docker-php-ext-install zip

COPY symfony.pool.conf  /usr/local/etc/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN usermod -u 1000 www-data

EXPOSE 9000
CMD ["php-fpm", "-F"]